@extends('admin.partical.main')

@push('title')
    <title>Dashboard | Admin</title>
@endpush

@push('custom-css')
    <!-- Custom CSS styles here -->
@endpush

@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .integration-card {
            cursor: pointer;
        }
        .select2-container {
            z-index: 999999;
        }
        .select2-search--dropdown {
            display: none;
        }
        #reloadFolders {
            cursor: pointer;
        }
        #exampleModal .modal-body pre{
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-family: monospace;
        }
    </style>

    <!--<script>-->
    <!--    async function getFacebookPages(token) {-->
    <!--        if (!token) {-->
    <!--            console.error("Authorization token is missing");-->
    <!--            return { error: "Authorization token missing" };-->
    <!--        }-->

    <!--        try {-->
    <!--            const response = await fetch("https://graph.facebook.com/v22.0/me/accounts?access_token=" + token);-->
    <!--            const data = await response.json();-->

    <!--            if (!response.ok) {-->
    <!--                throw new Error(data.error?.message || "Failed to fetch Facebook pages");-->
    <!--            }-->

                return data; // Return the API response

    <!--        } catch (error) {-->
    <!--            console.error("Error fetching Facebook pages:", error.message);-->
    <!--            return { error: error.message };-->
    <!--        }-->
    <!--    }-->

    <!--    const fbAppId = '1020233543166702';-->
    <!--    const redirectUri = 'https://leads-management-in.fantasybet9.in/admin/leads-integration/callback';-->

    <!--    function loginWithFacebook() {-->
    <!--        const facebookLoginUrl = `https://www.facebook.com/v18.0/dialog/oauth?client_id=${fbAppId}&redirect_uri=${redirectUri}&scope=pages_show_list,pages_read_engagement,leads_retrieval,pages_manage_ads`;-->

            // Open login in a small popup
    <!--        const popup = window.open(facebookLoginUrl, 'facebookLoginPopup', 'width=600,height=700');-->

            // Listen for messages from popup (callback)
    <!--        window.addEventListener('message', function (event) {-->
                if (event.origin !== window.location.origin) return; // Ensure security
    <!--            if (event.data.access_token) {-->
    <!--                console.log(event.data.access_token);-->
    <!--                localStorage.setItem('facebook_access_token', event.data.access_token);-->
                    // fetch
    <!--                getFacebookPages(event.data.access_token).then(data => {-->
    <!--                    data.data.forEach((element) => {-->
    <!--                        console.log(element);-->
    <!--                    });-->
    <!--                });-->
                    // fetch
    <!--            } else {-->
    <!--                console.error("Error retrieving access token:", event.data);-->
    <!--            }-->
    <!--        });-->
    <!--    }-->
    <!--</script>-->

    <div class="main-content">
        <!-- write-body-content here start -->
        <div class="pages-content">
            <h1>Connected Integrations</h1>
            
            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-InActiveclient" role="tabpanel" aria-labelledby="pills-InActiveclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="example row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><span class="d-none">All</span></th>
                                        <th>Folder Name</th>
                                        <th>Type</th>
                                        <th>Total Assign</th>
                                        <th>Webhook</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($integrations_leads as $in_leads)
                                        <tr>
                                            <td></td>
                                            <td>{{ $in_leads?->folder?->folder_name }}</td>
                                            <td>{{ $in_leads->type }}</td>
                                            <td>{{ $in_leads->count_assign }}</td>
                                            <td class="text-center">
                                                @if($in_leads->webhook_id != null)
                                                <div class="input-group mb-3">
                                                        <span class="input-group-text fw-bold" style="font-size: small;">URL</span>
                                                      <input type="text" class="form-control form-control-sm border-end-0 pe-0" value='{{ url("api/webhook/$in_leads->webhook_id") }}' style="font-size: small;" readonly>
                                                      <span class="input-group-text copyWebhook text-primary bg-white px-2" style="cursor:pointer;"><i class="fa-solid fa-clipboard copyIcons"></i></span>
                                                    </div>
                                                    @if($in_leads->type == 'ga_leads')
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text fw-bold" style="font-size: small;">Key</span>
                                                      <input type="text" class="form-control form-control-sm border-end-0 pe-0" value='{{ $in_leads->access_token }}' style="font-size: small;" readonly>
                                                      <span class="input-group-text copyWebhook text-primary bg-white px-2" style="cursor:pointer;"><i class="fa-solid fa-clipboard copyIcons"></i></span>
                                                    </div>
                                                    @endif
                                                @else
                                                -----
                                                @endif
                                            </td>
                                            <td>{{ date('d M, Y - h:i A', strtotime($in_leads->created_at)) }}</td>
                                            <!--<td>-->
                                            <!--    <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">-->
                                                    <!--<li><a href="https://leads-management-in.fantasybet9.in/admin/office/delete-employee/1"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;" class="iconify iconify--iconoir"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m20 9l-1.995 11.346A2 2 0 0 1 16.035 22h-8.07a2 2 0 0 1-1.97-1.654L4 9m17-3h-5.625M3 6h5.625m0 0V4a2 2 0 0 1 2-2h2.75a2 2 0 0 1 2 2v2m-6.75 0h6.75"></path></svg></a>-->
                                                    <!--</li>-->
                                                    <!--<li><a href="https://leads-management-in.fantasybet9.in/admin/office/edit-employee/1"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;" class="iconify iconify--solar"><path fill="currentColor" fill-rule="evenodd" d="M14.757 2.621a4.682 4.682 0 0 1 6.622 6.622l-9.486 9.486c-.542.542-.86.86-1.216 1.137q-.628.492-1.35.835c-.406.193-.834.336-1.56.578l-3.332 1.11l-.802.268a1.81 1.81 0 0 1-2.29-2.29l1.378-4.133c.242-.727.385-1.155.578-1.562q.344-.72.835-1.35c.276-.354.595-.673 1.137-1.215zM4.4 20.821l2.841-.948c.791-.264 1.127-.377 1.44-.526q.572-.274 1.073-.663c.273-.214.525-.463 1.115-1.053l7.57-7.57a7.36 7.36 0 0 1-2.757-1.744A7.36 7.36 0 0 1 13.94 5.56l-7.57 7.57c-.59.589-.84.84-1.053 1.114q-.39.5-.663 1.073c-.149.313-.262.649-.526 1.44L3.18 19.6zM15.155 4.343c.035.175.092.413.189.69a5.86 5.86 0 0 0 1.4 2.222a5.86 5.86 0 0 0 2.221 1.4c.278.097.516.154.691.189l.662-.662a3.182 3.182 0 0 0-4.5-4.5z" clip-rule="evenodd"></path></svg></a>-->
                                                    <!--</li>-->
                                            <!--        <li><svg data-bs-toggle="modal" data-bs-target="#exampleModal" data-access_token="{{ $in_leads->access_token }}" data-form_id="{{ $in_leads->form_id }}" data-form_name="{{ $in_leads->form_name }}" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;" class="iconify iconify--basil"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0M12 9.75a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5"></path><path d="M4.323 10.646c-.419.604-.573 1.077-.573 1.354s.154.75.573 1.354c.406.583 1.008 1.216 1.77 1.801C7.62 16.327 9.713 17.25 12 17.25s4.38-.923 5.907-2.095c.762-.585 1.364-1.218 1.77-1.801c.419-.604.573-1.077.573-1.354s-.154-.75-.573-1.354c-.406-.583-1.008-1.216-1.77-1.801C16.38 7.673 14.287 6.75 12 6.75s-4.38.923-5.907 2.095c-.762.585-1.364 1.218-1.77 1.801m.856-2.991C6.91 6.327 9.316 5.25 12 5.25s5.09 1.077 6.82 2.405c.867.665 1.583 1.407 2.089 2.136c.492.709.841 1.486.841 2.209s-.35 1.5-.841 2.209c-.506.729-1.222 1.47-2.088 2.136c-1.73 1.328-4.137 2.405-6.821 2.405s-5.09-1.077-6.82-2.405c-.867-.665-1.583-1.407-2.089-2.136C2.6 13.5 2.25 12.723 2.25 12s.35-1.5.841-2.209c.506-.729 1.222-1.47 2.088-2.136"></path></g></svg>-->
                                            <!--            </li>-->
                                            <!--    </ul>-->
                                                <!--<div class="dropdown">-->
                                                <!--    <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical" ></i></button>  -->
                                                <!--    <ul class="dropdown-menu">-->
                                                <!--        <li><a class="dropdown-item" href="#">Action</a></li>-->
                                                <!--        <li><a class="dropdown-item" href="#">Another action</a></li>-->
                                                <!--        <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                                                <!--    </ul>-->
                                                <!--</div>-->
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
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><img src="https://cdn.pixabay.com/animation/2023/11/30/10/11/10-11-02-622_512.gif" style="width:25px"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
                <img src="https://cdn.pixabay.com/animation/2023/11/30/10/11/10-11-02-622_512.gif" class="w-25">
            </div>
      </div>
    </div>
  </div>
</div>
 

<script>

    $(document).ready(function() {
        async function getFacebookPagesFormLeads(form_id, access_token) {
        if (!access_token) {
            console.error("Authorization token is missing");
            return { error: "Authorization token missing" };
        }

        try {
            let response = await $.ajax({
                url: `https://graph.facebook.com/v22.0/${form_id}/leads?access_token=${access_token}&limit=5`,
                method: "GET",
                dataType: "json"
            });
            return response;
        } catch (error) {
            console.error("Error fetching Facebook pages:", error.responseJSON?.error?.message || error.statusText);
            return { error: error.responseJSON?.error?.message || error.statusText };
        }
    }
    $('[data-bs-toggle=modal]').on('click', function(){
        const access_token = $(this).attr('data-access_token')
        const form_name = $(this).attr('data-form_name')
        const form_id = $(this).attr('data-form_id')
        
        getFacebookPagesFormLeads(form_id,access_token).then(response => {
            $('#exampleModal .modal-body').html('')
            $('#exampleModal .modal-header h1').text(`${form_name}`)
            $('#exampleModal .modal-body').html(`<pre>${JSON.stringify(response.data, null, 4)}</pre>`)
        })
    })
    $('#exampleModal').on('hidden.bs.modal', function(){
        $('#exampleModal .modal-header h1').html('<img src="https://cdn.pixabay.com/animation/2023/11/30/10/11/10-11-02-622_512.gif" style="width:25px">')
        $('#exampleModal .modal-body').html('<div><img src="https://cdn.pixabay.com/animation/2023/11/30/10/11/10-11-02-622_512.gif" class="w-25"></div>')
    })
    $('.copyWebhook').click(function(){
        $('.copyIcons').removeClass('fa-clipboard-check')
        $('.copyIcons').addClass('fa-clipboard')
        navigator.clipboard.writeText($(this).parent().find('input').val());
        $(this).html(`<i class="fa-solid fa-clipboard-check copyIcons"></i>`);
    })
    
});
</script>

    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png" alt="close-window" />
        </div>
    </div>

    @push('custom-js')
        <!-- Custom JavaScript here -->
    @endpush
@endsection