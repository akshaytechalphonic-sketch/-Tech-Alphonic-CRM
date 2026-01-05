@extends('admin.partical.main')
@push('title')
<title>Profile Update</title>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Update Profile</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('employee.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            {{-- Name --}}
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    class="form-control" required>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    class="form-control" required>
                            </div>

                            {{-- Mobile --}}
                            <div class="col-md-6">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" name="mobile_no"
                                    value="{{ old('mobile_no', auth()->user()->mobile_no) }}"
                                    class="form-control" required>
                            </div>

                            {{-- Gender --}}
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ auth()->user()->gender == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            {{-- Profile Image --}}
                            <div class="col-md-6">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="profile_image" class="form-control">

                                @if(auth()->user()->profile_image)
                                    <img src="{{ asset('uploads/profile/' . auth()->user()->profile_image) }}"
                                        class="mt-2 rounded-circle"
                                        width="70" height="70">
                                @endif
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-muted">Leave blank if you don't want to change</small>
                            </div>

                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                Update Profile
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
