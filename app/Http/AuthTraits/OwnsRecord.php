<?php
namespace App\Http\AuthTraits;

use Illuminate\Support\Facades\Auth;

trait OwnsRecord
{
    public function userNotOwnerOf($modelRecord)
    {
        return $modelRecord->getUser() != Auth::user();
    }

    public function currentUserOwns($modelRecord)
    {
        return $modelRecord->getUser() === Auth::user();
    }

    public function adminOrCurrentUserOwns($modelRecord)
    {
        if (Auth::user()->isAdmin()){
            return true;
        }
        return $modelRecord->getUser() === Auth::user();
    }

    public function allowUserUpdate($user)
    {

        if (Auth::user()->isAdmin()){

            return true;

        }

        return $user === Auth::user();

    }

}