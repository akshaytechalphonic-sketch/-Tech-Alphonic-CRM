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

            <div class="container-fluid px-0 ">
                <div class="row w-100">
                    <div class="col-md-5">
                        <div class="client-perview-left ">
                            <div class="client-id-sec pt-5">
                                <h4 class="">Project Details</h4>

                                <ul class="list-unstyled mt-4">

                                    <li class="d-flex justify-content-between gap-3">
                                        <p class="label">Project name</p>
                                        <p class="value">{{ $data['project']->project_name }}</p>
                                    </li>

                                    <li class="d-flex justify-content-between gap-3">
                                        <p class="label">Client Name</p>
                                        <p class="value">{{ $data['project']->client_name }}</p>
                                    </li>

                                    <li class="d-flex justify-content-between gap-3">
                                        <p class="label">Project Description</p>
                                        <p class="value">{{ $data['project']->description }}</p>
                                    </li>

                                    <li class="d-flex justify-content-between gap-3">
                                        <p class="label">Start Date</p>
                                        <p class="value">{{ $data['project']->start_date }}</p>
                                    </li>

                                    <li class="d-flex justify-content-between gap-3">
                                        <p class="label">End Date</p>
                                        <p class="value">{{ $data['project']->deadline }}</p>
                                    </li>

                                </ul>
                            </div>


                        </div>

                    </div>
                    <div class="col-lg-7">
                        <div class="accordion box-accordian" id="accordionExample">
                            <div class="accordion-item mb-4">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Projects
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="projects-details-client">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="products">

                                                        <div class="product-detailtop d-flex gap-3">
                                                            <img src="{{ asset('public/admin/assets/images/icons/callendly.png') }}"
                                                                alt="">
                                                            <div>
                                                                <h6>{{ $data['project']->title }}</h6>
                                                                <ul class="d-flex list-unstyled gap-4 mb-0">
                                                                    <li>{{ $data['totalTasks'] }} tasks</li>
                                                                    <li>{{ $data['completedTasks'] }} Completed</li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <ul
                                                            class="project-deadline d-flex justify-content-between list-unstyled my-2">
                                                            <li>
                                                                <span>Deadline</span>
                                                                <p>{{ date('d M Y', strtotime($data['project']->deadline)) }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <span>Value</span>
                                                                <p>₹{{ number_format($data['project']->value, 2) }}</p>
                                                            </li>
                                                            <li>
                                                                <span>Project Lead</span>
                                                                <p>{{ $data['project']->manager->name ?? 'N/A' }}</p>
                                                            </li>
                                                        </ul>

                                                        <ul class="progreessbwi list-unstyled d-flex mb-0 gap-4">
                                                            <li>Total {{ $data['estimatedHours'] }} Hrs</li>
                                                            <li class="w-100">
                                                                <div class="skill-wrapper w-100">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center px-2">
                                                                        <span>{{ $data['totalHours'] }} Hrs</span>
                                                                        <span>{{ $data['remainingHours'] }} Hrs</span>
                                                                    </div>

                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="width: {{ $data['progress'] }}%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="accordion-item mb-4">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Tasks
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="task-section">
                                            <ul class="list-unstyled">

                                                @foreach ($data['project']->tasks as $task)
                                                    <li class="d-flex align-items-center gap-4 justify-content-between">

                                                        {{-- Checkbox + Task Title --}}
                                                        <div class="form-check d-flex align-items-center gap-3">
                                                            <span>{{ $loop->iteration }}.</span>
                                                            <label class="form-check-label">
                                                                {{ $task->title }}
                                                            </label>
                                                        </div>

                                                        {{-- Status + Options Icon --}}
                                                        <div class="d-flex align-items-center gap-4">
                                                            <p
                                                                class="mb-0 
                                                              @if ($task->status == 'completed') text-success
                                                              @elseif($task->status == 'in_progress') text-warning
                                                               @elseif($task->status == 'todo') text-danger 
                                                                @elseif($task->status == 'review') text-danger @endif">
                                                                {{ ucfirst($task->status) }}
                                                            </p>

                                                        </div>

                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-4">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Update Status
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="invoice-box">
                                            <div class=" no-scrollbar">
                                                <form
                                                    action="{{ route('admin.projects.updateStatus', $data['project']->id) }}"
                                                    method="POST" class="d-flex gap-3 align-items-center">
                                                    @csrf
                                                    @method('post')

                                                    <div class="col-3">
                                                        <select class="form-select mb-2" name="status" required>
                                                            <option value="" disabled
                                                                {{ $data['project']->status ? '' : 'selected' }}>
                                                                Choose status
                                                            </option>

                                                            <option value="open"
                                                                {{ $data['project']->status == 'open' ? 'selected' : '' }}>
                                                                Open
                                                            </option>

                                                            <option value="hold"
                                                                {{ $data['project']->status == 'hold' ? 'selected' : '' }}>
                                                                Hold
                                                            </option>

                                                            <option value="closed"
                                                                {{ $data['project']->status == 'closed' ? 'selected' : '' }}>
                                                                Closed
                                                            </option>
                                                        </select>

                                                        <button type="submit"
                                                            class="btn btn-primary w-100">Update</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              Notes
                              </button>
                              </h2>
                              <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <div class="note-section">
                                          <div class="row ">
                                              <div class="col-lg-4 mb-3">
                                                  <div class="note-box">
                                                      <div class=" heaa d-flex align-items-center justify-content-between gap-4">
                                                          <p class="mb-0">15 May 2025</p>
                                                          <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>
                                                      </div>
                                                      <h4>Changes & design</h4>
                                                      <p>An office management app project streamlines administrative tasks by integrating tools for</p>
                                                  </div>
                                              </div>
                                              <div class="col-lg-4 mb-3">
                                                  <div class="note-box">
                                                      <div class=" heaa d-flex align-items-center justify-content-between gap-4">
                                                          <p class="mb-0">15 May 2025</p>
                                                          <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>
                                                      </div>
                                                      <h4>Changes & design</h4>
                                                      <p>An office management app project streamlines administrative tasks by integrating tools for</p>
                                                  </div>
                                              </div>
                                              <div class="col-lg-4 mb-3">
                                                  <div class="note-box">
                                                      <div class=" heaa d-flex align-items-center justify-content-between gap-4">
                                                          <p class="mb-0">15 May 2025</p>
                                                          <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>
                                                      </div>
                                                      <h4>Changes & design</h4>
                                                      <p>An office management app project streamlines administrative tasks by integrating tools for</p>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              Documents
                              </button>
                              </h2>
                              <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <div class="invoice-box">
                                          <div class=" no-scrollbar">
                                              <div class="table-responsive ">
                                                  <table  class="table example">
                                                      <thead>
                                                          <tr>
                                                              <th>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                      All
                                                                  </div>

                                                              </th>
                                                              <th>Name</th>
                                                              <th>Size</th>
                                                              <th>Type </th>
                                                              <th>Modified</th>
                                                              <th>Share</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          <!-- Sample Rows -->
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>Cheat_codez</td>
                                                              <td>8 MB</td>
                                                              <td>Xml</td>
                                                              <td>Oct 12, 2025</td>
                                                              <td>15 Aug 2024</td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>Cheat_codez</td>
                                                              <td>8 MB</td>
                                                              <td>Xml</td>
                                                              <td>Oct 12, 2025</td>
                                                              <td>15 Aug 2024</td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>Cheat_codez</td>
                                                              <td>8 MB</td>
                                                              <td>Xml</td>
                                                              <td>Oct 12, 2025</td>
                                                              <td>15 Aug 2024</td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>Cheat_codez</td>
                                                              <td>8 MB</td>
                                                              <td>Xml</td>
                                                              <td>Oct 12, 2025</td>
                                                              <td>15 Aug 2024</td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>Cheat_codez</td>
                                                              <td>8 MB</td>
                                                              <td>Xml</td>
                                                              <td>Oct 12, 2025</td>
                                                              <td>15 Aug 2024</td>
                                                          </tr>

                                                          <!-- Add more rows here -->
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div> --}}
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
















        <script>
            $(window).on('scroll', function() {
                let scroll = $(window).scrollTop();
                let oTop = $('.progress-bar').offset().top - window.innerHeight;
                if (scroll > oTop) {
                    $(".progress-bar").addClass("progressbar-active");
                } else {
                    $(".progress-bar").removeClass("progressbar-active");
                }
            });
        </script>

        @push('custom-js')
        @endpush
    @endsection
