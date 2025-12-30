@extends('office.partical.main')
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
                    {{-- @if ($lead->csv != null)
                        @php
                            // $lead_csv_json = json_decode($lead->csv, true);
                            $lead_csv_json = json_decode($lead->csv);

                        @endphp
                        <div class="col-12 mb-3">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            Csv Data
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body row">
                                            @foreach ($lead_csv_json as $key => $dt)
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                                    <label for=""
                                                        class="form-label text-capitalize">{{ str_replace('_', ' ', $key) }}</label>
                                                    <input type="text" class="form-control" value="{{ $dt }}"
                                                        readonly>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif --}}
                    {{-- @if (!empty($lead->csv) && is_string($lead->csv))
                        @php
                            $lead_csv_json = json_decode($lead->csv, true);
                        @endphp

                        @if (is_array($lead_csv_json))
                            <div class="col-12 mb-3">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                                CSV Data
                                            </button>
                                        </h2>

                                        <div id="flush-collapseOne" class="accordion-collapse collapse">
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
                                <li class="list-group-item mb-2"><strong>Service Name</strong> : {{ $lead->service_name }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Client Name</strong> : {{ $lead->client_name }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Client Mobile</strong> : {{ $lead->client_mobile }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Client Email</strong> : {{ $lead->client_email }}
                                </li>
                                <li class="list-group-item mb-2"><strong>Amount</strong> :
                                    {{ number_format($lead->amount) }}</li>
                                <li class="list-group-item mb-2"><strong>Final Amount</strong> :
                                    {{ number_format($lead->final_amount) }}</li>
                                <li class="list-group-item mb-2"><strong>Recived Amount</strong> :
                                    {{ number_format($lead->recived_amount) }}</li>
                                <li class="list-group-item mb-2"><strong>Pending Amount</strong> :
                                    {{ number_format($lead->final_amount - $lead->recived_amount) }}</li>
                                <li class="list-group-item mb-2"><strong>status</strong> : {{ $lead->status }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="bg-white rounded p-3 h-100">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-dark btn-sm py-1 active me-2" id="pills-home-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Remarks 📜</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="btn btn-dark btn-sm py-1" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Follow ups 📁</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab" tabindex="0">
                                    <!--<button class="btn btn-dark btn-sm py-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Follow ups 📁</button>-->
                                    <div class="position-relative">
                                        <div id="remarks" class="bg-light mb-3 rounded p-3"
                                            style="height: 400px; overflow-y:scroll;scroll-behavior: smooth;flex-direction: column-reverse;">
                                            @php
                                                $remark_json = json_decode($lead->remark, true);
                                            @endphp

                                            @foreach ($remark_json as $key => $remark)
                                                <p
                                                    class="mb-2 bg-white rounded text-wrap p-2 {{ count($remark_json) == $key + 1 ? 'mb-0' : '' }}">
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
                                    <form class="row m-0"
                                        action="{{ route('office_employee.leads.update_lead_remark', ['id' => $lead->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Final Amount</label>
                                            <input type="number" class="form-control" value="{{ $lead->final_amount }}"
                                                placeholder="Final amount" name="final_amount">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Received Amount</label>
                                            <input type="number" class="form-control" value="{{ $lead->recived_amount }}"
                                                placeholder="Recived mount" name="recived_amount">
                                        </div>
                                        <div class="col-9 pe-0">
                                            <textarea name="remark" class="form-control" placeholder="Write Remark" rows="3" required></textarea>
                                        </div>

                                        <div class="col-3">
                                            <select class="form-select mb-2" aria-label="Default select example"
                                                name="status" required>
                                                <option value="" selected disabled>Choose status</option>
                                                <option value="open" {{ $lead->status == 'open' ? 'selected' : '' }}>
                                                    Open</option>
                                                <option value="hot" {{ $lead->status == 'hot' ? 'selected' : '' }}>Hot
                                                </option>
                                                <option value="warm" {{ $lead->status == 'warm' ? 'selected' : '' }}>
                                                    Warm</option>
                                                <option value="cold" {{ $lead->status == 'cold' ? 'selected' : '' }}>
                                                    Cold</option>
                                                <option value="fake" {{ $lead->status == 'fake' ? 'selected' : '' }}>
                                                    Fake</option>
                                                <option value="future" {{ $lead->status == 'future' ? 'selected' : '' }}>
                                                    Future</option>
                                                <option value="loss" {{ $lead->status == 'loss' ? 'selected' : '' }}>
                                                    Loss</option>
                                                <option value="connected"
                                                    {{ $lead->status == 'connected' ? 'selected' : '' }}>Connected</option>
                                                <option value="not connected"
                                                    {{ $lead->status == 'not connected' ? 'selected' : '' }}>Not Connected
                                                </option>
                                                <option value="converted"
                                                    {{ $lead->status == 'converted' ? 'selected' : '' }}>Converted</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="position-relative">

                                        <div id="followups" class="bg-light mb-3 rounded p-3"
                                            style="height: 400px; overflow-y:scroll;scroll-behavior: smooth;flex-direction: column-reverse;">
                                            @foreach ($followups as $key => $item)
                                                <p
                                                    class="mb-2 bg-white rounded text-wrap p-2 {{ count($remark_json) == $key + 1 ? 'mb-0' : '' }}">
                                                    {{ $item->content }}<br>
                                                    <span
                                                        class="badge bg-primary-subtle text-dark mt-2 text-capitalize">Date:
                                                        {{ date('d M,Y', strtotime($item->date)) }}</span>
                                                    <span
                                                        class="badge bg-primary-subtle text-dark mt-2 text-capitalize">Time:
                                                        {{ date('h:i A', strtotime($item->time)) }}</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <form class="row m-0"
                                        action="{{ route('office_employee.leads.followup', ['lead_id' => $lead->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Date</label>
                                            <input type="date" class="form-control" min="{{ date('Y-m-d') }}"
                                                name="date">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Time</label>
                                            <input type="time" class="form-control" name="time" min="10:00"
                                                max="19:00">
                                        </div>
                                        <div class="col-9 pe-0">
                                            <textarea name="content" class="form-control" placeholder="Write follow Up" rows="1" required></textarea>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- write-body-content here end -->
    </div>

    </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="{{ route('office_employee.leads.followup', ['lead_id' => $lead->id]) }}"
                method="post">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Followups</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row m-0 modal-body">
                    <div class="col-md-6">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" min="{{ date('Y-m-d') }}" name="date">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Time</label>
                        <input type="time" class="form-control" name="time" min="10:00" max="19:00">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" rows="3" name="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                alt="close-window" />
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
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const remarksDiv = document.getElementById("followups");
                    if (remarksDiv) {
                        remarksDiv.scrollTop = remarksDiv.scrollHeight;
                    }
                });
                document.addEventListener("DOMContentLoaded", function() {
                    const remarksDiv = document.getElementById("followups");
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
