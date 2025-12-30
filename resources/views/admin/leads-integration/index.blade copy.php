@extends('admin.partical.main')
@push('title')
    <title>Dashboard | Admin</title>
    
@endpush

@push('custom-css')
@endpush

@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .integration-card {
            cursor: pointer;
            width: 80px;
            height: 80px;
        }
        .select2-container{
            z-index: 999999;
        }
        .select2-search--dropdown{
            display: none;
        }
        #reloadFolders{
            cursor: pointer;
        }
    </style>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <h1 class="d-flex justify-content-between align-items-center"><span>Leads Integration</span> <a href="{{ route('admin.leads_integration.integrations') }}" class="btn btn-dark btn-sm"> Connected Integrations </a></h1>
            <div class="row">
                <div class="col-1">
                    <div class="py-4 bg-white shaodw integration-card fs-3 text-primary rounded-4 shadow d-flex justify-content-center align-items-center "
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/1200px-2021_Facebook_icon.svg.png" style="width: 30px;">
                    </div>
                </div>
                <div class="col-1">
                    <div class="py-4 bg-white shaodw integration-card fs-3 text-primary rounded-4 shadow d-flex justify-content-center align-items-center "
                        data-bs-toggle="modal" data-bs-target="#googleLeadsInt">
                        <img src="https://www.svgrepo.com/show/353800/google-ads.svg" style="width: 30px;">
                    </div>
                </div>
                <div class="col-1">
                    <div class="py-4 bg-white shaodw integration-card fs-3 text-primary rounded-4 shadow d-flex justify-content-center align-items-center "
                        data-bs-toggle="modal" data-bs-target="#indiamartLeadsInt">
                        <img src="https://companieslogo.com/img/orig/INDIAMART.NS-ecf147e0.png?t=1720244492" style="width: 30px;">
                    </div>
                </div>
                <div class="col-1">
                    <div class="py-4 bg-white shaodw integration-card fs-3 text-primary rounded-4 shadow d-flex justify-content-center align-items-center "
                        data-bs-toggle="modal" data-bs-target="#elementorLeadsInt">
                        <img src="https://cdn-icons-png.flaticon.com/512/5968/5968699.png" style="width: 30px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="{{ route('admin.leads_integration.saveFbIntegration') }}" method="POST">
                @csrf
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Facebook Integration</h1>
                    <a href="{{ route('admin.leads.index') }}" target="_blank" class="btn btn-dark btn-sm py-1 px-2" style="--bs-btn-font-size: .75rem;">Create Folder</a>
                </div>
                <div class="modal-body">
                    <div class="mb-3 selectFacebookPage d-none">
                          <label for="selectFacebookPage" class="form-label">Select Page</label>
                            <select class="form-select" id="selectFacebookPage" name="page_id">
                                <option selected value="" disabled>Select Page</option>
                            </select>
                            <input type="hidden" name="access_token" value="">
                            <input type="hidden" name="page_name" value="">
                        </div>
                        <div class="mb-3 selectFacebookPageForm d-none">
                          <label for="selectFacebookPageForm" class="form-label">Select Page Forms</label>
                            <select class="form-select" id="selectFacebookPageForm" name="form_id">
                                <option selected value="" disabled>Select Page Forms</option>
                            </select>
                            <input type="hidden" name="form_name" value="">
                        </div>
                        <div class="mb-3 selectFacebookPageFormFolder d-none">
                          <label for="selectFacebookPageFormFolder" class="form-label">Select Leads Folder <span class="badge text-bg-dark" id="reloadFolders" title="Reload after Create Folder"><i class="fa-solid fa-rotate"></i></span></label>
                            <select class="form-select" id="selectFacebookPageFormFolder" name="folder_id"> 
                                <option selected value="" disabled>Select Leads Folder</option>
                                @foreach($lead_folders as $folder)
                                    <option value="{{$folder->id}}" >{{$folder->folder_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    <button class="btn btn-primary" id="facebookLoginButton" type="button"><i class="fa-brands fa-facebook-f"></i> Facebook integration</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancle" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary d-none" id="saveFbIntegration">Save</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal fade" id="googleLeadsInt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="googleLeadsIntLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="{{ route('admin.leads_integration.saveWebHookIntegration') }}" method="POST">
                @csrf
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Google Ads Integration</h1>
                    <a href="{{ route('admin.leads.index') }}" target="_blank" class="btn btn-dark btn-sm py-1 px-2" style="--bs-btn-font-size: .75rem;">Create Folder</a>
                </div>
                <div class="modal-body">
                        <div class="mb-3 selectFacebookPageFormFolder">
                          <label for="selectFacebookPageFormFolder" class="form-label">Select Leads Folder <span class="badge text-bg-dark" id="reloadFolders" title="Reload after Create Folder"><i class="fa-solid fa-rotate"></i></span></label>
                            <select class="form-select" id="selectFacebookPageFormFolder" name="folder_id" required> 
                                <option selected value="" disabled>Select Leads Folder</option>
                                @foreach($lead_folders as $folder)
                                    <option value="{{$folder->id}}">{{$folder->folder_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="type" value="ga_leads"/>
                        <input type="hidden" name="type_url" value="google-ads"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancle" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveGaIntegration">Save</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal fade" id="indiamartLeadsInt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="indiamartLeadsIntLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="{{ route('admin.leads_integration.saveImIntegration') }}" method="POST">
                @csrf
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">IndiaMart Integration</h1>
                    <a href="{{ route('admin.leads.index') }}" target="_blank" class="btn btn-dark btn-sm py-1 px-2" style="--bs-btn-font-size: .75rem;">Create Folder</a>
                </div>
                <div class="modal-body">
                        <div class="mb-3 selectIndiaMartPageFormFolder">
                          <label for="selectIndiaMartPageFormFolder" class="form-label">Select Leads Folder <span class="badge text-bg-dark" id="reloadFolders2" title="Reload after Create Folder"><i class="fa-solid fa-rotate"></i></span></label>
                            <select class="form-select" id="selectIndiaMartPageFormFolder" name="folder_id"> 
                                <option selected value="" disabled>Select Leads Folder</option>
                                @foreach($lead_folders as $folder)
                                    <option value="{{$folder->id}}" >{{$folder->folder_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="indiaMartApikey">
                            <label class="form-label">Enter Pull Api</label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" style="font-size: small;" name="access_token" placeholder="mRywGr5p5Hxxxxxxxxxxxxxxxxxxx" required>
                              <span class="input-group-text"><a class="text-primary-emphasis" href="https://seller.indiamart.com/leadmanager/crmapi" target="_blank">Get Pull API</a></span>
                            </div>
                        </div>
                        
                    <!--<button class="btn btn-primary" id="indiamartLoginButton" type="button"><i class="fa-brands fa-google"></i> Google integration</button>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancle" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveImIntegration">Save</button>
                </div>
            </form>
        </div>
    </div>
    
<div class="modal fade" id="elementorLeadsInt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="elementorLeadsIntLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="{{ route('admin.leads_integration.saveWebHookIntegration') }}" method="POST">
                @csrf
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5" id="elementorLeadsIntLabel">Elementor Form Integration</h1>
                    <a href="{{ route('admin.leads.index') }}" target="_blank" class="btn btn-dark btn-sm py-1 px-2" style="--bs-btn-font-size: .75rem;">Create Folder</a>
                </div>
                <div class="modal-body">
                        <div class="mb-3 selectFacebookPageFormFolder">
                          <label for="selectFacebookPageFormFolder" class="form-label">Select Leads Folder <span class="badge text-bg-dark" id="reloadFolders" title="Reload after Create Folder"><i class="fa-solid fa-rotate"></i></span></label>
                            <select class="form-select" id="selectFacebookPageFormFolder" name="folder_id" required> 
                                <option selected value="" disabled>Select Leads Folder</option>
                                @foreach($lead_folders as $folder)
                                    <option value="{{$folder->id}}">{{$folder->folder_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="type" value="elementor_leads"/>
                        <input type="hidden" name="type_url" value="elementor"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancle" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png" alt="close-window" />
        </div>
        <script src="https://apis.google.com/js/api:client.js"></script>

// setup google api
<script>
        function handleCredentialResponse(response) {
            const responsePayload = parseJwt(response.credential);

            console.log("ID: " + responsePayload.sub);
            console.log('Full Name: ' + responsePayload.name);
            console.log('Given Name: ' + responsePayload.given_name);
            console.log('Family Name: ' + responsePayload.family_name);
            console.log("Image URL: " + responsePayload.picture);
            console.log("Email: " + responsePayload.email);

            // You can now use this information to authenticate the user in your system
        }

        function parseJwt(token) {
            const base64Url = token.split('.')[1];
            const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16).slice(-2);
            }).join(''));

            return JSON.parse(jsonPayload);
        }
    </script>
// end setup google api



// setup facebook api
<script>
    $(document).ready(function() {
        const alreadyExist = {!!json_encode($fb_leads, true)!!}
    async function getFacebookPages(token) {
        if (!token) {
            console.error("Authorization token is missing");
            return { error: "Authorization token missing" };
        }

        try {
            let response = await $.ajax({
                url: `https://graph.facebook.com/v22.0/me/accounts?access_token=${token}`,
                method: "GET",
                dataType: "json"
            });
            return response;
        } catch (error) {
            console.error("Error fetching Facebook pages:", error.responseJSON?.error?.message || error.statusText);
            return { error: error.responseJSON?.error?.message || error.statusText };
        }
    }
    async function getFacebookForms(pages_id, token) {
        if (!token) {
            console.error("Authorization token is missing");
            return { error: "Authorization token missing" };
        }

        try {
            let response = await $.ajax({
                url: `https://graph.facebook.com/v22.0/${pages_id}/leadgen_forms?access_token=${token}`,
                method: "GET",
                dataType: "json"
            });
            return response;
        } catch (error) {
            console.error("Error fetching Facebook page leads forms:", error.responseJSON?.error?.message || error.statusText);
            return { error: error.responseJSON?.error?.message || error.statusText };
        }
    }
async function getFacebookPagesFormLeads(form_id, access_token) {
        if (!access_token) {
            console.error("Authorization token is missing");
            return { error: "Authorization token missing" };
        }

        try {
            let response = await $.ajax({
                url: `https://graph.facebook.com/v22.0/${form_id}/leads?access_token=${access_token}`,
                method: "GET",
                dataType: "json"
            });
            return response;
        } catch (error) {
            console.error("Error fetching Facebook pages:", error.responseJSON?.error?.message || error.statusText);
            return { error: error.responseJSON?.error?.message || error.statusText };
        }
    }
    const fbAppId = '597982789329810';
    // const redirectUri = 'https://leads-management-in.fantasybet9.in/admin/leads-integration/callback';
    const redirectUri = 'https://oykey.in/admin/leads-integration/callback';

    $('#facebookLoginButton').click(function() {
        console.log('click')
        const facebookLoginUrl = `https://www.facebook.com/v18.0/dialog/oauth?client_id=${fbAppId}&redirect_uri=${redirectUri}&scope=pages_show_list,pages_read_engagement,leads_retrieval,pages_manage_ads`;
        
        const popup = window.open(facebookLoginUrl, 'facebookLoginPopup', 'width=600,height=700');

        $(window).on('message', function(event) {
            if (event.originalEvent.origin !== window.location.origin) return;
            
            let data = event.originalEvent.data;
            if (data.access_token) {
                console.log(data.access_token);
                localStorage.setItem('facebook_access_token', data.access_token);
                
                getFacebookPages(data.access_token).then(response => {
                    if (response.data) {
                        $('.selectFacebookPage').removeClass('d-none')
                        $.each(response.data, function(index, element) {
                            console.log(element);
                            $('#selectFacebookPage').append(`<option value="${element.id}" data-accessId="${element.access_token}">${element.name}</option>`)
                        });
                    }
                });
            } else {
                console.error("Error retrieving access token:", data);
            }
        });
    });
    $('#selectFacebookPage').on('change',function(){
        $('#selectFacebookPageForm').html('')
        getFacebookForms($(this).val(), $(this).find('option:selected').data('accessid')).then(response => {
                    if (response.data) {
                        // console.log(response.data)
                        $('.selectFacebookPageForm').removeClass('d-none')
                        $.each(response.data, function(index, element) {
                            console.log(element);
                            if(alreadyExist.includes(`${element.id}`)){
                                $('#selectFacebookPageForm').append(`<option value="${element.id}" data-locale="${element.locale}" status="${element.status}" disabled>${element.name}</option>`)
                            }else{
                                $('#selectFacebookPageForm').append(`<option value="${element.id}" data-locale="${element.locale}" status="${element.status}">${element.name}</option>`)
                            }
                        });
                    }
                });
                $(`input[name=access_token]`).val($(this).find('option:selected').data('accessid'))
                $(`input[name=page_name]`).val($(this).find('option:selected').text())
        console.log($(this).val(),$(this).find('option:selected').data('accessid'),$(this).find('option:selected').text());
    })
    $('#selectFacebookPageForm').on('change',function(){
        $('.selectFacebookPageFormFolder').removeClass('d-none')
        $('input[name=form_name]').val($(this).find('option:selected').text())
        // getFacebookPagesFormLeads($(this).val(), $(`input[name=access_token]`).val()).then(response => {
        //     let datas = response.data[0];
        //     console.log(datas.field_data)
        // })
    })
    $('#reloadFolders').on('click', function(){
        $.ajax({
            url: "leads-integration/get-lead-folders",
            // type: "GET",
            success: function(response) {
                $('#selectFacebookPageFormFolder').html('')
                $.each(response, function(index, element) {
                    if(index == 0){
                        $('#selectFacebookPageFormFolder').append(`<option selected value="" disabled>Select Leads Folder</option>`)
                    }
                    $('#selectFacebookPageFormFolder').append(`<option value="${element.id}">${element.folder_name}</option>`)
                });
            },complete: function (data) {
             $("#selectFacebookPageFormFolder").select2().select2("open");
            }
        });
    })
    $('#selectFacebookPageFormFolder').on('change', function(){
        $('#saveFbIntegration').removeClass('d-none')
    })
});
</script>
// end setup facebook api


// setup indiamart api
<script>
    $(document).ready(function() {

    $('#reloadFolders2').on('click', function(){
        $.ajax({
            url: "leads-integration/get-lead-folders",
            // type: "GET",
            success: function(response) {
                $('#selectIndiaMartPageFormFolder').html('')
                $.each(response, function(index, element) {
                    if(index == 0){
                        $('#selectIndiaMartPageFormFolder').append(`<option selected value="" disabled>Select Leads Folder</option>`)
                    }
                    $('#selectIndiaMartPageFormFolder').append(`<option value="${element.id}">${element.folder_name}</option>`)
                });
            },complete: function (data) {
             $("#selectIndiaMartPageFormFolder").select2().select2("open");
            }
        });
    })
});
</script>
// end setup indiamart api
<!--<script src="{{ asset('public/admin/assets/js/fb.js')}}"></script>-->
        @push('custom-js')
        @endpush
    @endsection
