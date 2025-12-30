@extends('admin.partical.main')
@push('title')
<title>Dashboard | Admin</title>
@endpush

@push('custom-css')

@endpush

@section('content')


        <div class="main-content">
            <div class="pages-content">
                <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill active" id="pills-Activeclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Activeclient" type="button" role="tab" aria-controls="pills-Activeclient" aria-selected="false">Corprate </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-InActiveclient-tab" data-bs-toggle="pill" data-bs-target="#pills-InActiveclient" type="button" role="tab" aria-controls="pills-InActiveclient" aria-selected="false">Government </button>
                        </li>
                    </ul>


                </div>

                <div class="dash-tabs-content no-scrollbar">

                    <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-Activeclient" role="tabpanel" aria-labelledby="pills-Activeclient-tab" tabindex="0">
                      <div class="container-fluid py-4 px-5">
                        <div class="row">
                            {{-- <form action="{{ route('admin.client.create') }}" method="post">@csrf --}}
                             <div class="col-md-12">
                                <div class="step-form">
                                    <div class="step-form-step active">
                                           <form>
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Organisation Details/ Buyer Details</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Name </label>
                                                    <input type="text" name="od_clientName" class="form-control" id=""  placeholder="Name">
                                                    <input type="hidden" name="firstForm" value="1">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Type </label>
                                                    <input type="text" name="od_type" class="form-control" id=""  placeholder="Type">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Ministry </label>
                                                    <input type="text" name="od_ministry" class="form-control" id="" placeholder="Ministry ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Department  </label>
                                                    <input type="text" name="od_department" class="form-control" id="" placeholder="Department ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Organisation Name  </label>
                                                    <input type="text" name="od_organisation_name" class="form-control" id="" placeholder="Organisation Name ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Office Zone   </label>
                                                    <input type="text" name="od_office_zone" class="form-control" id="" placeholder="Office Zone  ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Designation  </label>
                                                    <input type="text" name="od_designation" class="form-control" id="" placeholder="Designation ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Contact No  </label>
                                                    <input type="text" name="od_contact_no" class="form-control" id="" placeholder="Contact No ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Email  </label>
                                                    <input type="text" name="od_email" class="form-control" id="" placeholder="Email ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">GSTIN  </label>
                                                    <input type="text" name="od_gstin" class="form-control" id="" placeholder="GSTIN ">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-3">
                                                    <label for="" class="form-label">Address </label>
                                                    <input type="text" name="od_address" class="form-control" id="" placeholder="Address">
                                                </div>
                                                <div class="col-lg-12 mb-3 mt-4">
                                                    <div class="step-title">
                                                        <h3>Financial Approval Details/ Paying Authority Details</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">IFD Concurrence </label>
                                                    <input type="text" name="ifd_concurrence" class="form-control" id=""  placeholder="IFD Concurrence ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Role  </label>
                                                    <input type="text" name="ifd_role" class="form-control" id=""  placeholder="Role ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Designation of Administrative Approval </label>
                                                    <input type="text" name="ifd_admin_approval_designation" class="form-control" id="" placeholder="Designation of Administrative Approval ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Payment Mode  </label>
                                                    <input type="text" name="ifd_payment_mode" class="form-control" id="" placeholder="Payment Mode ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Designation of Financial Approval  </label>
                                                    <input type="text" name="ifd_financial_approval_designation" class="form-control" id="" placeholder="Designation of Financial Approval ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Designation  </label>
                                                    <input type="text" name="fa_designation" class="form-control" id="" placeholder="Designation ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Email  </label>
                                                    <input type="text" name="fa_email" class="form-control" id="" placeholder="Email ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">GSTIN  </label>
                                                    <input type="text" name="fa_gstin" class="form-control" id="" placeholder="GSTIN ">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-3">
                                                    <label for="" class="form-label">Address </label>
                                                    <input type="text" name="fa_address" class="form-control" id="" placeholder="Address">
                                                </div>
                                            </div>
                                           </form>
                                    </div>
                                    <div class="step-form-step">
                                        <form>
                                            <div class="row">

                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Consignee Details</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Contact No  </label>
                                                    <input type="text" name="consignee_contact_no" class="form-control" id="" placeholder="Contact No ">
                                                    <input type="hidden" name="firstForm" value="2">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Email  </label>
                                                    <input type="text" name="consignee_email" class="form-control" id="" placeholder="Email ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">GSTIN  </label>
                                                    <input type="text" name="consignee_gstin" class="form-control" id="" placeholder="GSTIN ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Address </label>
                                                    <input type="text" name="consignee_address" class="form-control" id="" placeholder="Address">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-3">
                                                    <label for="" class="form-label">Service Description  </label>
                                                    <input type="text" name="service_description" class="form-control" id="" placeholder="Service Description ">
                                                </div>
                                                <div class="col-lg-12 mb-3 mt-4">
                                                    <div class="step-title">
                                                        <h3>Service Provider Details</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Gem Seller ID </label>
                                                    <input type="text" name="sp_gem_seller_id" class="form-control" id=""  placeholder="Gem Seller ID ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Company Name  </label>
                                                    <input type="text" name="sp_company_name" class="form-control" id="" placeholder="Company Name  ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Email  </label>
                                                    <input type="text" name="sp_contact_number" class="form-control" id="" placeholder="Email ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Contact No  </label>
                                                    <input type="text" name="sp_email" class="form-control" id=""  placeholder="Contact No ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Address </label>
                                                    <input type="text" name="sp_address" class="form-control" id="" placeholder="Address">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">MSME Verified  </label>
                                                    <input type="text" name="sp_msme_verified" class="form-control" id=""  placeholder="MSME Verified ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">MSME Registration No </label>
                                                    <input type="text" name="sp_msme_registration" class="form-control" id="" placeholder="MSME Registration No ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">MSE Social Category  </label>
                                                    <input type="text" name="sp_mse_social_category"  class="form-control" id="" placeholder="MSE Social Category ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Gender  </label>
                                                    <input type="text" name="sp_gender" class="form-control" id="" placeholder="Gender ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">GSTIN  </label>
                                                    <input type="text" name="sp_gstin" class="form-control" id="" placeholder="GSTIN ">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="step-form-step">
                                        <form>
                                            <div class="row">

                                                <div class="col-lg-12 mb-3">
                                                    <div class="step-title ">
                                                        <h3>Service Details</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Service Start Date  </label>
                                                    <input type="date" name="service_start_date" class="form-control" id="" placeholder="Service Start Date ">
                                                    <input type="hidden" name="firstForm" value="3">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Service End Date  </label>
                                                    <input type="date" name="service_end_date" class="form-control" id="" placeholder="Service End Date ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Type of Establishment/Area  </label>
                                                    <input type="text" name="establishment_area" class="form-control" id="" placeholder="Type of Establishment/Area ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Category of Profile </label>
                                                    <input type="text" name="category_profile" class="form-control" id="" placeholder="Category of Profile">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Category of Skills  </label>
                                                    <input type="text" name="category_skills" class="form-control" id="" placeholder="Category of Skills ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Gender </label>
                                                    <input type="text" name="gender" class="form-control" id=""  placeholder="Gender ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Duty Hours in a Day  </label>
                                                    <input type="text" name="duty_hours_per_day" class="form-control" id="" placeholder="Duty Hours in a Day  ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Qualification  </label>
                                                    <input type="text" name="qualification" class="form-control" id="" placeholder="Qualification ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Ex-Serviceman  </label>
                                                    <input type="text" name="ex_serviceman" class="form-control" id=""  placeholder="Ex-Serviceman ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Age Limit </label>
                                                    <input type="text" name="age_limit" class="form-control" id="" placeholder="Age Limit">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Years of Experience  </label>
                                                    <input type="text" name="years_experience" class="form-control" id=""  placeholder="Years of Experience ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Additional Requirement </label>
                                                    <input type="text" name="additional_requirement" class="form-control" id="" placeholder="Additional Requirement ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">District  </label>
                                                    <input type="text" name="district" class="form-control" id="" placeholder="District ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Zipcode  </label>
                                                    <input type="text" name="zipcode" class="form-control" id="" placeholder="Zipcode ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Number of Working Days  </label>
                                                    <input type="text" name="working_days" class="form-control" id="" placeholder="Number of Working Days ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Tenure/Duration of Employment  </label>
                                                    <input type="text" name="tenure_duration_employment" class="form-control" id="" placeholder="Tenure/Duration of Employment ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Basic Pay  </label>
                                                    <input type="text" name="basic_pay" class="form-control" id="" placeholder="Basic Pay ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Provident Fund  </label>
                                                    <input type="text" name="provident_fund" class="form-control" id="" placeholder="Provident Fund ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">EDLI  </label>
                                                    <input type="text" name="edli" class="form-control" id="" placeholder="EDLI ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">ESI  </label>
                                                    <input type="text" name="esi" class="form-control" id="" placeholder="ESI ">
                                                </div>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">EPF  </label>
                                                    <input type="text" name="epf" class="form-control" id="" placeholder="ESI ">
                                                </div>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Bonus  </label>
                                                    <input type="text" name="bonus" class="form-control" id="" placeholder="Bonus">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Optional Allowance 1  </label>
                                                    <input type="text" name="optional_allowance_1" class="form-control" id="" placeholder="Optional Allowance 1 ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Optional Allowance 2  </label>
                                                    <input type="text" name="optional_allowance_2" class="form-control" id="" placeholder="Optional Allowance 2 ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Optional Allowance 3  </label>
                                                    <input type="text" name="optional_allowance_3" class="form-control" id="" placeholder="Optional Allowance 3 ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Total Value Without Addons  </label>
                                                    <input type="text" name="total_value_without_addons" class="form-control" id="" placeholder="Total Value Without Addons ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Total Addons Value  </label>
                                                    <input type="text" name="total_addons_value" class="form-control" id="" placeholder="Total Addons Value ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Total Value Including Addons  </label>
                                                    <input type="text" name="total_value_including_addons" class="form-control" id="" placeholder="Total Value Including Addons ">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <label for="" class="form-label">Total Contract Value  </label>
                                                    <input type="text" name="total_contract_value" class="form-control" id="" placeholder="Total Contract Value ">
                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="next-preview-btns d-flex align-items-center justify-content-between mt-4">
                                <button class="prev-step">Back</button>
                                <button class="next-step">Next</button>
                                <button class="confirm-step" style="display:none;" >Send</button>
                                {{-- <button class="confirm-step" style="display:none;" type="submit">Send</button> --}}
                                </div>
                            </div>
                            {{-- </form> --}}
                        </div>
                     </div>
                    </div>

                    <div class="tab-pane fade" id="pills-InActiveclient" role="tabpanel" aria-labelledby="pills-InActiveclient-tab" tabindex="0">
                        <div class="container-fluid py-4 px-5">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="step-form">
                                            <div class="step-form-step active">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="step-title ">
                                                                <h3>Organisation Details/ Buyer Details</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Name </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Name">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Type </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Type">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Ministry </label>
                                                            <input type="text" class="form-control" id="" placeholder="Ministry ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Department  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Department ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Organisation Name  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Organisation Name ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Office Zone   </label>
                                                            <input type="text" class="form-control" id="" placeholder="Office Zone  ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Designation  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Designation ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Contact No  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Contact No ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Email  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Email ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">GSTIN  </label>
                                                            <input type="text" class="form-control" id="" placeholder="GSTIN ">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-3">
                                                            <label for="" class="form-label">Address </label>
                                                            <input type="text" class="form-control" id="" placeholder="Address">
                                                        </div>
                                                        <div class="col-lg-12 mb-3 mt-4">
                                                            <div class="step-title">
                                                                <h3>Financial Approval Details/ Paying Authority Details</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">IFD Concurrence </label>
                                                            <input type="text" class="form-control" id=""  placeholder="IFD Concurrence ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Role  </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Role ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Designation of Administrative Approval </label>
                                                            <input type="text" class="form-control" id="" placeholder="Designation of Administrative Approval ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Payment Mode  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Payment Mode ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Designation of Financial Approval  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Designation of Financial Approval ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Designation  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Designation ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Email  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Email ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">GSTIN  </label>
                                                            <input type="text" class="form-control" id="" placeholder="GSTIN ">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-3">
                                                            <label for="" class="form-label">Address </label>
                                                            <input type="text" class="form-control" id="" placeholder="Address">
                                                        </div>


                                                    </div>
                                                </form>
                                            </div>
                                            <div class="step-form-step">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="step-title ">
                                                                <h3>Consignee Details</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Contact No  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Contact No ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Email  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Email ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">GSTIN  </label>
                                                            <input type="text" class="form-control" id="" placeholder="GSTIN ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Address </label>
                                                            <input type="text" class="form-control" id="" placeholder="Address">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-3">
                                                            <label for="" class="form-label">Service Description  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Service Description ">
                                                        </div>
                                                        <div class="col-lg-12 mb-3 mt-4">
                                                            <div class="step-title">
                                                                <h3>Service Provider Details</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Gem Seller ID </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Gem Seller ID ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Company Name  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Company Name  ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Email  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Email ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Contact No  </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Contact No ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Address </label>
                                                            <input type="text" class="form-control" id="" placeholder="Address">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">MSME Verified  </label>
                                                            <input type="text" class="form-control" id=""  placeholder="MSME Verified ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">MSME Registration No </label>
                                                            <input type="text" class="form-control" id="" placeholder="MSME Registration No ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">MSE Social Category  </label>
                                                            <input type="text" class="form-control" id="" placeholder="MSE Social Category ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Gender  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Gender ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">GSTIN  </label>
                                                            <input type="text" class="form-control" id="" placeholder="GSTIN ">
                                                        </div>


                                                    </div>
                                                </form>
                                            </div>
                                            <div class="step-form-step">
                                                <form action="client.php">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="step-title ">
                                                                <h3>Service Details</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Service Start Date  </label>
                                                            <input type="date" class="form-control" id="" placeholder="Service Start Date ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Service End Date  </label>
                                                            <input type="date" class="form-control" id="" placeholder="Service End Date ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Type of Establishment/Area  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Type of Establishment/Area ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Category of Profile </label>
                                                            <input type="text" class="form-control" id="" placeholder="Category of Profile">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Category of Skills  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Category of Skills ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Gender </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Gender ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Duty Hours in a Day  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Duty Hours in a Day  ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Qualification  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Qualification ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Ex-Serviceman  </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Ex-Serviceman ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Age Limit </label>
                                                            <input type="text" class="form-control" id="" placeholder="Age Limit">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Years of Experience  </label>
                                                            <input type="text" class="form-control" id=""  placeholder="Years of Experience ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Additional Requirement </label>
                                                            <input type="text" class="form-control" id="" placeholder="Additional Requirement ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">District  </label>
                                                            <input type="text" class="form-control" id="" placeholder="District ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Zipcode  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Zipcode ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Number of Working Days  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Number of Working Days ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Tenure/Duration of Employment  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Tenure/Duration of Employment ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Basic Pay  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Basic Pay ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Provident Fund  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Provident Fund ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">EDLI  </label>
                                                            <input type="text" class="form-control" id="" placeholder="EDLI ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">ESI  </label>
                                                            <input type="text" class="form-control" id="" placeholder="ESI ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Bonus  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Bonus ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Optional Allowance 1  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Optional Allowance 1 ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Optional Allowance 2  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Optional Allowance 2 ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Optional Allowance 3  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Optional Allowance 3 ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Total Value Without Addons  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Total Value Without Addons ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Total Addons Value  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Total Addons Value ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Total Value Including Addons  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Total Value Including Addons ">
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 mb-3">
                                                            <label for="" class="form-label">Total Contract Value  </label>
                                                            <input type="text" class="form-control" id="" placeholder="Total Contract Value ">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                        <div class="next-preview-btns d-flex align-items-center justify-content-between mt-4">
                                        <button class=" prev-step">Back</button>
                                        <button class=" next-step">Next</button>
                                        <button class=" confirm-step" style="display:none;" type="submit">Send</button>
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
          src="https://img.icons8.com/ios/30/close-window.png"
          alt="close-window"
        />
      </div>



@push('custom-js')

<script>
    $(document).ready(function () {
var currentStep = 0;
var totalSteps = $('.step-form-step').length;

// Function to update progress (optional, for UX)
function updateProgress() {
    console.log("Current step:", currentStep + 1, "of", totalSteps);
}

// Function to save form data
function saveFormData(stepIndex)
{
    var formData = $('.step-form-step').eq(stepIndex).find('form').serialize(); // Serialize form data

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

     if(stepIndex=='0')
        {
            $.ajax({
                    url: '{{ route('admin.client.create') }}', // Replace with your backend URL
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        // Check for success status in the response
                        // if (response.success) {
                        //     Swal.fire({
                        //         title: 'Success!',
                        //         text: response.message, // Message from the backend
                        //         icon: 'success',
                        //         confirmButtonText: 'OK'
                        //     }).then(() => {
                        //         // Optional: Reload the page or redirect after the alert
                        //         window.location.reload();
                        //     });
                        // } else {
                        //     // Handle other cases if needed
                        //     Swal.fire({
                        //         title: 'Oops!',
                        //         text: response.message || 'Something went wrong!',
                        //         icon: 'error',
                        //         confirmButtonText: 'OK'
                        //     });
                        // }
                    },
                    // error: function (xhr, status, error) {
                    //     // Handle validation or server errors
                    //     Swal.fire({
                    //         title: 'Error!',
                    //         text: xhr.responseJSON?.message || 'An error occurred!',
                    //         icon: 'error',
                    //         confirmButtonText: 'OK'
                    //     });
                    // }
                });

        }
        if(stepIndex=='1')
        {
           $.ajax({
                    url: '{{ route('admin.client.create') }}', // Replace with your backend URL
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        // // Check for success status in the response
                        // if (response.success) {
                        //     Swal.fire({
                        //         title: 'Success!',
                        //         text: response.message, // Message from the backend
                        //         icon: 'success',
                        //         confirmButtonText: 'OK'
                        //     }).then(() => {
                        //         // Optional: Reload the page or redirect after the alert
                        //         window.location.reload();
                        //     });
                        // } else {
                        //     // Handle other cases if needed
                        //     Swal.fire({
                        //         title: 'Oops!',
                        //         text: response.message || 'Something went wrong!',
                        //         icon: 'error',
                        //         confirmButtonText: 'OK'
                        //     });
                        // }
                    },
                    // error: function (xhr, status, error) {
                    //     // Handle validation or server errors
                    //     Swal.fire({
                    //         title: 'Error!',
                    //         text: xhr.responseJSON?.message || 'An error occurred!',
                    //         icon: 'error',
                    //         confirmButtonText: 'OK'
                    //     });
                    // }
                });
        }
        if(stepIndex=='2')
        {
           $.ajax({
                    url: '{{ route('admin.client.create') }}', // Replace with your backend URL
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        // Check for success status in the response
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message, // Message from the backend
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '{{ route('admin.client.index') }}';
                            });
                        } else {
                            // Handle other cases if needed
                            Swal.fire({
                                title: 'Oops!',
                                text: response.message || 'Something went wrong!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle validation or server errors
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'An error occurred!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
        }
}

// Handle "Next" button click
$('.next-step').click(function () {
    if (currentStep < totalSteps - 1) {

        saveFormData(currentStep); // Save current step's data

        $('.step-form-step').eq(currentStep).removeClass('active');
        currentStep++;
        $('.step-form-step').eq(currentStep).addClass('active');
        updateProgress();
    }

    // Show the confirm button on the last step
    if (currentStep === totalSteps - 1) {
        $('.confirm-step').show();
        $('.next-step, .prev-step').hide();
    }
});

// Handle "Back" button click
$('.prev-step').click(function () {
    if (currentStep > 0) {
        $('.step-form-step').eq(currentStep).removeClass('active');
        currentStep--;
        $('.step-form-step').eq(currentStep).addClass('active');
        updateProgress();
        $('.confirm-step').hide();
        $('.next-step, .prev-step').show();
    } else {
        // Redirect to client.php when on the first step
        window.location.href = 'client.php';
    }
});

// Handle "Submit" button click
$('.confirm-step').click(function () {
  //  alert(currentStep);
    saveFormData(currentStep); // Save data of the last step
  //  $('.step-form-step form').submit(); // Submit the form
});
});
  </script>


@endpush


@endsection
