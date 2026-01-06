@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <style>
        .daterangepicker {
            width: 13%;
        }

        .drp-calendar {
            width: 100%;
        }

        .drp-calendar .calendar-table table.table-condensed tr:last-child {
            display: none
        }

        .drp-calendar .calendar-table table.table-condensed tbody {
            display: none;
        }

        #filterMonth {
            display: block;
            border: 0;
            height: 0px;
        }

        .daterangepicker select.monthselect,
        .daterangepicker select.yearselect {
            font-size: 16px;
            padding: 1px;
            height: auto;
            margin: 0;
            cursor: default;
        }

        text {
            cursor: pointer;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        option.active::before {
    content: "● ";
    color: #28a745; /* green */
}

option.inactive::before {
    content: "● ";
    color: #dc3545; /* red */
}

    </style>
    @php
        $month = date('m');
        $year = date('Y');
    @endphp
    @if (isset($_GET['employee']) && $_GET['employee'] != '')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        @if ($monthlyTarget != null)
            @php
                // dd($leads->where('status','open')->count(),$leads->where('status','converted')->count());
                $total_received = array_sum(array_column($monthlyTarget, 'recived_amount'));
                $final_amount = array_sum(array_column($monthlyTarget, 'final_amount'));

                $today_received = array_sum(
                    array_column(
                        array_filter($monthlyTarget, function ($item) {
                            return $item['day'] === date('d'); // Filter by day = 27
                        }),
                        'recived_amount',
                    ),
                );
            @endphp
            <script type="text/javascript">
                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(monthlyTarget);

                function monthlyTarget() {
                    let monthly_sales_target = {{ $login_employee->monthly_sales_target }};
                    let total_received = {{ $total_received }};
                    let extra_target = {{ $total_received > $login_employee->monthly_sales_target ? $total_received : 0 }};
                    let final_amount = {{ $final_amount }};

                    var data = google.visualization.arrayToDataTable([
                        ['Task', ' Monthly Target'],
                        ['Complete Target : {{ number_format($total_received) }}', {{ $total_received }}],
                        ['Monthly Target : {{ number_format($login_employee->monthly_sales_target) }}',
                            {{ $login_employee->monthly_sales_target - $total_received }}
                        ],
                        ['Extra Target', extra_target],
                    ]);

                    var options = {
                        title: 'Monthly Target',
                        pieHole: 0.4,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('monthlyTarget'));
                    chart.draw(data, options);
                }
            </script>
            <script type="text/javascript">
                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(drawTaskChart);

                function drawTaskChart() {

                    let total_tasks = {{ $total_tasks }};
                    let completed_tasks = {{ $completed_tasks }};
                    let in_progress = {{ $in_progress }};
                    let pending_tasks = {{ $pending_tasks }};

                    var data = google.visualization.arrayToDataTable([
                        ['Task Status', 'Count'],
                        ['Completed', completed_tasks],
                        ['In Progress', in_progress],
                        ['Pending', pending_tasks],
                    ]);

                    var options = {
                        title: 'Employee Task Report',
                        pieHole: 0.4,
                        colors: ['#4CAF50', '#FFC107', '#F44336'], // optional colors
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('taskReportChart'));
                    chart.draw(data, options);
                }
            </script>
        @endif
        @if ($all_leads->count() != 0)
            <script type="text/javascript">
                google.charts.load("current", {
                    packages: ["corechart"]
                });

                google.charts.setOnLoadCallback(leadsStatus);

                function leadsStatus() {
                    // Define lead statuses and their respective links
                    var chartData = [
                        ['Task', 'All Leads Status', {
                            role: 'tooltip'
                        }, 'Link'],
                        ['Open', {{ $all_leads->where('status', 'open')->count() }}, 'Click Open Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=open"
                        ],
                        ['Hot', {{ $all_leads->where('status', 'hot')->count() }}, 'Click Hot Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=hot"
                        ],
                        ['Warm', {{ $all_leads->where('status', 'warm')->count() }}, 'Click Warm Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=warm"
                        ],
                        ['Cold', {{ $all_leads->where('status', 'cold')->count() }}, 'Click Cold Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=cold"
                        ],
                        ['Fake', {{ $all_leads->where('status', 'fake')->count() }}, 'Click Fake Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=fake"
                        ],
                        ['Future', {{ $all_leads->where('status', 'future')->count() }}, 'Click Future Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=future"
                        ],
                        ['Loss', {{ $all_leads->where('status', 'loss')->count() }}, 'Click Loss Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=loss"
                        ],
                        ['Not Connected', {{ $all_leads->where('status', 'not connected')->count() }}, 'Click Not Connected',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=not+connected"
                        ],
                        ['Connected', {{ $all_leads->where('status', 'connected')->count() }}, 'Click Connected Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=loss"
                        ],
                        ['Converted', {{ $all_leads->where('status', 'converted')->count() }}, 'Click Converted Leads',
                            "{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=converted"
                        ]
                    ];

                    // Convert data to Google Charts format
                    var data = google.visualization.arrayToDataTable(chartData);

                    // Chart Options
                    var options = {
                        title: 'All Leads Status',
                        pieHole: 0.4, // Donut chart
                    };

                    // Create the chart
                    var chart = new google.visualization.PieChart(document.getElementById('leadsStatus'));

                    // Draw chart
                    chart.draw(data, options);

                    // Add click event listener
                    google.visualization.events.addListener(chart, 'select', function() {
                        var selectedItem = chart.getSelection()[0]; // Get clicked slice
                        if (selectedItem) {
                            var url = chartData[selectedItem.row + 1][3]; // Get link from data
                            window.open(url, '_blank'); // Open link in new tab
                        }
                    });
                }
            </script>
        @endif
    @endif
    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center">
            <h1>Dashbord</h1>
            <form class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item me-2" role="presentation">
                    <select class="form-select rounded-pill text-capitalize" aria-label="Default select example"
                        name="employee" onchange="this.form.submit()" required>
                        <option value="" selected>All Sales Employee</option>
                        @foreach ($sales_emp as $items)
                            <option value="{{ $items->id }}"
                                {{ isset($_GET['employee']) ? ($_GET['employee'] == $items->id ? 'selected' : '') : '' }}>
                                 {{ $items->is_online == '1' ? '🟢' : '🔴' }} {{ $items->name }} -
                                {{ $items->email}}</option>
                        @endforeach
                    </select>
                </li>
            </form>
        </div>
        @if (isset($_GET['employee']) && $_GET['employee'] != '')
            <div class="laevae-boxes-dashboard mb-3">
                <div class="row">
                   
                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-1">Active</h6>
                                        <h2 class="text-success fw-bold mb-0">
                                            {{ $active_emp ?? 0 }}
                                        </h2>
                                    </div>
                                    <div class="icon-box bg-success bg-opacity-10 text-success">
                                        <i class="fa fa-check-circle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inactive -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-1">Inactive</h6>
                                        <h2 class="text-danger fw-bold mb-0">
                                            {{ $Inactive_emp ?? 0 }}
                                        </h2>
                                    </div>
                                    <div class="icon-box bg-danger bg-opacity-10 text-danger">
                                        <i class="fa fa-times-circle fs-3 text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                   


                    <div class="col-lg-3 mb-3 ">
                        <form class="leave-boxone h-100">
                            <h5>Monthly Target <span>{!! isset($_GET['filter_by_month']) && $_GET['filter_by_month'] != ''
                                ? "<span class='badge rounded-pill text-bg-warning'>" .
                                    date('M, Y', strtotime($_GET['filter_by_month'])) .
                                    '</span>'
                                : '' !!}</span></h5>
                            <div class="leace-conunt d-flex justify-content-between align-items-center mt-4">
                                <div class="leave-count-number">
                                    <h4>₹{{ number_format($login_employee->monthly_sales_target) }}</h4>
                                    <p>Achived Target : <span class="text-success">+
                                            ₹{{ isset($total_received) ? number_format($total_received) : 0 }}</span></p>
                                    <p>Remaining Target : <span
                                            class="text-warning">₹{{ isset($total_received) ? number_format($login_employee->monthly_sales_target - $total_received) : 0 }}</span>
                                    </p>
                                </div>
                                <div class="laeave-ount-icon" title="Open Month Calender">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="font-size: 24px;cursor: pointer;"
                                        viewBox="0 0 24 24" onclick="openMonthPicker('filterMonth')">
                                        <rect width="10" height="0" x="5" y="5" fill="currentColor">
                                            <animate fill="freeze" attributeName="height" begin="0.6s" dur="0.2s"
                                                values="0;3" />
                                        </rect>
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                            <path stroke-dasharray="64" stroke-dashoffset="64"
                                                d="M12 4h7c0.55 0 1 0.45 1 1v14c0 0.55 -0.45 1 -1 1h-14c-0.55 0 -1 -0.45 -1 -1v-14c0 -0.55 0.45 -1 1 -1Z">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s"
                                                    values="64;0" />
                                            </path>
                                            <path stroke-dasharray="4" stroke-dashoffset="4" d="M7 4v-2M17 4v-2">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s"
                                                    dur="0.2s" values="4;0" />
                                            </path>
                                            <path stroke-dasharray="12" stroke-dashoffset="12" d="M7 11h10">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s"
                                                    dur="0.2s" values="12;0" />
                                            </path>
                                            <path stroke-dasharray="8" stroke-dashoffset="8" d="M7 15h7">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1s"
                                                    dur="0.2s" values="8;0" />
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <input type="hidden" name="employee" value="{{ request('employee') }}">
                            <input type="month" id="filterMonth" name="filter_by_month" class="float-end"
                                onchange="this.form.submit()"
                                value="{{ isset($_GET['filter_by_month']) && $_GET['filter_by_month'] != '' ? $_GET['filter_by_month'] : '' }}">

                            {{-- <button onclick="openMonthPicker('filterMonth')" type="button">Open First</button> --}}
                        </form>
                    </div>
                    <div class="col-lg-3 mb-3  ">
                        <div class="leave-boxone h-100">
                            <h5>Today Target</h5>
                            <div class="leace-conunt d-flex justify-content-between align-items-center mt-4">
                                <div class="leave-count-number">
                                    @php
                                        $pp_target =
                                            $login_employee->monthly_sales_target /
                                            countDaysWithoutSundays($month, $year);

                                    @endphp
                                    <h4>{{ number_format($pp_target) }}</h4>
                                    @if (isset($total_received))
                                        <p>Achived Target : <span class="text-success">+
                                                ₹{{ isset($total_received) ? number_format($today_received) : 0 }}</span>
                                        </p>

                                        @if ($today_received < $pp_target)
                                            <p>Remaining Target : <span
                                                    class="text-warning">₹{{ isset($total_received) ? number_format($today_received) : 0 }}</span>
                                            </p>
                                        @else
                                            <p>Extra Achived : <span class="text-success">+
                                                    ₹{{ isset($total_received) ? number_format($today_received - $pp_target) : 0 }}</span>
                                            </p>
                                        @endif
                                    @endif
                                </div>
                                <div class="laeave-ount-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                        width="1em" height="1em" viewBox="0 0 32 32"
                                        data-icon="oui:app-users-roles" data-inline="false" style="font-size: 32px;"
                                        class="iconify iconify--oui">
                                        <path fill="currentColor"
                                            d="M19.307 3.21a2.91 2.91 0 1 0-.223 1.94a11.64 11.64 0 0 1 8.232 7.049l1.775-.698a13.58 13.58 0 0 0-9.784-8.291m-2.822 1.638a.97.97 0 1 1 0-1.939a.97.97 0 0 1 0 1.94m-4.267.805l-.717-1.774a13.58 13.58 0 0 0-8.291 9.784a2.91 2.91 0 1 0 1.94.223a11.64 11.64 0 0 1 7.068-8.233m-8.34 11.802a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94m12.607 8.727a2.91 2.91 0 0 0-2.599 1.62a11.64 11.64 0 0 1-8.233-7.05l-1.774.717a13.58 13.58 0 0 0 9.813 8.291a2.91 2.91 0 1 0 2.793-3.578m0 3.879a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94M32 16.485a2.91 2.91 0 1 0-4.199 2.599a11.64 11.64 0 0 1-7.05 8.232l.718 1.775a13.58 13.58 0 0 0 8.291-9.813A2.91 2.91 0 0 0 32 16.485m-2.91.97a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94">
                                        </path>
                                        <path fill="currentColor"
                                            d="M19.19 16.35a3.879 3.879 0 1 0-5.42 0a4.85 4.85 0 0 0-2.134 4.014v1.939h9.697v-1.94a4.85 4.85 0 0 0-2.143-4.014m-4.645-2.774a1.94 1.94 0 1 1 3.88 0a1.94 1.94 0 0 1-3.88 0m-.97 6.788a2.91 2.91 0 1 1 5.819 0z"
                                            class="ouiIcon__fillSecondary"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3  ">
                        <div class="leave-boxone  h-100">
                            <h5>Today Assigned Leads</h5>
                            <div class="leace-conunt d-flex justify-content-between align-items-center mt-4">
                                <div class="leave-count-number">
                                    <h4>{{ $leads->count() }}</h4>
                                    <p>Open leads : <a
                                            href="{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=open&filter_by_lead={{ date('Y-m-d') }}"
                                            class="text-warning">{{ $leads->where('status', 'open')->count() }} <i
                                                class="fa-solid fa-link"></i></a></p>
                                    <p>Converted leads : <a
                                            href="{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status=converted&filter_by_lead={{ date('Y-m-d') }}"
                                            class="text-success">{{ $leads->where('status', 'converted')->count() }} <i
                                                class="fa-solid fa-link"></i></a></p>
                                </div>
                                <div class="laeave-ount-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                        width="1em" height="1em" viewBox="0 0 24 24" data-icon="iconoir:rocket"
                                        data-inline="false" style="font-size: 32px;" class="iconify iconify--iconoir">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5">
                                            <path
                                                d="M16.061 10.404L14 17h-4l-2.061-6.596a6 6 0 0 1 .998-5.484l2.59-3.315a.6.6 0 0 1 .946 0l2.59 3.315a6 6 0 0 1 .998 5.484M10 20c0 2 2 3 2 3s2-1 2-3m-5.5-7.5C5 15 7 19 7 19l3-2m5.931-4.5c3.5 2.5 1.5 6.5 1.5 6.5l-3-2">
                                            </path>
                                            <path d="M12 11a2 2 0 1 1 0-4a2 2 0 0 1 0 4"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3  ">
                        <div class="leave-boxone h-100">
                            <h5>Assigned Leads Status</h5>
                            <div class="leace-conunt d-flex justify-content-between align-items-center mt-4">
                                <div class="leave-count-number">
                                    @php
                                        $pp_target =
                                            $login_employee->monthly_sales_target /
                                            countDaysWithoutSundays($month, $year);
                                        $status_array = [
                                            'bg-danger-subtle text-danger-emphasis' => 'open',
                                            'bg-info-subtle text-info-emphasis' => 'converted',
                                            'bg-secondary-subtle text-dark' => 'hot',
                                            'bg-primary text-white' => 'connected',
                                            'bg-success text-white' => 'warm',
                                            'bg-secondary text-white' => 'fake',
                                            'bg-primary-subtle text-primary-emphasis' => 'not connected',
                                            'bg-success-subtle text-success-emphasis' => 'cold',
                                            'bg-warning text-dark' => 'future',
                                             'bg-warning text-light' => 'follow up',
                                            'bg-info text-dark' => 'loss',
                                            'bg-success-subtle text-primary-emphasis' => 'not intrested',
                                        ];
                                    @endphp
                                    <h4>{{ number_format($all_leads->count()) }}</h4>
                                    <p>
                                        @foreach ($status_array as $key => $st)
                                            <a href="{{ route('admin.leads.index') }}?employee={{ $_GET['employee'] }}&status={{ $st }}"
                                                class="badge {{ $key }}"> {{ $st }}
                                                {{ number_format($all_leads->where('status', $st)->count()) }} <i
                                                    class="fa-solid fa-link"></i></a>
                                        @endforeach
                                    </p>
                                </div>
                                {{-- <div class="laeave-ount-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em"
                                    height="1em" viewBox="0 0 32 32" data-icon="oui:app-users-roles"
                                    data-inline="false" style="font-size: 32px;" class="iconify iconify--oui">
                                    <path fill="currentColor"
                                        d="M19.307 3.21a2.91 2.91 0 1 0-.223 1.94a11.64 11.64 0 0 1 8.232 7.049l1.775-.698a13.58 13.58 0 0 0-9.784-8.291m-2.822 1.638a.97.97 0 1 1 0-1.939a.97.97 0 0 1 0 1.94m-4.267.805l-.717-1.774a13.58 13.58 0 0 0-8.291 9.784a2.91 2.91 0 1 0 1.94.223a11.64 11.64 0 0 1 7.068-8.233m-8.34 11.802a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94m12.607 8.727a2.91 2.91 0 0 0-2.599 1.62a11.64 11.64 0 0 1-8.233-7.05l-1.774.717a13.58 13.58 0 0 0 9.813 8.291a2.91 2.91 0 1 0 2.793-3.578m0 3.879a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94M32 16.485a2.91 2.91 0 1 0-4.199 2.599a11.64 11.64 0 0 1-7.05 8.232l.718 1.775a13.58 13.58 0 0 0 8.291-9.813A2.91 2.91 0 0 0 32 16.485m-2.91.97a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94">
                                    </path>
                                    <path fill="currentColor"
                                        d="M19.19 16.35a3.879 3.879 0 1 0-5.42 0a4.85 4.85 0 0 0-2.134 4.014v1.939h9.697v-1.94a4.85 4.85 0 0 0-2.143-4.014m-4.645-2.774a1.94 1.94 0 1 1 3.88 0a1.94 1.94 0 0 1-3.88 0m-.97 6.788a2.91 2.91 0 1 1 5.819 0z"
                                        class="ouiIcon__fillSecondary"></path>
                                </svg>
                            </div> --}}
                            </div>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card p-3 text-center">
                                <h6>Total Tasks</h6>
                                <h3>{{ $total_tasks }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 text-center">
                                <h6>Completed</h6>
                                <h3 class="text-success">{{ $completed_tasks }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 text-center">
                                <h6>In Progress</h6>
                                <h3 class="text-warning">{{ $in_progress }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 text-center">
                                <h6>Pending</h6>
                                <h3 class="text-danger">{{ $pending_tasks }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">

                @if ($monthlyTarget != null)
                    <div class="col-md-6 col-12">
                        <div id="monthlyTarget" style="height: 400px;"></div>
                    </div>
                @endif
                @if ($all_leads->count() != 0)
                    <div class="col-md-6 col-12">
                        <div id="leadsStatus" style="height: 400px;"></div>
                    </div>
                @endif
                {{-- <div class="col-4"></div> --}}

                @if ($total_tasks != 0)
                    <div class="col-md-6 col-12 mt-4">
                        <div id="taskReportChart" style="height: 400px;"></div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
        </div>
    </div>


    @push('custom-js')
        <script>
            // $(function() {
            //     $('input[name="filter_by_month"]').daterangepicker({
            //         singleDatePicker: true,
            //         showDropdowns: true,
            //         locale: {
            //             format: 'YYYY-MM',
            //         },
            //         minYear: 2000,
            //         maxYear: parseInt(moment().format('YYYY'), 10),
            //         timePicker: false,
            //     }).on('apply.daterangepicker', function(ev, picker) {
            //         $("#filterMonth").val(picker.startDate.format('YYYY-MM'));
            //     });
            //     $('#filterMonth').on('apply.daterangepicker', function(ev, picker) {
            //         // $fgdhijslk = $()[]
            //         console.log("Date selected: ", picker.startDate.format('YYYY-MM')); // Debugging
            //         this.value = picker.startDate.format('YYYY-MM')
            //     });
            //     $('input[name="filter_by_month"]').on('apply.daterangepicker', function(ev, picker) {
            //         // This will fire when a date is selected or changed
            //         var selectedDate = picker.startDate.format('YYYY-M');
            //         // $(this).parent().submit()
            //         console.log('Selected Month:', selectedDate);
            //     });
            // });
        </script>


        <script>
            function openMonthPicker(id) {
                document.getElementById(id).showPicker?.(); // Some browsers support showPicker()
                document.getElementById(id).focus(); // Fallback for others
            }
        </script>
    @endpush
@endsection
