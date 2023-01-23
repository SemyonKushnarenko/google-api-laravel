<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Google;
use DateTime;
use Google_Client;
use Google_Service;
use Google_Service_Docs;
use Google_Service_Docs_Body;
use Google_Service_Docs_Document;
use Google_Service_Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class GoogleController extends Controller
{
    private Google_Service_Docs $service;
    private Google_Service_Drive $drive;
    private Google_Client $client;

    public function __construct(Google $google)
    {
        $this->client = $google->client();
        $this->drive = $google->drive($this->client);
        $this->service = $google->doc($this->client);

    }
    public function handlePost(Request $request): RedirectResponse
    {
        if ($request->session()->get('access_token')){
            $client=$this->client;
            $client->setAccessToken($request->session()->get('access_token'));

            $time = new DateTime();

            $doc = new Google_Service_Docs_Document(
                ['title' => $time->format('Y-m-d-H:i:s')],
            );
            $this->service->documents->create($doc);

            return redirect('/home')->with('success','post has been created');
        }else{
            return redirect('/home')->with('error','you have not been authenticated');
        }
    }
}