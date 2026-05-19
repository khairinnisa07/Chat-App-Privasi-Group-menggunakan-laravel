<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Percakapan;
use App\Models\Anggota;
use App\Models\Pesan;
use App\Models\User;

class chatController extends Controller
{
    public function bukaPercakapan($userId)
    {
        $saya = auth()->id();
        $percakapan = Percakapan::where('type', 'private')
            ->whereHas('anggota', fn($q) => $q->where('user_id', $saya))
            ->whereHas('anggota', fn($q) => $q->where('user_id', $userId))
            ->first();

        if (!$percakapan) {
            $percakapan = Percakapan::create([
                'type' => 'private',
                'created_by' => $saya,]);

            Anggota::create([
                'percakapan_id' => $percakapan->id,
                'user_id' => $saya]);

            Anggota::create([
                'percakapan_id' => $percakapan->id,
                'user_id' => $userId]);
        }

        return redirect()->route('chat.show', $percakapan->id);
    }

    public function show($percakapanId)
    {
        $percakapan = Percakapan::with([
            'pesan.user',
            'anggota.user'
        ])->findOrFail($percakapanId);

        $pesanList = $percakapan->pesan()
            ->with('user')
            ->orderBy('created_at')
            ->get();

        $lawanBicara = $percakapan->anggota
            ->firstWhere('user_id', '!=', auth()->id())?->user;

        $users = User::where('id', '!=', auth()->id())->get();

        $groupChats = Percakapan::where('type', 'group')->get();

        return view(
            'dashboard',
            compact(
                'percakapan',
                'pesanList',
                'lawanBicara',
                'users',
                'groupChats'
            )
        );
    }

    public function kirim(Request $request, $percakapanId)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        $pesan = Pesan::create([
            'percakapan_id' => $percakapanId,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return response()->json([
            'status' => 'ok',

            'pesan' => [
                'id' => $pesan->id,
                'body' => $pesan->body,
                'user_id' => $pesan->user_id,
                'created_at' => $pesan->created_at->format('H:i'),
            ]
        ]);
    }

    public function createGroup()
    {
        $users = User::where(
            'id',
            '!=',
            auth()->id()
        )->get();

        return view('group', compact('users'));
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'members' => 'required|array']);

        $percakapan = Percakapan::create([
            'type' => 'group',
            'name' => $request->name,
            'created_by' => auth()->id(),]);

        Anggota::create([
            'percakapan_id' => $percakapan->id,
            'user_id' => auth()->id(),]);

        foreach ($request->members as $memberId) {

            Anggota::create([
                'percakapan_id' => $percakapan->id,
                'user_id' => $memberId,]);
        }

        return redirect()->route(
            'chat.show',
            $percakapan->id
        );
    }
}