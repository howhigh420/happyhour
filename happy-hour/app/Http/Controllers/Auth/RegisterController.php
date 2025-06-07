<?php

  namespace App\Http\Controllers\Auth;

  use App\Http\Controllers\Controller;
  use App\Models\User;
  use Illuminate\Foundation\Auth\RegistersUsers;
  use Illuminate\Support\Facades\Hash;
  use Illuminate\Support\Facades\Validator;

  class RegisterController extends Controller
  {
      use RegistersUsers;

      protected $redirectTo = '/dashboard';

      public function __construct()
      {
          $this->middleware('guest');
      }

      protected function validator(array $data)
      {
          return Validator::make($data, [
              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'phone' => ['required', 'string', 'max:20'],
              'country' => ['required', 'string', 'max:2'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
              'terms' => ['required', 'accepted'],
          ]);
      }

      protected function create(array $data)
      {
          return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'phone' => $data['phone'],
              'country' => $data['country'],
              'password' => Hash::make($data['password']),
              'email_verified_at' => now(), // Auto-verify for testing
          ]);
      }
  }