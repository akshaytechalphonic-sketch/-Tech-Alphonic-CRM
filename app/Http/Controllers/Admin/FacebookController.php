<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')
            // ->scopes(['pages_show_list', 'pages_read_engagement', 'leads_retrieval', 'pages_manage_ads'])
            ->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            session(['facebook_access_token' => $user->token]);

            return redirect('/facebook/pages');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong!');
        }
    }

    public function getFacebookPages()
    {
        $accessToken = session('facebook_access_token');
        if (!$accessToken) {
            return redirect('/facebook/login');
        }

        $response = Http::get("https://graph.facebook.com/v18.0/me/accounts", [
            'access_token' => $accessToken,
        ]);

        $pages = $response->json()['data'] ?? [];

        return view('facebook.pages', compact('pages'));
    }

    public function getLeadForms($page_id)
    {
        $accessToken = session('facebook_access_token');
        if (!$accessToken) {
            return redirect('/facebook/login');
        }

        $response = Http::get("https://graph.facebook.com/v18.0/{$page_id}/leadgen_forms", [
            'access_token' => $accessToken,
        ]);

        $forms = $response->json()['data'] ?? [];

        return view('facebook.leads', compact('forms', 'page_id'));
    }

    public function getLeadFormInsights($form_id)
    {
        $accessToken = session('facebook_access_token');
        if (!$accessToken) {
            return redirect('/facebook/login');
        }

        $response = Http::get("https://graph.facebook.com/v18.0/{$form_id}/insights", [
            'metric' => 'leads_submitted',
            'access_token' => $accessToken,
        ]);

        $insights = $response->json();

        return view('facebook.insights', compact('insights'));
    }
}