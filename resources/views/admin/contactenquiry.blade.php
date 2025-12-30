@extends('web.partical.main')
@push('title')
<title>Dashboard | Admin</title>
@endpush

@push('custom-css')

@endpush

@section('content')
@push('custom-css')
@endpush




<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active"> Contact Enquiries</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <!-- happy customer -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-bordered">
                            <h3 class="card-title">Filter Enquiries</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.contact-enquiry') }}" method="post"> @csrf
                                <div class=" row">
                                        <div class="col-4 mb-3">
                                            <label for="" class="form-label">Start Date:</label>
                                            <input type="Date" class="form-control" name="start_date" value="{{ $startDate }}" id="" placeholder="" />
                                        </div>
                                        <div class="col-4 mb-3">
                                            <label for="" class="form-label">End Date:</label>
                                            <input type="Date" class="form-control" name="end_date" value="{{ $endDate }}" id="" placeholder="" />
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label for="" class="form-label"> </label>
                                            <input type="submit" class="form-control text-white btn btn-primary w-max "/>
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label for="" class="form-label"> </label>
                                            <a href="{{ route('admin.contact-enquiry') }}" class="btn btn-secondary w-100">Reset</a>                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>


            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">View Contact Enquiries</h4>
                        </div>
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Where to go</th>
                                        <th>Departure Date</th>
                                        <th>Created date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($contactPageEnquirys as $allcontactPageEnquirys)
                                    <tr>
                                        <td>01</td>
                                        <td>{{ $allcontactPageEnquirys->name }}</td>
                                        <td>{{ $allcontactPageEnquirys->email }}</td>
                                        <td>{{ $allcontactPageEnquirys->phone_no }}</td>
                                        <td>{{ $allcontactPageEnquirys->age }}</td>
                                        <td>{{ $allcontactPageEnquirys->destination }}</td>
                                        <td>{{ $allcontactPageEnquirys->date }}</td>
                                        <td>{{ \Carbon\Carbon::parse($allcontactPageEnquirys->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <ul class="d-flex gap-4 list-unstyled justify-content-center">
                                                <li class=" avatar "><a href="#!"><i class="fa fa-trash fs14 avatar-label-danger"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Clivax.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://codebucks.in/" target="_blank" class="text-muted">Codebucks</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<!-- end main content-->


<!-- add Blog modal  -->

<div class="modal fade" id="creatertaskModal" tabindex="-1" aria-labelledby="creatertaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="creatertaskModalLabel">Add New Features</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="projectName" class="form-label">Feature Title</label>
                            <input type="text" class="form-control" id="projectName" placeholder="Enter Feature Title">
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="sub-tasks" class="form-label">Feature category</label>
                            <select class="form-select">
                                <option selected="selected">Select Feature category</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <!--end col-->
                        <div class="col-12 mb-3">
                            <label for="" class="form-label">Feature Image</label>
                            <input type="file" class="dropify" data-default-file="">
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="task-description" class="form-label">Feature Description</label>
                            <textarea class="form-control" id="full-featured-non-premium" rows="5" placeholder="Services description"></textarea>
                        </div>
                        <!--end col-->
                        <div class="mt-4">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add Feature</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- blog modal end    -->

<!-- edit Blog modal  -->

<div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="editBlogModalLabel">Edit Feature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="projectName" class="form-label">Feature Title</label>
                            <input type="text" class="form-control" id="projectName" placeholder="Enter Services Title">
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="sub-tasks" class="form-label">Feature category</label>
                            <select class="form-select">
                                <option selected="selected">Select Feature category</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <!--end col-->
                        <div class="col-12 mb-3">
                            <label for="" class="form-label">Feature Image</label>
                            <input type="file" class="dropify" data-default-file="">
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="task-description" class="form-label">Feature Description</label>
                            <textarea class="form-control" id="full-featured-non-premium" rows="5" placeholder="Services description"></textarea>
                        </div>
                        <!--end col-->
                        <div class="mt-4">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Edit Feature</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit blog modal end    -->

<script>
    document.getElementById('addButton').addEventListener('click', function() {
        // Get the template row and clone it
        const templateRow = document.querySelector('.template-row');
        const newRow = templateRow.cloneNode(true);

        // Remove the "display: none" style
        newRow.style.display = 'flex';

        // Add event listener to the delete button inside the new row
        newRow.querySelector('.delete-button').addEventListener('click', function() {
            newRow.remove();
        });

        // Append the new row to the container
        document.getElementById('rowContainer').appendChild(newRow);
    });
</script>



@push('custom-js')
@endpush
@endsection
