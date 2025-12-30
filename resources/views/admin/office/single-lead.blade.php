@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
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
            <div class="container-fluid">
                <div class="row">
                    {{-- @if (!empty($lead->csv) && is_string($lead->csv))
                        @php
                            $lead_csv_json = json_decode($lead->csv, true);
                        @endphp

                        @if (is_array($lead_csv_json))
                            <div class="col-12 mb-3">
                                <div class="accordion accordion-flush" id="accordionFlushExampleAdmin">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseAdmin"
                                                aria-expanded="false">
                                                CSV Data
                                            </button>
                                        </h2>

                                        <div id="flush-collapseAdmin" class="accordion-collapse collapse">
                                            <div class="accordion-body row">
                                                @foreach ($lead_csv_json as $key => $dt)
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                                        <label class="form-label text-capitalize">
                                                            {{ str_replace('_', ' ', $key) }}
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $dt }}" readonly>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif --}}


                    <div class="col-4">
                        <div class="bg-white rounded p-3 h-100">
                            <div class="step-title mb-4">
                                <h6>Employee Details</h6>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item mb-2"><strong>Employee ID</strong> : #{{ $lead->employee->id ?? ''}}
                                </li>
                                <li class="list-group-item mb-2"><strong>Employee Name</strong> :
                                    {{ $lead->employee->name ?? ''}}</li>
                                <li class="list-group-item mb-2"><strong>Employee Designation</strong> :
                                    {{ $lead->employee->designation->designation_name ?? ''}}</li>
                                <li class="list-group-item mb-2"><strong>Service Name</strong> : {{ $lead->service_name }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Client Name</strong> : {{ $lead->client_name }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Client Mobile</strong> : {{ $lead->client_mobile }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Client Email</strong> : {{ $lead->client_email }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Amount</strong> : {{ $lead->amount }}</li>
                                <li class="list-group-item mb-2"><strong>Final Amount</strong> : {{ $lead->final_amount }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Recived Amount</strong> :
                                    {{ $lead->recived_amount }}</li>
                                <li class="list-group-item mb-2"><strong>Pending Amount</strong> :
                                    {{ $lead->final_amount - $lead->recived_amount }}</li>

                                <li class="list-group-item mb-2"><strong>status</strong> : {{ $lead->status }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="bg-white rounded p-3 h-100">
                            <div class="step-title ">
                                <h6>Remarks</h6>
                            </div>
                            <div class="position-relative">
                                <div id="remarks" class="bg-light mb-3 rounded p-3"
                                    style="height: 600px; overflow-y:scroll;scroll-behavior: smooth;flex-direction: column-reverse;">
                                    @php
                                        $remark_json = json_decode($lead->remark, true);
                                    @endphp

                                    @foreach ($remark_json as $key => $remark)
                                        <p
                                            class="mb bg-white rounded text-wrap p-2 {{ count($remark_json) == $key + 1 ? 'mb-0' : '' }}">
                                            {{ $remark['remark'] }}<br>
                                            @foreach ($remark as $ky => $mark)
                                                @if ($ky != 'remark')
                                                    <span
                                                        class="badge bg-primary-subtle text-dark mt-2 text-capitalize">{{ str_replace('_', ' ', $ky) }}
                                                        :
                                                        {{ $mark }}</span>
                                                @endif
                                            @endforeach
                                        </p>
                                    @endforeach
                                </div>
                                <span
                                    class="badge rounded-pill bg-light text-bg-light justify-content-center align-items-center border position-absolute"
                                    id="scrollToBottomBtn"
                                    style="width:40px;height:40px;right:50px;bottom:30px;cursor: pointer;"><i
                                        class="fa-solid fa-chevron-down"></i></span>
                            </div>
                            {{-- <button id="scrollToBottomBtn" class="btn btn-primary rounded-pill py-2" style="">
                            <i class="fa-solid fa-chevron-down"></i>
                        </button> --}}

                            {{-- <form class="row m-0"
                                action="{{ route('admin.leads.update_lead_remark', ['id' => $lead->id]) }}" method="POST">
                                @csrf
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Final Amount</label>
                                    <input type="number" class="form-control" value="{{$lead->final_amount}}" placeholder="Final amount"
                                        name="final_amount">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Recived Amount</label>
                                    <input type="number" class="form-control" value="{{ $lead->recived_amount }}" placeholder="Recived mount"
                                        name="recived_amount">
                                </div>
                                <div class="col-9 pe-0">
                                    <textarea name="remark" class="form-control" placeholder="Write Remark" rows="3" required></textarea>
                                </div>
                                <div class="col-3">
                                    <select class="form-select mb-2" aria-label="Default select example" name="status"
                                        required>
                                        <option value="" selected disabled>Choose status</option>
                                        <option value="open" {{ $lead->status == 'open' ? 'selected' : '' }}>Hot</option>
                                        <option value="hot" {{ $lead->status == 'hot' ? 'selected' : '' }}>Hot</option>
                                        <option value="warm" {{ $lead->status == 'warm' ? 'selected' : '' }}>Warm</option>
                                        <option value="cold" {{ $lead->status == 'cold' ? 'selected' : '' }}>Cold</option>
                                        <option value="fake" {{ $lead->status == 'fake' ? 'selected' : '' }}>Fake</option>
                                        <option value="future" {{ $lead->status == 'future' ? 'selected' : '' }}>Future</option>
                                        <option value="loss" {{ $lead->status == 'loss' ? 'selected' : '' }}>Loss</option>
                                        <option value="converted" {{ $lead->status == 'converted' ? '' : '' }}>Converted</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </form> --}}
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
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const remarksDiv = document.getElementById("remarks");
                    if (remarksDiv) {
                        remarksDiv.scrollTop = remarksDiv.scrollHeight;
                    }
                });
                document.addEventListener("DOMContentLoaded", function() {
                    const remarksDiv = document.getElementById("remarks");
                    const scrollToBottomBtn = document.getElementById("scrollToBottomBtn");

                    // Show/hide button based on scroll position
                    remarksDiv.addEventListener("scroll", function() {
                        const isAtBottom = remarksDiv.scrollHeight == Math.round(remarksDiv.scrollTop + remarksDiv
                            .clientHeight + 1) ? true : false;
                        console.log(remarksDiv.scrollHeight, Math.round(remarksDiv.scrollTop + remarksDiv
                            .clientHeight + 1))
                        scrollToBottomBtn.style.display = isAtBottom ? "none" : "flex";
                    });

                    // Scroll to bottom when button is clicked
                    scrollToBottomBtn.addEventListener("click", function() {
                        remarksDiv.scrollTop = remarksDiv.scrollHeight;
                    });
                });
            </script>
        @endpush
    @endsection
