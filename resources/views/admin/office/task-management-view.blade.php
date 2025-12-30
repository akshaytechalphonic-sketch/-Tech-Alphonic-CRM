@extends('admin.partical.main')

@push('title')
    <title>Task Details | Admin</title>
@endpush

@push('custom-css')
    <!-- Add any custom CSS here if needed -->
@endpush

@section('content')
    <div class="main-content">
        <div class="pages-content card">

            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Task Details</h1>

                <a href="{{ route('admin.task_management.index') }}" class="btn btn-primary">
                    Back to Task List
                </a>
            </div>

            @if ($task)
                <!-- STATUS UPDATE SECTION -->
                <div class="p-3 border-bottom bg-light">
                    <form action="{{ route('admin.task_management.updateStatus', $task->id) }}" method="POST"
                        class="d-flex gap-3 align-items-center">
                        @csrf
                        @method('post')

                        <div>
                            <label class="fw-bold">Update Status:</label>
                            <select name="status" class="form-select w-auto">
                                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                                <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>Review</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed
                                </option>

                            </select>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">
                            Update Status
                        </button>
                    </form>
                </div>

                <!-- Task Info Table -->
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Field</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Title</td>
                                <td>{{ $task->title }}</td>
                            </tr>

                            <tr>
                                <td>Description</td>
                                <td>{{ $task->description ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Project Name</td>
                                <td>{{ $task->project->project_name ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Task Type</td>
                                <td>{{ $task->task_type ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Assignee</td>
                                <td>{{ $task->assignee->name ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <td>Estimate</td>
                                <td>
                                    @php
                                        if ($task->estimate) {
                                            $estimate = \Carbon\Carbon::parse($task->estimate);
                                            $created = \Carbon\Carbon::parse($task->created_at);

                                            $diff = $created->diffInSeconds($estimate);
                                            $d = floor($diff / 86400);
                                            $h = floor(($diff % 86400) / 3600);
                                            $m = floor(($diff % 3600) / 60);

                                            echo "{$d}d {$h}h {$m}m";
                                        } else {
                                            echo 'N/A';
                                        }
                                    @endphp
                                </td>
                            </tr>

                            <tr>
                                <td>Spent Time</td>
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
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td>
                                    <span
                                        class="badge 
                                                    @if ($task->status == 'completed') bg-success
                                                   @elseif ($task->status == 'in_progress') bg-warning
                                                   @else bg-danger @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>Created At</td>
                                <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                            </tr>

                            <tr>
                                <td>Updated At</td>
                                <td>{{ $task->updated_at->format('Y-m-d H:i') }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            @else
                <p>No task data available.</p>
            @endif

        </div>
    </div>
@endsection
