<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SendWebhookController extends Controller
{
    //
    public function send(Request $request)
    {
        $url = 'https://webhook.site/2d5153b6-5cb3-4c5a-8d05-7c680b17924d';
        $data = [
            'job_id'=> $job->job_id,
            'queue'=>$job->queue,
             'name'=> $job->name,
             'started_at'=>$job->started_at,
             'finished_at'=>$job->finished_at,
             'attempt'=>$job->attempt,
             'progress'=>$job->progress,
            ],
        ];
    	$json_array = json_encode($data);
        $curl = curl_init();
        $headers = ['Content-Type: application/json'];

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_array);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($http_code >= 200 && $http_code < 300) {
            echo "webhook send successfully.";
        } else {
            echo "webhook failed.";
        }
    }
}
