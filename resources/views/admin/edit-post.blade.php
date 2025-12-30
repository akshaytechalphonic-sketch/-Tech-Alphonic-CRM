@extends('web.partical.main')
@push('title')
<title>Dashboard | Admin</title>
@endpush

@push('custom-css')

@endpush

@section('content')
@push('custom-css')
@endpush


<style>
 .invalid-feedback{
    width: 100%;
    margin-top: .25rem;
    font-size: .7rem;
    color: var(--bs-form-invalid-color);
 }

</style>


<!-- Latest Bootstrap CSS -->

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
                                <li class="breadcrumb-item active">Edit Post</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-bordered">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        <div class="card-body">


                            <form action="{{ route('admin.updatepost') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class=" row">

                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" name="title" id="postTitle" value="{{ $blogs->title }}"  placeholder="Enter Title" />
                                        <input type="hidden" name="id" value="{{ $blogs->id }}">
                                        @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                       @enderror

                                    </div>


                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Package</label>
                                        <select name="package_id" id="mySelect" class="form-select select2">

                                            @forelse ($packages as $allpackages)
                                              <option value="{{ $allpackages->id }}" {{ $allpackages->id == $blogs->package_id ? 'selected' : '' }}>{{ $allpackages->title }}</option>
                                            @empty

                                            @endforelse


                                        </select>

                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>


                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="editSlug" value="{{ $blogs->slug }}" placeholder="Enter Title" />

                                        @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="addPost" rows="10" placeholder="Description">{{ $blogs->description }}</textarea>

                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Upload Image</label>
                                        <input type="file" name="image" class="dropify" data-default-file="{{ asset($blogs->banner_image) }}">

                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Image Alt</label>
                                        <input type="text" name="banner_alt" class="form-control" id="" value="{{ $blogs->banner_alt }}" placeholder="Enter Alt title" />

                                        @error('imageAlt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Status</label>

                                        <select name="status" id="" class="form-select">
                                            <option value="1" {{ $blogs->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $blogs->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>


                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="" class="form-label">Meta Title</label>
                                        <textarea class="form-control" name="meta_title" id="" rows="5" placeholder="Meta Title">{{ $blogs->meta_title }}</textarea>

                                    @error('meta_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="" class="form-label">Meta Keywords</label>
                                        <textarea class="form-control" name="meta_keywords" id="" rows="5" placeholder="Meta Keywords">{{ $blogs->meta_keywords }}</textarea>


                                        @error('meta_keywords')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="" class="form-label">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" id="" rows="5" placeholder="Meta Description">{{ $blogs->meta_description }}</textarea>

                                        @error('meta_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


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
    document.getElementById('postTitle').addEventListener('input', function () {
        let title = this.value;
        let slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s]/g, '') // Remove special characters
            .replace(/\s+/g, '-')        // Replace spaces with hyphens
            .trim();                     // Trim leading and trailing spaces
        document.getElementById('editSlug').value = slug;
    });
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
