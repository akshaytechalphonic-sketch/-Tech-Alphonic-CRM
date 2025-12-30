@extends('admin.partical.main')
@push('title')
<title>Dashboard | Admin</title>
@endpush

@push('custom-css')

@endpush

@section('content')
<style>
    .dash-tabs-content {
    height: calc(100vh - 115px);
}
</style>

<div class="main-content">
    <!-- write-body-content here start -->
      <div class="pages-content">
  
          <div class="container-fluid px-0 ">
              <div class="row w-100">
                  <div class="col-lg-5 mb-3">
                      <div class="client-perview-left">
                          <div class="client-bg-color">
                              <a href="#!" class="d-flex align-items-center justify-content-center"><img src="../assets/images/icons/Edit_Pencil.png" alt=""></a>
                          </div>
  
                          <div class="client-profile-sec employidsec d-flex gap-4 align-items-center  w-100 "> 
                              <div class="client-img">
                                  <img src="{{url('public/'.$profile->profile_image)}}" alt="">
                              </div>
                              <div class=" clinet-img-contetn text-left">
                              <h2>{{$profile->name}}</h2>
                              <h4>{{$profile->designation->designation_name}}</h4>
                              <p>{{$profile->total_exp}} years of Experience</p>
                              </div>
                          </div>
  
                          <div class="client-id-sec mt-5">
                              <ul class="list-unstyled">
                                  <li class="d-flex justify-content-between align-items-center gap-3 ">
                                       <p>Department</p>
                                       <p>{{$profile->designation->department->department_name}}</p>
                                  </li>
                                  <li class="d-flex justify-content-between align-items-center gap-3 ">
                                       <p>Date Of Join</p>
                                       <p>{{ \Carbon\Carbon::parse($profile->doj)->format('M d, Y') }}</p>
                                  </li>
                              </ul>
                          </div>
                          <hr>
  
                          <div class="client-id-sec employidsec mt-5 pb-3">
                              <h4 class="my-4">Basic information</h4>
                              <ul class="list-unstyled mt-4">
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Phone</p>
                                       <p>{{$profile->mobile_no}}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Email</p>
                                       <p>{{$profile->email}}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Gender</p>
                                       <p>{{$profile->gender}}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Birdthday</p>
                                       <p>{{ \Carbon\Carbon::parse($profile->dob)->format('M d, Y') }}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Present Address</p>
                                       <p>{{$profile->present_building_no}}, {{$profile->present_area}}, {{$profile->present_city}}, {{$profile->present_country}}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                    <p>Permanent Address</p>
                                    <p>{{$profile->permanent_building_no}}, {{$profile->permanent_area}}, {{$profile->permanent_city}}, {{$profile->permanent_country}}</p>
                               </li>
                              </ul>
                          </div>
                          <hr>
                          <div class="client-id-sec employidsec mt-5 pb-5">
                              <h4 class="my-4">Personal Information</h4>
                              <ul class="list-unstyled mt-4">
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Aadhar No.</p>
                                       <p>{{$profile->aadhar_no}} <a href="{{url('public/'.$profile->aadhar_file)}}" download><i class="fa-solid fa-download"></i></a></p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                    <p>PAN No.</p>
                                    <p>{{$profile->pan_no}} <a href="{{url('public/'.$profile->pan_file)}}" download><i class="fa-solid fa-download"></i></a></p>
                               </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>IP No.</p>
                                       <p>{{$profile->ipn_no}} <a href="{{url('public/'.$profile->ipn_file)}}" download><i class="fa-solid fa-download"></i></a></p>
                                  </li>
                                <li class="d-flex justify-content-between  gap-3 ">
                                    <p>UAN No.</p>
                                    <p>{{$profile->uan_no}} <a href="{{url('public/'.$profile->uan_file)}}" download><i class="fa-solid fa-download"></i></a></p>
                               </li>
                               <li class="d-flex justify-content-between  gap-3 ">
                                <p>Rent Agreement/ Electricity bill Proof No.</p>
                                <p>{{$profile->rent_elec}} <a href="{{url('public/'.$profile->rent_elec_file)}}" download><i class="fa-solid fa-download"></i></a></p>
                                </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Religion</p>
                                       <p>{{$profile->religion}}</p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Marital status</p>
                                       <p>{{$profile->marital_status}} </p>
                                  </li>
                                  <li class="d-flex justify-content-between  gap-3 ">
                                       <p>Reference</p>
                                       <p>{{$profile->reference}} </p>
                                  </li>
                                  @if ($profile->children != null)
                                      
                                  <li class="d-flex justify-content-between  gap-3 ">
                                      <p>No. of children</p>
                                      <p>{{$profile->children}} </p>
                                    </li>
                                    @endif
                              </ul>
                          </div>
                      </div>
                          
                  </div>
                  <div class="col-lg-7 mb-4">
                      <div class="accordion box-accordian" id="accordionExample">
                          <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              About Employee
                              </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                      <div class="abot-emoloy-box">
                                          <p>{{$profile->about_employee}}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Bank Information
                              </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <div class="client-id-sec employidsec">
                                          <ul class="list-unstyled ">
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                  <p>Bank Name</p>
                                                  <p>{{$profile->bank_name}}</p>
                                              </li>
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                  <p>Bank Location</p>
                                                  <p>{{$profile->branch_location}}</p>
                                              </li>
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                <p>Account No.</p>
                                                <p>{{$profile->account_no}}</p>
                                              </li>
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                <p>IFSC Code</p>
                                                <p>{{$profile->ifsc}}</p>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Family Information
                              </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <div class="client-id-sec employidsec ">
                                          <ul class="list-unstyled ">
                                            <li class="d-flex justify-content-between  gap-3 ">
                                                <p>Father's Name</p>
                                                <p>{{$profile->father_name}}</p>
                                            </li>
                                            <li class="d-flex justify-content-between  gap-3 ">
                                                <p>Mother's Name</p>
                                                <p>{{$profile->father_name}}</p>
                                            </li>
                                            <li class="d-flex justify-content-between  gap-3 ">
                                                <p>Contact No.</p>
                                                <p>{{$profile->family_contact}}</p>
                                            </li>
                                            <li class="d-flex justify-content-between  gap-3 ">
                                                <p>Family Photo</p>
                                                <p><img src="{{url('public/'.$profile->family_photo)}}" alt="" class="w-100"></p>
                                            </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
  
                          <div class="accordion-item mb-4">
                              <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              Education Details
                              </button>
                              </h2>
                              <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <div class="client-id-sec employidsec">
                                          <h4 class="my-4">Basic information</h4>
                                          <ul class="list-unstyled mt-4">
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                  <p>School Completed Year</p>
                                                  <p>{{$profile->school_year}}</p>
                                              </li>
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                  <p>High School Completed Year</p>
                                                  <p>{{$profile->high_school_year}}</p>
                                              </li>
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                  <p>Graduation Completed Year</p>
                                                  <p>{{$profile->graducation_year}}</p>
                                              </li>
                                              <li class="d-flex justify-content-between  gap-3 ">
                                                  <p>Masters Completed Year</p>
                                                  <p>{{$profile->masters_year}}</p>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="accordion-item xyz mb-4">
                                      <h2 class="accordion-header">
                                      <button class="accordion-button ">
                                      Projects
                                      </button>
                                      </h2>
                                      <div id="collapseFive" class="accordion-collapse ">
                                      
                                          <div class="accordion-body">
                                              <div class="projects-details-client">
                                                  <div class="row">
                                                      <div class="col-lg-12 mb-3">
                                                          <div class="products">
                                                              <div class="product-detailtop d-flex gap-3">
                                                                  <img src="{{ asset('public/admin/assets/images/icons/callendly.png')}}" alt="">
                                                                  <div class="">
                                                                      <h6>Medical App (iOS native)</h6>
                                                                      <ul class="d-flex list-unstyled gap-4 mb-0">
                                                                          <li>Completed</li>
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
                                                              </ul>   
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-12 mb-3">
                                                          <div class="products">
                                                              <div class="product-detailtop d-flex gap-3">
                                                                  <img src="{{ asset('public/admin/assets/images/icons/video-calling-icon.png')}}" alt="">
                                                                  <div class="">
                                                                      <h6>Video Calling App</h6>
                                                                      <ul class="d-flex list-unstyled gap-4 mb-0">                                                                
                                                                          <li> Completed</li>
                                                                      </ul>
  
                                                                  </div>
                                                              </div>
                                                              <ul class="project-deadline d-flex justify-content-between list-unstyled my-2">
                                                                  <li>
                                                                      <span>Deadline</span>
                                                                      <p>31 July 2025</p>
                                                                  </li>
                                                                  <li>
                                                                      <span>Project Lead</span>
                                                                      <p>Leona</p>
                                                                  </li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="accordion-item xyz mb-4">
                                      <h2 class="accordion-header">
                                      <button class="accordion-button ">
                                      Assets
                                      </button>
                                      </h2>
                                      <div id="collapseSix" class="accordion-collapse">
                                      
                                          <div class="accordion-body">
                                              <div class="projects-details-client">
                                                  <div class="row">
                                                      <div class="col-lg-12 mb-3">
                                                          <div class="products">
                                                              <div class="product-detailtop d-flex gap-3">
                                                                  <img src="{{ asset('public/admin/assets/images/icons/laptop.png')}}" alt="">
                                                                  <div class="">
                                                                      <h6>Dell Laptop - #343556656</h6>
                                                                      <ul class="d-flex list-unstyled gap-4 mb-0">
                                                                          <li>Assigned on 22 Nov, 2022 10:32AM</li>
                                                                      </ul>
  
                                                                  </div>
                                                              </div>  
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-12 mb-3">
                                                          <div class="products">
                                                              <div class="product-detailtop d-flex gap-3">
                                                                  <img src="{{ asset('public/admin/assets/images/icons/mouse.png')}}" alt="">
                                                                  <div class="">
                                                                      <h6>Bluetooth Mouse - #478878</h6>
                                                                      <ul class="d-flex list-unstyled gap-4 mb-0">                                                                
                                                                          <li> Assigned on 22 Nov, 2022 10:32AM</li>
                                                                      </ul>
  
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
                          </div>
                      </div>
                  </div>
              </div>
          </div>
  
    <!-- write-body-content here end -->
  </div>
  
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


      @endpush
      @endsection
      