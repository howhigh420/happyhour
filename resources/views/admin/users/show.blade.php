@extends('layouts.admin')
@section('title', 'User Details')

@section('content')
@extends('layouts.admin')
@section('title', 'User Details')

@section('content')
<div class="container-fluid px-4">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
    </nav>

    <div class="row">
        {{-- User Profile Card --}}
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-3" 
                         src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=150' }}" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    
                    {{-- Status Badges --}}
                    <div class="mb-3">
                        @if($user->is_admin)
                            <span class="badge bg-danger me-2">
                                <i class="fas fa-shield-alt me-1"></i>Administrator
                            </span>
                        @else
                            <span class="badge bg-secondary me-2">
                                <i class="fas fa-user me-1"></i>User
                            </span>
                        @endif
                        
                        @if($user->email_verified_at)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Verified
                            </span>
                        @else
                            <span class="badge bg-warning">
                                <i class="fas fa-clock me-1"></i>Unverified
                            </span>
                        @endif
                    </div>

                    {{-- Quick Actions --}}
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        @if(!$user->email_verified_at)
                            <button class="btn btn-success btn-sm" onclick="verifyUser({{ $user->id }})">
                                <i class="fas fa-check me-1"></i>Verify
                            </button>
                        @endif
                        @if($user->id !== auth()->id())
                            <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Stats</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h5 class="text-primary">{{ $user->posts_count ?? 0 }}</h5>
                                <small class="text-muted">Posts</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="text-success">{{ $user->comments_count ?? 0 }}</h5>
                            <small class="text-muted">Comments</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- User Details --}}
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                    <div class="ms-auto">
                        <small class="text-muted">Last updated: {{ $user->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Basic Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold text-muted">User ID:</td>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Full Name:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Email:</td>
                                    <td>
                                        {{ $user->email }}
                                        @if($user->email_verified_at)
                                            <i class="fas fa-check-circle text-success ms-1" title="Verified"></i>
                                        @else
                                            <i class="fas fa-exclamation-circle text-warning ms-1" title="Unverified"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Phone:</td>
                                    <td>{{ $user->phone ?? 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Role:</td>
                                    <td>
                                        @if($user->is_admin)
                                            <span class="text-danger fw-bold">Administrator</span>
                                        @else
                                            <span class="text-secondary">User</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Account Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold text-muted">Created:</td>
                                    <td>
                                        {{ $user->created_at->format('M d, Y') }}
                                        <br><small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Last Updated:</td>
                                    <td>
                                        {{ $user->updated_at->format('M d, Y') }}
                                        <br><small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                @if($user->email_verified_at)
                                <tr>
                                    <td class="fw-bold text-muted">Email Verified:</td>
                                    <td>
                                        {{ $user->email_verified_at->format('M d, Y') }}
                                        <br><small class="text-muted">{{ $user->email_verified_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="fw-bold text-muted">Last Login:</td>
                                    <td>
                                        {{ $user->last_login_at ? $user->last_login_at->format('M d, Y H:i') : 'Never' }}
                                        @if($user->last_login_at)
                                            <br><small class="text-muted">{{ $user->last_login_at->diffForHumans() }}</small>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Activity Log (if available) --}}
            @if(isset($activities) && $activities->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @foreach($activities->take(5) as $activity)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">{{ $activity->description }}</h6>
                                <p class="timeline-text text-muted">{{ $activity->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Users
                </a>
                <div>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit me-2"></i>Edit User
                    </a>
                    @if($user->id !== auth()->id())
                        <button class="btn btn-danger" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
                            <i class="fas fa-trash me-2"></i>Delete User
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Same delete modal as in index --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                    <div>
                        <h6 class="mb-1">Are you sure you want to delete this user?</h6>
                        <p class="text-muted mb-0">This action cannot be undone.</p>
                    </div>
                </div>
                <div class="alert alert-warning">
                    <strong>User:</strong> <span id="deleteUserName"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>

</style>

<script>
    function deleteUser(userId, userName) {
    document.getElementById('deleteUserName').textContent = userName;
    document.getElementById('deleteForm').action = `/admin/users/${userId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function verifyUser(userId) {
    if (confirm('Are you sure you want to verify this user?')) {
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
                location.reload();
            } else {
                alert('Failed to verify user');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }
}


</script>
@endsection