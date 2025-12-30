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
                      <div class="client-perview-left">
                          <div class="client-bg-color">
                              <a href="#!" class="d-flex align-items-center justify-content-center"><img src="{{ asset('public/admin/assets/images/icons/Edit_Pencil.png')}}" alt=""></a>
                          </div>

                          <div class="client-profile-sec text-center">
                              <div class="client-img">
                                  <img src="{{ asset('public/admin/assets/images/client-profile.png')}}" alt="">
                              </div>
                              <h2>{{ $clientDetail->name }}</h2>
                              <h4>{{ $clientDetail->type }}</h4>
                              <p>{{ $clientDetail->ministry }}</p>
                          </div>

                          <div class="client-id-sec mt-5">
                              <ul class="list-unstyled">
                                  <li class="d-flex justify-content-between align-items-center gap-3 ">
                                       <p>Client ID</p>
                                       <p>CLT-00{{ $clientDetail->id }}</p>
                                  </li>

                              </ul>
                          </div>
                          <div class="client-action-btns d-flex align-items-center justify-content-between my-5">
                              <div class="d-flex align-items-center justify-content-between">
                              <a href="tel:-" class="d-flex align-items-center gap-2"> <img src="{{ asset('public/admin/assets/images/icons/phone-icon.png')}}" alt="">Call</a>
                              </div>
                              <div class="d-flex align-items-center justify-content-between">
                              <a href="tel:-" class="d-flex align-items-center gap-2"> <img src="{{ asset('public/admin/assets/images/icons/mail-icon.png')}}" alt="">Message</a>
                              </div>
                          </div>
                          <hr>

                          <div class="client-id-sec mt-5 pb-5">
                              <h4 class="my-4">Basic information</h4>
                              <ul class="list-unstyled mt-4">
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Phone</p>
                                       <p>{{ $clientDetail->contact_no }}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Email</p>
                                       <p>{{ $clientDetail->email }}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Address</p>
                                       <p>{{ $clientDetail->address }}</p>
                                  </li>
                              </ul>
                          </div>





                      </div>

                  </div>
                  <div class="col-lg-7">
                      <div class="accordion box-accordian" id="accordionExample">
                          <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Projects
                              </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <div class="projects-details-client">
                                          <div class="row">
                                              <div class="col-lg-6 mb-3">
                                                  <div class="products">
                                                      <div class="product-detailtop d-flex gap-3">
                                                          <img src="{{ asset('public/admin/assets/images/icons/callendly.png')}}" alt="">
                                                          <div class="">
                                                              <h6>Medical App (iOS native)</h6>
                                                              <ul class="d-flex list-unstyled gap-4 mb-0">
                                                                  <li>8 tasks</li>
                                                                  <li>15 Completed</li>
                                                              </ul>

                                                          </div>
                                                      </div>
                                                      <ul class="project-deadline d-flex justify-content-between list-unstyled my-2">
                                                          <li>
                                                              <span>Deadline</span>
                                                              <p>31 July 2025</p>
                                                          </li>
                                                          <li>
                                                              <span>Value</span>
                                                              <p>₹20,328</p>
                                                          </li>
                                                          <li>
                                                              <span>Project Lead</span>
                                                              <p>Leona</p>
                                                          </li>
                                                      </ul>
                                                      <ul class="progreessbwi list-unstyled d-flex mb-0 gap-4">
                                                          <li>Total 565 Hrs</li>
                                                          <li class="w-100">
                                                              <div class="skill-wrapper w-100">
                                                                  <div class="d-flex justify-content-between align-items-center px-2">
                                                                  <span class="d-block float-left">495 Hrs </span><span class="d-block float-right">70 Hrs</span>
                                                                  </div>
                                                                  <div class="progress">
                                                                      <div class="progress-bar" role="progressbar" style="width:80%;"></div>
                                                                  </div>
                                                              </div>
                                                          </li>

                                                      </ul>
                                                  </div>
                                              </div>
                                              <div class="col-lg-6 mb-3">
                                                  <div class="products">
                                                      <div class="product-detailtop d-flex gap-3">
                                                          <img src="{{ asset('public/admin/assets/images/icons/video-calling-icon.png')}}" alt="">
                                                          <div class="">
                                                              <h6>Video Calling App</h6>
                                                              <ul class="d-flex list-unstyled gap-4 mb-0">
                                                                  <li>8 tasks</li>
                                                                  <li>15 Completed</li>
                                                              </ul>

                                                          </div>
                                                      </div>
                                                      <ul class="project-deadline d-flex justify-content-between list-unstyled my-2">
                                                          <li>
                                                              <span>Deadline</span>
                                                              <p>31 July 2025</p>
                                                          </li>
                                                          <li>
                                                              <span>Value</span>
                                                              <p>₹20,328</p>
                                                          </li>
                                                          <li>
                                                              <span>Project Lead</span>
                                                              <p>Leona</p>
                                                          </li>
                                                      </ul>
                                                      <ul class="progreessbwi list-unstyled d-flex mb-0 gap-4">
                                                          <li>Total 565 Hrs</li>
                                                          <li class="w-100">
                                                              <div class="skill-wrapper w-100">
                                                                  <div class="d-flex justify-content-between align-items-center px-2">
                                                                  <span class="d-block float-left">495 Hrs </span><span class="d-block float-right">70 Hrs</span>
                                                                  </div>
                                                                  <div class="progress">
                                                                      <div class="progress-bar" role="progressbar" style="width:80%;"></div>
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
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Tasks
                              </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                  <div class="task-section">
                                      <ul class="list-unstyled">
                                          <li class="d-flex align-items-center gap-4 justify-content-between" >
                                              <div class="form-check d-flex align-items-center gap-3">
                                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                  <label class="form-check-label" for="flexCheckDefault">
                                                  Marketing dashboard app
                                                  </label>
                                              </div>
                                              <div class="d-flex align-items-center gap-4">
                                                  <p class="mb-0 complete">Complete</p>
                                                  <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>

                                              </div>
                                          </li>
                                          <li class="d-flex align-items-center gap-4 justify-content-between" >
                                              <div class="form-check d-flex align-items-center gap-3">
                                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                  <label class="form-check-label" for="flexCheckDefault">
                                                  User Testing
                                                  </label>
                                              </div>
                                              <div class="d-flex align-items-center gap-4">
                                                  <p class="mb-0 Onhold">Onhold</p>
                                                  <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>

                                              </div>
                                          </li>
                                          <li class="d-flex align-items-center gap-4 justify-content-between" >
                                              <div class="form-check d-flex align-items-center gap-3">
                                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                  <label class="form-check-label" for="flexCheckDefault">
                                                  Awesome task
                                                  </label>
                                              </div>
                                              <div class="d-flex align-items-center gap-4">
                                                  <p class="mb-0 complete">Complete</p>
                                                  <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>

                                              </div>
                                          </li>
                                          <li class="d-flex align-items-center gap-4 justify-content-between" >
                                              <div class="form-check d-flex align-items-center gap-3">
                                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                  <label class="form-check-label" for="flexCheckDefault">
                                                  Marketing dashboard app
                                                  </label>
                                              </div>
                                              <div class="d-flex align-items-center gap-4">
                                                  <p class="mb-0 inprogres">Complete</p>
                                                  <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>

                                              </div>
                                          </li>
                                          <li class="d-flex align-items-center gap-4 justify-content-between" >
                                              <div class="form-check d-flex align-items-center gap-3">
                                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                  <label class="form-check-label" for="flexCheckDefault">
                                                  Awesome task
                                                  </label>
                                              </div>
                                              <div class="d-flex align-items-center gap-4">
                                                  <p class="mb-0 complete">Complete</p>
                                                  <span class="iconify" data-icon="pepicons-pencil:dots-y" data-inline="false" style="font-size: 24px;"></span>

                                              </div>
                                          </li>
                                      </ul>
                                  </div>
                                  </div>
                              </div>
                          </div>
                          <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Invoices
                              </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                                                              <th>SNo.</th>
                                                              <th>Invoice ID</th>
                                                              <th>Client	Amount</th>
                                                              <th>Rest Payment </th>
                                                              <th>Due Date</th>
                                                              <th>Action</th>
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
                                                              <td>1</td>
                                                              <td>#1254049</td>
                                                              <td>₹2,05,426</td>
                                                              <td>₹2,426</td>
                                                              <td>28 Dec 2023</td>
                                                              <td><a href="#!" data-bs-toggle="modal" data-bs-target="#clientStatusModel"><span class="badge  succes-bg ">Paid</span></a></td>

                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>1</td>
                                                              <td>#1254049</td>
                                                              <td>₹2,05,426</td>
                                                              <td>₹2,426</td>
                                                              <td>28 Dec 2023</td>
                                                              <td><a href="#!" data-bs-toggle="modal" data-bs-target="#clientStatusModel"><span class="badge  succes-bg ">Paid</span></a></td>

                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>1</td>
                                                              <td>#1254049</td>
                                                              <td>₹2,05,426</td>
                                                              <td>₹2,426</td>
                                                              <td>28 Dec 2023</td>
                                                              <td><a href="#!" data-bs-toggle="modal" data-bs-target="#clientStatusModel"><span class="badge  succes-bg ">Paid</span></a></td>

                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" value="" id="">
                                                                  </div>
                                                              </td>
                                                              <td>1</td>
                                                              <td>#1254049</td>
                                                              <td>₹2,05,426</td>
                                                              <td>₹2,426</td>
                                                              <td>28 Dec 2023</td>
                                                              <td><a href="#!" data-bs-toggle="modal" data-bs-target="#clientStatusModel"><span class="badge  succes-bg ">Paid</span></a></td>

                                                          </tr>
                                                          <!-- Add more rows here -->
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="accordion-item mb-4">
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
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- <div class="dash-tabs-content"> -->

          <!-- </div> -->

    <!-- write-body-content here end -->
  </div>

</div>
</section>

<div class="search-box-mob">
<div class="close-search-bar">
  <img
    width="30"
    height="30"
    src="https://img.icons8.com/ios/30/close-window.png"
    alt="close-window"
  />
</div>
















<script>

    $(window).on('scroll',function(){
        let scroll = $(window).scrollTop();
        let oTop = $('.progress-bar').offset().top - window.innerHeight;
        if(scroll>oTop){
            $(".progress-bar").addClass("progressbar-active");
          }
          else{
              $(".progress-bar").removeClass("progressbar-active");
          }
      });
      </script>

@push('custom-js')


@endpush
@endsection
