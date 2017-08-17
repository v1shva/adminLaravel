<?php

namespace App\Http\Controllers\Auth;

use App\Entities\UserEntity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $em;
    public function __construct()
    {
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['is_subscribed'] = empty($data['is_subscribed']) ? 0 : 1;
        $data['terms'] = empty($data['terms']) ? 0 : 1;

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:App\Entities\UserEntity',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Entities\UserEntity
     */
    protected function create(array $data)
    {
        $data['is_subscribed'] = empty($data['is_subscribed']) ? 0 : 1;
        $user = new UserEntity(
            $data['name'],
            $data['email'],
            bcrypt($data['password']),
            10
        );
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }
}
