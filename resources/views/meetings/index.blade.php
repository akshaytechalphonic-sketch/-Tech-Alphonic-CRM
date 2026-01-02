@extends('office.partical.main')
@push('title')
    <title>Meetings</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between align-items-end mb-3">
                <div class="d-flex align-items-center gap-3 w-100">

                </div>
                <div class="dash-tabs-filter  d-flex gap-3">

                </div>
            </div>

            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Clent name</th>
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

                                    {{-- @forelse($meetings as $meeting) --}}
                                    @foreach ($meetings as $meeting)
                                        @php
                                            $end = \Carbon\Carbon::parse(
                                                $meeting->date . ' ' . $meeting->end_time,
                                                'Asia/Kolkata',
                                            );

                                            $status = $end->isPast() ? 'completed' : 'upcoming';
                                        @endphp

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $meeting->id }}">
                                                </div>
                                            </td>


                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $meeting->title }}</td>

                                            <td>
                                                <a
                                                    href="{{ route('office_employee.leads.single_lead', ['id' => $meeting->officelead->id]) }}">
                                                    {{ $meeting->officelead->client_name }}
                                                </a>
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
                                    @endforeach

                                    {{-- @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            No meetings found
                                        </td>
                                    </tr>
                                @endforelse --}}

                                </tbody>
                            </table>

                        </div>

                    </div>



                </div>
            </div>

        </div>

    </div>

    </div>
    </section>



    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png" alt="close-window" />
        </div>

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
    @endsection
