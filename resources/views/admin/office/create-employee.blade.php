@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    @php
        $route = \Request::route()->getName();

    @endphp

    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <!-- <li class="nav-item me-3">
                                <button class="client-main-btn" type="button" >Employee <img src="../assets/images/icons/double-arrow.png" alt=""> </button>
                            </li> -->
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link rounded-pill {{ isset($_GET['tab']) ? ($_GET['tab'] == 'employees' ? 'active' : '') : 'active' }}"
                            id="pills-Allclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Allclient" type="button"
                            role="tab" aria-controls="pills-Allclient" aria-selected="true">Employees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link rounded-pill {{ isset($_GET['tab']) ? ($_GET['tab'] == 'departments' ? 'active' : '') : '' }}"
                            id="pills-Activeclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Activeclient"
                            type="button" role="tab" aria-controls="pills-Activeclient"
                            aria-selected="false">Departments</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link rounded-pill {{ isset($_GET['tab']) ? ($_GET['tab'] == 'designations' ? 'active' : '') : '' }}"
                            id="pills-InActiveclient-tab" data-bs-toggle="pill" data-bs-target="#pills-InActiveclient"
                            type="button" role="tab" aria-controls="pills-InActiveclient"
                            aria-selected="false">Designations</button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button
                            class="nav-link rounded-pill {{ isset($_GET['tab']) ? ($_GET['tab'] == 'teams' ? 'active' : '') : '' }}"
                            id="pills-teams-tab" data-bs-toggle="pill" data-bs-target="#pills-teams"
                            type="button" role="tab" aria-controls="pills-teams"
                            aria-selected="false">Teams</button>
                    </li> --}}
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link rounded-pill {{ isset($_GET['tab']) ? ($_GET['tab'] == 'employeeShift' ? 'active' : '') : '' }}"
                            id="pills-Completedclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Completedclient"
                            type="button" role="tab" aria-controls="pills-Completedclient"
                            aria-selected="false">Employee_Shift</button>
                    </li>

                </ul>

                <div class="dash-tabs-filter multi-btns d-flex gap-3">

                    <div class="create-client-btn {{ isset($_GET['tab']) ? ($_GET['tab'] == 'employees' ? 'd-block' : 'd-none') : 'active' }}"
                        data-cl="Employees">
                        <a href="{{ route('admin.office.create') }}" class="d-flex align-items-center gap-2"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add
                            Employee</a>
                    </div>
                    <div class="create-client-btn {{ isset($_GET['tab']) ? ($_GET['tab'] == 'departments' ? 'd-block' : 'd-none') : 'd-none' }}"
                        data-cl="Departments">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#addDepartmentModel"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add
                            Departments</a>
                    </div>
                    <div class="create-client-btn {{ isset($_GET['tab']) ? ($_GET['tab'] == 'designations' ? 'd-block' : 'd-none') : 'd-none' }}"
                        data-cl="Designations">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#addDesignationsModel"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add
                            Designations</a>
                    </div>
                    <div class="create-client-btn {{ isset($_GET['tab']) ? ($_GET['tab'] == 'teams' ? 'd-block' : 'd-none') : 'd-none' }}"
                        data-cl="Teams">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#addTeamsModel"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add
                            Team</a>
                    </div>
                    {{-- <div class="create-client-btn {{ isset($_GET['tab']) ? ($_GET['tab'] == 'employeeShift' ? 'd-block' : 'd-none') : 'd-none' }}"
                        data-cl="Employee_Shift">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#addEmployeeShift"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add Employee
                            Shift</a>
                    </div> --}}
                </div>
            </div>

            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade {{ isset($_GET['tab']) ? ($_GET['tab'] == 'employees' ? 'show active' : '') : 'show active' }}"
                        id="pills-Allclient" role="tabpanel" aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>Emp ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Joining Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($office_employees as $key => $items)
                                        <tr>
                                            <td></td>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ $items->name }}</td>
                                            <td>{{ $items->email }}</td>
                                            <td>{{ $items->mobile_no }}</td>
                                            <td>{{ $items->designation->department->department_name }}</td>
                                            <td>{{ $items->designation->designation_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($items->created_at)->format('M d, Y') }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('admin.office.change_employee_status', ['statusId' => $items->id]) }}">{!! $items->status == 1
                                                        ? '<span class="badge succes-bg">Active</span>'
                                                        : '<span class="badge danger-bg">Inactive</span>' !!}</a>
                                            </td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><a
                                                            href="{{ route('admin.office.delete_employee', ['id' => $items->id]) }}"><span
                                                                class="iconify" data-icon="iconoir:trash"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('admin.office.edit_employee', ['id' => $items->id]) }}"><span
                                                                class="iconify" data-icon="solar:pen-outline"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                    {{-- <li><a
                                                            href="{{ route('admin.office.profile', ['id' => $items->id]) }}"><span
                                                                class="iconify" data-icon="basil:eye-outline"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                        </li> --}}
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade {{ isset($_GET['tab']) ? ($_GET['tab'] == 'departments' ? 'show active' : '') : '' }}"
                        id="pills-Activeclient" role="tabpanel" aria-labelledby="pills-Activeclient-tab" tabindex="0">
                        <div class="table-responsive ">
                            <table  class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>SNo.</th>
                                        <th>Department</th>
                                        <th>No of Employees</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Rows -->
                                    @foreach ($departments as $items)
                                        <tr>
                                            <td></td>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ $items->department_name }}</td>
                                            <td>{{ $items->employees_count }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="changeStatus"
                                                        data-tb="department" data-id="{{ $items->id }}"
                                                        value="{{ $items->status == 1 ? 0 : 1 }}" role="switch"
                                                        {{ $items->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    @if ($items->employees_count == 0)
                                                        <li><a
                                                                href="{{ route('admin.office.delete_department', ['id' => $items->id]) }}"><span
                                                                    class="iconify" data-icon="iconoir:trash"
                                                                    data-inline="false"
                                                                    style="font-size: 24px;"></span></a></li>
                                                    @endif
                                                    <li><a
                                                            href="{{ route('admin.office.edit_department', ['id' => $items->id]) }}?tab=departments"><span
                                                                class="iconify" data-icon="solar:pen-outline"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade {{ isset($_GET['tab']) ? ($_GET['tab'] == 'designations' ? 'show active' : '') : '' }}"
                        id="pills-InActiveclient" role="tabpanel" aria-labelledby="pills-InActiveclient-tab"
                        tabindex="0">
                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>SNo.</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>No of Employees</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Rows -->
                                    @foreach ($designations as $items)
                                        <tr>
                                            <td></td>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ $items->designation_name }}</td>
                                            <td>{{ $items->department->department_name }}</td>
                                            <td>{{ $items->employees_count }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="changeStatus"
                                                        data-tb="designation" data-id="{{ $items->id }}"
                                                        value="{{ $items->status == 1 ? 0 : 1 }}" role="switch"
                                                        {{ $items->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    @if ($items->employees_count == 0)
                                                        <li><a
                                                                href="{{ route('admin.office.delete_designation', ['id' => $items->id]) }}"><span
                                                                    class="iconify" data-icon="iconoir:trash"
                                                                    data-inline="false"
                                                                    style="font-size: 24px;"></span></a></li>
                                                    @endif
                                                    <li><a
                                                            href="{{ route('admin.office.edit_designation', ['id' => $items->id]) }}?tab=designations"><span
                                                                class="iconify" data-icon="solar:pen-outline"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade {{ isset($_GET['tab']) ? ($_GET['tab'] == 'teams' ? 'show active' : '') : '' }}"
                        id="pills-teams" role="tabpanel" aria-labelledby="pills-teams-tab"
                        tabindex="0">
                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>EMP ID</th>
                                        <th>Team</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teams as $items)
                                    <tr>
                                        <td></td>
                                        <td>{{$items->id}}</td>
                                        <td>{{$items->team_name}}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="changeStatus"
                                                    data-tb="teams" data-id="{{ $items->id }}"
                                                    value="{{ $items->status == 1 ? 0 : 1 }}" role="switch"
                                                    {{ $items->status == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                <li><a
                                                        href="{{ route('admin.office.delete_teams', ['id' => $items->id]) }}"><span
                                                            class="iconify" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px;"></span></a>
                                                </li>
                                                <li><a
                                                        href="{{ route('admin.office.edit_teams', ['id' => $items->id]) }}"><span
                                                            class="iconify" data-icon="solar:pen-outline"
                                                            data-inline="false" style="font-size: 24px;"></span></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade {{ isset($_GET['tab']) ? ($_GET['tab'] == 'employeeShift' ? 'show active' : '') : '' }}" id="pills-Completedclient" role="tabpanel"
                        aria-labelledby="pills-Completedclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>Emp ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Shift Type</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Total Hours</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Rows -->
                                    @foreach ($office_employees as $key => $items)
                                    @php
                                        $shift_json = json_decode($items->shift_json);
                                        // dd($shift_json->shift_type);
                                    @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $items->id }}</td>
                                            <td>{{ $items->name }}</td>
                                            <td>{{ $items->designation->department->department_name }}</td>
                                            <td>{{ $items->designation->designation_name }}</td>
                                            <td>{{ $shift_json->shift_type}}</td>
                                            <td>{{ changeTimeto12($shift_json->start_time) }}</td>
                                            <td>{{ changeTimeto12($shift_json->end_time) }}</td>
                                            <td>{{ countHours($shift_json->start_time, $shift_json->end_time) }}</td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><a href="{{ route('admin.office.edit_shift', ['id' => $items->id]) }}?tab=employeeShift"><span
                                                            class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span>
                                                        </a></li>
                                                </ul>
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




        <!-- write-body-content here end -->
    </div>

    </div>
    </section>

    <!--Department  Modal -->
    <div class="modal fade" id="addDepartmentModel" tabindex="-1" aria-labelledby="addDepartmentModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form
                action="{{ !isset($editDepartment) ? route('admin.office.create_department') : route('admin.office.update_department', ['id' => $editDepartment->id]) }}"
                class="w-100" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDepartmentModelLabel">
                            {{ !isset($editDepartment) ? 'Add Departments' : 'Update Departments' }}</h1>
                        <a href="{{ url('admin/office?tab=departments') }}" class="btn-close" aria-label="Close"></a>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Department Name* </label>
                                <input type="text" class="form-control" id="" placeholder="Department Name*"
                                    name="department_name"
                                    value="{{ isset($editDepartment) ? $editDepartment->department_name : old('department_name') }}">
                                @error('department_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                               <label for="" class="form-label">Status*</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="1" {{ isset($editDepartment) ? ($editDepartment->status == "1" ? 'selected' : '') : '' }}> Active</option>
                                    <option value="0" {{ isset($editDepartment) ? ($editDepartment->status == "0" ? 'selected' : '') : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <a href="{{ url('admin/office?tab=departments') }}" class="prev-step btn-dark">Cancel</a>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--Department  Modal end -->
    <!--Designations  Modal -->
    <div class="modal fade" id="addDesignationsModel" tabindex="-1" aria-labelledby="addDesignationsModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form
                action="{{ !isset($editDesignation) ? route('admin.office.create_designation') : route('admin.office.update_designation', ['id' => $editDesignation->id]) }}"
                class="w-100" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDesignationsModelLabel">
                            {{ !isset($editDesignation) ? 'Add Designation' : 'Update Designation' }} </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <a href="{{ url('admin/office?tab=designations') }}" class="btn-close" aria-label="Close"></a>


                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Add Designation* </label>
                                <input type="text" class="form-control" id="" required
                                    placeholder="Add Designation" name="designation_name"
                                    value="{{ isset($editDesignation) ? $editDesignation->designation_name : old('designation_name') }}">
                                @error('designation_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Department Name* </label>
                                <select class="form-select" aria-label="Default select example" name="department_id"
                                    required>
                                    <option value="" disabled selected>Choose Department</option>
                                    @foreach ($select_departments as $items)
                                        <option value="{{ $items->id }}"
                                            {{ isset($editDesignation) ? ($editDesignation->id == $items->id ? 'selected' : '') : '' }}>
                                            {{ $items->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 mb-3">
                              <label for="" class="form-label">Status*</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="1" {{ isset($editDesignation) ? ($editDesignation->status == "1" ? 'selected' : '') : '' }}> Active</option>
                                    <option value="2" {{ isset($editDesignation) ? ($editDesignation->status == "2" ? 'selected' : '') : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <a href="{{ url('admin/office?tab=designations') }}" class="prev-step btn-dark">Cancel</a>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="addTeamsModel" tabindex="-1" aria-labelledby="addTeamsModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form
                action="{{ !isset($editTeams) ? route('admin.office.create_teams') : route('admin.office.edit_teams', ['id' => $editTeams->id]) }}"
                class="w-100" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDesignationsModelLabel">
                            {{ !isset($editTeams) ? 'Add Teams' : 'Update Teams' }} </h1>
                      
                        <a href="{{ url('admin/office?tab=employeeShift') }}" class="btn-close" aria-label="Close"></a>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                
                                <label for="" class="form-label">Team Name* </label>
                                <input type="text" class="form-control" id="" required
                                    placeholder="Team Name" name="team_name"
                                    value="{{ isset($editTeams) ? $editTeams->team_name : old('team_name') }}">
                                @error('team_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 mb-3">
                                <label for="" class="form-label">Status* </label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="1" selected> Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <a href="{{ url('admin/office?tab=employeeShift') }}" class="prev-step btn-dark">Cancel</a>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (isset($shift_employees))
    @php
        $shiftData = json_decode($shift_employees->shift_json, true);
    @endphp
    <div class="modal fade" id="addEmployeeShift" tabindex="-1" aria-labelledby="addEmployeeShiftModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form
                action="{{ route('admin.office.edit_shift', ['id' => $shift_employees->id]) }}"
                class="w-100" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addEmployeeShiftModelLabel"> Update Shift </h1>
                        <a href="{{ url('admin/office?tab=employeeShift') }}" class="btn-close" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mb-3">
                                <label for="" class="form-label">Shift</label>
                                <select class="form-select" aria-label="Default select example" name="shift_type">
                                    <option value="Day" {{$shiftData['shift_type'] == 'Day'  ? 'Selected' : ''}}> Day</option>
                                    <option value="Night" {{$shiftData['shift_type'] == 'Night'  ? 'Selected' : ''}}> Night</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label for="" class="form-label">Start Shift Time</label>
                                <input type="time" class="form-control" value="{{$shiftData['start_time']}}" name="start_time">
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label for="" class="form-label">End Shift Time</label>
                                <input type="time" class="form-control" value="{{$shiftData['end_time']}}" name="end_time">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                    <a href="{{ url('admin/office?tab=employeeShift') }}" class="prev-step btn-dark">Cancel</a>
                    <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    <!--Designations  Modal end -->
    @if (isset($status_employees))
        <div class="modal fade" id="employeeStatusModel" tabindex="-1" aria-labelledby="clientStatusModelLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form action="{{ url()->current() }}" class="w-100" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h1 class="modal-title fs-5" id="clientStatusModelLabel">Change Status</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <label for="" class="form-label">Status* </label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="1" {{ $status_employees->status == '1' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0" {{ $status_employees->status == '0' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <label for="" class="form-label">Reason* </label>
                                    <textarea class="form-control" id="" rows="3" placeholder="Write Reason" name="status_reason"
                                        required>{{ $status_employees->status_reason }}</textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label for="" class="form-label">Upload Document* </label>
                                    <input type="file" class="form-control" name="status_document">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex align-item-center justify-content-between">
                            <button type="reset" class="btn-dark">Reset</button>
                            <button type="Submit" class="btn-dark" id="success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif


    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
        </div>

        @push('custom-js')
            <script>
                $(document).ready(function() {
                    {!! isset($editDepartment) ? "$('#addDepartmentModel').modal('show')" : '' !!}
                    {!! isset($editDesignation) ? "$('#addDesignationsModel').modal('show')" : '' !!}
                    {!! isset($status_employees) ? "$('#employeeStatusModel').modal('show')" : '' !!}
                    {!! isset($shift_employees) ? "$('#addEmployeeShift').modal('show')" : '' !!}
                    {!! isset($editTeams) ? "$('#addTeamsModel').modal('show')" : '' !!}

                    {!! $errors->has('department_name') ? "$('#addDepartmentModel').modal('show')" : '' !!}
                    {!! $errors->has('designation_name') ? "$('#addDesignationsModel').modal('show')" : '' !!}

                    $('#pills-tab').on('shown.bs.tab', function(event) {
                        // Get the activated tab text
                        $('.dash-tabs-filter').find('.create-client-btn').addClass('d-none');
                        const activeTab = $(event.target).text();
                        // Find the element and update the attribute
                        $('.dash-tabs-filter')
                            .find(`.create-client-btn[data-cl=${activeTab}]`)
                            .removeClass('d-none').addClass('d-block'); // Removes the 'd-none' class
                    });
                    
                    $('input[name=changeStatus]').change(function(){
                        let mthis = $(this);
                        $.ajax({
                          type: "POST",
                          url: "{{route('admin.office.change_status')}}",
                          data: {'type':$(this).data('tb'), 'id':$(this).data('id'),'value':$(this).val(),'_token':"{{ csrf_token() }}"},
                          success: function(data){
                             $(mthis).val(`${$(mthis).val() == 0 ? 1 : 0}`)
                          }
                        });
                    })

                });
            </script>
        @endpush
    @endsection
