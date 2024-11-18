@include('partials.head')

<body>
  <div class="auth-main">
    <div class="auth-wrapper v1">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <h4 class="text-center f-w-500 mb-3">Login with your email</h4>

            <!-- Menampilkan pesan error jika ada -->
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
              @csrf
              <div class="form-group mb-3">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
              </div>
              <div class="form-group mb-3">
                <input type="password" class="form-control" id="floatingInput1" name="password" placeholder="Password" required>
              </div>
              <div class="d-flex mt-1 justify-content-between align-items-center">
                <div class="form-check">
                  <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" name="remember" checked="{{ old('remember') ? 'checked' : '' }}">
                  <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                </div>
                <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
              </div>
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
