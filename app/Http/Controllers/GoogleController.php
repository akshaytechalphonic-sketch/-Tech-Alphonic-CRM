<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->addScope(Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return redirect($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {

        $client = new Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));

        $token = $client->fetchAccessTokenWithAuthCode($request->code);
        if (isset($token['error'])) {
            return redirect('/office-employee/leads')
                ->with('error', 'Google authentication failed');
        }
        $employee = auth('office_employees')->user();
        $existingToken = json_decode($employee->google_token, true);

        // auth('office_employees')->user()->update([
        //     'google_token' => json_encode($token)
        // ]);
        if (!isset($token['refresh_token']) && isset($existingToken['refresh_token'])) {
            $token['refresh_token'] = $existingToken['refresh_token'];
        }

        if (!isset($token['refresh_token'])) {
            return redirect('/office-employee/leads')
                ->with('error', 'Please Reconnect Google');
        }

        $employee->update([
            'google_token' => json_encode($token)
        ]);


        return redirect('/office-employee/leads')->with('success', 'Google Connected');

        // return redirect('/dashboard')->with('success', 'Google Connected');
    }
}
