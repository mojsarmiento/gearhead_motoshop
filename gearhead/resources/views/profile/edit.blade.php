@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Edit Profile
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
                            </div>

                            <!-- Add other profile fields as needed -->

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>

                        <hr>

                        <!-- Password Update Form -->
                        <form method="POST" action="{{ route('profile.update.password') }}">
                            <h5 class="mb-3">Update Password:</h5>
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>

                    <a href="{{ route('profile.show') }}" class="btn btn-secondary mt-3">Back to Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
