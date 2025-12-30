$(document).ready(function() {
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

    const fbAppId = '1020233543166702';
    const redirectUri = 'https://leads-management-in.fantasybet9.in/admin/leads-integration/callback';

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
        getFacebookForms($(this).val(), $(this).find('option:selected').data('accessid')).then(response => {
                    if (response.data) {
                        // console.log(response.data)
                        $('.selectFacebookPageForm').removeClass('d-none')
                        $.each(response.data, function(index, element) {
                            console.log(element);
                            $('#selectFacebookPageForm').append(`<option value="${element.id}" data-locale="${element.locale}" status="${element.status}">${element.name}</option>`)
                        });
                    }
                });
        console.log($(this).val(),$(this).find('option:selected').data('accessid'),$(this).find('option:selected').text());
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
             $('#selectFacebookPageFormFolder').show().focus().click();
            }
        });
    })
});