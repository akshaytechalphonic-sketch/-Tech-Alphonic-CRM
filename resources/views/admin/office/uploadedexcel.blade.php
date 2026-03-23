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


                </div>


                <div class="dash-tabs-filter multi-btns d-flex gap-3">



                    <div class="create-client-btn active d-flex ">

                       <a href="javascript:void(0)" class="btn btn-sm me-2"
   data-bs-toggle="modal" data-bs-target="#googlesheetModal">
    <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">
    Google Sheet
</a>

                        <a href="#!" class="btn btn-sm me-2" data-bs-toggle="modal" data-bs-target="#uploadCsvModel">
                            <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt=""> Upload
                            CSV </a>

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
                                        <th><span class="d-none">All</span></th>
                                        <th>Sr.no.</th>
                                        <th>File Name</th>
                                        <th>Sourse Type</th>
                                        <th>Total Rows</th>
                                        <th>Distributed Rows</th>
                                        <th>Uploaded At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- {{dd($leads->employee)}} --}}
                                    @foreach ($uploadedexcel as $index => $item)
                                        @php

                                            $assignedCount = $item->uploadedexcelrow->where('is_assigned', 1)->count();

                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->original_name }}</td>
                                            <td>{{ $item->source_type }}</td>
                                            <td>{{ $item->total_rows }}</td>
                                            <td>{{ $assignedCount }}</td>
                                            <td>{{ $item->uploaded_at }}</td>

                                            <td><span class="badge succes-bg text-capitalize">{{ $item->status }}</span>
                                            </td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            onclick="openDistributeModal({{ $item->id }},{{ $item->total_rows }})"
                                                            title="Distribute">
                                                            <span class="iconify" data-icon="mdi:share-variant"
                                                                style="font-size: 24px;"></span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            href="{{ route('admin.leads.cron_restore', ['id' => $item->id]) }}"><span
                                                                class="iconify" data-icon="mdi:history" data-inline="false"
                                                                style="font-size: 24px;"></span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.leads.excel', ['id' => $item->id]) }}"><span
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

  <div class="modal fade" id="googlesheetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Connect Google Sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form Start -->
            <form method="POST" action="{{ route('admin.google.sheet.connect') }}">
                @csrf

                <!-- Modal Body -->
                <div class="modal-body">

                    <!-- Sheet URL -->
                    <div class="mb-3">
                        <label class="form-label">Google Sheet URL</label>
                        <input type="text" id="sheet_url" name="sheet_url"
                               class="form-control" required>
                    </div>

                    <!-- Fetch Columns Button -->
                    <button type="button" id="fetchColumnsBtn" class="btn btn-primary">
                        Fetch Columns
                    </button>

                    <hr>

                    <!-- Mapping Section -->
                    <div id="mappingSection" style="display:none;">

                        <h5 class="mb-3">Map Sheet Columns</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Name Column</label>
                                <select name="mapping[client_name]" id="client_name"
                                        class="form-control" required></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Phone Column</label>
                                <select name="mapping[client_mobile]" id="client_mobile"
                                        class="form-control" required></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Mobile Column 2</label>
                                <select name="mapping[client_mobile2]" id="client_mobile2"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email Column</label>
                                <select name="mapping[client_email]" id="client_email"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Service Column</label>
                                <select name="mapping[service_name]" id="service_name"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Budget</label>
                                <select name="mapping[budget]" id="budget"
                                        class="form-control"></select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label>Website URL</label>
                                <select name="mapping[website]" id="website"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Location</label>
                                <select name="mapping[location]" id="location"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Extra Column 1</label>
                                <select name="mapping[extra_1]" id="extra_1"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Extra Column 2</label>
                                <select name="mapping[extra_2]" id="extra_2"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Extra Column 3</label>
                                <select name="mapping[extra_3]" id="extra_3"
                                        class="form-control"></select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Extra Column 4</label>
                                <select name="mapping[extra_4]" id="extra_4"
                                        class="form-control"></select>
                            </div>

                        </div>

                        <!-- Folder Selection -->
                        <div class="mb-3">
                            <label>Select Folder</label>
                            <select name="folder_id" class="form-control" required>
                                @foreach ($folders as $folder)
                                    <option value="{{ $folder->id }}">
                                        {{ $folder->folder_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit" id="connectBtn"
                            class="btn btn-success" style="display:none;">
                        Connect Live Sync
                    </button>
                </div>

            </form>
            <!-- Form End -->

        </div>
    </div>
</div>

    <div class="modal fade" id="uploadCsvModel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.leads.upload_lead_csv') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Excel / CSV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Hidden values -->
                        {{-- <input type="hidden" name="employees" value=" $single_folder->emp_json"> --}}

                        <!-- File -->
                        <div class="mb-3">
                            <label class="form-label">Select CSV File</label>
                            <input type="file" name="csv" class="form-control" required>
                        </div>

                        <!-- Column Mapping -->
                        <div class="row" id="appendCsvCol"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="modal fade" id="distributeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            {{-- <form action="{{ route('admin.leads.uploaded-excels.distribute') }}" method="POST"> --}}
            {{-- <form action="{{ route('admin.leads.uploaded-excels.schedule') }}" method="POST">

                @csrf
                <input type="hidden" name="excel_id" id="excel_id">
                <input type="hidden" name="end_row" id="end_row">


                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Distribute Leads</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row mb-2">
                            <div class="col">
                                <label>Start Row</label>
                                <input type="number" name="start" id="start" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>End Row</label>
                                <input type="number" name="end" id="end" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label>Select Folder</label>
                            <select name="folder_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach ($folders as $folder)
                                    <option value="{{ $folder->id }}">
                                        {{ $folder->folder_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label>Date</label>
                                <input type="date" name="assign_date" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Time</label>
                                <input type="time" name="assign_time" class="form-control" required>
                            </div>
                        </div>

                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Schedule</button>
                    </div>
                </div>
            </form> --}}
            <form action="{{ route('admin.leads.uploaded-excels.schedule') }}" method="POST">
                @csrf

                <input type="hidden" name="excel_id" id="excel_id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Distribute Leads</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_auto" class="form-check-input" id="auto_run" value="1">
                            <label class="form-check-label" for="auto_run">Auto Run Cron Job (Distribute All)</label>
                        </div>

                        <div id="distribution-wrapper">

                            <!-- 🔥 DISTRIBUTION BLOCK -->
                            <div class="distribution-block border rounded p-3 mb-3 position-relative">


                                <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-block distribution-action-btn"
                                    onclick="removeDistributionBlock(this)">
                                    Remove
                                </button><br>
                                <div class="row mb-2 manual-distribution-fields">
                                    <div class="col">
                                        <label>Start Row</label>
                                        <input type="number" name="start[]" class="form-control start-row" required>
                                    </div>
                                    <div class="col">
                                        <label>End Row</label>
                                        <input type="number" name="end[]" class="form-control end-row" required>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label>Select Folder</label>
                                    <select name="folder_id[]" class="form-control" required>
                                        <option value="">Select One</option>
                                        @foreach ($folders as $folder)
                                            <option value="{{ $folder->id }}">{{ $folder->folder_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row mb-2 manual-distribution-fields">
                                    <div class="col">
                                        <label>Date</label>
                                        <input type="date" name="assign_date[]" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label>Time</label>
                                        <input type="time" name="assign_time[]" class="form-control" required>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- ➕ ADD BUTTON -->
                        <button type="button" id="add-more-distribution-btn" class="btn btn-sm btn-outline-primary distribution-action-btn" onclick="addDistributionBlock()">
                            ➕ Add More
                        </button>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Schedule</button>
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
                document.getElementById("fetchColumnsBtn").addEventListener("click", function() {

                    let sheetUrl = document.getElementById("sheet_url").value;
                    

                    fetch("{{ route('admin.google.sheet.fetchColumns') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                sheet_url: sheetUrl
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            console.log('API Response:', data);
                            if (!data.status) {
                                alert(data.message);
                                return;
                            }

                            let headers = data.headers;
                            let fields = ["client_name", "client_mobile", "client_mobile2", "client_email", "service_name", "budget", "website", "location", "extra_1", "extra_2", "extra_3", "extra_4"];

                            fields.forEach(field => {

                                let select = document.getElementById(field);
                                select.innerHTML = "";

                                // Add default empty option first
                                let defaultOption = document.createElement("option");
                                defaultOption.value = "";
                                defaultOption.text = "-- Select Header --";
                                defaultOption.selected = true;
                                select.appendChild(defaultOption);

                                headers.forEach(col => {
                                    let option = document.createElement("option");
                                    option.value = col;
                                    option.text = col;
                                    select.appendChild(option);
                                });

                            });

                            document.getElementById("mappingSection").style.display = "block";
                            document.getElementById("connectBtn").style.display = "inline-block";

                        });

                });
            </script>
            <script>
                $("[name=csv]").on('change', function() {
                    let file = this.files[0];
                    if (!file) return;

                    let reader = new FileReader();

                    reader.onload = function(e) {
                        let lines = e.target.result.split("\n");
                        let headers = lines[0].split(",");

                        $("#appendCsvCol").html("");

                        headers.forEach((col, index) => {
                            $("#appendCsvCol").append(`
                    <div class="col-md-3 mb-3">
                        <label class="form-label">${col.trim()}</label>
                        <select name="${index}" class="form-select">
                            <option value="none">None</option>
                            <option value="client_name">Client Name</option>
                            <option value="service_name">Service Name</option>
                            <option value="client_mobile">Client Mobile</option>
                            <option value="client_email">Client Email</option>
                            <option value="description">Description</option>
                        </select>
                    </div>
                `);
                        });
                    };

                    reader.readAsText(file);
                });
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

            {{-- <script>
                function openDistributeModal(excelId, end_row) {
                    document.getElementById('excel_id').value = excelId;
                    //   document.getElementById('start').value = end_row;
                    new bootstrap.Modal(document.getElementById('distributeModal')).show();
                }
            </script> --}}

            {{-- <script>
                function openDistributeModal(excelId) {
                    document.getElementById('excel_id').value = excelId;
                     document.getElementById('excel_id').value = excelId;
                    new bootstrap.Modal(document.getElementById('distributeModal')).show();
                }

                function addDistributionBlock() {

                    let wrapper = document.getElementById('distribution-wrapper');
                    let blocks = wrapper.getElementsByClassName('distribution-block');
                    let lastBlock = blocks[blocks.length - 1];

                    let lastEnd = lastBlock.querySelector('.end-row').value;

                    let clone = lastBlock.cloneNode(true);

                    // reset values
                    clone.querySelectorAll('input, select').forEach(el => el.value = '');

                    // auto start row = last end + 1
                    if (lastEnd) {
                        clone.querySelector('.start-row').value = parseInt(lastEnd) + 1;
                    }

                    wrapper.appendChild(clone);
                }
            </script> --}}
            <script>
                function openDistributeModal(excelId) {
                    document.getElementById('excel_id').value = excelId;
                    new bootstrap.Modal(document.getElementById('distributeModal')).show();
                }

                function addDistributionBlock() {

                    let wrapper = document.getElementById('distribution-wrapper');
                    let blocks = wrapper.getElementsByClassName('distribution-block');
                    let lastBlock = blocks[blocks.length - 1];

                    let lastEnd = lastBlock.querySelector('.end-row').value;

                    let clone = lastBlock.cloneNode(true);

                    // reset inputs
                    clone.querySelectorAll('input, select').forEach(el => el.value = '');

                    // auto start row
                    if (lastEnd) {
                        clone.querySelector('.start-row').value = parseInt(lastEnd) + 1;
                    }

                    wrapper.appendChild(clone);
                }

                function removeDistributionBlock(btn) {

                    let wrapper = document.getElementById('distribution-wrapper');
                    let blocks = wrapper.getElementsByClassName('distribution-block');

                    // ❗ At least one block must remain
                    if (blocks.length <= 1) {
                        alert('At least one distribution block is required');
                        return;
                    }

                    btn.closest('.distribution-block').remove();
                }

                // Auto Run toggle logic
                document.getElementById('auto_run').addEventListener('change', function() {
                    let isChecked = this.checked;
                    
                    document.querySelectorAll('.manual-distribution-fields').forEach(el => {
                        el.style.display = isChecked ? 'none' : 'flex';
                    });
                    
                    document.querySelectorAll('.distribution-action-btn').forEach(el => {
                        el.style.display = isChecked ? 'none' : 'inline-block';
                    });

                    // Remove required attributes from hidden manual fields so it can submit
                    document.querySelectorAll('.manual-distribution-fields input').forEach(el => {
                        if (isChecked) {
                            el.removeAttribute('required');
                        } else {
                            el.setAttribute('required', 'required');
                        }
                    });

                    if (isChecked) {
                        // Keep only first block, remove others
                        let blocks = document.querySelectorAll('.distribution-block');
                        for (let i = 1; i < blocks.length; i++) {
                            blocks[i].remove();
                        }
                    }
                });
            </script>

           
        @endpush
    @endsection
