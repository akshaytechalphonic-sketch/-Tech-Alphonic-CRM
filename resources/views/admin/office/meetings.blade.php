@extends('admin.partical.main')

@push('title')
    <title>Meetings | Admin</title>
@endpush

@section('content')
    <div class="main-content">

        <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <form class="nav nav-pills" id="pills-tab" role="tablist">
                    @php
                        $authEmployee = Auth::guard('admin')->user();
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
                            <option value="scheduled"
                                {{ isset($_GET['status']) ? ($_GET['status'] == 'scheduled' ? 'selected' : '') : '' }}>
                                Scheduled
                            </option>
                            <option value="completed"
                                {{ isset($_GET['status']) ? ($_GET['status'] == 'completed' ? 'selected' : '') : '' }}>
                                Completed
                            </option>
                            <option value="cancelled"
                                {{ isset($_GET['status']) ? ($_GET['status'] == 'cancelled' ? 'selected' : '') : '' }}>
                                Cancelled
                            </option>

                        </select>
                    </li>
                    <li class="nav-item ms-2 d-flex align-items-center" role="presentation">
                        <input type="date" name="date" onchange="this.form.submit()"
                            class="form-control rounded-pill "
                            value="{{ isset($_GET['date']) && $_GET['date'] != '' ? $_GET['date'] : '' }}"
                            max="{{ date('Y-m-d') }}">
                        @if (isset($_GET['date']) && $_GET['date'] != '')
                            <a class="ms-2"
                                href="{{ url()->current() . '?' . http_build_query(request()->except('date')) }}"><i
                                    class="fa-regular fa-circle-xmark"></i></a>
                        @endif
                    </li>
                </form>
            </div>
        </div>
        <div class="dash-tabs-content no-scrollbar">
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                    aria-labelledby="pills-Allclient-tab" tabindex="0">
                    <div class="">
                        <table class="example row-border order-column nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th><span class="d-none">All</span></th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Clent name</th>
                                    <th>Senior</th>
                                    <th>Date</th>
                                    <th>Time (IST)</th>
                                    <th>Meet link</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Meet</th>
                                    {{-- <th>Created By</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($meetings as $meeting)
                                    @php
                                        $end = \Carbon\Carbon::parse(
                                            $meeting->date . ' ' . $meeting->end_time,
                                            'Asia/Kolkata',
                                        );

                                        $status = $end->isPast() ? 'completed' : 'upcoming';
                                    @endphp

                                    <tr>
                                        <td></td>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $meeting->title }}</td>

                                        <td>
                                            @if (isset($meeting->officelead?->id))
                                                <a
                                                    href="{{ route('admin.leads.single_lead', ['id' => $meeting->officelead->id]) }}">
                                                    {{ $meeting->officelead->client_name }}
                                                </a>
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        </td>

                                        <td>{{ $meeting->employee->name ?? 'N/A' }}</td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($meeting->date)->format('d M Y') }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($meeting->start_time)->format('h:i A') }}
                                            -
                                            {{ \Carbon\Carbon::parse($meeting->end_time)->format('h:i A') }}
                                        </td>
                                        <td><input type="text" value="{{ $meeting->meet_link }} "></td>

                                        <td>
                                            <span
                                                class="badge 
                                {{ $status == 'upcoming' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                        <td>{{ $meeting->description ?? '-' }}</td>

                                        <td>
                                            @if ($meeting->meet_link && $meeting->status == 'scheduled' && $status == 'upcoming')
                                                <a href="{{ $meeting->meet_link }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Join
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
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
@endsection
