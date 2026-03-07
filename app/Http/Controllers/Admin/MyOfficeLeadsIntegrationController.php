<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeFacebookIntegrations;
use App\Models\OfficeIndiamartLeads;
use App\Models\OfficeLeads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MyOfficeLeadsIntegrationController extends Controller
{
    public function index()
    {

        $lead_folders = OfficeLeadsFolders::all();
        $fb_leads = OfficeFacebookIntegrations::select('form_id')->where('type', 'fb_leads')->get()->pluck('form_id')->toArray();

        return view('admin.leads-integration.index', compact('lead_folders', 'fb_leads'));
    }
    public function getLeadFolders()
    {
        $lead_folders = OfficeLeadsFolders::orderBy('id', "DESC")->get();
        return response()->json($lead_folders);
    }


    // public function callback(Request $request)
    // {

    //     $code = $_GET['code'];
    //     if (!$code) {
    //         return response()->json(['error' => 'Authorization code missing'], 400);
    //     }

    //     try {
    //         $client = new Client();
    //         $response = $client->get('https://graph.facebook.com/v22.0/oauth/access_token', [

    //             'query' => [
    //                 'client_id'     => env("FACEBOOK_CLIENT_ID"),
    //                 'client_secret' => env("FACEBOOK_CLIENT_SECRET"),
    //                 'redirect_uri'  => env("FACEBOOK_REDIRECT_URI"),
    //                 'code'          => $code,
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
    //         return "<script>
    //                     window.opener.postMessage(" . json_encode(['error' => $e->getMessage()]) . ", '*');
    //                     window.close();
    //                 </script>";
    //     }
    // }
    public function callback(Request $request)
    {
        // ✅ Facebook error check
        if ($request->has('error')) {
            return response()->json([
                "error" => $request->get('error_description')
            ], 400);
        }

        // ✅ Safe code fetch
        $code = $request->get('code');

        if (!$code) {
            return response()->json([
                'error' => 'Authorization code missing'
            ], 400);
        }

        try {

            $client = new \GuzzleHttp\Client();

            $response = $client->get(
                "https://graph.facebook.com/v22.0/oauth/access_token",
                [
                    'query' => [
                        'client_id'     => env("FACEBOOK_CLIENT_ID"),
                        'client_secret' => env("FACEBOOK_CLIENT_SECRET"),
                        'redirect_uri'  => env("FACEBOOK_REDIRECT_URI"),
                        'code'          => $code,
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);

            // ✅ Check token exists
            if (!isset($data['access_token'])) {
                return response()->json([
                    "error" => "Access token not received",
                    "response" => $data
                ], 500);
            }

            session(['facebook_access_token' => $data['access_token']]);

            // ✅ Popup safe close
            return "<script>
            if(window.opener){
                window.opener.postMessage(" . json_encode([
                'access_token' => $data['access_token']
            ]) . ", '*');
            }
            window.close();
        </script>";
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage()
            ], 500);
        }
    }


    public function pages(Request $request, $token)

    {

        if (!$token) {
            return response()->json(['error' => 'Authorization code missing'], 400);
        }

        try {
            $client = new Client();
            $response = $client->get("https://graph.facebook.com/v22.0/me/accounts", [
                'query' => ['access_token' => $token]
            ]);


            $data = json_decode($response->getBody(), true);

            return response()->json($data);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return $e->getMessage();
        }
    }
    // public function saveFbIntegration(Request $request)
    // {

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

    public function saveFbIntegration(Request $request)
    {
        $addFbFrom = new OfficeFacebookIntegrations;
        $addFbFrom->page_id = $request->page_id;
        $addFbFrom->access_token = $request->access_token;
        $addFbFrom->page_name = $request->page_name;
        $addFbFrom->form_id = $request->form_id;
        $addFbFrom->form_name = $request->form_name;
        $addFbFrom->folder_id = $request->folder_id;
        $addFbFrom->integration_id = Str::random(50);
        $addFbFrom->type = 'fb_leads';
        $addFbFrom->save();

        // ✅ IMPORTANT: Subscribe app to page
        $pageId = $request->page_id;
        $accessToken = $request->access_token;

        $url = "https://graph.facebook.com/v18.0/{$pageId}/subscribed_apps";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'access_token' => $accessToken,
                'subscribed_fields' => 'leadgen'
            ],
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // save webhook response
        $addFbFrom->webhook_id = $response;
        $addFbFrom->save();

        return redirect(route('admin.leads_integration.integrations'));
    }

    public function saveImIntegration(Request $request)
    {
        $addFbFrom = new OfficeFacebookIntegrations;
        $addFbFrom->access_token = $request->access_token;
        $addFbFrom->folder_id = $request->folder_id;
        $addFbFrom->integration_id = Str::random(50);
        $addFbFrom->type = 'im_leads';
        $addFbFrom->save();
        return redirect(route('admin.leads_integration.integrations'));
    }


    public function saveWebHookIntegration(Request $request)
    {
        $addFbFrom = new OfficeFacebookIntegrations;
        $addFbFrom->folder_id = $request->folder_id;
        $addFbFrom->access_token = Str::random(10);
        $addFbFrom->integration_id = Str::random(50);
        $addFbFrom->webhook_id = $request->type_url . '/' . $addFbFrom->integration_id;
        $addFbFrom->type = $request->type;
        $addFbFrom->save();
        return redirect(route('admin.leads_integration.integrations'));
    }
    public function integrations()
    {
        $integrations_leads = OfficeFacebookIntegrations::with('folder')->get();
        return view('admin.leads-integration.integrations', compact('integrations_leads'));
    }
    public function single_integration($integration_id)
    {
        $single_integration = OfficeFacebookIntegrations::where('integration_id', $integration_id)->with('folder')->first();
        return view('admin.leads-integration.single-integration', compact('single_integration'));
    }
    public function indiamart_webhook(Request $request)
    {
        $response = $request->all();
        $main_response = $response['RESPONSE'];
        $addint = new OfficeIndiamartLeads;
        $addint->lead_id = $main_response['UNIQUE_QUERY_ID'];
        $addint->folder_id = 1;
        $addint->response = json_encode($main_response);
        $addint->save();

        return response()->json(['status' => 200, response => $response]);
    }




    // public function facebook_webhook(Request $request)
    // {
    //     if ($request->isMethod('get')) {

    //         $mode      = $request->get('hub_mode') ?? $request->get('hub.mode');
    //         $token     = $request->get('hub_verify_token') ?? $request->get('hub.verify_token');
    //         $challenge = $request->get('hub_challenge') ?? $request->get('hub.challenge');

    //         Log::info("Mode: $mode");
    //         Log::info("Token: $token");
    //         Log::info("Challenge: $challenge");

    //         if ($token === "meta_verify_2026") {
    //             return response($challenge, 200);
    //         }

    //         return response("Invalid token", 403);
    //     }

    //     if ($request->isMethod('post')) {
    //         Log::info("Webhook Event Received", $request->all());
    //         return response("EVENT_RECEIVED", 200);
    //     }
    // }

    public function facebook_webhook(Request $request)
    {
        // GET request - Webhook Verification
        if ($request->isMethod('get')) {
            $mode      = $request->get('hub_mode') ?? $request->get('hub.mode');
            $token     = $request->get('hub_verify_token') ?? $request->get('hub.verify_token');
            $challenge = $request->get('hub_challenge') ?? $request->get('hub.challenge');

            Log::info("Mode: $mode");
            Log::info("Token: $token");
            Log::info("Challenge: $challenge");

            if ($token === "meta_verify_2026") {
                return response($challenge, 200);
            }
            return response("Invalid token", 403);
        }

        // POST request - Actual Lead Data
        if ($request->isMethod('post')) {
            Log::info("Webhook Event Received", $request->all());

            try {
                $data = $request->all();

                // Process each entry
                if (isset($data['entry']) && is_array($data['entry'])) {
                    foreach ($data['entry'] as $entry) {
                        if (isset($entry['changes']) && is_array($entry['changes'])) {
                            foreach ($entry['changes'] as $change) {
                                if ($change['field'] === 'leadgen') {
                                    $leadValue = $change['value'];

                                    // 🔍 Step 1: Get full lead details from Facebook
                                    $fullLeadData = $this->fetchLeadDetails($leadValue['leadgen_id']);

                                    if ($fullLeadData) {
                                        // 🔍 Step 2: Find which integration this belongs to
                                        $integration = OfficeFacebookIntegrations::where('form_id', $leadValue['form_id'])->first();

                                        if ($integration) {
                                            // ✅ Step 3: Insert lead into OfficeLeads
                                            $this->createLeadFromWebhook($fullLeadData, $integration, $leadValue);
                                        } else {
                                            Log::warning("No integration found for form_id: " . $leadValue['form_id']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                return response("EVENT_RECEIVED", 200);
            } catch (\Exception $e) {
                Log::error("Webhook processing error: " . $e->getMessage());
                return response("ERROR", 500);
            }
        }
    }

    /**
     * Fetch complete lead details from Facebook Graph API
     */
    private function fetchLeadDetails($leadgenId)
    {
        try {
            // Get the integration to use its access token
            // Note: You'll need to find which integration has access to this lead
            $integration = OfficeFacebookIntegrations::whereNotNull('access_token')->first();

            if (!$integration) {
                Log::error("No integration found with access token");
                return null;
            }

            $url = "https://graph.facebook.com/v18.0/{$leadgenId}";
            $url .= "?fields=id,created_time,field_data,form_id";
            $url .= "&access_token=" . $integration->access_token;

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                return json_decode($response, true);
            } else {
                Log::error("Failed to fetch lead details: " . $response);
                return null;
            }
        } catch (\Exception $e) {
            Log::error("fetchLeadDetails error: " . $e->getMessage());
            return null;
        }
    }

    private function createLeadFromWebhook($fullLeadData, $integration, $webhookValue)
    {
        try {
            // Extract field data
            $fieldData = [];
            if (isset($fullLeadData['field_data'])) {
                foreach ($fullLeadData['field_data'] as $field) {
                    $fieldData[$field['name']] = $field['values'][0] ?? '';
                }
            }

            // Check if lead already exists (prevent duplicates)
            $existingLead = OfficeLeads::where('fb_lead_id', $fullLeadData['id'])->first();
            if ($existingLead) {
                Log::info("Lead already exists: " . $fullLeadData['id']);
                return true;
            }

            // Map Facebook fields to your database fields
            $leadData = [
                // Facebook specific fields (NEW)
                'fb_lead_id' => $fullLeadData['id'],
                'fb_form_id' => $integration->form_id,
                'fb_page_id' => $integration->page_id,
                'raw_data' => json_encode($fullLeadData), // Store raw data for reference

                // Your existing fields
                'emp_id' => null, // You'll need to assign based on your logic
                'service_name' => $integration->form_name ?? 'Facebook Lead',
                'client_name' => $fieldData['full_name'] ?? 'Anonymous',
                'client_mobile' => $this->extractPhoneNumber($fieldData),
                'client_email' => $fieldData['email'] ?? $fieldData['client_email'] ?? 'Anonymous',
                'status' => 'New',
                'amount' => 0,
                'final_amount' => 0,
                'recived_amount' => 0,
                'folder_id' => $integration->folder_id ?? null,
                'remark' => json_encode([[
                    'remark' => 'Lead from Facebook: ' . ($fieldData['website_url'] ?? ''),
                    'date' => date('Y-m-d'),
                    'time' => date('h:i A'),
                    'status' => 'New'
                ]]),
            ];

            // Create the lead
            $addlead = OfficeLeads::create($leadData);

            Log::info("Lead created successfully from webhook. Lead ID: " . $addlead->id . ", FB Lead ID: " . $fullLeadData['id']);
            return true;
        } catch (\Exception $e) {
            Log::error("createLeadFromWebhook error: " . $e->getMessage());
            return false;
        }
    }


    /**
     * Extract phone number from various possible field names
     */
    private function extractPhoneNumber($fieldData)
    {
        $phoneFields = ['phone_number', '📱no.', 'phone', 'mobile', 'contact', '📱no'];

        foreach ($phoneFields as $field) {
            if (isset($fieldData[$field]) && !empty($fieldData[$field])) {
                return $fieldData[$field];
            }
        }

        return 'Not Provided';
    }



    public function webhook(Request $request, $type, $id)
    {
        Log::info('Received Webhook Request', $request->all());
        $webhookData = $request->all();
        $integration = OfficeFacebookIntegrations::where('integration_id', $id)->first();
        $folder = OfficeLeadsFolders::find($integration->folder_id);

        if ($integration != null) {
            if ($type == 'elementor') {
                $new = new OfficeLeads;
                $new->emp_id = 18;
                $new->assign_date = date('Y-m-d');
                $new->service_name = $folder->folder_name;
                $new->remark = json_encode([['remark' => "Please work on this lead as soon as possible", 'date' => date('Y-m-d'), 'time' => date('h:i A'), 'status' => 'open']]);
                $new->status = "open";
                $new->folder_id = $integration->folder_id;
                $new->csv = json_encode($webhookData);
                $new->type = $integration->type;
                $new->integration_id = $integration->id;
                $new->save();
                if ($integration->mapping == null) {
                    $integration->mapping = json_encode(array_keys($webhookData));
                    $integration->save();
                }
            }
            $new = new OfficeIndiamartLeads;
            $new->folder_id = $integration->folder_id;
            $new->integration_id = $integration->integration_id;
            $new->type = $integration->type;
            $new->response = json_encode($webhookData);
            $new->save();
        }

        return true;
    }
}
