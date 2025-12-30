@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
    <style>
        .dash-tabs-content .dt-container .dt-search {
            width: max-content !important;
        }
    </style>
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
                        <div class="dropdown-header form-select" id="dropdownHeader">{{ $single_folder->folder_name }}</div>
                        <div class="dropdown-items hidden" id="dropdownItems">
                            <a href="{{ route('admin.leads.index') }}" class="dropdown-item" data-value="all-leads">
                                <span class="project-title">All Leads</span>
                            </a>
                            @foreach ($lead_folders as $folder)
                                <a href="{{ route('admin.leads.single_folder', ['slug' => $folder->slug]) }}"
                                    class="dropdown-item {{ $folder->slug == $single_folder->slug ? 'selected' : '' }}"
                                    data-value="medical-app">
                                    <span class="project-id">Sales Man :
                                        {{ count(json_decode($folder->emp_json, true)) }}</span>
                                    <span class="project-title">{{ $folder->folder_name }}</span>
                                    {{-- <a href="#" class="view-details">View Leads</a> --}}
                                </a>
                            @endforeach
                            <a href="{{ route('admin.leads.trash_leads') }}" class="dropdown-item" data-value="medical-app">
                                <span class="project-id"></span>
                                <span class="project-title">Trash Leads</span>
                            </a>
                        </div>
                    </div>
                    <form class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item me-2" role="presentation">
                            <select class="form-select rounded-pill" aria-label="Default select example" name="employee"
                                onchange="this.form.submit()" required>
                                <option value="" selected>All Sales Employee</option>
                                @foreach ($sales_emp_folder as $items)
                                    <option value="{{ $items->id }}"
                                        {{ isset($_GET['employee']) ? ($_GET['employee'] == $items->id ? 'selected' : '') : '' }}>
                                        {{ $items->name }} - {{ $items->designation->designation_name }}</option>
                                @endforeach
                            </select>
                        </li>
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
                    </form>
                </div>
                <ul class="nav nav-pills d-none" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill text-nowrap" href="{{ route('admin.leads.index') }}">All Leads</a>
                    </li>
                    @foreach ($lead_folders as $folder)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded-pill text-nowrap {{ $folder->slug == $slug ? 'active' : '' }}"
                                href="{{ route('admin.leads.single_folder', ['slug' => $folder->slug]) }}">{{ $folder->folder_name }}
                                <span
                                    class="badge text-bg-secondary">{{ count(json_decode($folder->emp_json, true)) }}</span></a>
                        </li>
                    @endforeach

                </ul>

                <div class="dash-tabs-filter multi-btns d-flex gap-3">

                    <div class="create-client-btn active d-flex ">
                        {{-- <a href="#!" class="btn btn-sm me-2" data-bs-toggle="modal"
                            data-bs-target="#addLeadsFolderModel"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add
                            Folder</a> --}}
                        {{-- <form class="btn btn-sm me-2" action="{{ route('admin.campaign.run', $folder->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm" style="background-color:#3c2fc0; color:#fff;">

                                ▶ Run Campaign
                            </button>
                        </form> --}}
                        @if (isset($single_folder))
                            <a href="#!" class="btn btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#editLeadsFolderModel"> <img
                                    src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Edit
                                Folder</a>
                            <a href="#!" class="btn btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#addLeadsModel"> <img
                                    src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add Lead
                                in {{ $single_folder->folder_name }}</a>
                            {{-- <a href="#!" class="btn btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#uploadCsvModel"> <img
                                    src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt=""> Upload
                                Csv {{ $single_folder->folder_name }}</a> --}}
                        @endif
                    </div>
                </div>
            </div>

            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>Sr.no.</th>
                                        <th>Employee Name</th>
                                        <th>Designation</th>
                                        <th>Service Name</th>
                                        <th>Change assigned employee</th>
                                        <th>Client Name</th>
                                        <th>Client Phone</th>
                                        <th>Client Email</th>
                                        <th>Price</th>
                                        <th>Latest Remark</th>
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
                                            <td data-rowId="{{ $lead->id }}" class="rowId">{{ $lead->id }}</td>
                                            <td>{{ $lead->employee->name ?? '' }}</td>
                                            <td>{{ $lead->employee->designation->designation_name ?? '' }}</td>
                                            <td>{{ $lead->service_name }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.leads.change_lead_assign', ['id' => $lead->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="old_emp"
                                                        value="{{ $lead->employee->id ?? '' }}">
                                                    <select class="form-select" onchange="this.form.submit()"
                                                        name="assignTo" required>
                                                        @foreach ($sales_emp_folder as $items)
                                                            <option value="{{ $items->id }}" {{-- $lead->employee->id == $items->id ? 'selected' : '' --}}>
                                                                {{ $items->name }} -
                                                                {{ $items->designation->designation_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td>{{ $lead->client_name }}</td>
                                            <td>{{ $lead->client_mobile }}</td>
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
                                            <td><span class="badge succes-bg text-capitalize">{{ $lead->status }}</span>
                                            </td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <a href="{{ route('admin.leads.trash', ['id' => $lead->id]) }}"><span
                                                                class="iconify" data-icon="iconoir:trash"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('admin.leads.single_lead', ['id' => $lead->id]) }}"><span
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
    <div class="modal fade" id="editLeadsFolderModel" tabindex="-1" aria-labelledby="editLeadsFolderModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.leads.edit_folder', ['id' => $single_folder->id]) }}" class="w-100"
                method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="editDepartmentModelLabel">
                            Edit This Folder</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="emp_id" value="3">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Folder Name</label>
                                <input type="text" class="form-control" id="" placeholder="Folder Name"
                                    name="folder_name" value="{{ $single_folder->folder_name }}" required>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Select Sales Man</label>
                                <select class="form-select" aria-label="Default select example" name="employees[]"
                                    multiple required>
                                    <option value="" selected disabled>All Sales Employee</option>
                                    @foreach ($sales_emp as $items)
                                        <option value="{{ $items->id }}"
                                            {{ in_array($items->id, array_column($sales_emp_folder->toArray(), 'id')) ? 'selected' : '' }}>
                                            {{ $items->name }} - {{ $items->designation->designation_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="reset" class="btn-dark">Reset</button>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="addLeadsFolderModel" tabindex="-1" aria-labelledby="addLeadsFolderModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.leads.create_folder') }}" class="w-100" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDepartmentModelLabel">
                            Add Folder</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="emp_id" value="3">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Folder Name</label>
                                <input type="text" class="form-control" id="" placeholder="Folder Name"
                                    name="folder_name" required>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Select Sales Man</label>
                                <select class="form-select" aria-label="Default select example" name="employees[]"
                                    multiple required>
                                    <option value="" selected disabled>All Sales Employee</option>
                                    @foreach ($sales_emp as $items)
                                        <option value="{{ $items->id }}">
                                            {{ $items->name }} - {{ $items->designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="reset" class="btn-dark">Reset</button>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="uploadCsvModel" tabindex="-1" aria-labelledby="uploadCsvModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.leads.upload_lead_csv', ['folder_id' => $single_folder->id]) }}" class="w-100"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDepartmentModelLabel">
                            Upload CSV</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-12 mb-3">
                                <input type="hidden" name="service_name" value="{{ $single_folder->folder_name }}">
                                <input type="hidden" name="employees" value="{{ $single_folder->emp_json }}">
                                <label for="trsdfghj" class="form-label">Select csv</label>
                                <input type="file" id="trsdfghj" class="form-control w-100" name="csv" required>
                            </div>

                        </div>
                        <div class="row" id="appendCsvCol">
                        </div>

                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="reset" class="btn-dark">Reset</button>
                        <button type="Submit" class="btn-dark">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="addLeadsModel" tabindex="-1" aria-labelledby="addLeadsModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.leads.create_lead') }}" class="w-100" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addDepartmentModelLabel">
                            Add Leads</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="emp_id" value="3">
                            <input type="hidden" name="folder_id" value="{{ $single_folder->id }}">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Service Name </label>
                                <input type="text" class="form-control" id="" placeholder="Service Name"
                                    name="service_name" required>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Client Mobile </label>
                                <input type="text" class="form-control" id="" placeholder="987654321"
                                    name="client_mobile" required>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Client Name </label>
                                <input type="text" class="form-control" id="" placeholder="Client Name"
                                    name="client_name" value="" required>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Client Email</label>
                                <input type="text" class="form-control" id="" placeholder="Client Email"
                                    name="client_email">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="" placeholder="amount"
                                    name="amount">
                            </div>

                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Status</label>
                                <select class="form-select" aria-label="Default select example" name="status" required>
                                    <option value="" selected disabled>Choose one status</option>
                                    <option value="hot">Hot</option>
                                    <option value="warm">Warm</option>
                                    <option value="cold">Cold</option>
                                    <option value="fake">Fake</option>
                                    <option value="future">Future</option>
                                    <option value="loss">Loss</option>
                                    <option value="converted">Converted</option>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input border border-success-subtle" type="checkbox"
                                        name="final_recived_amount" value="true" id="flexCheckDefault">
                                    <label class="form-check-label text-danger-emphasis" for="flexCheckDefault">
                                        <small>check this if client already converted</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <label for="" class="form-label">Select Sales Man of
                                        {{ $single_folder->folder_name }}</label>
                                    <select class="form-select" aria-label="Default select example" name="emp_id"
                                        required>
                                        <option value="" selected disabled>All Sales Employee of
                                            {{ $single_folder->folder_name }}</option>
                                        @foreach ($sales_emp_folder as $items)
                                            <option value="{{ $items->id }}">
                                                {{ $items->name }} - {{ $items->designation->designation_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-3 final_recived_amount d-none">
                                    <label for="" class="form-label">Final Amount</label>
                                    <input type="number" class="form-control" id="" placeholder="Final amount"
                                        name="final_amount">
                                </div>
                                <div class="col-lg-6 col-md-6 mb-3 final_recived_amount d-none">
                                    <label for="" class="form-label">Recived Amount</label>
                                    <input type="number" class="form-control" id=""
                                        placeholder="Recived mount" name="recived_amount">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Remark*</label>
                                    <textarea name="remark" rows="3" class="form-control" placeholder="Enter Remark" required></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer d-flex align-item-center justify-content-between">
                            <button type="reset" class="btn-dark">Reset</button>
                            <button type="Submit" class="btn-dark">Submit</button>
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

        @push('custom-js')
            <script>
                $(document).ready(function() {
                    var table = $('.example').DataTable();

                    $('input.dt-select-checkbox').change(function() {
                        $('.dt-container.dt-empty-footer .dt-buttons form').remove();
                        var ids = [];

                        table.rows({
                            selected: true
                        }).every(function(e) {
                            console.log(e)
                            // get the row node
                            var rowNode = $(this.node());
                            // find the .rowId inside that row
                            var id = rowNode.find('.rowId').text().trim();

                            if (id && !ids.includes(Number(id))) {
                                ids.push(Number(id));
                            }
                        });

                        // console.log(ids);
                        if (ids.length > 0) {
                            $('.dt-container.dt-empty-footer .dt-buttons').prepend(`<form action="{{ route('admin.leads.assign_multiple_leads') }}" method="POST">
                            @csrf
                                                    <input name="leads_ids" type="hidden" value='${JSON.stringify(ids)}'>
                                                    <select class="form-select" onchange="this.form.submit()" aria-label="Default select example" name="emp_id"
                                        required>
                                        <option value="" selected disabled>Assign to other</option>
                                        @foreach ($sales_emp_folder as $items)
                                            <option value="{{ $items->id }}">
                                                {{ $items->name }} - {{ $items->designation->designation_name }}</option>
                                        @endforeach
                                    </select>
                                                </form>`)
                        }
                    })
                    $("[name=final_recived_amount]").change(function() {
                        $(".final_recived_amount").find('input').val(null);
                        if ($(this).is(":checked")) {
                            $(".final_recived_amount").removeClass('d-none');
                        } else {
                            $(".final_recived_amount").addClass('d-none');
                        }
                    });
                    $("[name=csv]").change(function() {

                        var fileInput = $(this)[0];
                        var file = fileInput.files[0];

                        if (file) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                var contents = e.target.result;
                                var lines = contents.split('\n');
                                let line = lines[0]
                                $('#appendCsvCol').html('')
                                $(line.split(',')).each(function(i, e) {
                                    $('#appendCsvCol').append(`<div class="col-lg-3 mb-3">
                                <label for="" class="form-label">${e}</label>
                                <select name="${i}" class="form-control">
                                    <option value="none" selected>None</option>
                                    <option value="client_name">Client name</option>
                                    <option value="client_mobile">Client mobile</option>
                                    <option value="client_email">Client email</option>
                                    <option value="description">Description</option>
                                </select>
                            </div>`)
                                })
                                // $('#appendCsvCol').find('selectd').change(function(){
                                //     $(this)
                                // })
                            };

                            reader.readAsText(file);
                        } else {
                            alert('Please select a file first.');
                        }
                    });
                })
            </script>

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
