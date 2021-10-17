<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\MemberUpload;
use DB;

class ClientMainController extends Controller
{
    public function index()
    {
        return redirect('/dashboard');
    }
    public function dashboard_view (Request $request)
    {
        $email              = $request->session()->get('ClientEmail');
        $client             = Client::where('email', $email)->get();
        $client_id          = $client[0]->id;
        $files = MemberUpload::where('client_id' , $client_id)->get();
        return view('client.dashboard', [
            'client_id' => $client_id, 
            'files' => $files
        ]);
    }
}
