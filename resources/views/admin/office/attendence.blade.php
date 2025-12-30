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
            <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <!-- <li class="nav-item me-3">
                                    <button class="client-main-btn" type="button" >Employee <img src="{{ asset('public/admin/assets/images/icons') }}/double-arrow.png" alt=""> </button>
                                </li> -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill {{isset($_GET['type']) ? ($_GET['type'] == 'attendance' ? 'active' : '') : 'active' }}" id="pills-Allclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Allclient" type="button" role="tab" aria-controls="pills-Allclient"
                            aria-selected="true">Attendance </button>
                    </li>
                    {{-- <li class="nav-item d-none" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-Activeclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Activeclient" type="button" role="tab"
                            aria-controls="pills-Activeclient" aria-selected="false">Shift & Schedule </button>
                    </li> --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill {{isset($_GET['type']) ? ($_GET['type'] == 'leaves' ? 'active' : '') : '' }}" id="pills-InActiveclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-InActiveclient" type="button" role="tab"
                            aria-controls="pills-InActiveclient" aria-selected="false">Leaves </button>
                    </li>
                </ul>
                <div class="dash-tabs-filter d-flex gap-3">
                    <div class="create-client-btn">
                        <div class="d-flex gap-3">
                            <input type="date" class="form-control" id="attendFilter"
                                value="{{ !isset($_GET['filter_by_employee']) ? (isset($_GET['filter_by_date']) ? $_GET['filter_by_date'] : date('Y-m-d')) : '' }}"
                                max="{{ date('Y-m-d') }}">

                        <a href="#!" class="bg-white text-black border-light" data-bs-toggle="modal"
                        data-bs-target="#filterModel"> <img
                            src="{{ asset('public/admin/assets/images/icons') }}/setting.png" alt="">Filter</a>

                        <a href="#!" data-bs-toggle="modal" data-bs-target="#addAttendanceModel"
                            class="d-flex align-items-center gap-2"> <img
                                src="{{ asset('public/admin/assets/images/icons') }}/plus.png" alt="">Add
                            Attendance</a>
                            
                        </div>
                    </div>
                    <div class="create-client-btn">
                        {{-- <a href="#!" data-bs-toggle="modal" data-bs-target="#addLeaveModel"
                            class="d-flex align-items-center gap-2"> <img
                                src="{{ asset('public/admin/assets/images/icons') }}/plus.png" alt="">Add Leave</a> --}}
                    </div>
                </div>
            </div>

        </div>

        <div class="dash-tabs-content no-scrollbar">
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade {{isset($_GET['type']) ? ($_GET['type'] == 'attendance' ? 'show active' : '') : 'show active' }}" id="pills-Allclient" role="tabpanel"
                    aria-labelledby="pills-Allclient-tab" tabindex="0">

                    <div class="table-responsive">
                        <table  id="example" class="  row-border order-column nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> <span class="d-none">All</span></th>
                                    <th>SNo.</th>
                                    <th>Employee ID</th>
                                    <th>Date</th>
                                    <th>Employee Name</th>
                                    <th>Designation </th>
                                    <th>Check In Time</th>
                                    <th> Check Out Time</th>
                                    <th>Total Working Hours</th>
                                    <th>Shift</th>
                                    <th>Work Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample Rows -->
                                @foreach ($today_attendance as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{ $item->id }}</td>
                                        <td>#{{ $item->employee->id }}</td>
                                        <td>{{ date('d M, Y', strtotime("$item->year-$item->month-$item->day")) }}</td>
                                        <td>{{ $item->employee->name }}</td>
                                        <td>{{ $item->employee->designation->designation_name }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="green"></div>
                                                {{ $item->check_in != null ? changeTimeto12($item->check_in) : '---' }}
                                            </div>
                                        </td>
                                        <td>{{ $item->check_out != null ? changeTimeto12($item->check_out) : '---' }}</td>
                                        <td>{{ ($item->check_in != null) & ($item->check_out == null) ? countHours($item->check_in, now()->format('H:i')) : countHours($item->check_in, $item->check_out) }}
                                        </td>
                                        <td>{{ json_decode($item->employee->shift_json, true)['shift_type'] }}</td>
                                        <td>{{ 'Work from ' . $item->work_type }}</td>
                                        <td>
                                            <span class="badge succes-bg">Present</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="tab-pane fade" id="pills-Activeclient" role="tabpanel" aria-labelledby="pills-Activeclient-tab"
                    tabindex="0">
                    <div class="table-responsive">
                        <table id="example" class="  row-border order-column nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                            All
                                        </div>

                                    </th>
                                    <th>SNo.</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Designation </th>
                                    <th>Check In Time</th>
                                    <th> Check Out Time</th>
                                    <th>Total Working Hours</th>
                                    <th>Shift</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample Rows -->
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>2</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="red"></div>09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Night Shift</td>
                                    <td><span class="badge  danger-bg ">Leave</span></td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>2</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="red"></div>09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Night Shift</td>
                                    <td><span class="badge  danger-bg ">Leave</span></td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>2</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="red"></div>09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Night Shift</td>
                                    <td><span class="badge  danger-bg ">Leave</span></td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>2</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="red"></div>09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Night Shift</td>
                                    <td><span class="badge  danger-bg ">Leave</span></td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>#4651</td>
                                    <td>Kimberley Myers</td>
                                    <td>UI/UX Designer</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="green"></div> 09:46 AM
                                        </div>
                                    </td>
                                    <td>07:46 PM</td>
                                    <td>8 Hrs 40 Mins 56 Secs</td>
                                    <td>Day Shift</td>
                                    <td><span class="badge  succes-bg ">Present</span></td>
                                </tr>



                                <!-- Add more rows here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade {{isset($_GET['type']) ? ($_GET['type'] == 'leaves' ? 'show active' : '') : '' }}" id="pills-InActiveclient" role="tabpanel"
                    aria-labelledby="pills-InActiveclient-tab" tabindex="0">
                    <div class="table-responsive">
                        <table id="example" class="  row-border order-column nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> <span class="d-none">All</span></th>
                                    <th>Leave ID</th>
                                    <th>Leave Type</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Approved To</th>
                                    <th> No of Days</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample Rows -->
                                {{-- {{dd($leaves->approved_by)}} --}}
                                @foreach ($leaves as $leave)
                                    <tr>
                                        <td></td>
                                        <td>#{{ $leave->id }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ $leave->employee->name }}</td>
                                        <td>{{ $leave->employee->designation->designation_name }}</td>
                                        <td>{{ $leave->leave_from }}</td>
                                        <td>{{ $leave->leave_to }}</td>
                                        <td><a href="#" class="badge succes-bg addAssignLeaveTo" data-leave_id="{{ $leave->id }}" data-bs-toggle="modal" data-bs-target="#addAssignLeaveToModel">{{$leave->approved_by != null ? $leave->approved_by->name .' - '. $leave->approved_by->designation->designation_name: "Click to Assign"}}</a></td>
                                        <td>
                                            @php
                                                    $startDate = new DateTime($leave->leave_from);
                                                    $endDate = new DateTime($leave->leave_to);
                                                    $interval = $startDate->diff($endDate);
                                                    echo $interval->days;
                                            @endphp
                                        </td>
                                        <td>{{ $leave->leave_reason }}</td>
                                        <td>
                                            <select name="changeLeaveStatus" class="form-control" style="width:120px;" data-leave_id="{{ $leave->id }}">
                                                <option value="2" {{$leave->status == "2" ? 'selected' : ''}}>Pending</option>
                                                <option value="1" {{$leave->status == "1" ? 'selected' : ''}}>Approveed</option>
                                                <option value="0" {{$leave->status == "0" ? 'selected' : ''}}>Disapproved</option>
                                            </select>
                                            {{-- @if ($leave->status == '0')
                                                <span class="badge  danger-bg ">Disapproveed</span>
                                            @elseif ($leave->status == '1')
                                                <span class="badge  succes-bg ">Approveed</span>
                                            @elseif ($leave->status == '2')
                                                <span class="badge  blue-bg ">Pending</span>
                                            @endif --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </section>
    <div class="modal fade" id="addAssignLeaveToModel" tabindex="-1" aria-labelledby="addAssignLeaveToModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.attendance.assign_leave_to') }}" class="w-100" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addLeaveModelLabel">Add Attendance</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="hidden" id="model_leave_id" name="leave_id">
                                <label for="" class="form-label">Assign To</label>
                                <select class="form-select" aria-label="Default select example" required name="request_id">
                                    <option value="" disabled selected="">Choose one Employee</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }} -
                                            {{ $emp->designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="Submit" class="btn-dark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="addAttendanceModel" tabindex="-1" aria-labelledby="addAttendanceModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.attendance.create_attendance') }}" class="w-100" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addLeaveModelLabel">Add Attendance</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Select Employee</label>
                                <select class="form-select" aria-label="Default select example" required name="emp_id">
                                    <option value="" disabled selected="">Choose one Employee</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }} -
                                            {{ $emp->designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Attendance Date </label>
                                <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}"
                                    required>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Select Work Type</label>
                                <select class="form-select" aria-label="Default select example" required
                                    name="work_type">
                                    <option value="" disabled selected="">Choose one Employee</option>
                                    <option value="office" selected>Work from Office</option>
                                    <option value="home">Work from Home</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Check in Time </label>
                                <input type="time" class="form-control" name="check_in" value="09:00" required>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Check out Time </label>
                                <input type="time" class="form-control" name="check_out" value="19:00" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="Submit" class="btn-dark" id="success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="filterModel" tabindex="-1" aria-labelledby="filterModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <form action="{{ route('admin.attendance.index') }}" class="w-100" method="get">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="filterModelLabel">Filter</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="" class="form-label">Search By Employee </label>
                                <select class="form-select" name="filter_by_employee">
                                    <option value="" disabled selected="">Choose one Employee</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}"
                                            {{ isset($_GET['filter_by_employee']) && $_GET['filter_by_employee'] == $emp->id ? 'selected' : '' }}>
                                            {{ $emp->name }} - {{ $emp->designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="form-label">Search By Month</label>
                                <input type="month" class="form-control" name="filder_by_month"
                                    value="{{ isset($_GET['filder_by_month']) && $_GET['filder_by_month'] != '' ? $_GET['filder_by_month'] : '' }}"
                                    max="{{ date('Y-m') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-end">
                        <!-- <button type="reset" class="btn-dark">Reset</button> -->
                        <button type="submit" class="btn-dark">Apply Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade d-none" id="addLeaveModel" tabindex="-1" aria-labelledby="addLeaveModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.attendance.create_leave') }}" class="w-100" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addLeaveModelLabel">Add Leave</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Select Employee</label>
                                <select class="form-select" aria-label="Default select example" required name="emp_id">
                                    <option value="" disabled selected="">Choose one Employee</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }} -
                                            {{ $emp->designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Leave Type </label>
                                <select class="form-select" aria-label="Default select example" name="leave_type"
                                    required>
                                    <option value="" selected disabled> Select Leave Type</option>
                                    <option value="Sick leave">Sick leave</option>
                                    <option value="Casual leave">Casual leave</option>
                                    <option value="Paid leave">Paid leave</option>
                                    <option value="Maternity leave">Maternity leave</option>
                                    <option value="Paternity leave">Paternity leave</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Select Day Type (optional)</label>
                                <select class="form-select" aria-label="Default select example" name="day_type" required>
                                    <option selected=""> Choose one day type</option>
                                    <option value="Full Day"> Full Day</option>
                                    <option value="Half day">Half day</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">From </label>
                                <input type="date" class="form-control" name="from" required>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">To </label>
                                <input type="date" class="form-control" name="to">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Reason in document (optional)</label>
                                <input type="file" name="reason_document">
                                <small class="text-black-50">Email or Message Screenshot etc.</small>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="form-label">Reason </label>
                                <textarea class="form-control" id="" rows="3" placeholder="Add some description of the Reason"
                                    name="reason" required></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="Submit" class="btn-dark" id="success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
        </div>

        <!-- <script>
            const tabs = document.querySelectorAll('.nav-link');
            const createClientBtns = document.querySelectorAll('.create-client-btn');
            console.log(tabs);
            console.log(createClientBtns);

            function updateButtons() {
                createClientBtns.forEach(btn => btn.style.display = 'none');

                const activeTab = document.querySelector('.nav-link.active');
                if (activeTab) {
                    const tabIndex = Array.from(tabs).indexOf(activeTab);
                    if (createClientBtns[tabIndex]) {
                        createClientBtns[tabIndex].style.display = 'flex';
                    }
                }
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', updateButtons);
            });
        </script> -->
        @push('custom-js')
            <script>
                $('#attendFilter').change(function() {

                    window.location.href = `{{ route('admin.attendance.index') }}?filter_by_date=${$(this).val()}`
                })
                $('select[name=changeLeaveStatus]').change(function() {
                    $.ajax({
                          type: "POST",
                          url: "{{route('admin.attendance.change_leave_status')}}",
                          data: {
                            'leave_id':$(this).data('leave_id'),
                            'status':$(this).val(),
                            '_token':"{{ csrf_token() }}"},
                          success: function(data){
                             console.log(data);
                          }
                        });
                })
                $('.addAssignLeaveTo').click(function(){
                    $lfgh = $(this)[0]
                    $('input#model_leave_id').val($($lfgh).data('leave_id'))
                })
            </script>
            <script>
                const tabs = document.querySelectorAll('.nav-link');
                  const createClientBtns = document.querySelectorAll('.create-client-btn');
                  console.log(tabs);
                  console.log(createClientBtns);
                  
                  // Function to update the visibility of create-client-btns
                  function updateButtons() {
                      // Hide all create-client-btns
                      createClientBtns.forEach(btn => btn.style.display = 'none');
                  
                      // Get the active tab
                      const activeTab = document.querySelector('.nav-link.active');
                      if (activeTab) {
                          const tabIndex = Array.from(tabs).indexOf(activeTab);
                          if (createClientBtns[tabIndex]) {
                              // Show the corresponding create-client-btn
                              createClientBtns[tabIndex].style.display = 'flex';
                          }
                      }
                  }
                  
                  // Add event listeners to tabs
                  tabs.forEach(tab => {
                      tab.addEventListener('click', updateButtons);
                  });
            </script>
        @endpush
    @endsection
