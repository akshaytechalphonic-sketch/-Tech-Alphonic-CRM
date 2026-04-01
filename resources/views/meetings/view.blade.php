@extends('office.partical.main')

@push('title')
    <title>Meeting Details | CRM</title>
@endpush

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Meeting: {{ $meeting->title }}</h5>
                        <div>
                            @if ($meeting->status === 'scheduled')
                                <span class="badge bg-primary">Scheduled</span>
                            @elseif($meeting->status === 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @else
                                <span class="badge bg-success">{{ ucfirst($meeting->status) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Client Name:</div>
                            <div class="col-sm-8">
                                @if ($meeting->officelead)
                                    <a href="{{ route('office_employee.leads.single_lead', $meeting->officelead->id) }}">
                                        {{ $meeting->officelead->client_name }}
                                    </a>
                                @else
                                    {{ $meeting->client_name ?? 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Client Email:</div>
                            <div class="col-sm-8">{{ $meeting->client_email ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Date & Time:</div>
                            <div class="col-sm-8">
                                {{ \Carbon\Carbon::parse($meeting->date)->format('d M Y') }} | 
                                {{ \Carbon\Carbon::parse($meeting->start_time)->format('h:i A') }} - 
                                {{ \Carbon\Carbon::parse($meeting->end_time)->format('h:i A') }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Meeting Link:</div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $meeting->meet_link }}" id="meetLink" readonly>
                                    <button class="btn btn-outline-secondary" type="button" onclick="copyMeetLink()">Copy</button>
                                    <a href="{{ $meeting->meet_link }}" target="_blank" class="btn btn-primary">Join</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Created By:</div>
                            <div class="col-sm-8">{{ $meeting->creator->name ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Initial Description:</div>
                            <div class="col-sm-8">{{ $meeting->description ?? 'No description provided.' }}</div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Discussion Notes / Remarks</h5>
                    </div>
                    <div class="card-body">
                        <div class="remark-list mb-4" style="max-height: 400px; overflow-y: auto;">
                            @if(!empty($meeting->remarks))
                                @foreach($meeting->remarks as $remark)
                                    <div class="p-3 mb-2 border-start border-4 border-primary bg-light rounded">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="fw-bold">{{ $remark['by'] }}</span>
                                            <span class="text-muted small">{{ \Carbon\Carbon::parse($remark['date'])->format('d M Y, h:i A') }}</span>
                                        </div>
                                        <p class="mb-0 text-dark">{{ $remark['text'] }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted italic">No remarks added yet.</p>
                            @endif
                        </div>

                        <form action="{{ route('office_employee.meetings.updateRemarks', $meeting->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="remark" class="form-label fw-bold">Add New Remark</label>
                                <textarea class="form-control" name="remark" id="remark" rows="3" placeholder="Enter discussion notes here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Remark</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white font-weight-bold">Quick Actions</div>
                    <div class="card-body">
                        @if($meeting->status === 'scheduled')
                            <a href="{{ route('office_employee.meetings.complete', $meeting->id) }}" class="btn btn-outline-success w-100 mb-2" onclick="return confirm('Mark this meeting as completed?')">Complete Meeting</a>
                            <a href="{{ route('office_employee.meetings.cancel', $meeting->id) }}" class="btn btn-outline-danger w-100 mb-2" onclick="return confirm('Are you sure you want to cancel this meeting?')">Cancel Meeting</a>
                        @endif
                        <a href="{{ route('office_employee.meetings.index') }}" class="btn btn-outline-secondary w-100">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyMeetLink() {
            var copyText = document.getElementById("meetLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Meeting link copied to clipboard");
        }
    </script>
@endsection
