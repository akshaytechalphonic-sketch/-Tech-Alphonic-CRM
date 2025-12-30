@extends('admin.partical.main')
@push('title')
<title>Projects | Admin</title>
@endpush

@section('content')
<div class="main-content">
    <div class="pages-content">
        <div class="dash-tabs d-flex justify-content-between align-items-end mb-3">
            <div class="d-flex align-items-center gap-3 w-100">
                <form method="GET" action="">
                    <div class="row w-100">

                        <!-- Client Filter -->
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

                        <!-- Project Manager Filter -->
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
                                <a href="{{ route('admin.project_management.index') }}" class="btn btn-secondary w-50">
                                    Reset
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
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

        <!-- Project Table -->
        <div class="table-responsive">
            <table class="example row-border order-column nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th>SNo.</th>
                        <th>Project Name</th>
                        <th>Client</th>
                        <th>Manager</th>
                        <th>Team</th>
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
                        <td>{{ $project->client->client_name ?? 'N/A' }}</td>
                        <td>{{ $project->manager->name ?? 'N/A' }}</td>
                        <td>{{ $project->team->team_name ?? 'N/A' }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->deadline }}</td>

                        <td>
                            <span class="badge 
                                @if($project->status=='completed') succes-bg
                                @elseif($project->status=='in_progress') warning-bg
                                @else danger-bg
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </td>

                        <td>
                            <ul class="action-icons d-flex list-unstyled gap-2 mb-0">

                                <!-- Delete -->
                                <li>
                                    <form action="{{ route('admin.project_management.delete') }}" 
                                          method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
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
                                        data-client="{{ $project->client_id }}"
                                        data-manager="{{ $project->project_manager_id }}"
                                        data-team="{{ $project->team_id }}"
                                        data-start="{{ $project->start_date }}"
                                        data-deadline="{{ $project->deadline }}"
                                        data-status="{{ $project->status }}">
                                        <span class="iconify" data-icon="solar:pen-outline" style="font-size:24px;"></span>
                                    </a>
                                </li>

                                <!-- View -->
                                <li>
                                    <a href="{{ route('admin.project_management.view', $project->id) }}">
                                        <span class="iconify" data-icon="basil:eye-outline" style="font-size:24px;"></span>
                                    </a>
                                </li>

                            </ul>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- Add Project Modal --}}
{{-- @include('admin.project_management.modals.add') --}}
<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addProjectLabel">Add Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Project Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="project_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Client</label>
                        <div class="col-sm-9">
                            <select name="client_id" class="form-control" required>
                                <option value="">Select Client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Start Date</label>
                        <div class="col-sm-9">
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Deadline</label>
                        <div class="col-sm-9">
                            <input type="date" name="deadline" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Project Manager</label>
                        <div class="col-sm-9">
                            <select name="project_manager_id" class="form-control" required>
                                <option value="">Select Manager</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                @endforeach
                            </select>
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
<div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" aria-labelledby="editProjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editProjectLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Project Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="project_name" value="{{ $project->project_name }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Client</label>
                        <div class="col-sm-9">
                            <select name="client_id" class="form-control" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $client->id == $project->client_id ? 'selected' : '' }}>
                                        {{ $client->client_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Start Date</label>
                        <div class="col-sm-9">
                            <input type="date" name="start_date" value="{{ $project->start_date }}" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Deadline</label>
                        <div class="col-sm-9">
                            <input type="date" name="deadline" value="{{ $project->deadline }}" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Project Manager</label>
                        <div class="col-sm-9">
                            <select name="project_manager_id" class="form-control">
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ $manager->id == $project->project_manager_id ? 'selected' : '' }}>
                                        {{ $manager->name }}
                                    </option>
                                @endforeach
                            </select>
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


@endsection
