<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class CustomRegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $role = $request->user()->roles;

        if ($role === 'ADMIN') {
            return redirect('/admin/dashboard');
        }

        return redirect('/dashboard');
    }
}
