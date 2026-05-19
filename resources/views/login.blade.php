<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container">
    <h2>Login</h2>
      <form action="/login" method="POST">
        @csrf
        <div class="input-box">
          <input type="email" name="email" placeholder="Email">
        </div>     
        <div class="input-box">
          <input type="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="link">Belum punya akun?<a href="daftar">Daftar</a></div>
      </form>
  </div>
</body>
</html>