@extends('office.partical.main')
@push('title')
    <title>Sales Report | Dashboard</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <div class="main-content">
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex w-100 flex-wrap gap-3">
                    <form class="p-2 nav nav-pills w-100 d-flex gap-3 align-items-center" id="pills-tab" role="tablist" method="GET" action="{{ route('office_employee.sales_report.index') }}">
                        
                        <!-- From Date -->
                        <li class="nav-item" role="presentation">
                            <label class="form-label mb-0 small text-muted">From Date</label>
                            <input type="date" name="from_date" onchange="this.form.submit()"
                                class="form-control rounded-pill"
                                value="{{ request('from_date') }}"
                                max="{{ date('Y-m-d') }}">
                        </li>

                        <!-- To Date -->
                        <li class="nav-item" role="presentation">
                            <label class="form-label mb-0 small text-muted">To Date</label>
                            <input type="date" name="to_date" onchange="this.form.submit()"
                                class="form-control rounded-pill"
                                value="{{ request('to_date') }}"
                                max="{{ date('Y-m-d') }}">
                        </li>

                        <!-- Employee Filter -->
                        <li class="nav-item" role="presentation">
                            <label class="form-label mb-0 small text-muted">Team Member</label>
                            <select class="form-select rounded-pill text-capitalize" aria-label="Default select example"
                                name="employee_id" onchange="this.form.submit()">
                                <option value="" selected>All Team Members</option>
                                @foreach ($sales_emp as $items)
                                    <option value="{{ $items->id }}"
                                        {{ request('employee_id') == $items->id ? 'selected' : '' }}>
                                        {{ $items->name }} - ({{ $items->role->role_name ?? 'Employee' }})
                                    </option>
                                @endforeach
                            </select>
                        </li>

                        <!-- Status Filter -->
                        <li class="nav-item" role="presentation">
                            <label class="form-label mb-0 small text-muted">Status</label>
                            <select class="form-select rounded-pill" aria-label="Default select example"
                                onchange="this.form.submit()" name="status">
                                <option value="" selected>All Statuses</option>
                                @php
                                    $statuses = ['open', 'hot', 'warm', 'cold', 'fake', 'future', 'loss', 'connected', 'not connected', 'converted'];
                                @endphp
                                @foreach ($statuses as $stat)
                                    <option value="{{ $stat }}" {{ request('status') == $stat ? 'selected' : '' }}>
                                        {{ ucfirst($stat) }}
                                    </option>
                                @endforeach
                            </select>
                        </li>

                        <li class="nav-item ms-auto" role="presentation">
                            <br>
                            <a href="{{ route('office_employee.sales_report.index') }}" class="btn btn-outline-danger rounded-pill">Clear Filters</a>
                        </li>
                    </form>
                </div>
            </div>

            <!-- Report Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="card-title text-uppercase fw-bold text-white-50">Total Leads</h6>
                            <h2 class="mb-0">{{ $leads->count() }}</h2>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-dark shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="card-title text-uppercase fw-bold text-dark-50">Open Leads</h6>
                            <h2 class="mb-0">{{ $leads->where('status', 'open')->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="card-title text-uppercase fw-bold text-white-50">Converted Leads</h6>
                            <h2 class="mb-0">{{ $leads->where('status', 'converted')->count() }}</h2>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-3 mb-3">
                    <div class="card bg-info text-white shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="card-title text-uppercase fw-bold text-white-50">Total Revenue</h6>
                            <h2 class="mb-0">₹ {{ number_format($leads->sum('final_amount')) }}</h2>
                        </div>
                    </div>
                </div>
                
                <!-- Detailed Assigned Leads Status Badges -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            {{-- <h5 class="card-title text-secondary fw-bold mb-3">Assigned Leads Status</h5>
                            <h1 class="mb-4 fw-bolder text-dark" style="font-size: 3rem;">{{ $leads->count() }}</h1> --}}
                            <div class="d-flex flex-wrap gap-1">
                                @php
                                    $statusBadges = [
                                        'open' => ['bg' => '#f8d7da', 'text' => '#842029'],
                                        'converted' => ['bg' => '#d1e7dd', 'text' => '#0f5132'],
                                        'hot' => ['bg' => '#e2e3e5', 'text' => '#41464b'],
                                        'connected' => ['bg' => '#0d6efd', 'text' => '#ffffff'],
                                        'warm' => ['bg' => '#198754', 'text' => '#ffffff'],
                                        'fake' => ['bg' => '#6c757d', 'text' => '#ffffff'],
                                        'not connected' => ['bg' => '#cfe2ff', 'text' => '#0a58ca'],
                                        'cold' => ['bg' => '#d1e7dd', 'text' => '#0f5132'],
                                        'future' => ['bg' => '#ffc107', 'text' => '#000000'],
                                        'follow up' => ['bg' => '#ffc107', 'text' => '#000000'],
                                        'loss' => ['bg' => '#0dcaf0', 'text' => '#000000'],
                                        'not intrested' => ['bg' => '#d1e7dd', 'text' => '#0f5132']
                                    ];
                                @endphp
                                @foreach($statusBadges as $status => $colors)
                                    @php $count = $leads->where('status', $status)->count(); @endphp
                                    <a href="{{ request()->fullUrlWithQuery(['status' => $status]) }}" 
                                       class="badge text-decoration-none px-3 py-2 rounded-3 d-flex align-items-center gap-1 shadow-sm"
                                       style="background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; font-size: 14px; text-transform: lowercase;">
                                        {{ $status }} <span class="fw-bold">{{ $count }}</span>
                                        <i class="fa fa-link ms-1" style="font-size: 11px;"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
           <div class="dash-tabs-content no-scrollbar" style="margin-bottom: 180px">
                <div class="tab-content" id="pills-tabContent">
                   <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="example row-border order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>ID</th>
                                        <th>Assign Date</th>
                                        <th>Assigned To</th>
                                        <th>Client Name</th>
                                        <th>Client Phone</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leads as $lead)
                                        <tr>
                                            <td></td>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ date('d, M Y', strtotime($lead->assign_date)) }}</td>
                                            <td>{{ $lead->employee->name ?? 'N/A' }}</td>
                                            <td>{{ $lead->client_name }}</td>
                                            <td>
                                                {{ $lead->client_mobile }}
                                                @if($lead->client_mobile)
                                                    <a href="https://wa.me/91{{ preg_replace('/\D/', '', $lead->client_mobile) }}" target="_blank" title="Chat on WhatsApp">
                                                        <i class="fa-brands fa-whatsapp ms-2" style="color:#25D366; font-size:18px;"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>₹ {{ number_format($lead->amount) }}</td>
                                            <td><span class="badge succes-bg text-capitalize">{{ $lead->status }}</span></td>
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
@endsection

@push('custom-js')
@endpush
