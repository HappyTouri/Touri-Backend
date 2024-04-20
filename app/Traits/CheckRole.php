<?php

namespace App\Traits;

use Illuminate\Auth\Access\AuthorizationException;

trait CheckRole
{
    protected function checkRole($roles)
    {
        $user = auth()->user();

        if (!$user || !$user->hasAnyRole($roles) ) {
            throw new AuthorizationException();
        }
    }   

    protected function checkRoleAndUser($roles , $country= null)
    {
        $user = auth()->user();
        
        if($user->role != 'admin'){
            if (!$user || (!$user->hasAnyRole($roles) || (!$country || $user->country_id != $country))) {
                throw new AuthorizationException();
            }
        }
    }   
}
