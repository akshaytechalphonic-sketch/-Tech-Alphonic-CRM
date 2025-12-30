


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
                                <li class="breadcrumb-item active"> Gallery</li>
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
                            <h3 class="card-title">Add Gallery</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.store.gallery') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Package*</label>
                                        <select name="package_id" id="" class="form-select select2">
                                            <option value="">-- Select Any One --</option>
                                            @forelse ($packages as $allpackages)
                                                <option value="{{ $allpackages->id }}">{{ $allpackages->title }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                            
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Upload Image</label>
                                        <input type="file" name="uploadImage" class="dropify" data-default-file="">
                                    </div>
                            
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Status*</label>
                                        <select name="status" id="" class="form-select" required>
                                            <option value="">-- Select Any One --</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                            
                                    <div class="hstack gap-2 justify-content-end">
                                        <button class="btn btn-primary w-max" type="submit">Submit</button>
                                    </div>
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
                            <h4 class="card-title">All Demo</h4>
                        </div>
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Package</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($gallery as $key=>$allgallery)

                                    @php
                                      $packageDetail = DB::table('packages')->where('id',$allgallery->pkg_id)->first();
                                    @endphp
                                        
                                   
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $packageDetail->title??'---' }}</td>
                                        <td><img src="{{ asset($allgallery->image??'') }} " alt="" width="200" height="80"></td>
                                        <td>
                                            @if($allgallery->status == '1')
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $allgallery->created_at }}</td>
                                        <td>
                                            <ul class="d-flex gap-4 list-unstyled justify-content-center">
                                                <li class="avatar">
                                                    <a href="javascript:void(0);" onclick="confirmDelete({{ $allgallery->id }}, '{{ $allgallery->image }}')">
                                                        <i class="fa fa-trash fs14 avatar-label-danger"></i>
                                                    </a>
                                                </li>
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
    function confirmDelete(eventId, imagePath) {
        if (confirm("Are you sure you want to delete this event?")) {
            var url = "{{ route('admin.delete.gallery', ':id') }}".replace(':id', eventId);
            window.location.href = url + "?image=" + encodeURIComponent(imagePath);
        }
    }

</script>

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
