@extends('office.partical.main')
@push('title')
    <title>Meetings</title>
@endpush

@push('custom-css')
    <style>
        .meet-link-input {
            max-width: 200px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-3">
                <form class="d-flex gap-2" id="filter-form" method="GET">
                    @php $authEmployee = Auth::guard('office_employees')->user(); @endphp
                    
                    @if (in_array($authEmployee->role_id, [1, 2, 4]))
                        <select class="form-select rounded-pill text-capitalize" name="employee" onchange="this.form.submit()">
                            <option value="" selected>All Employees</option>
                            @foreach ($sales_emp as $items)
                                <option value="{{ $items->id }}" {{ request('employee') == $items->id ? 'selected' : '' }}>
                                    {{ $items->name }} ({{ $items->designation->designation_name }})
                                </option>
                            @endforeach
                        </select>
                    @endif

                    <select class="form-select rounded-pill" name="status" onchange="this.form.submit()">
                        <option value="" selected>All Status</option>
                        <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>

                    <input type="date" name="date" onchange="this.form.submit()" class="form-control rounded-pill" value="{{ request('date') }}">
                </form>
            </div>
            
            <button type="button" class="btn btn-primary rounded-pill d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createMeetingModal">
                <i class="fas fa-plus"></i> Create Meeting
            </button>
        </div>

        <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">
           <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">
                 <div class="table-responsive">
                            <table class="example row-border order-column" style="width:100%">
                                <thead>
                            <tr>
                                 <th> <span class="d-none">All</span></th>
                                <th>#</th>
                                <th>Title</th>
                                <th>Client Name</th>
                                <th>Created By</th>
                                <th>Date</th>
                                <th>Time (IST)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $meeting)
                                @php
                                    $end = \Carbon\Carbon::parse($meeting->date . ' ' . $meeting->end_time, 'Asia/Kolkata');
                                    $isPast = $end->isPast();
                                @endphp
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $meeting->title }}</td>
                                    <td>
                                        @if ($meeting->officelead)
                                            <a href="{{ route('office_employee.leads.single_lead', $meeting->officelead->id) }}">
                                                {{ $meeting->officelead->client_name }}
                                            </a>
                                        @else
                                            {{ $meeting->client_name ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>{{ $meeting->creator->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($meeting->date)->format('d M Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($meeting->start_time)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($meeting->end_time)->format('h:i A') }}
                                    </td>
                                    <td>
                                        @if ($meeting->status === 'scheduled')
                                            <span class="badge bg-primary">Scheduled</span>
                                        @elseif ($meeting->status === 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @else
                                            <span class="badge bg-success">{{ ucfirst($meeting->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('office_employee.meetings.view', $meeting->id) }}" class="btn btn-sm btn-outline-info" title="View & Remarks">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            @if ($meeting->meet_link && $meeting->status == 'scheduled' && !$isPast)
                                                <a href="{{ $meeting->meet_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    Join
                                                </a>
                                            @endif
                                            @if ($meeting->status === 'scheduled' && !$isPast)
                                                <form action="{{ route('office_employee.meetings.cancel', $meeting->id) }}" method="POST" onsubmit="return confirm('Cancel this meeting?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
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

    <!-- Create Meeting Modal -->
    <div class="modal fade" id="createMeetingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('office_employee.meetings.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Meeting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Meeting Title*</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Project Discussion" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Name (Optional)</label>
                            <select name="client_name" class="form-select select2" id="leadSelector">
                                <option value="">Select a Lead</option>
                                @foreach($leads as $lead)
                                    <option value="{{ $lead->id }}">{{ $lead->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Email (Optional)</label>
                            <input type="email" name="client_email" class="form-control" placeholder="client@example.com">
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Date*</label>
                                <input type="date" name="date" class="form-control" min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Time*</label>
                                <input type="time" name="start_time" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Time*</label>
                                <input type="time" name="end_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Google Meet Link (Optional)</label>
                            <input type="url" name="meet_link" class="form-control" placeholder="Paste your google meet link here">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Brief about the meeting"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Generate Meeting Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Meeting link copied!');
            });
        }
    </script>
@endsection
