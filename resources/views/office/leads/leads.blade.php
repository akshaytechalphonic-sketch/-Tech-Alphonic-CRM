@extends('office.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    @php
        $route = \Request::route()->getName();
    @endphp
    <style>
        .custom-dropdown {
            width: 250px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2px;
            font-family: 'Arial', sans-serif;
            position: relative;
            cursor: pointer;
        }

        .dropdown-header {
            font-weight: bold;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            /* text-align: center; */
        }

        .dropdown-items {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 100;
            display: none;
        }

        .dropdown-items.visible {
            display: block;
        }

        .dropdown-item {
            padding: 10px;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f4f4f4;
        }

        .dropdown-item.selected {
            background-color: #f0f8ff;
            border: 1px solid #d0e8ff;
            border-right: 4px solid #3c2fc0;
        }

        .project-id {
            font-size: 12px;
            color: #666666;
        }

        .project-title {
            font-size: 14px;
            font-weight: bold;
            color: #333333;
        }

        .view-details {
            font-size: 12px;
            color: #007bff;
            text-decoration: none;
            align-self: flex-start;
        }

        .view-details:hover {
            text-decoration: underline;
        }
    </style>
    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex">
                    <div class="custom-dropdown me-3" id="dropdown">
                        <div class="dropdown-header form-select" id="dropdownHeader">All leads</div>
                        <div class="dropdown-items hidden" id="dropdownItems">
                            <a href="{{ route('office_employee.leads.index') }}" class="dropdown-item selected"
                                data-value="all-leads">
                                <span class="project-title">All Leads</span>
                            </a>
                            @foreach ($lead_folders as $folder)
                                @if (in_array($login_employee->id, json_decode($folder->emp_json, true)))
                                    <a href="{{ route('office_employee.leads.single_folder', ['slug' => $folder->slug]) }}"
                                        class="dropdown-item" data-value="medical-app">
                                        <span class="project-id">Sales Man :
                                            {{ count(json_decode($folder->emp_json, true)) }}</span>
                                        <span class="project-title">{{ $folder->folder_name }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <form class="nav nav-pills" id="pills-tab" role="tablist">
                        @php
                            $authEmployee = Auth::guard('office_employees')->user();
                        @endphp
                        @if (in_array($authEmployee->role_id, [1, 2, 4]))
                            <li class="nav-item me-2" role="presentation">
                                <select class="form-select rounded-pill text-capitalize" aria-label="Default select example"
                                    name="employee" onchange="this.form.submit()" required>
                                    <option value="" selected>All Sales Employee</option>
                                    @foreach ($sales_emp as $items)
                                        <option value="{{ $items->id }}"
                                            {{ isset($_GET['employee']) ? ($_GET['employee'] == $items->id ? 'selected' : '') : '' }}>
                                            {{ $items->name }} -
                                            ({{ $items->designation->designation_name }})
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                        @endif
                        <li class="nav-item" role="presentation">
                            <select class="form-select rounded-pill" aria-label="Default select example"
                                onchange="this.form.submit()" name="status" required>
                                <option value="" selected>Select status</option>
                                <option value="open"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'open' ? 'selected' : '') : '' }}>Open
                                </option>
                                <option value="hot"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'hot' ? 'selected' : '') : '' }}>Hot
                                </option>
                                <option value="warm"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'warm' ? 'selected' : '') : '' }}>Warm
                                </option>
                                <option value="cold"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'cold' ? 'selected' : '') : '' }}>Cold
                                </option>
                                <option value="fake"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'fake' ? 'selected' : '') : '' }}>Fake
                                </option>
                                <option value="future"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'future' ? 'selected' : '') : '' }}>
                                    Future
                                </option>
                                <option value="loss"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'loss' ? 'selected' : '') : '' }}>Loss
                                </option>
                                <option value="connected"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'connected' ? 'selected' : '') : '' }}>
                                    Connected
                                </option>
                                <option value="not connected"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'not connected' ? 'selected' : '') : '' }}>
                                    Not Connected
                                </option>
                                <option value="converted"
                                    {{ isset($_GET['status']) ? ($_GET['status'] == 'converted' ? 'selected' : '') : '' }}>
                                    Converted</option>
                            </select>
                        </li>
                        <li class="nav-item ms-2 d-flex align-items-center" role="presentation">
                            <input type="date" name="filter_by_lead" onchange="this.form.submit()"
                                class="form-control rounded-pill "
                                value="{{ isset($_GET['filter_by_lead']) && $_GET['filter_by_lead'] != '' ? $_GET['filter_by_lead'] : '' }}"
                                max="{{ date('Y-m-d') }}">
                            @if (isset($_GET['filter_by_lead']) && $_GET['filter_by_lead'] != '')
                                <a class="ms-2"
                                    href="{{ url()->current() . '?' . http_build_query(request()->except('filter_by_lead')) }}"><i
                                        class="fa-regular fa-circle-xmark"></i></a>
                            @endif
                        </li>
                    </form>
                </div>

                <div class="dash-tabs-filter multi-btns d-flex gap-3">
                    {{-- <div class="create-client-btn active d-flex">
                        <a href="#!" class="d-flex align-items-center gap-2 me-2" data-bs-toggle="modal"
                            data-bs-target="#meetingsScheduleModal">

                            <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">

                            Schedule Meeting
                        </a>
                    </div> --}}
                    @auth('office_employees')
                        @php
                            $employee = auth('office_employees')->user();
                        @endphp
                        @if (!$employee->google_token)
                            <div class="create-client-btn active d-flex">
                                <a href="{{ route('meetings.redirectToGoogle') }}"
                                    class="d-flex align-items-center gap-2 me-2">
                                    <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">
                                    Connect Google Calendar
                                </a>
                            </div>
                        @else
                            {{-- <div class="create-client-btn d-flex text-success align-items-center">
                                <i class="fa fa-check-circle me-2"></i>
                                Google Calendar Connected
                            </div> --}}
                            <div class="create-client-btn active d-flex">
                                <a href="#!" class="d-flex align-items-center gap-2 me-2" data-bs-toggle="modal"
                                    data-bs-target="#meetingsScheduleModal">

                                    <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">

                                    Schedule Meeting
                                </a>
                            </div>
                        @endif
                    @endauth

                </div>


                <div class="dash-tabs-filter multi-btns d-flex gap-3">
                    {{-- <div class="create-client-btn {{ isset($_GET['tab']) ? ($_GET['tab'] == 'departments' ? 'd-block' : 'd-none') : 'd-none' }}"
                        data-cl="Departments">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#addDepartmentModel"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add
                            Departments</a>
                    </div> --}}
                    {{-- <div class="create-client-btn {{ isset($_GET['tab']) ? ($_GET['tab'] == 'designations' ? 'd-block' : 'd-none') : 'd-none' }}"
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
                    </div> --}}
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

                    <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>ID</th>
                                        <th>Assign Date</th>
                                        @if (Auth::guard('office_employees')->user()->role_id != 3)
                                            <th>Assigned To</th>
                                        @endif
                                        <th>Service Name</th>
                                        <th>Client Name</th>
                                        <th>Client Phone</th>
                                        <th>WhatsApp</th>
                                        <th>Client Email</th>
                                        <th>Price</th>
                                        <th>Latest Remark</th>
                                        {{-- <th>Type</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($leads->employee)}} --}}
                                    @foreach ($leads as $lead)
                                        @php
                                            $remark_json = json_decode($lead->remark, true);
                                            $remark_json = end($remark_json);
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ date('d, M Y', strtotime($lead->assign_date)) }}</td>
                                             @if (Auth::guard('office_employees')->user()->role_id != 3)
                                            <td>{{ $lead->employee->name }}</td>
                                            @endif
                                            <td>{{ $lead->service_name }}</td>
                                            <td>{{ $lead->client_name }}</td>
                                            <td>{{ $lead->client_mobile }}</td>
                                            <td class="text-center">
                                                <a href="https://wa.me/91{{ preg_replace('/\D/', '', $lead->client_mobile) }}"
                                                    target="_blank" title="Chat on WhatsApp">
                                                    <i class="fa-brands fa-whatsapp"
                                                        style="color:#25D366; font-size:22px;"></i>
                                                </a>
                                            </td>

                                            <td>{{ $lead->client_email }}</td>
                                            <td>{{ number_format($lead->amount) }}</td>
                                            <td>
                                                <span class="badge bg-primary-subtle text-dark">Time :
                                                    {{ $remark_json['time'] }}</span>
                                                <span class="badge bg-primary-subtle text-dark">Date :
                                                    {{ date('d M, Y', strtotime($remark_json['date'])) }}</span><br>
                                                <span
                                                    class="badge bg-primary-subtle text-dark w-100 mt-1 text-wrap">{{ $remark_json['remark'] }}</span>
                                            </td>
                                            {{-- <td>{{ $lead->type }}</span> --}}
                                            <td><span class="badge succes-bg text-capitalize">{{ $lead->status }}</span>
                                            </td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <a
                                                            href="{{ route('office_employee.leads.trash', ['id' => $lead->id]) }}"><span
                                                                class="iconify" data-icon="iconoir:trash"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('office_employee.leads.single_lead', ['id' => $lead->id]) }}"><span
                                                                class="iconify" data-icon="basil:eye-outline"
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


                </div>
            </div>

        </div>




        <!-- write-body-content here end -->
    </div>

    </div>
    </section>

    <div class="modal fade" id="meetingsScheduleModal" tabindex="-1" aria-labelledby="meetingsScheduleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="meetingsScheduleModalLabel">
                        📅 Schedule Meeting
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('meetings.store') }}" id="meetingForm">
                        @csrf

                        <!-- Meeting Title -->
                        <div class="mb-3">
                            <label class="form-label">Meeting Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter meeting title"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Email (Optional)</label>
                            <input type="email" name="client_email" class="form-control" placeholder="Enter Email">

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Client</label>
                            <select name="client_name" class="form-select">
                                <option value="">-- Select Client --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">
                                        {{ $client->client_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Senior -->
                        <div class="mb-3">
                            <label class="form-label">Select Senior</label>
                            <select name="senior_id" class="form-select" required>
                                <option value="">-- Select Senior --</option>
                                @foreach ($seniors as $senior)
                                    <option value="{{ $senior->id }}">
                                        {{ $senior->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label class="form-label">Meeting Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <!-- Time -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="start_time" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Time</label>
                                <input type="time" name="end_time" class="form-control" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Optional notes"></textarea>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Schedule & Generate Meet Link
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
        </div>
        @push('custom-js')
            {{-- <script>
                $(document).ready(function() {
                    $("[name=final_recived_amount]").change(function() {
                        if ($(this).is(":checked")) {
                            $(".final_recived_amount").removeClass('d-none');
                        }else{
                            $(".final_recived_amount").addClass('d-none');
                        }
                    });
                })
            </script> --}}
            <script>
                // Get references to elements
                const dropdownHeader = document.getElementById("dropdownHeader");
                const dropdownItems = document.getElementById("dropdownItems");
                const dropdown = document.getElementById("dropdown");

                // Toggle dropdown visibility
                dropdownHeader.addEventListener("click", () => {
                    dropdownItems.classList.toggle("visible");
                });

                // Handle item selection
                dropdownItems.addEventListener("click", (event) => {
                    const selectedItem = event.target.closest(".dropdown-item");
                    if (selectedItem) {
                        // Close the dropdown
                        dropdownItems.classList.remove("visible");

                        // Remove "selected" class from all items
                        document.querySelectorAll(".dropdown-item").forEach((item) => {
                            item.classList.remove("selected");
                        });

                        // Mark the clicked item as selected
                        selectedItem.classList.add("selected");

                        // Optionally log or handle the selected value
                        console.log("Selected value:", selectedItem.dataset.value);
                    }
                });

                // Close dropdown if clicked outside
                document.addEventListener("click", (event) => {
                    if (!dropdown.contains(event.target)) {
                        dropdownItems.classList.remove("visible");
                    }
                });
            </script>
        @endpush
    @endsection
