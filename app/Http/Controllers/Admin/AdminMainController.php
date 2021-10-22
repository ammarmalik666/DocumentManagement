<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\IndividualClient;
use App\Models\BusinessClient;
use App\Models\MemberUpload;
use App\Models\AdminUpload;
use App\Models\MemberFolder;
use App\Models\AdminFolder;

class AdminMainController extends Controller
{
    public function dashboard_view()
    {
        return view('admin.dashboard');
    }
    public function add_client_view()
    {
        return view('admin.add-clients');
    }
    public function add_client(Request $request)
    {
        // return $request;
        $client_type                =  $request->client_type; 

        // ========Individual Client==========
        $client_name                =  $request->client_name; 
        $client_email               =  $request->client_email; 
        $client_phone               =  $request->client_phone; 
        $client_mobile              =  $request->client_mobile; 
        $client_physical_address    =  $request->physical_address; 
        $client_postal_checkbox     =  $request->postal_checkbox; 
        $client_postal_address      =  $request->postal_address; 

        // ========Business Client==========
        $business_name              =  $request->business_name; 
        $business_email             =  $request->business_email; 
        $business_phone             =  $request->business_phone; 
        $business_mobile            =  $request->business_mobile; 
        $business_physical_address  =  $request->business_physical_address; 
        $business_postal_checkbox   =  $request->business_postal_address_checkbox; 
        $business_postal_address    =  $request->business_postal_address; 
        $contact_name               =  $request->contact_name; 
        $contact_email              =  $request->contact_email; 
        $contact_mobile             =  $request->contact_mobile; 
        $contact_phone              =  $request->contact_phone; 

        if ($client_type == "individual") {
            $request->validate([
                'client_name'                => 'required|max:50',
                'client_email'               => 'required|unique:clients|email|max:33',
                'client_phone'               => 'required|max:15',
                'client_mobile'              => 'required|max:15',
                'physical_address'           => 'required|max:50',
            ]);
            $name               =   $client_name;
            $email              =   $client_email;
            $phone              =   $client_phone;
            $mobile             =   $client_mobile;
            $physical_address   =   $client_physical_address;
            $postal_checkbox    =   $client_postal_checkbox;
            $status             =   1;
            $password           =   12345678;
            $enc_password       =   bcrypt($password);

            if ($postal_checkbox == "postal-address") {
                $postal_address = $physical_address;
            }else{
                $request->validate([
                    'postal_address'   => 'required|max:50',
                ]);
                $postal_address = $client_postal_address;
            }
            $client_array = [
                'name'              => $name,
                'email'             => $email,
                'phone'             => $phone,
                'mobile'            => $mobile,
                'physical_address'  => $physical_address,
                'postal_address'    => $postal_address,
                'status'            => $status
            ]; 
            $client = IndividualClient::create($client_array);
            if($client)
            {
                $client_id = $client->id;
                $client_type_array = [
                    'client_type'           =>      $name,
                    'individual_client_id'  =>      $client_id,
                    'client_email'          =>      $email,
                    'password'              =>      $enc_password,
                    'status'                =>      $status,
                ];
            $client_type = Client::create($client_type_array);
            if ($client_type) {
                return back()->withErrors('Client_Added');
            }
            }else{
                return back()->withErrors('unknownError');
            }

        }elseif($client_type == "business"){
            $request->validate([
                'business_name'                => 'required|max:50',
                'business_email'               => 'required|unique:clients|email|max:33',
                'business_phone'               => 'required|max:15',
                'business_mobile'              => 'required|max:15',
                'business_physical_address'    => 'required|max:50',
                'contact_name'                 => 'required|max:50',
                'contact_email'                => 'required|unique:clients|email|max:33',
                'contact_mobile'               => 'required|max:15',
                'contact_phone'                => 'required|max:15',
            ]);
            $business_name               =   $business_name;
            $business_email              =   $business_email;
            $business_phone              =   $business_phone;
            $business_mobile             =   $business_mobile;
            $business_physical_address   =   $business_physical_address;
            $postal_checkbox             =   $business_postal_checkbox;
            $business_postal_address     =   $business_postal_address;
            $contact_name                =   $contact_name;
            $contact_email               =   $contact_email;
            $contact_mobile              =   $contact_mobile;
            $contact_phone               =   $contact_phone;
            $status                      =   1;
            $password                    =   12345678;
            $enc_password                =   bcrypt($password);

            if ($postal_checkbox == "business-postal-address") {
                $postal_address = $business_physical_address;
            }else{
                $postal_address = $business_postal_address;
            }
            $client_array = [
                'business_name'              =>  $business_name,
                'business_email'             =>  $business_email,
                'business_phone'             =>  $business_phone,
                'business_mobile'            =>  $business_mobile,
                'business_physical_address'  =>  $business_physical_address,
                'business_postal_address'    =>  $postal_address,
                'contact_name'               =>  $contact_name,
                'contact_email'              =>  $contact_email,
                'contact_phone'              =>  $contact_phone,
                'contact_mobile'             =>  $contact_mobile,
                'status'                     =>  $status,
            ]; 
            $client = BusinessClient::create($client_array);
            if($client)
            {
                $client_id = $client->id;
                $client_type_array = [
                    'client_type'           =>      $contact_name,
                    'business_client_id'    =>      $client_id,
                    'client_email'          =>      $contact_email,
                    'password'              =>      $enc_password,
                    'status'                =>      $status,
                ];
            $client_type = Client::create($client_type_array);
            if ($client_type) {
                return back()->withErrors('Client_Added');
            }
            }else{
                return back()->withErrors('unknownError');
            }
        }
    }
    public function all_client_view()
    {
        $clients = Client::orderBy('id', 'desc')->get();
        // return $clients;
        return view('admin.all-clients', ['client' => $clients]);
    }
    public function delete_client(Request $request)
    {
        $id         = $request->id;
        
        $delete = Client::where('id', $id)->delete();
        if($delete)
        {
            return back()->withErrors('client_deleted');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function access_folder_view($id)
    {
        $client_id  =  $id;
        return view('admin.access-folder', ['client_id' => $client_id]);
    }
    public function member_files ($id)
    {
        $client_id = $id;
        $files = MemberUpload::where('client_id' , $client_id)->get();
        $folders = MemberFolder::where('client_id', $client_id)->where('access_slug', null)->get();
        return view('admin.member-files', [
            'client_id' => $client_id, 
            'files'     => $files,
            'folders'   => $folders
        ]);
    }
    public function member_folder_files($id, $salt)
    {
        $client_id  = $id;
        $salt       = $salt;
        $files = MemberUpload::where('client_id' , $client_id)->where('slug', $salt)->get();
        $folders = MemberFolder::where('client_id', $client_id)->where('access_slug', $salt)->get();
        return view('admin.member-folder-files', [
            'client_id' => $client_id, 
            'slug'      => $salt, 
            'files'     => $files,
            'folders'   => $folders
        ]);

    }
    public function upload_member_files(Request $request)
    {
        $request->validate([
          'filename' => 'required|max:50',
          'file'     => 'required',
          'file.*'   => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf,docx,xlsx|max:2048'
        ]);
        $client_id = $request->client_id;
        $filename  = $request->filename;
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $orignal_name = $file->getClientOriginalName();
            $name = time().rand(1,100000000).'.'.$file->extension();
            $move_file = $file->move(public_path().'/uploads/member-files', $name);  
            $status = 1;
            if ($move_file) {
                $array = [
                    'client_id' => $client_id,
                    'file'      => $name,
                    'filename'  => $filename,
                    'status'    => $status
                ];
                $upload_file = MemberUpload::create($array);
                if ($upload_file) {
                    return back()->withErrors('FileUploaded');
                    
                }else{
                    return back()->withErrors('FileNotUploaded');

                }
            }
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function delete_member_files(Request $request)
    {
        $id         = $request->id;
        
        $delete = MemberUpload::where('id', $id)->delete();
        if($delete)
        {
            return back()->withErrors('file_deleted');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function admin_files ($id)
    {
        $client_id = $id;
        $files = AdminUpload::where('client_id' , $client_id)->get();
        $folders = AdminFolder::where('client_id', $client_id)->where('access_slug', null)->get();
        return view('admin.admin-files', [
            'client_id' => $client_id, 
            'files'     => $files,
            'folders'   => $folders
        ]);
    }
    public function upload_admin_files(Request $request)
    {
        $request->validate([
          'file' => 'required',
          'file.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf,docx,xlsx,ppt,pptx|max:2048'
        ]);
        $client_id = $request->client_id;
        $filename  = $request->filename;
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $orignal_name = $file->getClientOriginalName();
            $name = time().rand(1,100000000).'.'.$file->extension();
            $move_file = $file->move(public_path().'/uploads/admin-files', $name);  
            $status = 1;
            if ($move_file) {
                $array = [
                    'client_id' => $client_id,
                    'file'      => $name,
                    'filename'  => $filename,
                    'status'    => $status
                ];
                $upload_file = AdminUpload::create($array);
                if ($upload_file) {
                    return back()->withErrors('FileUploaded');
                    
                }else{
                    return back()->withErrors('FileNotUploaded');

                }
            }
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function delete_admin_files(Request $request)
    {
        $id         = $request->id;
        
        $delete = AdminUpload::where('id', $id)->delete();
        if($delete)
        {
            return back()->withErrors('file_deleted');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function admin_folder_files($id, $salt)
    {
        $client_id  = $id;
        $salt       = $salt;
        $files = AdminUpload::where('client_id' , $client_id)->where('slug', $salt)->get();
        $folders = AdminFolder::where('client_id', $client_id)->where('access_slug', $salt)->get();
        return view('admin.admin-folder-files', [
            'client_id' => $client_id, 
            'slug'      => $salt, 
            'files'     => $files,
            'folders'   => $folders
        ]);

    }
    public function create_admin_folder_in_folder (Request $request)
    {
        function generate_salt($len = 20)
        {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$_';
            $l = strlen($chars) - 1;
            $str = '';
            for ($i = 0; $i < $len; ++$i) {
                $str .= $chars[rand(0, $l)];
            }
            return $str;
        }

        $request->validate([
          'folder_name' => 'required|max:40',
        ]);
        
        $folder_name    = $request->folder_name;
        $client_id      = $request->client_id;
        $access_slug    = $request->slug;
        $salt           = generate_salt();
        $status         = 1;
        $array = [
            'client_id'     => $client_id,
            'folder_name'   => $folder_name,
            'slug'          => $salt,
            'access_slug'   => $access_slug,
            'status'        => $status
        ];
        $create_folder = AdminFolder::create($array);
        if ($create_folder) {
            return back()->withErrors('FolderCreated');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function upload_admin_files_in_folder(Request $request)
    {
        $request->validate([
          'filename' => 'required|max:50',
          'file'     => 'required',
          'file.*'   => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf,docx,xlsx|max:2048'
        ]);
        $client_id  = $request->client_id;
        $filename   = $request->filename;
        $slug       = $request->slug;
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $orignal_name = $file->getClientOriginalName();
            $name = time().rand(1,100000000).'.'.$file->extension();
            $move_file = $file->move(public_path().'/uploads/member-files', $name);  
            $status = 1;
            if ($move_file) {
                $array = [
                    'client_id' => $client_id,
                    'file'      => $name,
                    'filename'  => $filename,
                    'slug'      => $slug,
                    'status'    => $status
                ];
                $upload_file = AdminUpload::create($array);
                if ($upload_file) {
                    return back()->withErrors('FileUploaded');
                    
                }else{
                    return back()->withErrors('FileNotUploaded');

                }
            }
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function create_member_folder (Request $request)
    {
        function generate_salt($len = 20)
        {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$_';
            $l = strlen($chars) - 1;
            $str = '';
            for ($i = 0; $i < $len; ++$i) {
                $str .= $chars[rand(0, $l)];
            }
            return $str;
        }

        $request->validate([
          'folder_name' => 'required|max:40',
        ]);
        
        $folder_name    = $request->folder_name;
        $client_id      = $request->client_id;
        $salt           = generate_salt();
        $status         = 1;
        $array = [
            'client_id'     => $client_id,
            'folder_name'   => $folder_name,
            'slug'          => $salt,
            'status'        => $status
        ];
        $create_folder = MemberFolder::create($array);
        if ($create_folder) {
            return back()->withErrors('FolderCreated');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function create_member_folder_in_folder (Request $request)
    {
        function generate_salt($len = 20)
        {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$_';
            $l = strlen($chars) - 1;
            $str = '';
            for ($i = 0; $i < $len; ++$i) {
                $str .= $chars[rand(0, $l)];
            }
            return $str;
        }

        $request->validate([
          'folder_name' => 'required|max:40',
        ]);
        
        $folder_name    = $request->folder_name;
        $client_id      = $request->client_id;
        $access_slug    = $request->slug;
        $salt           = generate_salt();
        $status         = 1;
        $array = [
            'client_id'     => $client_id,
            'folder_name'   => $folder_name,
            'slug'          => $salt,
            'access_slug'   => $access_slug,
            'status'        => $status
        ];
        $create_folder = MemberFolder::create($array);
        if ($create_folder) {
            return back()->withErrors('FolderCreated');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function upload_member_files_in_folder(Request $request)
    {
        $request->validate([
          'filename' => 'required|max:50',
          'file'     => 'required',
          'file.*'   => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf,docx,xlsx|max:2048'
        ]);
        $client_id  = $request->client_id;
        $filename   = $request->filename;
        $slug       = $request->slug;
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $orignal_name = $file->getClientOriginalName();
            $name = time().rand(1,100000000).'.'.$file->extension();
            $move_file = $file->move(public_path().'/uploads/member-files', $name);  
            $status = 1;
            if ($move_file) {
                $array = [
                    'client_id' => $client_id,
                    'file'      => $name,
                    'filename'  => $filename,
                    'slug'      => $slug,
                    'status'    => $status
                ];
                $upload_file = MemberUpload::create($array);
                if ($upload_file) {
                    return back()->withErrors('FileUploaded');
                    
                }else{
                    return back()->withErrors('FileNotUploaded');

                }
            }
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function delete_member_folders(Request $request)
    {
        $id     = $request->id;
        $delete = MemberFolder::where('id', $id)->delete();
        if($delete)
        {
            return back()->withErrors('folder_deleted');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function create_admin_folder (Request $request)
    {
        function generate_salt($len = 20)
        {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$_';
            $l = strlen($chars) - 1;
            $str = '';
            for ($i = 0; $i < $len; ++$i) {
                $str .= $chars[rand(0, $l)];
            }
            return $str;
        }

        $request->validate([
          'folder_name' => 'required|max:40',
        ]);
        
        $folder_name    = $request->folder_name;
        $client_id      = $request->client_id;
        $salt           = generate_salt();
        $status         = 1;
        $array = [
            'client_id'     => $client_id,
            'folder_name'   => $folder_name,
            'slug'          => $salt,
            'status'        => $status
        ];
        $create_folder = AdminFolder::create($array);
        if ($create_folder) {
            return back()->withErrors('FolderCreated');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
    public function delete_admin_folders(Request $request)
    {
        $id     = $request->id;
        $delete = AdminFolder::where('id', $id)->delete();
        if($delete)
        {
            return back()->withErrors('folder_deleted');
        }else{
            return back()->withErrors('UnknownError');
        }
    }
}