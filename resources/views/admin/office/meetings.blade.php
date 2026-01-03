@extends('admin.partical.main')

@push('title')
    <title>Meetings | Admin</title>
@endpush

@section('content')
    <div class="main-content">


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
