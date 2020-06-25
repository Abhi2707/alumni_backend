<?php


namespace App\Repositories\Auth;


use App\Mail\RegisterMail;

class AuthRepository
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user =  $user;
    }

    /**
     * Store a newly created resource in storage.
     * @createUser
     * @param  $input
     * @return
     * @register function
     *
     */

    public function createUser($input){
        $user = $this->user->create($input);
        //TODO :: need to fix this for email
        //$user->notify(new RegisterMail($user->name));
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return $success;
    }

}
