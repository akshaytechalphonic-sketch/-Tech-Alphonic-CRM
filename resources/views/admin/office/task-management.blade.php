@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
@endpush

@section('content')
    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <div class="dash-tabs d-flex justify-content-between align-items-end mb-3">
                <div class="d-flex align-items-center gap-3 w-100">
                    <form method="GET" action="">
                        <div class="row w-100">

                            <!-- Department -->
                            <div class="col-3">
                                <label class="form-label">Select Department</label>
                                <select class="form-select" name="department">
                                    <option value="">Select Department</option>
                                    @foreach ($department as $items)
                                        <option value="{{ $items->id }}"
                                            {{ request('department') == $items->id ? 'selected' : '' }}>
                                            {{ $items->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Employee -->
                            <div class="col-3">
                                <label class="form-label">Select Employee</label>
                                <select class="form-select" name="employee">
                                    <option value="">Select Employee</option>
                                    @foreach ($employee as $items)
                                        <option value="{{ $items->id }}"
                                            {{ request('employee') == $items->id ? 'selected' : '' }}>
                                            {{ $items->name }} -
                                            {{ preg_replace('/\..*$/', '', substr(strstr($items->email, '@'), 1)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="col-3">
                                <label class="form-label">Select Status</label>
                                <select class="form-select" name="status">
                                    <option value="">Select Status</option>

                                    <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>
                                        Todo
                                    </option>

                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>

                                    <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>
                                        Review
                                    </option>

                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-3">
                                <div class="d-flex align-items-end h-100 gap-2">
                                    <button type="submit" class="btn btn-dark w-50">
                                        Filter
                                    </button>

                                    <a href="{{ route('admin.task_management.index') }}" class="btn btn-secondary w-50 ">
                                        Reset
                                    </a>
                                </div>
                            </div>

                        </div>
                    </form>



                </div>

                <div class="dash-tabs-filter  d-flex gap-3">
                    {{-- <div class="filter-btn">
                        <a href="#!" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#taskfilterModel"> <img
                                src="{{ asset('public/admin/assets/images/icons') }}/setting.png" alt="">Filter</a>
                    </div> --}}
                    <div class="create-client-btn">
                        <a href="#!" data-bs-toggle="modal" data-bs-target="#addProjectModel"
                            class="d-flex align-items-center gap-2"> <img
                                src="{{ asset('public/admin/assets/images/icons') }}/plus.png" alt="">Add
                            Task</a>
                    </div>

                </div>
            </div>

            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel"
                        aria-labelledby="pills-Allclient-tab" tabindex="0">

                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap">
                                <thead>
                                    <tr>
                                        <th>
                                            {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox"> All
                                            </div> --}}
                                        </th>
                                        <th>SNo.</th>
                                        <th>Project Name</th>
                                        {{-- <th>Client Name</th> --}}
                                        <th>Task Type</th>
                                        <th>Assignee</th>
                                        <th>Reporting Head</th>
                                        <th>Estimate</th>
                                        <th>Spend Time</th>
                                        <th>Priority </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($tasks as $key => $task)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $task->id }}">
                                                </div>
                                            </td>

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $task->title }}</td>
                                            {{-- <td>{{ $task->client_name ?? 'N/A' }}</td> --}}
                                            <td>{{ $task->task_type ?? 'N/A' }}</td>
                                            <td>{{ $task->assignee->name ?? 'N/A' }}</td>
                                            <td>{{ $task->reporter->name ?? 'N/A' }}</td>
                                            <td> @php
                                                if ($task->estimate) {
                                                    $estimate = \Carbon\Carbon::parse($task->estimate);
                                                    $now = \Carbon\Carbon::parse($task->created_at);

                                                    $diffInSeconds = $now->diffInSeconds($estimate);

                                                    $days = floor($diffInSeconds / 86400);
                                                    $hours = floor(($diffInSeconds % 86400) / 3600);
                                                    $minutes = floor(($diffInSeconds % 3600) / 60);

                                                    echo "{$days}d {$hours}h {$minutes}m";
                                                } else {
                                                    echo 'N/A';
                                                }
                                            @endphp
                                            </td>
                                            <td>
                                                   @php
                                        if ($task->review_at) {
                                            $review = \Carbon\Carbon::parse($task->review_at);

                                            // completed_at हो तो वही, नहीं है तो now()
                                            $end = $task->completed_at
                                                ? \Carbon\Carbon::parse($task->completed_at)
                                                : \Carbon\Carbon::now();

                                            // अगर end गलत future date हो तो रोक दो
                                            if ($end < $review) {
                                                echo 'Invalid Time';
                                            } else {
                                                $diff = $review->diff($end);

                                                echo $diff->days . 'd ' . $diff->h . 'h ' . $diff->i . 'm';
                                            }
                                        } else {
                                            echo 'N/A';
                                        }
                                    @endphp
                                            </td>
                                            <td>{{ $task->task_type ?? '—' }}</td>
                                            <td>
                                                <span
                                                    class="badge 
                                                    @if ($task->status == 'completed') bg-success
                                                   @elseif ($task->status == 'in_progress') bg-warning
                                                   @else bg-danger @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </td>

                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <form action="{{ route('admin.task_management.delete') }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            <input type="hidden" name="task_id"
                                                                value="{{ $task->id }}">
                                                            <button type="submit"
                                                                style="background:none; border:none; padding:0; cursor:pointer;">
                                                                <span class="iconify" data-icon="iconoir:trash"
                                                                    style="font-size:24px; color:red;"></span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="edit-task-btn"
                                                            data-id="{{ $task->id }}"
                                                            data-project_id="{{ $task->project_id }}"
                                                            data-title="{{ $task->title }}"
                                                            data-department_id="{{ $task->department_id }}"
                                                            data-assigned_to="{{ $task->assigned_to }}"
                                                            data-reporting_head="{{ $task->reporting_head }}"
                                                            data-estimate="{{ date('Y-m-d\TH:i', strtotime($task->estimate)) }}"
                                                            data-description="{{ $task->description }}"
                                                            data-task_type="{{ $task->task_type }}">
                                                            <span class="iconify" data-icon="solar:pen-outline"
                                                                style="font-size:24px;"></span>
                                                        </a>
                                                    </li>
                                                    <li><a href="{{ route('admin.task_management.view', $task->id) }}"><span
                                                                class="iconify" data-icon="basil:eye-outline"
                                                                style="font-size:24px;"></span></a></li>
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




        <!-- write-body-content here end -->
    </div>

    </div>
    </section>

    <div class="modal fade" id="addProjectModel" tabindex="-1" aria-labelledby="addProjectModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('admin.task_management.store') }}" class="w-100" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="addProjectModelLabel">Add Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Project name</label>
                                <select class="form-select" aria-label="Default select example" name="project_name"
                                    required>
                                    <option value="" selected disabled> Select Project</option>
                                    @foreach ($projects as $item)
                                        <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" placeholder="Project Name" name="title"
                                    required>
                            </div>
                            {{-- <div class="col-lg-6 col-md-6 mb-3">
                            <label for="" class="form-label">Client Name </label>
                            <input type="text" class="form-control" placeholder="Project Name" name="project_name">                                                            
                        </div> --}}
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Departments</label>
                                <select class="form-select" aria-label="Default select example" name="department_id"
                                    required>
                                    <option value="" selected disabled> Select Department</option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Assign Employee</label>
                                <select class="form-select " aria-label="Default select example" name="assigned_to"
                                    required>
                                    <option value="" disabled selected=""> Select Employee</option>
                                    @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Reporter </label>
                                <select class="form-select" aria-label="Default select example" name="reporting_head"
                                    required>
                                    <option value="na" selected=""> Select Reporter</option>
                                    @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Estimate</label>
                                <input type="datetime-local" class="form-control" name="estimate">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="" class="form-label">Priority </label>
                                <select class="form-select" aria-label="Default select example" name="task_type"
                                    required>
                                    <option name="" id="" selected>Select One</option>
                                    <option value="low"> Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 mb-3">
                                <label for="" class="form-label">Work Description </label>
                                <textarea class="form-control" id="" rows="3" name="description"
                                    placeholder="Add some description of the task" required></textarea>
                            </div>
                            {{-- <div class="col-lg-6 col-md-12 mb-3">
                            <label for="" class="form-label">Remark</label>
                            <textarea class="form-control" id="" rows="3" name="remark " placeholder="Add Remark"></textarea>
                        </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-item-center justify-content-between">
                        <button type="Submit" class="btn-dark" id="">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <!-- IMPORTANT: No $task here -->
            <form action="#" method="POST" id="editTaskForm">
                @csrf
                @method('POST')

                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="editTaskModalLabel">Edit Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Project Name</label>
                                <select class="form-select" id="editProjectId" name="project_id" required>
                                    <option value="" disabled>Select Project</option>
                                    @foreach ($projects as $item)
                                        <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="editTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="editTitle" name="title" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="editDepartment" class="form-label">Departments</label>
                                <select class="form-select" id="editDepartment" name="department_id" required>
                                    <option value="" disabled>Select Department</option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="editAssignedTo" class="form-label">Assign Employee</label>
                                <select class="form-select" id="editAssignedTo" name="assigned_to" required>
                                    <option value="" disabled>Select Employee</option>
                                    @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="editReportingHead" class="form-label">Reporter</label>
                                <select class="form-select" id="editReportingHead" name="reporting_head" required>
                                    <option value="na">Select Reporter</option>
                                    @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="editEstimate" class="form-label">Estimate</label>
                                <input type="datetime-local" class="form-control" id="editEstimate" name="estimate">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label class="form-label">Priority</label>
                                <select class="form-select" id="editTaskType" name="task_type" required>
                                    <option disabled>Select One</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="editDescription" class="form-label">Work Description</label>
                                <textarea class="form-control" id="editDescription" rows="3" name="description" required></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
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
        @push('custom-js')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    document.querySelectorAll('.edit-task-btn').forEach(button => {
                        button.addEventListener('click', () => {

                            const taskId = button.dataset.id;

                            const updateUrlTemplate =
                                "{{ route('admin.task_management.update', ['id' => ':id']) }}";
                            const updateUrl = updateUrlTemplate.replace(':id', taskId);

                            document.getElementById('editTaskForm').action = updateUrl;
                            document.getElementById('editProjectId').value = button.dataset.project_id;
                            document.getElementById('editTitle').value = button.dataset.title;
                            document.getElementById('editDepartment').value = button.dataset.department_id;
                            document.getElementById('editAssignedTo').value = button.dataset.assigned_to;
                            document.getElementById('editReportingHead').value = button.dataset
                                .reporting_head;
                            document.getElementById('editEstimate').value = button.dataset.estimate;
                            document.getElementById('editDescription').value = button.dataset.description;
                            document.getElementById('editTaskType').value = button.dataset.task_type;

                            new bootstrap.Modal(document.getElementById('editTaskModal')).show();
                        });
                    });
                });
            </script>
        @endpush
    @endsection
