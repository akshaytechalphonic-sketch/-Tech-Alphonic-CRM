@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <div class="main-content">
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item me-3">
                        <button class="client-main-btn" type="button">Client <img
                                src="{{ asset('public/admin/assets/images/icons/double-arrow.png') }}" alt="">
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill" id="pills-Allclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Allclient" type="button" role="tab" aria-controls="pills-Allclient"
                            aria-selected="true">All </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-Activeclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Activeclient" type="button" role="tab"
                            aria-controls="pills-Activeclient" aria-selected="false">Active </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-InActiveclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-InActiveclient" type="button" role="tab"
                            aria-controls="pills-InActiveclient" aria-selected="false">Inactive </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-Completedclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Completedclient" type="button" role="tab"
                            aria-controls="pills-Completedclient" aria-selected="false">Completed </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-Dropedclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Dropedclient" type="button" role="tab"
                            aria-controls="pills-Dropedclient" aria-selected="false">Droped </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill" id="pills-Editclient-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-Editclient" type="button" role="tab"
                            aria-controls="pills-Editclient" aria-selected="false">Edit </button>
                    </li>
                </ul>

                <div class="dash-tabs-filter d-flex gap-3">
                    <div class="filter-btn">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#filterModel"> <img
                                src="{{ asset('public/admin/assets/images/icons/setting.png') }}" alt="">Filter</a>
                    </div>
                    <div class="create-client-btn">
                        <a href="{{ route('admin.client.create') }}" class="d-flex align-items-center gap-2"> <img
                                src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Create
                            Client</a>
                    </div>
                </div>
            </div>

            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive ">
                            <table class="table example">
                                <thead>
                                    <tr>
                                        <th>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="">
                                                All
                                            </div>

                                        </th>
                                        <th>SNo.</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Organisation Name</th>
                                        <th>Ministry</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($clients as $key=>$allclients)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $allclients->name }}</td>
                                            <td>{{ $allclients->department }}</td>
                                            <td>{{ $allclients->contact_no }}</td>
                                            <td>{{ $allclients->email }}</td>
                                            <td>{{ $allclients->organisation_name }}</td>
                                            <td>{{ $allclients->ministry }} {{ $allclients->status }}</td>
                                            <td>
                                                @if ($allclients->status == '0')
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#clientStatusModel">
                                                        <span class="badge danger-bg">Inactive</span>
                                                    </a>
                                                @elseif ($allclients->status == '1')
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#clientStatusModel">
                                                        <span class="badge succes-bg">Active</span>
                                                    </a>
                                                @elseif ($allclients->status == '2')
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#clientStatusModel">
                                                        <span class="badge blue-bg ">Complete</span>
                                                    </a>
                                                @elseif ($allclients->status == '3')
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#clientStatusModel">
                                                        <span class="badge gray-bg">Dropped</span>
                                                    </a>
                                                @else
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#clientStatusModel">
                                                        <span class="badge gray-bg">Not Have</span>
                                                    </a>
                                                @endif
                                            </td>


                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <span class="iconify delete-icon" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px; cursor: pointer;"
                                                            data-id="{{ $allclients->id }}">
                                                        </span>
                                                    </li>
                                                    <a href="{{ route('admin.client.detail', ['id' => $allclients->id]) }}">
                                                        <li><span class="iconify" data-icon="basil:eye-outline"
                                                                data-inline="false" style="font-size: 24px;"></span>
                                                            </i></li>
                                                        <li><a
                                                                href="{{ route('admin.client.update', ['id' => $allclients->id]) }}"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                                    role="img" width="1em" height="1em"
                                                                    viewBox="0 0 24 24" href=""
                                                                    data-icon="uil:pen" data-inline="false"
                                                                    style="font-size: 24px;" class="iconify iconify--uil">
                                                                    <path fill="currentColor"
                                                                        d="M22 7.24a1 1 0 0 0-.29-.71l-4.24-4.24a1 1 0 0 0-.71-.29a1 1 0 0 0-.71.29l-2.83 2.83L2.29 16.05a1 1 0 0 0-.29.71V21a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .76-.29l10.87-10.93L21.71 8a1.2 1.2 0 0 0 .22-.33a1 1 0 0 0 0-.24a.7.7 0 0 0 0-.14ZM6.83 20H4v-2.83l9.93-9.93l2.83 2.83ZM18.17 8.66l-2.83-2.83l1.42-1.41l2.82 2.82Z">
                                                                    </path>
                                                                </svg></a>
                                                        </li>

                                                    </a>
                                                </ul>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse


                                </tbody>
                            </table>
                        </div>

                    </div>





                    <div class="tab-pane fade" id="pills-Activeclient" role="tabpanel"
                        aria-labelledby="pills-Activeclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="table example">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="">
                                                All
                                            </div>

                                        </th>
                                        <th>SNo.</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Organisation Name</th>
                                        <th>Ministry</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @forelse ($activeClients as $key=>$allclients)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $allclients->name }}</td>
                                            <td>{{ $allclients->department }}</td>
                                            <td>{{ $allclients->contact_no }}</td>
                                            <td>{{ $allclients->email }}</td>
                                            <td>{{ $allclients->organisation_name }}</td>
                                            <td>{{ $allclients->ministry }}</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline"
                                                            data-inline="false" style="font-size: 24px;"></span>
                                                        </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse


                                </tbody>


                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-InActiveclient" role="tabpanel"
                        aria-labelledby="pills-InActiveclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="table example">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="">
                                                All
                                            </div>

                                        </th>
                                        <th>SNo.</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Organisation Name</th>
                                        <th>Ministry</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inactiveClients as $key=>$allclients)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $allclients->name }}</td>
                                            <td>{{ $allclients->department }}</td>
                                            <td>{{ $allclients->contact_no }}</td>
                                            <td>{{ $allclients->email }}</td>
                                            <td>{{ $allclients->organisation_name }}</td>
                                            <td>{{ $allclients->ministry }}</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline"
                                                            data-inline="false" style="font-size: 24px;"></span>
                                                        </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-Completedclient" role="tabpanel"
                        aria-labelledby="pills-Completedclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="table example">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="">
                                                All
                                            </div>

                                        </th>
                                        <th>SNo.</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Organisation Name</th>
                                        <th>Ministry</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>



                                <tbody>

                                    @forelse ($clients as $key=>$allclients)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $allclients->name }}</td>
                                            <td>{{ $allclients->department }}</td>
                                            <td>{{ $allclients->contact_no }}</td>
                                            <td>{{ $allclients->email }}</td>
                                            <td>{{ $allclients->organisation_name }}</td>
                                            <td>{{ $allclients->ministry }}</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline"
                                                            data-inline="false" style="font-size: 24px;"></span>
                                                        </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse


                                </tbody>











                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-Dropedclient" role="tabpanel"
                        aria-labelledby="pills-Dropedclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="table example">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="">
                                                All
                                            </div>

                                        </th>
                                        <th>SNo.</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Organisation Name</th>
                                        <th>Ministry</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @forelse ($clients as $key=>$allclients)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $allclients->name }}</td>
                                            <td>{{ $allclients->department }}</td>
                                            <td>{{ $allclients->contact_no }}</td>
                                            <td>{{ $allclients->email }}</td>
                                            <td>{{ $allclients->organisation_name }}</td>
                                            <td>{{ $allclients->ministry }}</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline"
                                                            data-inline="false" style="font-size: 24px;"></span>
                                                        </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse


                                </tbody>






                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-Editclient" role="tabpanel"
                        aria-labelledby="pills-Editclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="table example">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="">
                                                All
                                            </div>

                                        </th>
                                        <th>SNo.</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Organisation Name</th>
                                        <th>Ministry</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @forelse ($editclients as $key=>$allclients)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $allclients->name }}</td>
                                            <td>{{ $allclients->department }}</td>
                                            <td>{{ $allclients->contact_no }}</td>
                                            <td>{{ $allclients->email }}</td>
                                            <td>{{ $allclients->organisation_name }}</td>
                                            <td>{{ $allclients->ministry }}</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash"
                                                            data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline"
                                                            data-inline="false" style="font-size: 24px;"></span>
                                                        </i></li>
                                                    <li><a
                                                            href="{{ route('admin.client.update', ['id' => $allclients->id]) }}"><span
                                                                href class="iconify" data-icon="uil:pen"
                                                                data-inline="false" style="font-size: 24px;"></span></a>
                                                        </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse


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
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
        </div>






        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.delete-icon').forEach(icon => {
                    icon.addEventListener('click', function() {
                        const id = this.getAttribute('data-id'); // Get the ID
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`{{ route('admin.client.delete', ['id' => '1']) }}${id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({
                                            id: id
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire(
                                                'Deleted!',
                                                'Client record has been deleted.',
                                                'success'
                                            ).then(() => window.location.reload());
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                data.message || 'Something went wrong.',
                                                'error'
                                            );
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire(
                                            'Error!',
                                            'An unexpected error occurred.',
                                            'error'
                                        );
                                    });
                            }
                        });
                    });
                });
            });
        </script>





        @push('custom-js')
        @endpush
    @endsection
