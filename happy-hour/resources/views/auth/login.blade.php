@extends('layouts.app')
  @section('title', 'Login')
  @section('content')
  <div class="container py-5">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header">
                      <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Login</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{ route('login') }}">
                          @csrf
                          <div class="mb-3">
                              <label for="email" class="form-label">Email Address</label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label class="form-check-label" for="remember">Remember Me</label>
                          </div>
                          <div class="d-flex justify-content-between align-items-center">
                              <button type="submit" class="btn btn-primary">Sign In</button>
                              @if (Route::has('password.request'))
                                  <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Password?</a>
                              @endif
                          </div>
                      </form>
                      <p class="mt-3 text-center">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection