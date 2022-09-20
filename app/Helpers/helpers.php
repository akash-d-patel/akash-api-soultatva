<?php

namespace App\Helpers;

use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

function getSchedulerApiData(Request $request)
{
    $url = env('SCHEDULER_URL');
        
        $requestContent =    [
            'form_params' => [
                'client_id' => $request->client_id,
                'email_template_id' => $request->email_template_id,
                'project_id' => $request->project_id,
                'from_email' => $request->from_email,
                'to_email[]' => $request->to_email,
                'cc[]' => $request->cc,
                'bcc[]' => $request->bcc,
                'subject' => $request->subject,
                'attechment' => $request->attechment,
                'template' => $request->template,
                'status' => $request->status,
                'name' => $request->name,
                'template_var' => $request->template_var
            ],
            'headers' => ['Accept' => 'application/json'],
        ];

        try {
            $client = new GuzzleHttp\Client();
            $apiRequest = $client->request('POST', $url, $requestContent);
            $response = json_decode($apiRequest->getBody());
            return $response;
        } catch (RequestException  $re) {
            //
        }
}
