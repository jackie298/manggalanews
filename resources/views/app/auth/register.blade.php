@include('layouts.app-login')

<body>
  <div class="wrapper">
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <h2>Form Registrasi</h2>

      <div class="input-field">
        <input type="text" name="name" required value="{{ old('name') }}">
        <label>Nama Lengkap</label>
        @error('name')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>

      <div class="input-field">
        <input type="text" name="username" required value="{{ old('username') }}">
        <label>Username</label>
        @error('username')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>

      <div class="input-field">
        <input type="email" name="email" required value="{{ old('email') }}">
        <label>Email</label>
        @error('email')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>

      <div class="input-field">
        <input type="password" name="password" required>
        <label>Password</label>
        @error('password')
            <span style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>

      <div class="input-field">
        <input type="password" name="password_confirmation" required>
        <label>Konfirmasi Password</label>
      </div>

      <button type="submit">Daftar</button>

      <div style="text-align: center; color: #fff; margin-top: 20px;">
        <p style="font-size: 12px;">ATAU</p>
      </div>

      <div class="google-login" style="margin-top: 20px;">
        <a href="{{ route('login.google') }}" style="display: inline-block; padding: 10px 20px; background: #dd4b39; color: #fff; border-radius: 2px; font-weight: bold;">
          <i class="fab fa-google"></i> Daftar Dengan Google
        </a>
      </div>

      <div class="register">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}"
        });
    </script>
  @endif

  @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}"
        });
    </script>
  @endif

</body>
</html>
