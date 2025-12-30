@extends('admin.partical.main')
@push('title')
<title>Dashboard | Admin</title>
@endpush

@push('custom-css')

@endpush

@section('content')

        <div class="main-content">
          <!-- write-body-content here start -->
            <div class="pages-content">
                <div class="dash-tabs d-flex justify-content-between  align-items-center mb-3 d-none">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <!-- <li class="nav-item me-3">
                            <button class="client-main-btn" type="button" > Employee <img src="../assets/images/icons/double-arrow.png" alt=""> </button>
                        </li> -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill" id="pills-Allclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Allclient" type="button" role="tab" aria-controls="pills-Allclient" aria-selected="true">All Employees </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Activeclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Activeclient" type="button" role="tab" aria-controls="pills-Activeclient" aria-selected="false">Departments </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-InActiveclient-tab" data-bs-toggle="pill" data-bs-target="#pills-InActiveclient" type="button" role="tab" aria-controls="pills-InActiveclient" aria-selected="false">Designations </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Completedclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Completedclient" type="button" role="tab" aria-controls="pills-Completedclient" aria-selected="false">Employee Shift </button>
                        </li>
                    </ul>

                    <div class="dash-tabs-filter  d-flex gap-3">
                        <!-- <div class="filter-btn">
                            <a href="#!" class="d-flex align-items-center gap-2"  data-bs-toggle="modal" data-bs-target="#filterModel"> <img src="../assets/images/icons/setting.png" alt="">Filter</a>
                        </div> -->
                        <div class="create-client-btn">
                            <a href="{{route('admin.office.create')}}" class="d-flex align-items-center gap-2"> <img src="{{ asset('public/admin/assets/images/icons/plus.png')}}" alt="">Add Employee</a>
                        </div>
                        
                    </div>
                </div>

                <div class="dash-tabs-content no-scrollbar">
                    <div class="container-fluid py-4 px-5">
                        <div class="row">
                            <div class="col-md-12">
                            
                                <div class="step-form">
                                    <div class="step-form-step active">
                                        <form action="{{route('admin.office.update_employee',['id' => $office_employees->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Edit Employee</h3>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">DOJ (Date of Joining) </label>
                                                    <input type="date" class="form-control" id=""  placeholder="DOJ" name="doj" value="{{$office_employees->doj}}" required>
                                                </div> --}}
                                                
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Name </label>
                                                    <input type="text" class="form-control" id=""  placeholder="Name" name="name" value="{{$office_employees->name}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Email </label>
                                                    <input type="email" class="form-control" id=""  placeholder="Email" name="email" value="{{$office_employees->email}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Mobile No </label>
                                                    <input type="tel" class="form-control" id="" placeholder="Mobile No " name="mobile_no" value="{{$office_employees->mobile_no}}" required>
                                                </div>
                                                {{-- <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Total Year of Experience</label>
                                                    <input type="text" class="form-control" placeholder="Total Experience" name="total_exp" value="{{$office_employees->total_exp}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">DOB (Date of Birth) </label>
                                                    <input type="date" class="form-control" id=""  placeholder="DOB" name="dob" value="{{$office_employees->dob}}" required>
                                                </div> --}}
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Select Gender</label>
                                                    <select class="form-select" aria-label="Default select example" name="gender" required>
                                                        <option value="" disabled> Choose Any One</option>
                                                        <option value="Male" {{old('gender',$office_employees->gender ?? '')=='' ? 'selected': ''}}>Male</option>
                                                        <option value="Female" {{old('gender',$office_employees->gender ?? '')=='' ? 'selected': ''}}>Female</option>
                                                        <option value="Other" {{old('gender',$office_employees->gender ?? '')=='' ? 'selected': ''}}>Other</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Select Religion</label>
                                                    <select class="form-select" aria-label="Default select example" name="religion">
                                                        <option selected> Choose Any One</option>
                                                        <option value="Hindu" {{$office_employees->religion == "Hindu" ? 'selected' : ''}}>Hindu </option>
                                                        <option value="Muslim" {{$office_employees->religion == "Muslim" ? 'selected' : ''}}>Muslim</option>
                                                        <option value="Sikh" {{$office_employees->religion == "Sikh" ? 'selected' : ''}}>Sikh</option>
                                                        <option value="Christian" {{$office_employees->religion == "Christian" ? 'selected' : ''}}>Christian</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Marital status</label>
                                                    <select class="form-select" aria-label="Default select example" name="marital_status">
                                                        <option value="Married" {{$office_employees->marital_status == "Married" ? 'selected' : ''}}>Married</option>
                                                        <option value="Unmarried" {{$office_employees->marital_status == "Hindu" ? 'Unmarried' : ''}}>Unmarried</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Number of Children (Optional)</label>
                                                    <input type="number" class="form-control" id=""  placeholder="Number of Children" value="{{$office_employees->children}}" name="children">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">IP No   </label>
                                                    <div class="file-def">
                                                        <input type="text" class="form-control" id="" placeholder="IP No  " name="ipn_no" value="{{$office_employees->ipn_no}}" required>
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" name="ip_file">
                                                                <span class="{{$office_employees->ip_file == null ? 'd-none' : ''}}"><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">UAN   </label>
                                                    <div class="file-def">
                                                        <input type="text" class="form-control" id="" placeholder="UAN  " name="uan_no" value="{{$office_employees->uan_no}}" required>
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" name="uan_file">
                                                                <span class="{{$office_employees->uan_file == null ? 'd-none' : ''}}"><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Select Designation  </label>
                                                    <select class="form-select" aria-label="Default select example" name="designation_id" required>
                                                        @foreach ($designations as $items)
                                                            <option value="{{$items->id}}" {{$items->id == $office_employees->designation_id ? 'selected' : ''}} data-salesEmp="{{$items->department->department_name == 'Sales' ? 'true' : 'false'}}">{{$items->designation_name}}</option>
                                                        @endforeach
                                                        </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3" id=monthlySalesTarget>
                                                    <label for="" class="form-label">Monthly Sales Target</label>

                                                        <input type="number" name="monthly_sales_target" id="" class="form-control mt-2{{$office_employees->monthly_sales_target != null ? 'd-none' : ''}}" placeholder="Enter Monthly Sales Target" value="{{$office_employees->monthly_sales_target}}">
                                                </div>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                <label for="" class="form-label">Password </label>
                                                <input type="password" class="form-control" id=""
                                                    placeholder="Password" name="password" >
                                                    <small class="text-muted">Only fill to change password</small>
                                            </div>

                                                {{-- <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Aadhar no  </label>
                                                    <div class="file-def">
                                                        <input type="text" class="form-control" id="" placeholder="Aadhar no" name="aadhar_no" value="{{$office_employees->aadhar_no}}" required>
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" name="aadhar_file">
                                                                <span class="{{$office_employees->aadhar_file == null ? 'd-none' : ''}}"><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Pan Card no  </label>
                                                    <div class="file-def">
                                                        <input type="text" class="form-control" id="" placeholder="Pan Card no " name="pan_no" value="{{$office_employees->pan_no}}" required>
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" name="pan_file">
                                                                <span class="{{$office_employees->pan_file == null ? 'd-none' : ''}}"><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Rent Agreement/ Electricity bill Proof  </label>
                                                    <div class="file-def">
                                                        <input type="text" class="form-control" id="" placeholder="Upload Proof " name="rent_elec" value="{{$office_employees->rent_elec}}" required>
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" name="rent_elec_file">
                                                                <span class="{{$office_employees->rent_elec_file == null ? 'd-none' : ''}}"><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Reference </label>
                                                    <input type="text" class="form-control" id="" placeholder="Reference" name="reference" value="{{$office_employees->reference}}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Profile Image Upload </label>
                                                    <input type="file" class="form-control" id="" placeholder="Profile Image Upload" name="profile_image">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">CV Upload </label>
                                                    <input type="file" class="form-control" id="" placeholder="CV Upload" name="cvupload">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Police Verification</label>
                                                    <input type="file" class="form-control" id="" placeholder="Police Verification" name="police_verification">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="" class="form-label">About Employee</label>
                                                    <textarea name="about_employee" class="form-control" rows="5">{{$office_employees->about_employee}}</textarea>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Education Details</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">School Completed Year</label>
                                                    @php
                                                        $years = range(1980, strftime("%Y", time()));
                                                    @endphp
                                                    <select class="form-select" aria-label="Default select example" name="school_year">
                                                        <option selected>Select Year</option>
                                                        @foreach ($years as $item)
                                                            <option value="{{$item}}" {{$office_employees->school_year == $item ? 'selected' : ''}}>{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">School Marksheet</label>
                                                    <input type="file" class="form-control" id="" name="school_document">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">High School Completed Year</label>
                                                    @php
                                                        $years = range(1980, strftime("%Y", time()));
                                                    @endphp
                                                    <select class="form-select" aria-label="Default select example" name="high_school_year">
                                                        <option selected>Select Year</option>
                                                        @foreach ($years as $item)
                                                            <option value="{{$item}}" {{$office_employees->high_school_year == $item ? 'selected' : ''}}>{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">High School Marksheet</label>
                                                    <input type="file" class="form-control" id="" name="school_document">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Graduation Completed Year</label>
                                                    @php
                                                        $years = range(1980, strftime("%Y", time()));
                                                    @endphp
                                                    <select class="form-select" aria-label="Default select example" name="graducation_year">
                                                        <option selected>Select Year</option>
                                                        @foreach ($years as $item)
                                                            <option value="{{$item}}" {{$office_employees->graducation_year == $item ? 'selected' : ''}}>{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Graduation Marksheet</label>
                                                    <input type="file" class="form-control" id="" name="graducation_document">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Masters Completed Year</label>
                                                    @php
                                                        $years = range(1980, strftime("%Y", time()));
                                                    @endphp
                                                    <select class="form-select" aria-label="Default select example" name="masters_year">
                                                        <option selected>Select Year</option>
                                                        @foreach ($years as $item)
                                                            <option value="{{$item}}" {{$office_employees->masters_year == $item ? 'selected' : ''}}>{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Masters Marksheet</label>
                                                    <input type="file" class="form-control" id="" name="masters_document">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Any Certificate</label>
                                                    <input type="file" class="form-control" id="" name="certificate">
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Family Details</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Father Name</label>
                                                    <input type="text" class="form-control" id=""  placeholder="Father Name" name="father_name" value="{{$office_employees->father_name}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Mother Name</label>
                                                    <input type="text" class="form-control" id=""  placeholder="Email" name="mother_name" value="{{$office_employees->mother_name}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Contact No.</label>
                                                    <input type="tel" class="form-control" id=""  placeholder="987654321" name="family_contact" value="{{$office_employees->family_contact}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Family Photo</label>
                                                    <input type="file" class="form-control" id="" placeholder="Family Photo" name="family_photo">
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Permanent Address</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Building / Flat No. </label>
                                                    <input type="text" class="form-control" id="" placeholder="Building / Flat No." name="permanent_building_no" value="{{$office_employees->permanent_building_no}}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Area</label>
                                                    <input type="text" class="form-control" id="" placeholder="Area" name="permanent_area" value="{{$office_employees->permanent_area}}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="" placeholder="City" name="permanent_city" value="{{$office_employees->permanent_city}}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Country</label>
                                                    <input type="text" class="form-control" id="" placeholder="Country" name="permanent_country" value="{{$office_employees->permanent_country}}">
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Present Address</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Building / Flat No. </label>
                                                    <input type="text" class="form-control" id="" placeholder="Building / Flat No." name="present_building_no" value="{{$office_employees->present_building_no}}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Area</label>
                                                    <input type="text" class="form-control" id="" placeholder="Area" name="present_area" value="{{$office_employees->present_area}}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="" placeholder="City" name="present_city" value="{{$office_employees->present_city}}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Country</label>
                                                    <input type="text" class="form-control" id="" placeholder="Country" name="present_country" value="{{$office_employees->present_country}}">
                                                </div>
                                                <div class="col-lg-12 mb-3">

                                                    <div class="step-title ">
                                                        <h3>Bank Detail</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Bank name </label>
                                                    <input type="text" class="form-control" id=""  placeholder="Bank name" name="bank_name" value="{{$office_employees->bank_name}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Branch Location </label>
                                                    <input type="text" class="form-control" id=""  placeholder="Branch Location" name="branch_location" value="{{$office_employees->branch_location}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">IFSC </label>
                                                    <input type="text" class="form-control" id="" placeholder="IFSC" name="ifsc" value="{{$office_employees->ifsc}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Account no  </label>
                                                    <input type="text" class="form-control" id="" placeholder="Account no " name="account_no" value="{{$office_employees->account_no}}" required>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Leaves</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Monthly Casual Leaves</label>
                                                    <input type="number" class="form-control" name="monthly_casual_leave" value="{{$office_employees->monthly_casual_leave}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Monthly Sick Leaves</label>
                                                    <input type="number" class="form-control" name="monthly_sick_leave" value="{{$office_employees->monthly_sick_leave}}" required>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Monthly Paid Leaves</label>
                                                    <input type="number" class="form-control" name="monthly_paid_leave" value="{{$office_employees->monthly_paid_leave}}" required>
                                                </div>
                                                <div class="col-lg-9 col-md-12 mb-3">
                                                    <label for="" class="form-label">Other Leaves</label>
                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="other_leave" id="inlineRadio1" value="none" {{$office_employees->other_leave == 'none' ? 'checked' : ''}} required>
                                                            <label class="form-check-label" for="inlineRadio1">None</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="other_leave" id="inlineRadio2" value="all_saturday" {{$office_employees->other_leave == 'all_saturday' ? 'checked' : ''}} required>
                                                            <label class="form-check-label" for="inlineRadio2">All
                                                                Saturday</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="other_leave" id="inlineRadio3" value="first_and_third_saturday" {{$office_employees->other_leave == 'first_and_third_saturday' ? 'checked' : ''}} required>
                                                            <label class="form-check-label" for="inlineRadio3">1st and 3rd
                                                                Saturday</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="other_leave" id="inlineRadio4" value="secound_and_fourth_saturday" {{$office_employees->other_leave == 'secound_and_fourth_saturday' ? 'checked' : ''}} required>
                                                            <label class="form-check-label" for="inlineRadio4">2st and 4th
                                                                Saturday</label>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="next-preview-btns d-flex align-items-center justify-content-between mt-4">
                                            <a href="{{route('admin.office.index')}}" class="prev-step">Cancel</a>        
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
        <img
          width="30"
          height="30"
          src="https://img.icons8.com/ios/30/close-window.png"
          alt="close-window"
        />
      </div>

      @push('custom-js')

      <script>
        $(document).ready(function() {
            $('input[type=file]').change(function() {
                let innersec = $(this).parent()[0];
                $(innersec).find('span').removeClass('d-none')
            })
            $("select[name=designation_id]").change(function(){
                const isSalesEmp = $(this).find(':selected').data('salesemp');
                if(isSalesEmp == true){
                    $('#monthlySalesTarget').removeClass('d-none')
                    $('#monthlySalesTarget').val(null)
                }else{
                    $('#monthlySalesTarget').addClass('d-none')
                }
            })
        })
    </script>
      @endpush
      @endsection
      