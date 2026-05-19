<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
  <h2>Daftar</h2>

  <form action="/daftar" method="POST">
    @csrf
    <div class="input-box">
        <input type="text" name="name" placeholder="Nama Pengguna">
    </div>

    <div class="input-box">
        <input type="email" name="email" placeholder="Email">
    </div>

    <div class="input-box">
        <input type="password" name="password" placeholder="Password">
    </div>

    <button type="submit" class="btn">Daftar</button>
    <p class="link">Sudah punya akun? <a href="login">Login</a>
    </p>
  </form>
</div>

</body>
</html>