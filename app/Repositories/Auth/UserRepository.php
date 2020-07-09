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

    /**
     * Retrive all the user in storage.
     * @all_users
     *
     * @return
     * @all_users function
     *
     */
    public function all_users(){
        return $this->user::all();
    }
}
