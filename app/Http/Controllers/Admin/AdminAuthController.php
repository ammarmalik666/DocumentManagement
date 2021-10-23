<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use DB;

class AdminAuthController extends Controller
{
    public function login_view ()
    {
        return view('admin.login');
    }
    public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255'
        ]);
        $email = $request->email;
        $password = $request->password;

        $user = Admin::where('email', $email)->get();
        if(!$user->isEmpty())
        {   
            $dbPass = $user[0]->password;
            if(password_verify($password, $dbPass))
            {
                $request->session()->put('AdminEmail',$email);
                return redirect('/admin/');
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
        return view('admin.change-password');
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'current_password'   => 'required|max:14',
            'new_password'       => 'required|max:14',
            'confirm_password'   => 'required|same:new_password|max:14'
        ]);
        $new_password = $request->new_password;
        $email = $request->session()->get('AdminEmail');
        $current_password = $request->current_password;
        $user = Admin::where('email', $email)->get();
        if(!$user->isEmpty())
        {   
            $dbPass = $user[0]->password;
            $new_e_password = bcrypt($request->new_password);

            if(password_verify($current_password, $dbPass))
            {
                if ($new_password == $current_password) {
                    return back()->withErrors('old_pass_as_new');
                }else{
                    $query = DB::table('admins')->where('email', $email)->update(['password' => $new_e_password]);
                    return back()->withErrors('success');
                }
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
        session()->forget('AdminEmail');
        return redirect('/admin/login');
    }
}
