@extends('layouts.app')
  @section('title', 'Register')
  @section('content')
  <div class="container py-5">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">
                      <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Register</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{ route('register') }}">
                          @csrf
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <label for="name" class="form-label">Full Name</label>
                                  <div class="input-group">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                      @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label for="email" class="form-label">Email Address</label>
                                  <div class="input-group">
                                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <label for="phone" class="form-label">Phone Number</label>
                                  <div class="input-group">
                                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                      <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="tel">
                                      @error('phone')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label for="country" class="form-label">Country</label>
                                  <select class="form-select @error('country') is-invalid @enderror" id="country" name="country" required>
                                      <option selected disabled>Select Country</option>
                                      <option value="US">United States</option>
                                      <option value="KE">Kenya</option>
                                      <option value="NG">Nigeria</option>
                                      <!-- Add more countries as needed -->
                                  </select>
                                  @error('country')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <label for="password" class="form-label">Password</label>
                                  <div class="input-group">
                                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label for="password_confirmation" class="form-label">Confirm Password</label>
                                  <div class="input-group">
                                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                                  </div>
                              </div>
                          </div>
                          <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                              <label class="form-check-label" for="terms">I agree to the <a href="#" target="_blank">terms and conditions</a></label>
                          </div>
                          <div class="d-flex justify-content-between align-items-center">
                              <button type="submit" class="btn btn-primary">Register</button>
                              <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection