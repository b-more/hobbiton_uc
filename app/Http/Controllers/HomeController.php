<?php

namespace App\Http\Controllers;

use App\Models\ApiAccount;
use App\Models\Business;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function ussd_documentation()
    {
        return view('ussd_documentation');
    }

    public function create_account(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required'],
            'business_name' => ['required', 'string', 'max:255']
        ]);

        if(User::where('email', $request->email)->count() > 0)
        {
            Toastr::error('Email Address '.$request->email.' already exist, try another', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect('/app/register');
        }elseif(Business::where('name', $request->business_name)->count() > 0)
        {
            Toastr::error('Business name '.$request->business_name.' already exist, try another', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect('/app/register');
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_client' => 1,
                'role_id' => 2
            ]);

            $token = $user->createToken('ucsms-ussd-onit')->plainTextToken;

            $business = Business::create([
                'name' => $request->business_name,
                'email' => $request->email,
                'secret_key' => $token,
                'is_active' => 1
            ]);

            $update_user = User::where('id', $user->id)->update([
                'business_id' => $business->id
            ]);

            $api_account = ApiAccount::create([
                'user_id' => $user->id,
                'client_id' => Hash::make($request->name),
                'client_secret' => Hash::make($request->business_name)
            ]);

            Auth::login($user);
            Toastr::success('Account created successfully', 'Welcome', ["positionClass" => "toast-top-right"]);
            return redirect('/app');
        }
    }
}
