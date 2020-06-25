<?php


namespace App\Repositories\Auth;


use App\Models\Auth\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Store a newly created resource in storage.
     * @createUser
     * @param  $input
     * @return \Illuminate\Http\Response
     * @register function
     *
     */

    public function create($input){
        return $this->user::create($input);
    }
}
