@extends('admin.partical.main')
@push('title')
    <title>cron history | Admin</title>
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

                        <a href="{{ route('admin.leads.uploaded_excels')}}" class="btn btn-sm me-2 " >  Back
                            </a>

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
                                        <th>Row.no</th>
                                        <th>Service Name</th>
                                        <th>Client Name</th>
                                        <th>Client Phone</th>
                                        <th>Client Email</th>
                                        <th>Created At</th>
                                        <th>Ramarks</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- {{dd($leads->employee)}} --}}
                                    @foreach ($excelleads as $index => $item)
                                        <tr>
                                            <td></td>
                                            {{-- <td>{{ $index + 1 }}</td> --}}
                                            <td>{{ $item->excel_row_no }}</td>

                                            <td>{{ $item->raw_json['client_name'] ?? ''}}</td>
                                            <td>{{ $item->raw_json['client_name']}}</td>
                                            <td>{{ $item->raw_json['client_mobile'] ?? ''}}</td>
                                            <td>{{ $item->raw_json['client_email'] ?? ''}}</td>
                                             <td>{{ $item->created_at}}</td>
                                            <td>{{ $item->raw_json['description'] ?? ''}}</td>
                                            <td>
                                                @if($item->is_assigned=='1')
                                                <span class="badge succes-bg text-capitalize">Assigned</span>
                                                
                                                @else
                                                <span class="badge danger-bg text-capitalize">Unassigned</span>
                                                
                                                @endif

                                        
                                            </td>
                                              {{-- <td>
                                              <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            onclick="openDistributeModal({{ $item->id }},{{ $item->total_rows }})"
                                                            title="Distribute">
                                                            <span class="iconify" data-icon="mdi:share-variant"
                                                                style="font-size: 24px;"></span>
                                                        </a>
                                                    </li>
                                                </ul> 
                                            </td>--}}
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

        @push('custom-js')
          
        @endpush
    @endsection
