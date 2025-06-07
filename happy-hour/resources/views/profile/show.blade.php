@extends('layouts.app')
  @section('title', 'Profile')
  @section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card mb-4">
              <div class="card-header bg-primary text-white">
                  <h4 class="mb-0">Profile: {{ $user->name }}</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <p><strong>Name:</strong> {{ $user->name }}</p>
                          <p><strong>Email:</strong> {{ $user->email }}</p>
                          <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                      </div>
                      <div class="col-md-6 text-md-end">
                          <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection