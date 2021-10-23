<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\MemberUpload;
use App\Models\MemberFolder;
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
        $client             = Client::where('client_email', $email)->get();
        $client_id          = $client[0]->id;
        $files              = MemberUpload::where('client_id' , $client_id)->where('slug', null)->get();
        $folders            = MemberFolder::where('client_id', $client_id)->where('access_slug', null)->get();
        
        return view('client.dashboard', [
            'client_id' => $client_id, 
            'files'     => $files,
            'folders'   => $folders
        ]);
    }
    public function folder_files_view (Request $request, $slug)
    {
        $email              = $request->session()->get('ClientEmail');
        $client             = Client::where('client_email', $email)->get();
        $client_id          = $client[0]->id;
        $salt               = $slug;
        $files              = MemberUpload::where('client_id' , $client_id)->where('slug', $salt)->get();
        $folders            = MemberFolder::where('client_id', $client_id)->where('access_slug', $salt)->get();

        return view('client.folder-files', [
            'client_id' => $client_id, 
            'slug'      => $salt, 
            'files'     => $files,
            'folders'   => $folders
        ]);
    }
}
