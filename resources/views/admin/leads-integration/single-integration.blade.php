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
            <!--<h1>Connected Integrations</h1>-->
            <button id="addRow">hejs</button>
            <div class="dash-tabs-content no-scrollbar">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-InActiveclient" role="tabpanel" aria-labelledby="pills-InActiveclient-tab" tabindex="0">
                        <div class="table-responsive">
                            <table class="example6 row-border order-column nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <span class="d-none">All</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <tr>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="search-box-mob">
        <div class="close-search-bar">
            <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png" alt="close-window" />
        </div>
    </div>
<script>
    $(document).ready(function() {
        // var table = 
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
    
    getFacebookPagesFormLeads("{{$single_integration->form_id}}","{{$single_integration->access_token}}").then(response => {
                    
                    $.each(response.data, function(index, element) {
                            console.log(element);
                        if(index == 0){
                            $.each(element.field_data, function(index, element) {
                                $('.example6 thead tr').append('<th>' + element.name + '</th>');
                            })
                            $.each(element.field_data, function(index, element) {
                                $('.example6 tbody tr').append('<td>' + element.values + '</td>');
                            })
                            // new DataTable('.example6', {
                            //     dom: 'Bflrtip',
                            //     columnDefs: [
                            //         {
                            //             orderable: false,
                            //             render: DataTable.render.select(),
                            //             targets: 0
                            //         }
                            //     ],
                            //     fixedColumns: {
                            //         start: 1
                            //     },
                            //     order: [[0, 'asc']], // Default sort by the first column
                            //     paging: true, // Enable pagination
                            //     searching: true, // Enable search functionality
                            //     ordering: true, // Enable sorting functionality
                            //     pageLength: 10, // Default rows per page
                            //     lengthMenu: [10, 50, 75, 100], // Options for rows per page
                            //     responsive: true, // Enable responsiveness
                            //     language: {
                            //         lengthMenu: "Show _MENU_ entries" // Customize "Show entries" text
                            //     },
                            //     scrollCollapse: true,
                            //     scrollX: true,
                            //     scrollY: true,
                            //     select: {
                            //         style: 'multi',
                            //         selector: 'td:first-child'
                            //     },
                            //     buttons: [
                            //         {
                            //             extend: 'copy',
                            //             exportOptions: {
                            //                 columns: ':not(:first-child)',
                            //             }
                            //         },
                            //         {
                            //             extend: 'csv',
                            //             exportOptions: {
                            //                 columns: ':not(:first-child)',
                            //             }
                            //         },
                            //         {
                            //             extend: 'excel',
                            //             exportOptions: {
                            //                 columns: ':not(:first-child)',
                            //             }
                            //         },
                            //         {
                            //             extend: 'pdf',
                            //             orientation: 'landscape', // Set landscape orientation
                            //             pageSize: 'A4', // Optional: Set the page size
                            //             customize: function (doc) {
                            //                 // Adjust the page margins
                            //                 doc.pageMargins = [10, 20, 10, 20]; // [left, top, right, bottom]
                            //                 doc.defaultStyle.fontSize = 10; // Optional: Adjust font size
                            //                 doc.styles.tableHeader.fontSize = 12; // Optional: Adjust header font size
                            //             },
                            //             exportOptions: {
                            //                 columns: ':not(:first-child)',
                            //             }
                            //         },
                            //         {
                            //             extend: 'print',
                            //             text: 'Print all (not just selected)',
                            //             exportOptions: {
                            //                 columns: ':not(:first-child)',
                            //             }
                            //         },
                            //         {
                            //             extend: 'colvis',
                            //         }
                            //     ]
                            // });
                        }else{
                            let newRowData = '';
                            $.each(element.field_data, function(index, element) {
                                newRowData += '<td>' + element.values + '</td>'
                            })
                            $('.example6 tbody').append(`<tr><td></td>${newRowData}<tr/>`);
                        }
                        
                    });
                });
                
    
});
</script>
    @push('custom-js')
        <!-- Custom JavaScript here -->
    @endpush
@endsection