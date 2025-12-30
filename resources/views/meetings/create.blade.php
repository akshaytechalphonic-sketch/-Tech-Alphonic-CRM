@extends('office.partical.main')

@push('title')
    <title>Meetings | Admin</title>
@endpush

@section('content')
    <div class="main-content">

        <div class="card-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Meeting History</h4>
        </div>

        <!-- Meeting Table -->
        <div class="dash-tabs-content no-scrollbar">
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                    aria-labelledby="pills-Allclient-tab" tabindex="0">
                    <div class="">
                        <table class="example row-border order-column nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th></th> 
                                    {{-- <th>#</th> --}}
                                    <th>Title</th>
                                    <th>Senior</th>
                                    <th>Date</th>
                                    <th>Time (IST)</th>
                                    <th>Meet link</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Meet</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($meetings as $meeting)
                                    @php
                                        $end = \Carbon\Carbon::parse(
                                            $meeting->date . ' ' . $meeting->end_time,
                                            'Asia/Kolkata',
                                        );

                                        $status = $end->isPast() ? 'completed' : 'upcoming';
                                    @endphp

                                    <tr>
                                        {{-- <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $meeting->id }}">
                                                </div>
                                            </td> --}}

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $meeting->title }}</td>



                                        <td>{{ $meeting->employee->name ?? 'N/A' }}</td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($meeting->date)->format('d M Y') }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($meeting->start_time)->format('h:i A') }}
                                            -
                                            {{ \Carbon\Carbon::parse($meeting->end_time)->format('h:i A') }}
                                        </td>
                                        <td>
                                            @if ($meeting->meet_link)
                                                <a href="{{ $meeting->meet_link }}" target="_blank">
                                                    Open link
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>

                                        <td>
                                            <span
                                                class="badge 
                                                {{ $status == 'upcoming' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                        <td> {{ $meeting->description ?? '' }}</td>

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

                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            No meetings found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>

        {{-- </div> --}}
    </div>
@endsection
