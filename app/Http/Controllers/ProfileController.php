<?php

namespace App\Http\Controllers;

use App\Http\AuthTraits\OwnsRecord;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use App\Entities\ProfileEntity;
use App\Entities\UserEntity;
use Redirect;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Exceptions\UnauthorizedException;

class ProfileController extends Controller
{
    use OwnsRecord;
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->middleware('auth');
        $this->middleware('admin',['only'=> 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $profiles = Profile::paginate(10);
        return view('profile.index', compact('profiles'));

    }

    public function determineProfileRoute()
    {

        $profileExists = $this->profileExists();

        if ($profileExists){

            return Redirect::route('show-profile');

        }

        return view('profile.create');

    }

    public function showProfileToUser()
    {
        $profile =  $this->em->getRepository(ProfileEntity::class)->findOneBy(["user" => Auth::user()]);;

        if( ! $profile){

            return Redirect::route('profile.create');

        }

        $user = $profile->getUser();

        if ($this->userNotOwnerOf($profile)){

            throw new UnauthorizedException;

        }

        return view('profile.show', compact('profile', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $profileExists = $this->profileExists();

        if ($profileExists){

            return Redirect::route('show-profile');

        }

        return view('profile.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $this->validate($request, ['first_name' => 'required|alpha_num|max:20',
                                   'last_name' => 'required|alpha_num|max:20',
                                   'gender' => 'boolean|required',
                                   'birthdate' => 'date|required']);

        $profileExists = $this->profileExists();

        if ($profileExists){

            return Redirect::route('show-profile');

        }
        $profile = new ProfileEntity(
            Auth::user(),
            $request->first_name,
            $request->last_name,
            $request->gender,
            $request->birthdate);

        $this->em->persist($profile);
        $this->em->flush();
        $user = $profile->getUser();

        return view('profile.show', compact('profile', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $profile =  $this->em->getRepository(ProfileEntity::class)->find($id);;

        $user = $profile->getUser();

        if( ! $this->adminOrCurrentUserOwns($profile)){

            throw new UnauthorizedException;

        }

        return view('profile.show', compact('profile', 'user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $profile =  $this->em->getRepository(ProfileEntity::class)->find($id);;

        if ( ! $this->adminOrCurrentUserOwns($profile)){

            throw new UnauthorizedException;

        }

        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|alpha_num|max:20',
            'last_name' => 'required|alpha_num|max:20',
            'gender' => 'boolean|required',
            'birthdate' => 'date|required'
        ]);
        $profile =  $this->em->getRepository(ProfileEntity::class)->find($id);;

        if ($this->userNotOwnerOf($profile)) {

            throw new UnauthorizedException;

        }
        $profile->setFirstName($request->first_name);
        $profile->setLastName($request->last_name);
        $profile->setGender($request->gender);
        $profile->setBirthDate($request->birthdate);
        $this->em->merge($profile);
        $this->em->flush();
        return Redirect::route('profile.show', ['profile' => $profile->getId()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $profile =  $this->em->getRepository(ProfileEntity::class)->find($id);;

        if ($this->userNotOwnerOf($profile)){

            throw new UnauthorizedException;

        }
        $this->em->remove($profile);
        $this->em->flush();

        if (Auth::user()->isAdmin()){
            return Redirect::route('profile.index');
        }
        return Redirect::route('home');

    }

    /**
     * @return mixed
     */

    private function profileExists()
    {
        $profile =  $this->em->getRepository(ProfileEntity::class)->findBy(["user" => Auth::user()]);;
        if($profile) $profileExists = true;
        else $profileExists = false;
        return $profileExists;

    }

}