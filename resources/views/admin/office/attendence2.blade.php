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
                <div class="d-flex align-items-center gap-3">
                    <ul class="nav nav-pills " id="pills-tab" role="tablist">
                        <li class="nav-item me-3 d-none">
                            <!-- <button class="client-main-btn" type="button" >Employee <img src="assets/images/icons/double-arrow.png" alt=""> </button> -->
                        </li>
                        <li class="nav-item d-none" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Allclient-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Allclient" type="button" role="tab"
                                aria-controls="pills-Allclient" aria-selected="true">Tax Invoice </button>
                        </li>
                        <li class="nav-item d-none" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Completedclient-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Completedclient" type="button" role="tab"
                                aria-controls="pills-Completedclient" aria-selected="false">View Attendance </button>
                        </li>
                        <li class="nav-item d-none" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Activeclient-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Activeclient" type="button" role="tab"
                                aria-controls="pills-Activeclient" aria-selected="false">View Attendance2 </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill active" id="pills-InActiveclient-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-InActiveclient" type="button" role="tab"
                                aria-controls="pills-InActiveclient" aria-selected="false">View Attendance3 </button>
                        </li>
                    </ul>
                </div>

                <div class="dash-tabs-filter d-flex gap-3">
                    <div class="filter-btn">
                        @php
                            $curMonth = isset($_GET['attendDate']) ? $_GET['attendDate'] : date('Y-m');
                        @endphp
                        <input type="month" name="" class="form-control" id="dateFilter"
                            value="{{ $curMonth }}" max="{{ date('Y-m') }}">

                    </div>
                    <div class="filter-btn">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#filterModel"> <img src="../assets/images/icons/setting.png"
                                alt="">Filter</a>
                    </div>
                </div>
            </div>

            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    {{-- <div class="tab-pane fade d-none" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table id="example" class="  row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>SNo.</th>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Designation </th>
                                        <th>Check In Time</th>
                                        <th> Check Out Time</th>
                                        <th>Total Working Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Rows -->
                                    <tr>
                                        <td></td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="red"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="red"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
                                    </tr>


                                    <!-- Add more rows here -->
                                </tbody>
                            </table>
                        </div>

                    </div> --}}

                    {{-- <div class="tab-pane fade d-none" id="pills-Completedclient" role="tabpanel"
                        aria-labelledby="pills-Completedclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table class="table example">
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="red"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="red"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                                <div class="green"></div> 09:46 AM
                                            </div>
                                        </td>
                                        <td>07:46 PM</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
                                    </tr>


                                    <!-- Add more rows here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade d-none" id="pills-Activeclient" role="tabpanel"
                        aria-labelledby="pills-Activeclient-tab" tabindex="0">
                        <div class="table-responsive">

                            <table class="table example">
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
                                        <th>Total Days </th>
                                        <th>Present Days</th>
                                        <th> Overtime</th>
                                        <th>Total Working Hours</th>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
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
                                        <td>30</td>
                                        <td>24</td>
                                        <td>2 Hours</td>
                                        <td>8 Hrs 40 Mins 56 Secs</td>
                                    </tr>


                                    <!-- Add more rows here -->
                                </tbody>
                            </table>

                        </div>
                    </div> --}}

                    <div class="tab-pane fade show active" id="pills-InActiveclient" role="tabpanel"
                        aria-labelledby="pills-InActiveclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table id="example" class="  row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Month</th>
                                        @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($curMonth)), date('Y', strtotime($curMonth))); $i++)
                                            <th>Day {{ $i }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Sample Rows -->
                                    @foreach ($office_employees as $main)
                                        <tr>
                                            <td></td>
                                            <td>{{ $main->id }}</td>
                                            <td>{{ $main->name }}</td>
                                            <td>{{ $main->designation->designation_name }}</td>
                                            <td>{{ date('M, Y', strtotime($curMonth)) }} 
                                                @php
                                                // $currentMonth = date('Y-m');
                                                $attendanceForCurrentMonth = $main->attendances2->firstWhere('month', $curMonth);

                                                    // $attend = $sec_attendance != null ? $sec_attendance->firstWhere('emp_id', $main->id) : false;
                                                    $attendSingle = $attendanceForCurrentMonth ? $attendanceForCurrentMonth->toArray() : null;
                                                @endphp
                                            </td>
                                            @for ($a = 1; $a <= cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($curMonth)), date('Y', strtotime($curMonth))); $a++)
                                                <td>
                                                    @php
                                                        $all_saturday = '';
                                                        $first_saturday = '';
                                                        $third_saturday = '';
                                                        $secound_saturday = '';
                                                        $fourth_saturday = '';
                                                        if ($main->other_leave == 'all_saturday') {
                                                            $all_saturday =
                                                                date(
                                                                    'D',
                                                                    strtotime(
                                                                        "$curMonth-" .
                                                                            str_pad($a, 2, '0', STR_PAD_LEFT),
                                                                    ),
                                                                ) == 'Sat'
                                                                    ? 'checked'
                                                                    : '';
                                                        } elseif ($main->other_leave == 'first_and_third_saturday') {
                                                            $first_saturday =
                                                                date(
                                                                    'Y-m-d',
                                                                    strtotime(
                                                                        'first saturday of ' .
                                                                            date('M Y', strtotime($curMonth)),
                                                                    ),
                                                                ) ==
                                                                "$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT)
                                                                    ? 'checked'
                                                                    : '';
                                                            $third_saturday =
                                                                date(
                                                                    'Y-m-d',
                                                                    strtotime(
                                                                        'third saturday of ' .
                                                                            date('M Y', strtotime($curMonth)),
                                                                    ),
                                                                ) ==
                                                                "$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT)
                                                                    ? 'checked'
                                                                    : '';
                                                        } elseif ($main->other_leave == 'secound_and_fourth_saturday') {
                                                            $secound_saturday =
                                                                date(
                                                                    'Y-m-d',
                                                                    strtotime(
                                                                        date('F Y', strtotime($curMonth)) .
                                                                            ' second saturday',
                                                                    ),
                                                                ) ==
                                                                "$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT)
                                                                    ? 'checked'
                                                                    : '';
                                                            $fourth_saturday =
                                                                date(
                                                                    'Y-m-d',
                                                                    strtotime(
                                                                        'fourth saturday of ' .
                                                                            date('M Y', strtotime($curMonth)),
                                                                    ),
                                                                ) ==
                                                                "$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT)
                                                                    ? 'checked'
                                                                    : '';
                                                        }
                                                    @endphp
                                                    {{-- {{$sdfgg->id}} --}}
                                                    {{-- {{"$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT)}} --}}
                                                    {{-- {{ date('Y-m-d', strtotime('first saturday of ' . date('M Y', strtotime($curMonth)))) == "$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT) ? 'checked' : '' }} --}}
                                                    {{-- {{ (date('Y-m-d', strtotime($curMonth . "-$a")) == (date('Y-m-d', strtotime('second saturday of ' . date('F Y'))))) ? 'checked' : '' }} --}}
                                                    {{-- {{ date('Y-m-d', strtotime('secound saturday of ' . date('M Y', strtotime("2024-12")))).'-'.date('M Y', strtotime("2024-12")) }} --}}
                                                    {{-- {{ date('Y-m-d', strtotime('secound saturday of ' . date('M Y', strtotime("2024-12")))) == "2024-12-14" ? 'checked' : '' }} --}}
                                                    {{-- {{ date('Y-m-d', strtotime('third saturday of ' . date('M Y', strtotime($curMonth)))) == "$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT) ? 'checked' : '' }} --}}
                                                    {{-- {{ date('Y-m-d', strtotime('fourth saturday of ' . date('M Y', strtotime($curMonth)))) == "$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT) ? 'checked' : '' }} --}}
                                                    {{-- {{$secound_saturday . $fourth_saturday}} --}}
                                                    <input
                                                        class="manageAttendance form-check-input border-primary {{ date('D', strtotime("$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT))) == 'Sun' ? 'pe-none opacity-25' : '' }} {{ $all_saturday != '' ? 'pe-none opacity-25' : '' }} {{ $first_saturday != '' ? 'pe-none opacity-25' : '' }} {{ $secound_saturday != '' ? 'pe-none opacity-25' : '' }} {{ $third_saturday != '' ? 'pe-none opacity-25' : '' }} {{ $fourth_saturday != '' ? 'pe-none opacity-25' : '' }}"
                                                        data-manager="employeeAtten_{{ $main->id }}"
                                                        data-emp_id="{{ $main->id }}"
                                                        data-monthYear="{{ $curMonth }}"
                                                        data-date="{{ str_pad($a, 2, '0', STR_PAD_LEFT) }}"
                                                        type="checkbox" name="employeeAtten_{{ $main->id }}[]"
                                                        value='{{ json_encode(['day' => "day_$a", 'sun' => date('D', strtotime("$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT))) == 'Sun' ? true : false]) }}'
                                                        {{ date('D', strtotime("$curMonth-" . str_pad($a, 2, '0', STR_PAD_LEFT))) == 'Sun' ? 'checked' : '' }}
                                                        {{ $all_saturday == '' ? $first_saturday . $third_saturday . $secound_saturday . $fourth_saturday : $all_saturday }}
                                                        {{ $attendSingle != null ? ($attendSingle["day_$a"] != '' ? 'checked' : '') : ''}}>
                                                </td>
                                            @endfor
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
                $('#dateFilter').change(function() {

                    window.location.href = `{{ route('admin.attendance.attendance2') }}?attendDate=${$(this).val()}`
                })
                $('select[name=changeLeaveStatus]').change(function() {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.attendance.change_leave_status') }}",
                        data: {
                            'leave_id': $(this).data('leave_id'),
                            'status': $(this).val(),
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                })
                $('.addAssignLeaveTo').click(function() {
                    $lfgh = $(this)[0]
                    $('input#model_leave_id').val($($lfgh).data('leave_id'))
                })
                $(document).ready(function() {
                    $('.manageAttendance').change(function() {
                        let ertyuiug = $(this)[0]
                        $(ertyuiug).data('manager')
                        if ($(ertyuiug).is(':checked')) {
                            const attendanceValues = $(`input[name="${$(ertyuiug).data('manager')}[]"]:checked`).map(
                            function() {
                                return $(this).val();
                            }).get();
                            $.ajax({
                                type: "POST",
                                url: `{{ route('admin.attendance.attendance2_update') }}/${$(ertyuiug).data('emp_id')}`,
                                data: {
                                    'monthYear': $(ertyuiug).data('monthyear'),
                                    'data': attendanceValues,
                                    'type': 'checked',
                                    '_token': "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    console.log(data);
                                }
                            });
                        }else{
                            $.ajax({
                                type: "POST",
                                url: `{{ route('admin.attendance.attendance2_update') }}/${$(ertyuiug).data('emp_id')}`,
                                data: {
                                    'monthYear': $(ertyuiug).data('monthyear'),
                                    'data': $(ertyuiug).val(),
                                    'type': 'uncheck',
                                    '_token': "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    console.log(data);
                                }
                            });
                            console.log('uncheck',$(ertyuiug).val());
                        }
                        
                        // console.log($($ertyuiug).data('emp_id'),$($ertyuiug).data('monthyear'), attendanceValues);
                    })
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
