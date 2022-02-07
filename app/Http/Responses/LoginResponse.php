<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $userRole = User::where('email',$request->email)->first();
        $redirect_url = '/dashboard';
//        if($userRole->role_id == 2){
//            $redirect_url = '/dashboard';
//        }elseif($userRole->role_id == 1){
//            $redirect_url = '/change_password';
//        }
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($redirect_url);
    }

} ?>
