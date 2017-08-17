<?php

namespace App\Http\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use App\Entities\UserEntity;
use Illuminate\Support\Facades\Auth;
use Redirect;

class SettingsController extends Controller
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->middleware('auth');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit()
    {

        $user = Auth::user();
        return view('settings.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */

    public function update(Request $request)
    {

        $id = Auth::user()->getId();

        $this->validate($request, [
            'name' => 'required|max:20',
            'email' => 'required|email|max:255|unique:App\Entities\UserEntity,email,'. $id,
            'is_subscribed' => 'boolean'
        ]);

        $user = Auth::user();
        $user->setName($request->name);
        $user->setEmail($request->email);
        $user->setIsSubscribed($request->is_subscribed);
        $this->em->merge($user);
        $this->em->flush();

        return redirect()->action('SettingsController@edit', [$user->getId()]);

    }
}