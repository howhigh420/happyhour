<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Happy Hour - @yield('title')</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      <link rel="stylesheet" href="resources/css/style.css">
      @vite(['resources/scss/app.scss', 'resources/js/app.js'])
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">Happy Hour</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav me-auto">
                      <li class="nav-item"><a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a></li>
                      <li class="nav-item"><a class="nav-link {{ request()->is('deposit/fiat') ? 'active' : '' }}" href="{{ url('/deposit/fiat') }}">Deposit Fiat</a></li>
                      <li class="nav-item"><a class="nav-link {{ request()->is('deposit/crypto') ? 'active' : '' }}" href="{{ url('/deposit/crypto') }}">Deposit Crypto</a></li>
                      <li class="nav-item"><a class="nav-link {{ request()->is('portfolio') ? 'active' : '' }}" href="{{ url('/portfolio') }}">Portfolio</a></li>
                  </ul>
                  <ul class="navbar-nav ms-auto">
                      @auth
                          <li class="nav-item"><a class="nav-link {{ request()->is('profile/*') ? 'active' : '' }}" href="{{ route('profile.show', auth()->user()) }}">Profile</a></li>
                          <li class="nav-item">
                              <form action="{{ url('/logout') }}" method="POST">
                                  @csrf
                                  <button type="submit" class="nav-link btn btn-link">Logout</button>
                              </form>
                          </li>
                      @else
                          <li class="nav-item"><a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ url('/login') }}">Login</a></li>
                      @endauth
                  </ul>
              </div>
          </div>
      </nav>
      <main class="container py-4">
          @if (session('status'))
              <div class="alert alert-success">{{ session('status') }}</div>
          @endif
          @yield('content')
      </main>
  </body>
  </html>