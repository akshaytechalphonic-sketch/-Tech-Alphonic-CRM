@extends('office.partical.main')

@push('title')
    <title>Profile Update</title>
@endpush

@section('content')
<div class="main-content">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-11">

                <div class="card shadow border-0">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Update Profile</h4>
                    </div>

                    <div class="card-body p-0">
                        <div class="row g-0">

                            {{-- LEFT : PROFILE PREVIEW --}}
                     <div class="col-md-4 bg-light text-center p-4 border-end">
    <h6 class="mb-3 fw-semibold">Profile Preview</h6>

    <div class="mb-3">
        @if(Auth::guard('office_employees')->user()->profile_image)
            <img src="{{ asset('public/uploads/profile/' . Auth::guard('office_employees')->user()->profile_image) }}"
                 class="rounded-circle shadow"
                 width="150" height="150">
        @else
            <img src="{{ asset('public/admin/assets/images/user.png') }}"
                 class="rounded-circle shadow"
                 width="150" height="150">
        @endif
    </div>

    <h6 class="mb-1">
        {{ Auth::guard('office_employees')->user()->name }}
    </h6>

    {{-- DESIGNATION --}}
    @if($office_employees->designation->designation_name)
        <span class="badge bg-primary mb-2">
           {{ $office_employees->designation->designation_name}}
        </span>
    @endif

    {{-- DEPARTMENT --}}
    @if($office_employees->designation->department->department_name)
        <div class="text-muted small">
            <span class="text-bold">Department</span> : {{$office_employees->designation->department->department_name }}
        </div>
    @endif

    <small class="text-muted d-block mt-2">
        {{ Auth::guard('office_employees')->user()->email }}
    </small>

    <hr>

    <small class="text-muted">Mobile</small>
    <div class="fw-semibold">
        {{ Auth::guard('office_employees')->user()->mobile_no }}
    </div>
</div>


                            {{-- RIGHT : FORM --}}
                            <div class="col-md-8 p-4">
                                <h6 class="mb-4 fw-semibold">Edit Information</h6>

                                <form action="{{ route('office_employee.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3">

                                        {{-- Name --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name"
                                                   value="{{ old('name', Auth::guard('office_employees')->user()->name) }}"
                                                   class="form-control" required>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email"
                                                   value="{{ old('email', Auth::guard('office_employees')->user()->email) }}"
                                                   class="form-control" required>
                                        </div>

                                        {{-- Mobile --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Mobile Number</label>
                                            <input type="text" name="mobile_no"
                                                   value="{{ old('mobile_no', Auth::guard('office_employees')->user()->mobile_no) }}"
                                                   class="form-control" required>
                                        </div>

                                        {{-- Gender --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Gender</label>
                                            <select name="gender" class="form-select" required>
                                                <option value="">Select</option>
                                                <option value="Male" {{ Auth::guard('office_employees')->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ Auth::guard('office_employees')->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ Auth::guard('office_employees')->user()->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                        {{-- Profile Image --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Profile Image</label>
                                            <input type="file" name="profile_image" class="form-control">
                                        </div>

                                        {{-- Password --}}
                                        <div class="col-md-6">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control">
                                            <small class="text-muted">Leave blank if unchanged</small>
                                        </div>

                                    </div>

                                    <div class="mt-4 d-flex justify-content-end gap-2">
                                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                                            Back
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
        </div>

    </div>
</div>
@endsection
