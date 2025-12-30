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

                <div class="dash-tabs-content no-scrollbar">
                    <div class="container-fluid py-4 px-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="step-form">
                                    <div class="step-form-step active">
                                        <form action="{{ route('admin.employee.create') }}" method="post" enctype="multipart/form-data">@csrf
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Add New Employee</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Name </label>
                                                    <input type="text" class="form-control" name="name"  id=""  placeholder="Name">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Email </label>
                                                    <input type="email" class="form-control" name="email" id=""  placeholder="Email">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Mobile No </label>
                                                    <input type="tel" class="form-control" name="mobile_no" id="" placeholder="Mobile No ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Father Name  </label>
                                                    <input type="text" class="form-control" name="father_name" id="" placeholder="Father Name ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">IP No   </label>
                                                    <div class="file-def">
                                                        <input type="text" class="form-control" name="ipn_no" id="" placeholder="IP No  ">
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" >
                                                                <span><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">UAN </label>
                                                    <div class="file-def">
                                                        <input type="text" name="uan_no" class="form-control" id="" placeholder="UAN  ">
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" >
                                                                <span><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Select Client  </label>
                                                    
                                                    <select class="form-control select2" name="client_id" required>
                                                        <option>Choose Any One</option>
                                                        @forelse ($client as $allclient)
                                                          <option value="{{ $allclient->id }}">{{ $allclient->name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>

                                                </div>
                                                
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Select Designation  </label>
                                                    <select class="form-control select2" name="designation" required>
                                                        <option>Choose Any One</option>
                                                        @forelse ($designations as $alldesignations)
                                                          <option value="{{ $alldesignations->id }}">{{ $alldesignations->destination }}</option>
                                                        @empty

                                                        @endforelse
                                                  </select>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Contact No  </label>
                                                    <div class="file-def">
                                                        <input type="text" name="mobile_no" class="form-control" id="" placeholder="Contact No ">
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" >
                                                                <span><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">GSTIN  </label>
                                                    <div class="file-def">
                                                        <input type="text" name="gstin" class="form-control" id="" placeholder="GSTIN ">
                                                        <div class="file-upload-img">
                                                            <div class="inner-sec">
                                                                <img src="{{ asset('public/admin/assets/images/icons/upload.png')}}" alt="">
                                                                <input type="file" >
                                                                <span><img src="{{ asset('public/admin/assets/images/icons/check-w.png')}}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-3">
                                                    <label for="" class="form-label">Address </label>
                                                    <input type="text" name="address"  class="form-control" id="" placeholder="Address">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">IFD Concurrence </label>
                                                    <input type="text" name="ifd_concurrence" class="form-control" id=""  placeholder="IFD Concurrence ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Role  </label>
                                                    <input type="text" name="role" class="form-control" id=""  placeholder="Role ">
                                                </div>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Designation of Administrative Approval </label>
                                                    <input type="text" name="designation_of_administrative_approval" class="form-control" id="" placeholder="Designation of Administrative Approval ">
                                                </div>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Payment Mode  </label>
                                                    <input type="text" name="payment_mode" class="form-control" id="" placeholder="Payment Mode ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Designation of Financial Approval  </label>
                                                    <input type="text" name="designation_of_financial_approval" class="form-control" id="" placeholder="Designation of Financial Approval ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Designation  </label>
                                                    <input type="text" name="designation" class="form-control" id="" placeholder="Designation ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Email  </label>
                                                    <input type="text" name="email" class="form-control" id="" placeholder="Email ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">GSTIN  </label>
                                                    <input type="text" name="gstin" class="form-control" id="" placeholder="GSTIN ">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-3">
                                                    <label for="" class="form-label">Address </label>
                                                    <input type="text" name="address" class="form-control" id="" placeholder="Address">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Profile Image Upload </label>
                                                    <input type="file" class="form-control" name="profile_image" id="" placeholder="Profile Image Upload">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">CV Upload </label>
                                                    <input type="file" name="cvupload" class="form-control" id="" placeholder="CV Upload">
                                                </div>
                                            </div>
                                            <div class="next-preview-btns d-flex align-items-center justify-content-between mt-4">
                                            <button class="confirm-step" type="submit">Submit</button>
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

    <div class="search-box-mob">
      <div class="close-search-bar">
        <img
          width="30"
          height="30"
          src="https://img.icons8.com/ios/30/close-window.png')}}"
          alt="close-window"
        />
      </div>





      @push('custom-js')


      @endpush
      @endsection
