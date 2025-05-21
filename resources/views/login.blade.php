<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Salon</title>
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <div class="login-container">
    <h2>Login Salon</h2>
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
      </div>
      <div class="input-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" required />
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror
      </div>
      <button type="submit" class="login-btn">Masuk</button>
      <a href="#" class="forgot-password">Lupa Kata Sandi?</a>
      <div class="register-link">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
      </div>
    </form>
  </div>

  <script>
    function validateLogin() {
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;

      if (email === "" || password === "") {
        alert("Silakan isi semua kolom.");
        return false;
      }

      // Tambahkan autentikasi backend di sini (misalnya: API call)
      alert("Login berhasil (simulasi)");
      return false; // prevent actual form submission
    }
  </script>

</body>
</html>
