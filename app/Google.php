<?php

declare(strict_types=1);

namespace App;

use Google_Client;
use Google_Service_Books;
use Google_Service_Docs;
use Google_Service_Drive;

class Google
{
    public function client(): Google_Client
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
        $client->setScopes(explode(',', env('GOOGLE_SCOPES')));
        $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
        $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));
        return $client;
    }

    public function doc(Google_Client $client): Google_Service_Docs
    {
        return new Google_Service_Docs($client);
    }

    public function drive($client): Google_Service_Drive
    {
        return new Google_Service_Drive($client);
    }

    public function service($client): Google_Service_Books
    {
        return new Google_Service_Books($client);
    }
}