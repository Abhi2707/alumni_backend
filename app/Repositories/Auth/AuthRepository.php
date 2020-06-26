<?php


namespace App\Repositories\Auth;


use App\Mail\RegisterMail;
use App\Notifications\RegisterSuccessMail;

class AuthRepository
{
    protected $userRepository;

    public function __construct(UserRepository $user)
    {
        $this->userRepository =  $user;
    }

    /**
     * Store a newly created resource in storage.
     * @createUser
     * @param  $input
     * @return $success
     * @register function
     *
     */

    public function createUser($input){
        $user = $this->userRepository->create($input);
        $user->notify(new RegisterSuccessMail($user->name));
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return $success;
    }

}
