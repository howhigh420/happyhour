@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="container-fluid px-4">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-edit text-primary me-2"></i>Edit User
            </h1>
            <p class="text-muted mb-0">Update user information and permissions</p>
        </div>
    </div>

    <div class="row">
        {{-- User Avatar Card --}}
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-3" 
                         src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=150' }}" 
                         style="width: 150px; height: 150px; object-fit: cover;"
                         id="avatarPreview">
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    
                    {{-- Avatar Upload --}}
                    <form id="avatarForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="avatar" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-camera me-1"></i>Change Avatar
                            </label>
                            <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                        </div>
                    </form>
                    
                    {{-- Current Status --}}
                    <div class="mb-3">
                        @if($user->is_admin)
                            <span class="badge bg-danger">
                                <i class="fas fa-shield-alt me-1"></i>Administrator
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                <i class="fas fa-user me-1"></i>User
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Account Actions --}}
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Account Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if(!$user->email_verified_at)
                            <button class="btn btn-success btn-sm" onclick="verifyUser({{ $user->id }})">
                                <i class="fas fa-check-circle me-2"></i>Verify Email
                            </button>
                        @endif
                        
                        <button class="btn btn-warning btn-sm" onclick="resetPassword({{ $user->id }})">
                            <i class="fas fa-key me-2"></i>Reset Password
                        </button>
                        
                        @if($user->id !== auth()->id())
                            <button class="btn btn-outline-danger btn-sm" onclick="suspendUser({{ $user->id }})">
                                <i class="fas fa-ban me-2"></i>Suspend Account
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Form --}}
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" id="userForm">
                        @csrf
                        @method('PATCH')

                        {{-- Basic Information --}}
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">Basic Information</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        Full Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $user->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">
                                        Email Address <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $user->email) }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                                    <input type="tel" 
                                           name="phone" 
                                           id="phone"
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="timezone" class="form-label fw-bold">Timezone</label>
                                    <select name="timezone" id="timezone" class="form-select">
                                        <option value="">Select Timezone</option>
                                        <option value="UTC" {{ old('timezone', $user->timezone) == 'UTC' ? 'selected' : '' }}>UTC</option>
                                        <option value="America/New_York" {{ old('timezone', $user->timezone) == 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                                        <option value="America/Chicago" {{ old('timezone', $user->timezone) == 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                        <option value="America/Denver" {{ old('timezone', $user->timezone) == 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                        <option value="America/Los_Angeles" {{ old('timezone', $user->timezone) == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                                        <option value="Europe/London" {{ old('timezone', $user->timezone) == 'Europe/London' ? 'selected' : '' }}>London</option>
                                        <option value="Europe/Paris" {{ old('timezone', $user->timezone) == 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                                        <option value="Asia/Tokyo" {{ old('timezone', $user->timezone) == 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Permissions & Access --}}
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">Permissions & Access</h6>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-left-danger">
                                            <div class="card-body">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" 
                                                           type="checkbox" 
                                                           name="is_admin" 
                                                           id="is_admin"
                                                           {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                                                           {{ $user->id == auth()->id() ? 'disabled' : '' }}>
                                                    <label class="form-check-label fw-bold" for="is_admin">
                                                        Administrator Access
                                                    </label>
                                                </div>
                                                <small class="text-muted">
                                                    Grants full access to admin panel and user management
                                                </small>
                                                @if($user->id == auth()->id())
                                                    <div class="alert alert-info mt-2 mb-0">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        You cannot modify your own admin status
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-left-success">
                                            <div class="card-body">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" 
                                                           type="checkbox" 
                                                           name="email_verified" 
                                                           id="email_verified"
                                                           {{ $user->email_verified_at ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bold" for="email_verified">
                                                        Email Verified
                                                    </label>
                                                </div>
                                                <small class="text-muted">
                                                    Mark email as verified or unverified
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Password Reset --}}
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">Password Management</h6>
                            </div>
                            <div class="col-12">
                                <div class="card border-left-warning">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="send_password_reset" 
                                                   id="send_password_reset">
                                            <label class="form-check-label fw-bold" for="send_password_reset">
                                                Send Password Reset Email
                                            </label>
                                        </div>
                                        <small class="text-muted">
                                            Check this to send a password reset link to the user's email
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Form Actions --}}
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-2"></i>Cancel
                                        </a>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-primary me-2" onclick="previewChanges()">
                                            <i class="fas fa-eye me-2"></i>Preview Changes
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Update User
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Preview Changes Modal --}}
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Changes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Current Values</h6>
                        <table class="table table-sm">
                            <tr><td class="fw-bold">Name:</td><td id="currentName">{{ $user->name }}</td></tr>
                            <tr><td class="fw-bold">Email:</td><td id="currentEmail">{{ $user->email }}</td></tr>
                            <tr><td class="fw-bold">Phone:</td><td id="currentPhone">{{ $user->phone ?? 'Not set' }}</td></tr>
                            <tr><td class="fw-bold">Admin:</td><td id="currentAdmin">{{ $user->is_admin ? 'Yes' : 'No' }}</td></tr>
                            <tr><td class="fw-bold">Verified:</td><td id="currentVerified">{{ $user->email_verified_at ? 'Yes' : 'No' }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">New Values</h6>
                        <table class="table table-sm">
                            <tr><td class="fw-bold">Name:</td><td id="newName"></td></tr>
                            <tr><td class="fw-bold">Email:</td><td id="newEmail"></td></tr>
                            <tr><td class="fw-bold">Phone:</td><td id="newPhone"></td></tr>
                            <tr><td class="fw-bold">Admin:</td><td id="newAdmin"></td></tr>
                            <tr><td class="fw-bold">Verified:</td><td id="newVerified"></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">
                    <i class="fas fa-save me-2"></i>Confirm Changes
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-danger { border-left: 0.25rem solid #e74a3b !important; }

.form-switch .form-check-input {
    width: 3em;
    height: 1.5em;
}

.card {
    border: none;
    border-radius: 0.75rem;
}

.img-profile {
    transition: all 0.3s ease;
}

.img-profile:hover {
    transform: scale(1.05);
}
</style>


<script>
// Avatar preview
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
        
        // Upload avatar
        uploadAvatar(file);
    }
});

function uploadAvatar(file) {
    const formData = new FormData();
    formData.append('avatar', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    fetch(`/admin/users/{{ $user->id }}/avatar`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Avatar uploaded successfully
            console.log('Avatar updated');
        }
    })
    .catch(error => {
        console.error('Error uploading avatar:', error);
    });
}

function previewChanges() {
    // Get form values
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value || 'Not set';
    const isAdmin = document.getElementById('is_admin').checked ? 'Yes' : 'No';
    const isVerified = document.getElementById('email_verified').checked ? 'Yes' : 'No';
    
    // Update modal
    document.getElementById('newName').textContent = name;
    document.getElementById('newEmail').textContent = email;
    document.getElementById('newPhone').textContent = phone;
    document.getElementById('newAdmin').textContent = isAdmin;
    document.getElementById('newVerified').textContent = isVerified;
    
    // Show modal
    new bootstrap.Modal(document.getElementById('previewModal')).show();
}

function submitForm() {
    document.getElementById('userForm').submit();
}

function verifyUser(userId) {
    if (confirm('Send email verification to this user?')) {
        fetch(`/admin/users/${userId}/verify`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Verification email sent successfully');
            }
        });
    }
}

function resetPassword(userId) {
    if (confirm('Send password reset email to this user?')) {
        fetch(`/admin/users/${userId}/password-reset`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Password reset email sent successfully');
            }
        });
    }
}

function suspendUser(userId) {
    if (confirm('Are you sure you want to suspend this user account?')) {
        fetch(`/admin/users/${userId}/suspend`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User account suspended successfully');
                location.reload();
            }
        });
    }
}

// Form validation
document.getElementById('userForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    
    if (!name || !email) {
        e.preventDefault();
        alert('Name and email are required fields');
        return false;
    }
    
    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
        return false;
    }
});
</script>
@endsection