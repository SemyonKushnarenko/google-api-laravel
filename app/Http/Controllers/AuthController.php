<?php
namespace App\Http\Controllers;
use App\Google;
use App\Models\Post;
use Illuminate\Http\Request;
class AuthController extends Controller
{
//
    public function index(){
        $posts = Post::all();
        return view('home')->with('posts',$posts);
    }
    public function __construct(Google $google, Request $request)
    {
        $this->client = $google->client();
        $this->drive = $google->drive($this->client);
    }
    public function redirectToGoogleProvider(Google $google)
    {
        $client = $google->client();
        $auth_url = $client->createAuthUrl();
        return redirect($auth_url);
    }
    public function handleProviderGoogleCallback(Request $request)
    {
        if ($request->has('code')) {
            $client = $this->client;
            $client->authenticate($request->input('code'));
            $token = $client->getAccessToken();
            $request->session()->put('access_token',$token);
            return redirect('/home')->with('success','you have been authenticated');
        }else{
            $client=$this->client;
            $auth_url = $client->createAuthUrl();
            return redirect($auth_url);
        }
    }
}