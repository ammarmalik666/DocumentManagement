<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use DB;

class ClientAuthController extends Controller
{
    public function login_view ()
    {
        return view('client.login');
    }
    public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255'
        ]);
        $email = $request->email;
        $password = $request->password;

        $user = Client::where('client_email', $email)->get();
        if(!$user->isEmpty())
        {   
            $dbPass = $user[0]->password;
            if(password_verify($password, $dbPass))
            {
                $emails  = $request->session()->put('ClientEmail',$email);
                return redirect('/dashboard/');
                // return $emails;
            }
            else
            {
                return back()->withErrors('pass_not_match');
            }
        }else{
            return back()->withErrors('email_not_match');

        }
    }
    public function setting ()
    {
        return view('client.change-password');
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'current_password'   => 'required|max:14',
            'new_password'       => 'required|max:14',
            'confirm_password'   => 'required|same:new_password|max:14'
        ]);
        $new_password = $request->new_password;
        $email = $request->session()->get('ClientEmail');
        $current_password = $request->current_password;
        $user = Client::where('client_email', $email)->get();
        if(!$user->isEmpty())
        {   
            $dbPass = $user[0]->password;
            $new_e_password = bcrypt($request->new_password);

            if(password_verify($current_password, $dbPass))
            {
                $query = DB::table('clients')->where('client_email', $email)->update(['password' => $new_e_password]);
                return back()->withErrors('success');
            }
            else
            {
                return back()->withErrors('c_pass_not_match');
            }
        }else{
            return back()->withErrors('other');
        }
    }
    public function logout ()
    {
        session()->forget('ClientEmail');
        return redirect('/login');
    }
}
