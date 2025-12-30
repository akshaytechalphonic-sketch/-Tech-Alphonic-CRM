@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    {{-- Username :admin0143_enliveAdmin
Directory : /home/admin0143/public_html/
Password : !T8v@kL#x3$Qn9W
190.92.175.38 --}}
    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between  align-items-center mb-3 d-none">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <!-- <li class="nav-item me-3">
                                                                    <button class="client-main-btn" type="button" > Employee <img src="../assets/images/icons/double-arrow.png" alt=""> </button>
                                                                </li> -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill" id="pills-Allclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Allclient" type="button" role="tab" aria-controls="pills-Allclient"
                            aria-selected="true">All Employees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-Activeclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Activeclient" type="button" role="tab"
                            aria-controls="pills-Activeclient" aria-selected="false">Departments </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-InActiveclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-InActiveclient" type="button" role="tab"
                            aria-controls="pills-InActiveclient" aria-selected="false">Designations </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-Completedclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Completedclient" type="button" role="tab"
                            aria-controls="pills-Completedclient" aria-selected="false">Employee Shift </button>
                    </li>
                </ul>

                <div class="dash-tabs-filter  d-flex gap-3">
                    <!-- <div class="filter-btn">
                                                                    <a href="#!" class="d-flex align-items-center gap-2"  data-bs-toggle="modal" data-bs-target="#filterModel"> <img src="../assets/images/icons/setting.png" alt="">Filter</a>
                                                                </div> -->
                    <div class="create-client-btn">
                        <a href="{{ route('admin.office.create') }}" class="d-flex align-items-center gap-2"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add
                            Employee</a>
                    </div>

                </div>
            </div>

            <div class="dash-tabs-content no-scrollbar">
                <div class="container-fluid py-4 px-5">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="step-form">
                                <div class="step-form-step active">
                                    <form action="{{ route('admin.office.create') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="step-title ">
                                                    <h3>Add New Employee</h3>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Name </label>
                                                <input type="text" class="form-control" id="" placeholder="Name"
                                                    name="name" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Email </label>
                                                <input type="email" class="form-control" id=""
                                                    placeholder="Email" name="email" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Mobile No </label>
                                                <input type="number" class="form-control" placeholder="Mobile No"
                                                    name="mobile_no"
                                                    oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                    required>


                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Select Gender</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="gender" required>
                                                    <option value="" disabled selected>Choose Gender</option>
                                                    <option value="Male">Male </option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            {{-- <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">DOB (Date of Birth) </label>
                                                <input type="date" class="form-control" id=""
                                                    placeholder="DOB" name="dob" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Select Religion</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="religion" required>
                                                    <option value="" disabled selected>Choose Religion</option>
                                                    <option value="Hindu">Hindu </option>
                                                    <option value="Muslim">Muslim</option>
                                                    <option value="Sikh">Sikh</option>
                                                    <option value="Christian">Christian</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Marital status</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="marital_status" required>
                                                    <option value="" disabled selected>Choose Marital status</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Unmarried">Unmarried</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Number of Children
                                                    (Optional)</label>
                                                <input type="number" class="form-control" id=""
                                                    placeholder="Number of Children" name="children">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Total Year of Experience</label>
                                                <input type="number" class="form-control" placeholder="Total Experience"
                                                    name="total_exp" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">DOJ (Date of Joining) </label>
                                                <input type="date" class="form-control" id=""
                                                    placeholder="DOJ" name="doj" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Select Shift</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="shift" required>
                                                    <option value="" disabled selected>Choose Shift</option>
                                                    <option value="Day">Day </option>
                                                    <option value="Night">Night</option>
                                                </select>
                                            </div> --}}
                                            {{-- <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Select Department </label>
                                                <select class="form-control select2" name="designation" required>
                                                    <option>Choose Any One</option>
                                                    @forelse ($departments as $department)
                                                        <option value="{{ $department->id }}">
                                                            {{ $department->department_name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div> --}}
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Select Designation</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="designation_id" required>
                                                    <option value="" disabled selected>Choose Designation</option>
                                                    @foreach ($designations as $items)
                                                        <option value="{{ $items->id }}"
                                                            data-salesEmp="{{ $items->department->department_name == 'Sales' ? 'true' : 'false' }}">
                                                            {{ $items->designation_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                {{-- <input type="number" name="monthly_sales_target" id="monthlySalesTarget"
                                                    class="form-control mt-2 d-none"
                                                    placeholder="Enter Monthly Sales Target"> --}}

                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3 d-none" id='monthlySalesTarget'>
                                                <label for="" class="form-label">Monthly Sales Target</label>

                                                <input type="number" name="monthly_sales_target" id=""
                                                    class="form-control " placeholder="Enter Monthly Sales Target"
                                                    value="">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Password </label>
                                                <input type="password" class="form-control" id=""
                                                    placeholder="Name" name="password" required>
                                            </div>
                                            {{-- <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">IP No </label>
                                                <div class="file-def">
                                                    <input type="number" class="form-control" placeholder="IP No"
                                                        name="ipn_no" required>
                                                    <div class="file-upload-img">
                                                        <div class="inner-sec">
                                                            <img src="{{ asset('public/admin/assets/images/icons/upload.png') }}"
                                                                alt="">
                                                            <input type="file" name="ip_file" accept="application/pdf"
                                                                required>
                                                            <span class="d-none">
                                                                <img src="{{ asset('public/admin/assets/images/icons/check-w.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">UAN </label>
                                                <div class="file-def">
                                                    <input type="text" class="form-control" placeholder="UAN"
                                                        name="uan_no" maxlength="12"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);"
                                                        required>

                                                    <div class="file-upload-img">
                                                        <div class="inner-sec">
                                                            <img src="{{ asset('public/admin/assets/images/icons/upload.png') }}"
                                                                alt="">
                                                            <input type="file" name="uan_file"
                                                                accept="application/pdf" required>
                                                            <span class="d-none">
                                                                <img src="{{ asset('public/admin/assets/images/icons/check-w.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Aadhar no </label>
                                                <div class="file-def">
                                                    <input type="text" class="form-control" placeholder="Aadhar no"
                                                        name="aadhar_no" maxlength="12"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);"
                                                        required>

                                                    <div class="file-upload-img">
                                                        <div class="inner-sec">
                                                            <img src="{{ asset('public/admin/assets/images/icons/upload.png') }}"
                                                                alt="">
                                                            <input type="file" name="aadhar_file"
                                                                accept="application/pdf" required>
                                                            <span class="d-none">
                                                                <img src="{{ asset('public/admin/assets/images/icons/check-w.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Pan Card no </label>
                                                <div class="file-def">
                                                    <input type="text" class="form-control" maxlength="10"
                                                        placeholder="Pan Card no" name="pan_no" required>

                                                    <div class="file-upload-img">
                                                        <div class="inner-sec">
                                                            <img src="{{ asset('public/admin/assets/images/icons/upload.png') }}"
                                                                alt="">
                                                            <input type="file" name="pan_file"
                                                                accept="application/pdf" required>
                                                            <span class="d-none">
                                                                <img src="{{ asset('public/admin/assets/images/icons/check-w.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Rent Agreement / Electricity bill
                                                    Proof</label>
                                                <div class="file-def">
                                                    <input type="text" class="form-control" placeholder="Upload Proof"
                                                        name="rent_elec" required>

                                                    <div class="file-upload-img">
                                                        <div class="inner-sec">
                                                            <img src="{{ asset('public/admin/assets/images/icons/upload.png') }}"
                                                                alt="">
                                                            <input type="file" name="rent_elec_file"
                                                                accept="application/pdf" required>
                                                            <span class="d-none">
                                                                <img src="{{ asset('public/admin/assets/images/icons/check-w.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Profile Image Upload</label>
                                                <input type="file" class="form-control" name="profile_image"
                                                    accept="image/*" required>
                                            </div>


                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">CV Upload</label>
                                                <input type="file" class="form-control" name="cvupload"
                                                    accept="application/pdf" required>
                                            </div>


                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Police Verification</label>
                                                <input type="file" class="form-control" name="police_verification"
                                                    accept="application/pdf">
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Reference </label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Reference" name="reference" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="" class="form-label">About Employee</label>
                                                <textarea name="about_employee" class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="step-title ">
                                                    <h3>Education Details</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">School Completed Year</label>
                                                @php
                                                    $years = range(1980, strftime('%Y', time()));
                                                @endphp
                                                <select class="form-select" aria-label="Default select example"
                                                    name="school_year">
                                                    <option value="" disabled selected>Choose Year</option>

                                                    @foreach ($years as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">School Marksheet</label>
                                                <input type="file" class="form-control" name="school_document"
                                                    accept="application/pdf">
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">High School Completed
                                                    Year</label>
                                                @php
                                                    $years = range(1980, strftime('%Y', time()));
                                                @endphp
                                                <select class="form-select" name="high_school_year">
                                                    <option value="" disabled selected>Choose Year</option>
                                                    @foreach ($years as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">High School Marksheet</label>
                                                <input type="file" class="form-control" name="high_school_document"
                                                    accept="application/pdf">
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Graduation Completed Year</label>
                                                @php
                                                    $years = range(1980, strftime('%Y', time()));
                                                @endphp
                                                <select class="form-select" name="graducation_year">
                                                    <option value="" disabled selected>Choose Year</option>
                                                    @foreach ($years as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Graduation Marksheet</label>
                                                <input type="file" class="form-control" name="graducation_document"
                                                    accept="application/pdf">
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Masters Completed Year</label>
                                                @php
                                                    $years = range(1980, strftime('%Y', time()));
                                                @endphp
                                                <select class="form-select" name="masters_year">
                                                    <option value="" disabled selected>Choose Year</option>
                                                    @foreach ($years as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Masters Marksheet</label>
                                                <input type="file" class="form-control" name="masters_document"
                                                    accept="application/pdf">
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Any Certificate</label>
                                                <input type="file" class="form-control" name="certificate"
                                                    accept="application/pdf">
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <div class="step-title ">
                                                    <h3>Family Details</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Father Name</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Father Name" name="father_name" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Mother Name</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Mother Name" name="mother_name" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Contact No.</label>
                                                <input type="tel" class="form-control" id="" maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                                    placeholder="987654321" name="family_contact" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Family Photo</label>
                                                <input type="file" class="form-control" name="family_photo"
                                                    accept="image/*">
                                            </div>

                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Other Documents (Aadhaar,
                                                    Pancard, Etc.)</label>
                                                <input type="file" class="form-control" name="other_document"
                                                    accept="application/pdf">
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <div class="step-title ">
                                                    <h3>Permanent Address</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Building / Flat No. </label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Building / Flat No." name="permanent_building_no">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Area</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Area" name="permanent_area">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">City</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="City" name="permanent_city">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Country</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Country" name="permanent_country">
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="step-title ">
                                                    <h3>Present Address</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Building / Flat No. </label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Building / Flat No." name="present_building_no">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Area</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Area" name="present_area">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">City</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="City" name="present_city">
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Country</label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Country" name="present_country">
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="step-title ">
                                                    <h3>Bank Detail</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Bank name </label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Bank name" name="bank_name" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Branch Location </label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Branch Location" name="branch_location" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">IFSC </label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="IFSC" name="ifsc" required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Account no </label>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Account no " name="account_no" required>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="step-title ">
                                                    <h3>Leaves</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Monthly Casual Leaves</label>
                                                <input type="number" class="form-control" name="monthly_casual_leave"
                                                    required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Monthly Sick Leaves</label>
                                                <input type="number" class="form-control" name="monthly_sick_leave"
                                                    required>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Monthly Paid Leaves</label>
                                                <input type="number" class="form-control" name="monthly_paid_leave"
                                                    required>
                                            </div>
                                            <div class="col-lg-9 col-md-12 mb-3">
                                                <label for="" class="form-label">Other Leaves</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="other_leave"
                                                            id="inlineRadio1" value="none" required>
                                                        <label class="form-check-label" for="inlineRadio1">None</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="other_leave"
                                                            id="inlineRadio2" value="all_saturday" required>
                                                        <label class="form-check-label" for="inlineRadio2">All
                                                            Saturday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="other_leave"
                                                            id="inlineRadio3" value="first_and_third_saturday" required>
                                                        <label class="form-check-label" for="inlineRadio3">1st and 3rd
                                                            Saturday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="other_leave"
                                                            id="inlineRadio4" value="secound_and_fourth_saturday"
                                                            required>
                                                        <label class="form-check-label" for="inlineRadio4">2st and 4th
                                                            Saturday</label>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div
                                            class="next-preview-btns d-flex align-items-center justify-content-between mt-4">
                                            <a href="{{ url()->previous() }}" class=" prev-step">Cancel</a>
                                            <button class=" confirm-step" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




        <!-- write-body-content here end -->
    </div>

    </div>
    </section>

    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
        </div>


        @push('custom-js')
            <script>
                $(document).ready(function() {
                    $('input[type=file]').change(function() {
                        let innersec = $(this).parent()[0];
                        $(innersec).find('span').removeClass('d-none')
                    })
                    $("select[name=designation_id]").change(function() {
                        const isSalesEmp = $(this).find(':selected').data('salesemp');
                        if (isSalesEmp == true) {
                            $('#monthlySalesTarget').removeClass('d-none')
                            $('#monthlySalesTarget').val(null)
                        } else {
                            $('#monthlySalesTarget').addClass('d-none')
                        }
                    })
                })
            </script>
        @endpush
    @endsection
