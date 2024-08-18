<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider){

        return Socialite::driver($provider)->redirect();

    }
    public function callback($provider){

        $socialUser = Socialite::driver($provider)->user();
        // dd($socialUser);
        $user=User::UpdateOrCreate([
            "email" => $socialUser->email,
        ],[
            "name" => $socialUser->name,
            "nickname" => $socialUser->nickname,
            "provider_id" => $socialUser->id,
            "provider_token" => $socialUser->token,
            "provider" => $provider
        ]);
        Auth::login($user);
        if(Auth::user()->role == "admin"){
             return to_route('adminDashboard');
        }else{
            return to_route('userDashboard');
        }

    }
}
