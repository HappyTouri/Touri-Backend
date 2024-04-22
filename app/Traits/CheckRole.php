<?php

namespace App\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;

trait CheckRole
{
    protected function checkRole($roles)
    {
        $user = auth()->user();

        if (!$user || !$user->hasAnyRole($roles) ) {
            throw new AuthorizationException();
        }
    }   

    protected function checkRoleAndUser($roles, $country = null)
{
    // Check if user is authenticated
    if (auth()->check()) {
        $user = auth()->user();
        // dd($user);
        // Check if the user has the 'admin' role
        if ($user->role != 'admin') {
            // Check user roles and country
            if (!$user->hasAnyRole($roles) || ($country && $user->country_id != $country)) {
                throw new AuthorizationException();
            }
        }
    } else {
        // User is not authenticated, handle the case accordingly
        throw new AuthenticationException();
    }
}
}
