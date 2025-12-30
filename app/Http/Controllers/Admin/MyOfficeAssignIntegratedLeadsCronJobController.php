<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeFacebookIntegrations;
use App\Models\OfficeLeads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class MyOfficeAssignIntegratedLeadsCronJobController extends Controller
{
    // * * * * *	/usr/bin/curl --silent --output /dev/null https://leads-management-in.fantasybet9.in/assign-integrated-lead-job
    public function cron_job()
    {


        $facebook_leads_assign = $this->facebook_leads_assign(); // ;
        // $indiamart_leads_assign =$this->indiamart_leads_assign(); // $this->indiamart_leads_assign();


        // return ;
        return response()->json([
            'facebook_leads_assign' => $facebook_leads_assign,
            // 'indiamart_leads_assign' => $indiamart_leads_assign
        ]);
    }  

    // public function facebook_leads_assign()
    // {
    //     $fb_leads = OfficeFacebookIntegrations::where('type', 'fb_leads')->get();


    //     $todayAllLeads = [];
    //     foreach ($fb_leads as $fb) {
    //         try {
    //             $response = Http::get("https://graph.facebook.com/v22.0/$fb->form_id/leads", [
    //                 'access_token' => $fb->access_token,
    //             ]);

    //             $today = date('Y-m-d');
    //             // $today = date('2025-08-02');

    //             // Filter leads for today
    //             $todayLeads = array_filter($response->json()['data'], function ($lead) use ($today) {
    //                 // Ensure created_time is in a valid format before comparing
    //                 $leadDate = date('Y-m-d', strtotime($lead['created_time']));
    //                 return $leadDate === $today;
    //             });
    //             if (count($todayLeads) != 0) {
    //                 $todayAllLeads[] = $todayLeads;
    //             }
    //             // dd($todayAllLeads);

    //         } catch (\Exception $e) {

    //             dd($e->getMessage());
    //         }
    //     }
    //     // dd($todayAllLeads);

    //     echo json_encode($todayAllLeads, true);
    //     return 'true';
    // }


    public function facebook_leads_assign()
    {
        $fb_integrations = OfficeFacebookIntegrations::where('type', 'fb_leads')->get();

        foreach ($fb_integrations as $fb) {

            $folder = OfficeLeadsFolders::find($fb->folder_id);
            $emp_json = json_decode($folder->emp_json, true);
            $totalEmp = count($emp_json);

            // Last assigned employee index
            $index = array_search(
                ($fb->last_assign_id ?? end($emp_json)),
                $emp_json
            );

            try {

                $response = Http::get("https://graph.facebook.com/v22.0/{$fb->form_id}/leads", [
                    'access_token' => $fb->access_token
                ]);

                if (!isset($response['data'])) {
                    continue;
                }

                $today = date('Y-m-d');
                $inserted = [];

                foreach ($response['data'] as $lead) {

                    // Only today's leads
                    $leadDate = date('Y-m-d', strtotime($lead['created_time']));
                    if ($leadDate !== $today) {
                        continue;
                    }

                    // Avoid duplicate assign
                    if (OfficeLeads::where('type', 'fb_lead')
                        ->where('client_email', $lead['id'])
                        ->exists()
                    ) {
                        continue;
                    }

                    // Round-robin employee
                    $index = ($index + 1) % $totalEmp;

                    // Parse field_data
                    $name = $email = $mobile = '';
                    foreach ($lead['field_data'] as $field) {
                        if ($field['name'] == 'full_name') {
                            $name = $field['values'][0] ?? '';
                        }
                        if ($field['name'] == 'email') {
                            $email = $field['values'][0] ?? '';
                        }
                        if ($field['name'] == 'phone_number') {
                            $mobile = $field['values'][0] ?? '';
                        }
                    }

                    $inserted[] = [
                        'emp_id' => $emp_json[$index],
                        'assign_date' => date('Y-m-d'),
                        'service_name' => 'Facebook Lead',
                        'client_name' => $name,
                        'client_mobile' => $mobile,
                        'client_email' => $email ?: $lead['id'], // fallback unique
                        'remark' => json_encode([
                            [
                                'remark' => 'Please work on this Facebook lead',
                                'date' => date('Y-m-d'),
                                'time' => date('h:i A'),
                                'status' => 'open'
                            ]
                        ]),
                        'status' => 'open',
                        'folder_id' => $fb->folder_id,
                        'csv' => json_encode($lead),
                        'type' => 'fb_lead'
                    ];
                }

                if (count($inserted)) {

                    OfficeLeads::insert($inserted);

                    OfficeFacebookIntegrations::where('id', $fb->id)->update([
                        'count_assign' => $fb->count_assign + count($inserted),
                        'last_assign_id' => end($inserted)['emp_id'],
                        'last_assign_date_time' => now()
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Facebook Lead Assign Error: ' . $e->getMessage());
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Facebook leads assigned successfully'
        ]);
    }


    public function indiamart_leads_assign()
    {
        $im_leads = OfficeFacebookIntegrations::where('type', 'im_leads')->first();
        $folder = OfficeLeadsFolders::find($im_leads->folder_id);
        $response = Http::get("https://mapi.indiamart.com/wservce/crm/crmListing/v2/", ['glusr_crm_key' => $im_leads->access_token]);
        $emp_json = json_decode($folder->emp_json, true);
        $data = $response->json();

        if ($data['CODE'] == 200) {

            $index = array_search(($im_leads->last_assign_id != null ? $im_leads->last_assign_id : end($emp_json)), $emp_json);
            $totalEmp = count($emp_json);
            $inserted = [];

            foreach ($data['RESPONSE'] as $lead) {

                $index = ($index + 1) % $totalEmp;
                $inserted[] = ['emp_id' => $emp_json[$index], 'assign_date' => date('Y-m-d'), 'service_name' => $lead['QUERY_PRODUCT_NAME'], 'client_name' => $lead['SENDER_NAME'], 'client_mobile' => $lead['SENDER_MOBILE'], 'client_email' => $lead['SENDER_EMAIL'], 'remark' => json_encode([['remark' => "Please work on this lead as soon as possible", 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => 'open']]), 'status' => "open", 'folder_id' => $im_leads->folder_id, 'csv' => json_encode($lead), 'type' => "im_lead"];
            }
            if (count($inserted) != 0) {
                $insert = OfficeLeads::insert($inserted);
                $update = OfficeFacebookIntegrations::where('type', 'im_leads')->where('id', $im_leads->id)->update([
                    'count_assign' => ($im_leads->count_assign + count($inserted)),
                    'last_assign_id' => end($inserted)['emp_id'],
                    'last_assign_date_time' => date('Y-m-d H:i:s')
                ]);
                return response()->json(['response' => $data, 'status' => 200]);
            }

            // dd($inserted, $data);
        } else {
            return response()->json(['response' => $data, 'status' => 204]);
        }
    }

    // public function getLeadFolders()
    // {
    //     $lead_folders = OfficeLeadsFolders::orderBy('id',"DESC")->get();
    //     return response()->json($lead_folders);
    // }
    // public function callback(Request $request)
    // {
    //     $code = $_GET['code'];
    //         // dd($code);
    //     if (!$code) {
    //         return response()->json(['error' => 'Authorization code missing'], 400);
    //     }

    //     try {
    //         $client = new Client();
    //         $response = $client->get('https://graph.facebook.com/v22.0/oauth/access_token', [
    //             'query' => [
    //                 'client_id' => "597982789329810",
    //                 'client_secret' => "f78799c455601d771bdabb7fb375137a",
    //                 'redirect_uri' => "https://leads-management-in.fantasybet9.in/admin/leads-integration/callback",
    //                 'code' => $code,
    //             ]
    //         ]);

    //         $data = json_decode($response->getBody(), true);

    //         session(['facebook_access_token' => $data['access_token']]);

    //         // Return JavaScript to send the token to the parent window
    //         return "<script>
    //                     window.opener.postMessage(" . json_encode(['access_token' => $data['access_token']]) . ", '*');
    //                     window.close();
    //                 </script>";

    //     } catch (\Exception $e) {
    //         // dd($e->getMessage());
    //         return "<script>
    //                     window.opener.postMessage(" . json_encode(['error' => $e->getMessage()]) . ", '*');
    //                     window.close();
    //                 </script>";
    //     }
    // }
    // public function pages(Request $request,$token)
    // {
    //     if (!$token) {
    //         return response()->json(['error' => 'Authorization code missing'], 400);
    //     }

    //     try {
    //         $client = new Client();
    //         $response = $client->get("https://graph.facebook.com/v22.0/me/accounts", [
    //                 'query' => ['access_token' => $token]
    //         ]);

    //         $data = json_decode($response->getBody(), true);

    //         return response()->json($data);

    //     } catch (\Exception $e) {
    //         // dd($e->getMessage());
    //         return $e->getMessage();
    //     }
    // }
    // public function saveFbIntegration(Request $request){
    //     $addFbFrom = new OfficeFacebookIntegrations;
    //     $addFbFrom->page_id = $request->page_id;
    //     $addFbFrom->access_token = $request->access_token;
    //     $addFbFrom->page_name = $request->page_name;
    //     $addFbFrom->form_id = $request->form_id;
    //     $addFbFrom->form_name = $request->form_name;
    //     $addFbFrom->folder_id = $request->folder_id;
    //     $addFbFrom->integration_id = Str::random(50);
    //     $addFbFrom->type = 'fb_leads';
    //     $addFbFrom->save();
    //     return redirect(route('admin.leads_integration.integrations'));

    // }
    // public function integrations(){
    //     $integrations_leads = OfficeFacebookIntegrations::with('folder')->get();
    //     return view('admin.leads-integration.integrations', compact('integrations_leads'));
    // }
    // public function single_integration ($integration_id){
    //     $single_integration = OfficeFacebookIntegrations::where('integration_id', $integration_id)->with('folder')->first();
    //     return view('admin.leads-integration.single-integration', compact('single_integration'));
    // }
}
