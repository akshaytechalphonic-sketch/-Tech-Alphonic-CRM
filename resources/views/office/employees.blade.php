@extends('office.partical.main')
@push('title')
    <title>Employee| Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    @php
        $route = \Request::route()->getName();

    @endphp

    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex">


                </div>


                <div class="dash-tabs-filter multi-btns d-flex gap-3">

                    <div class="create-client-btn active d-flex ">

                        <a href="{{ route('admin.leads.uploaded_excels') }}" class="btn btn-sm me-2 "> Back
                        </a>

                    </div>
                </div>
            </div>
            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade {{ isset($_GET['tab']) ? ($_GET['tab'] == 'employees' ? 'show active' : '') : 'show active' }}"
                        id="pills-Allclient" role="tabpanel" aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                        <th>Emp ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Joining Date</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($office_employees as $key => $items)
                                        <tr>
                                            <td></td>
                                            <td>#{{ $loop->iteration }}</td>
                                            <td>{{ $items->name }}</td>
                                            <td>{{ $items->email }}</td>
                                            <td>{{ $items->mobile_no }}</td>
                                            <td>{{ $items->designation->department->department_name }}</td>
                                            <td>{{ $items->designation->designation_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($items->created_at)->format('M d, Y') }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('admin.office.change_employee_status', ['statusId' => $items->id]) }}">{!! $items->status == 1
                                                        ? '<span class="badge succes-bg">Active</span>'
                                                        : '<span class="badge danger-bg">Inactive</span>' !!}</a>
                                            </td>
                                            {{-- <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><a
                                                            href="{{ route('admin.office.delete_employee', ['id' => $items->id]) }}"><span
                                                                class="iconify" data-icon="iconoir:trash"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('admin.office.edit_employee', ['id' => $items->id]) }}"><span
                                                                class="iconify" data-icon="solar:pen-outline"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                    </li>
                                                 
                                                </ul>
                                            </td> --}}
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
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png" alt="close-window" />
        </div>

        @push('custom-js')
        @endpush
    @endsection
