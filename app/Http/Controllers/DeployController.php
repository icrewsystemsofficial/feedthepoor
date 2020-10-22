<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class DeployController extends Controller
{
    public function index() {

      //First we backup the entire application. via Spatie db backup or just cp the entire dir.
      //Store it to a secure location so that if build fails, we can restore it.

      $root_path = base_path();
      $process = new Process(['deploy.sh']);
      $process->run();
      echo $process->getOutput();

    }

    //Secure Deploy
    public function deploy(Request $request)
     {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        if (hash_equals($githubHash, $localHash)) {
             $root_path = base_path();
             $process = new Process('cd ' . $root_path . '; ./deploy.sh');
             $process->run(function ($type, $buffer) {
                 echo $buffer;
             });
        }
     }
}
