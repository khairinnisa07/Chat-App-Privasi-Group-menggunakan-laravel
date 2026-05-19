<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = ['percakapan_id', 'user_id', 'body'];

    public function percakapan()
    {
        return $this->belongsTo(Percakapan::class, 'percakapan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}