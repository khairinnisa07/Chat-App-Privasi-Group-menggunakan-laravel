<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Grup</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="layer">
    <h1>Buat Grup Chat</h1>

    <form action="/group/store" method="POST">
        @csrf

        <input 
            type="text" 
            name="name" 
            placeholder="Nama grup"
            required
        >
        <br>

        <h3>Pilih Anggota</h3>

        @foreach($users as $user)
            <div style="margin-bottom:10px;">
                <input 
                    type="checkbox"
                    name="members[]"
                    value="{{ $user->id }}"
                >
                {{ $user->name }}
            </div>
        @endforeach
        <br>

        <button type="submit" class="tombol">
            Buat Grup
        </button>
    </form>

</div>

</body>
</html>