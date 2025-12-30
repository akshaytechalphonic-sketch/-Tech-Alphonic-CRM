@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <div class="main-content">
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between align-items-end mb-3">
                <div class="d-flex align-items-center gap-3 w-100">
                    {{-- <form method="GET" action="">
                    <div class="row w-100">

                        
                        <div class="col-3">
                            <label class="form-label">Select Client</label>
                            <select class="form-select" name="client">
                                <option value="">Select Client</option>
                                @foreach ($clients as $item)
                                    <option value="{{ $item->id }}" 
                                        {{ request('client') == $item->id ? 'selected' : '' }}>
                                        {{ $item->client_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                     
                        <div class="col-3">
                            <label class="form-label">Project Manager</label>
                            <select class="form-select" name="project_manager">
                                <option value="">Select Manager</option>
                                @foreach ($employees as $item)
                                    <option value="{{ $item->id }}" 
                                        {{ request('project_manager') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Project Status Filter -->
                        <div class="col-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="">Select Status</option>

                                <option value="open"        {{ request('status')=='open' ? 'selected':'' }}>Open</option>
                                <option value="in_progress" {{ request('status')=='in_progress' ? 'selected':'' }}>In Progress</option>
                                <option value="completed"   {{ request('status')=='completed' ? 'selected':'' }}>Completed</option>
                                <option value="hold"        {{ request('status')=='hold' ? 'selected':'' }}>Hold</option>

                            </select>
                        </div>

                        <div class="col-3">
                            <div class="d-flex align-items-end h-100 gap-2">
                                <button type="submit" class="btn btn-dark w-50">
                                    Filter
                                </button>
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary w-50">
                                    Reset
                                </a>
                            </div>
                        </div>

                    </div>
                </form> --}}
                </div>

                <div class="dash-tabs-filter d-flex gap-3">
                    <div class="create-client-btn">
                        <a href="#!" data-bs-toggle="modal" data-bs-target="#addProjectModal"
                            class="d-flex align-items-center gap-2">
                            <img src="{{ asset('public/admin/assets/images/icons/plus.png') }}" alt="">Add Project
                        </a>
                    </div>
                </div>

            </div>
            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">
                        <!-- Project Table -->
                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>SNo.</th>
                                        <th>Project Name</th>
                                        <th>Client</th>
                                        <th>Project Lead</th>
                                        {{-- <th>Team</th> --}}
                                        <th>Start Date</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($projects as $key => $project)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox">
                                                </div>
                                            </td>

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $project->project_name }}</td>
                                            <td>{{ $project->client_name ?? 'N/A' }}</td>
                                            <td>{{ $project->manager->name ?? 'N/A' }}</td>
                                            {{-- <td>{{ $project->department->department_name ?? 'N/A' }}</td> --}}
                                            <td>{{ $project->start_date }}</td>
                                            <td>{{ $project->deadline }}</td>

                                            <td>
            
                                                    {{  $project->status }}          
                                            </td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">

                                                    <!-- Delete -->
                                                    <li>
                                                        <form action="{{ route('admin.projects.delete') }}" method="POST"
                                                            onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            <input type="hidden" name="project_id"
                                                                value="{{ $project->id }}">
                                                            <button type="submit" style="background:none;border:none;">
                                                                <span class="iconify" data-icon="iconoir:trash"
                                                                    style="font-size:24px;color:red;"></span>
                                                            </button>
                                                        </form>
                                                    </li>

                                                    <!-- Edit -->
                                                    <li>
                                                        <a href="#" class="edit-project-btn"
                                                            data-id="{{ $project->id }}"
                                                            data-name="{{ $project->project_name }}"
                                                            data-client="{{ $project->client_name }}"
                                                            data-manager="{{ $project->project_manager_id }}"
                                                            data-team="{{ $project->team_id }}"
                                                            data-start="{{ $project->start_date }}"
                                                            data-deadline="{{ $project->deadline }}"
                                                            data-description="{{ $project->description }}"
                                                            data-status="{{ $project->status }}">
                                                            <span class="iconify" data-icon="solar:pen-outline"
                                                                style="font-size:24px;"></span>
                                                        </a>
                                                    </li>

                                                    <!-- View -->

                                                    <a href="{{ route('admin.projects.detail', ['id' => $project->id]) }}">
                                                        <li><span class="iconify" data-icon="basil:eye-outline"
                                                                data-inline="false" style="font-size: 24px;"></span>
                                                            </i></li>
                                                        {{-- <li><a
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
                                                        </li> --}}

                                                    </a>



                                                </ul>
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
    </div>

    {{-- Add Project Modal --}}
    {{-- @include('admin.project_management.modals.add') --}}
    <!-- Add Project Modal -->
    <!-- Add Project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.projects.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="project_name" class="form-control" required>
                            </div>
                        </div>

                        <!-- Client input field -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Client Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="client_name" class="form-control"
                                    placeholder="Enter Client Name" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="start_date" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Deadline</label>
                            <div class="col-sm-9">
                                <input type="date" name="deadline" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Lead</label>
                            <div class="col-sm-9">
                                <select name="project_manager_id" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="" rows="3" name="description"
                                    placeholder="Add some description of the task" required></textarea>
                            </div>
                        </div>




                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>



    {{-- Edit Project Modal --}}

    {{-- @include('admin.project_management.modals.edit') --}}
    <!-- Edit Project Modal -->
    <!-- Edit Project Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="editProjectForm" method="POST">
                    @csrf
                    @method('post')

                    <div class="modal-body">

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="edit_project_name" name="project_name" class="form-control">
                            </div>
                        </div>

                        <!-- Client input field -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Client Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="edit_client_name" name="client_name" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                                <input type="date" id="edit_start_date" name="start_date" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Deadline</label>
                            <div class="col-sm-9">
                                <input type="date" id="edit_deadline" name="deadline" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Project Lead</label>
                            <div class="col-sm-9">
                                <select id="edit_project_manager" name="project_manager_id" class="form-control">
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" rows="3" name="description"
                                    placeholder="Add some description of the task" required></textarea>
                            </div>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    @push('custom-js')
        <script>
            $('.edit-project-btn').on('click', function() {

                let id = $(this).data('id');

                // Fill modal fields
                $('#edit_project_name').val($(this).data('name'));
                $('#edit_client_name').val($(this).data('client'));
                $('#edit_start_date').val($(this).data('start'));
                $('#edit_deadline').val($(this).data('deadline'));
                $('#edit_project_manager').val($(this).data('manager'));
                $('#description').val($(this).data('description'));

                // Correct form route
                let url = "{{ route('admin.projects.update', ':id') }}";
                url = url.replace(':id', id);

                // Set form action
                $('#editProjectForm').attr('action', url);

                // Show modal
                $('#editProjectModal').modal('show');
            });
        </script>
    @endpush
@endsection
