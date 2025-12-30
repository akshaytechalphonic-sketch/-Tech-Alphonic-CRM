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
    public function index(){
      
        $lead_folders = OfficeLeadsFolders::all();
        $fb_leads = OfficeFacebookIntegrations::select('form_id')->where('type', 'fb_leads')->get()->pluck('form_id')->toArray();
        
        return view('admin.leads-integration.index', compact('lead_folders','fb_leads'));
    }
    public function getLeadFolders()
    {
        $lead_folders = OfficeLeadsFolders::orderBy('id',"DESC")->get();
        return response()->json($lead_folders);
    }


    public function callback(Request $request)
    {
        $code = $_GET['code'];
        if (!$code) {
            return response()->json(['error' => 'Authorization code missing'], 400);
        }

        try {
            $client = new Client();
            $response = $client->get('https://graph.facebook.com/v22.0/oauth/access_token', [
                'query' => [
                    'client_id' => "597982789329810",
                    'client_secret' => "f78799c455601d771bdabb7fb375137a",
                    // 'redirect_uri' => "https://leads-management-in.fantasybet9.in/admin/leads-integration/callback",
                    'redirect_uri' => "https://oykey.in/admin/leads-integration/callback",

                    'code' => $code,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
           
            
            session(['facebook_access_token' => $data['access_token']]);

            // Return JavaScript to send the token to the parent window
            return "<script>
                        window.opener.postMessage(" . json_encode(['access_token' => $data['access_token']]) . ", '*');
                        window.close();
                    </script>";

        } catch (\Exception $e) {
            return "<script>
                        window.opener.postMessage(" . json_encode(['error' => $e->getMessage()]) . ", '*');
                        window.close();
                    </script>";
        }
    }

    public function pages(Request $request,$token)

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
    public function saveFbIntegration(Request $request){
      
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
        return redirect(route('admin.leads_integration.integrations'));
    }
    public function saveImIntegration(Request $request){
        $addFbFrom = new OfficeFacebookIntegrations;
        $addFbFrom->access_token = $request->access_token;
        $addFbFrom->folder_id = $request->folder_id;
        $addFbFrom->integration_id = Str::random(50);
        $addFbFrom->type = 'im_leads';
        $addFbFrom->save();
        return redirect(route('admin.leads_integration.integrations'));
    }


    public function saveWebHookIntegration(Request $request){
        $addFbFrom = new OfficeFacebookIntegrations;
        $addFbFrom->folder_id = $request->folder_id;
        $addFbFrom->access_token = Str::random(10);
        $addFbFrom->integration_id = Str::random(50);
        $addFbFrom->webhook_id = $request->type_url.'/'.$addFbFrom->integration_id;
        $addFbFrom->type = $request->type;
        $addFbFrom->save();
        return redirect(route('admin.leads_integration.integrations'));
    }
    public function integrations(){
        $integrations_leads = OfficeFacebookIntegrations::with('folder')->get();
        return view('admin.leads-integration.integrations', compact('integrations_leads'));
    }
    public function single_integration ($integration_id){
        $single_integration = OfficeFacebookIntegrations::where('integration_id', $integration_id)->with('folder')->first();
        return view('admin.leads-integration.single-integration', compact('single_integration'));
    }
    public function indiamart_webhook(Request $request){
        $response = $request->all();
        $main_response = $response['RESPONSE'];
        $addint = new OfficeIndiamartLeads;
        $addint->lead_id = $main_response['UNIQUE_QUERY_ID'];
        $addint->folder_id = 1;
        $addint->response = json_encode($main_response);
        $addint->save();
        
        return response()->json(['status' => 200, response => $response]);
    }


    public function facebook_webhook(Request $request){
        Log::info('Received Webhook Request', $request->all());

    $hubMode = $request->get('hub_mode');
    $hubChallenge = $request->get('hub_challenge');
    $hubVerifyToken = $request->get('hub_verify_token');
    
    // Log the specific parameters you're using for verification
    Log::info('hub_mode: ' . $hubMode);
    Log::info('hub_challenge: ' . $hubChallenge);
    Log::info('hub_verify_token: ' . $hubVerifyToken);

    if ($hubVerifyToken === 'meatyhamhock') {
        Log::info('Verification successful');  // Log verification success

        $addint = new OfficeIndiamartLeads;
        $addint->folder_id = $hubChallenge;
        $addint->save();

        Log::info('Saved challenge value to database'); // Log successful database save

        return response($hubChallenge, 200);
    }
    
    Log::info('Verification failed');  // Log verification failure
    return response('Verification failed', 403);
    }
    


    
    public function webhook(Request $request, $type, $id){
        Log::info('Received Webhook Request', $request->all());
        $webhookData = $request->all();
        $integration = OfficeFacebookIntegrations::where('integration_id', $id)->first();
        $folder = OfficeLeadsFolders::find($integration->folder_id);
        
        if($integration != null){
            if($type == 'elementor'){
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
                if($integration->mapping == null){
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