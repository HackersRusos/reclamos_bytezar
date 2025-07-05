<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $redirectUrl = auth()->user()?->is_admin
            ? route('reclamos.admin')
            : route('dashboard');

        return redirect()->intended($redirectUrl);
    }
}
