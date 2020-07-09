<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $authrepository;


    public function __construct(AuthRepository $AuthRepository)
    {
       $this->authrepository = $AuthRepository;

    }

    /**
     * Display the specified resource.
     * @POST api/v1/login
     * @param \Illuminate\Http\Request  $request
     * @return
     */
    public function login(LoginRequest $request)
    {
        $user = $this->authrepository->login($request);
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     * @POST api/v1/register
     * @param  \Illuminate\Http\Request  $request
     * @return
     * @register function
     * public route
     */
    public function register(RegisterFormRequest $request)
    {
        //todo:: need to encryption key(secret key)
        //todo:: need to handle the teacher data for batch
        //todo:: need to make a shorthand name
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        if(@$input["userType"]==="teacher"){
            $input = collect($input)->except('batch')->all();
        }
        $snaked_request = Helper::changeRequestSnakeCase($input);
        $user = $this->authrepository->register($snaked_request);
        return $user;

    }
    /**
     * Get all user details.
     * @POST api/v1/user_details
     * @param  \Illuminate\Http\Request  $request
     * @return
     * @user_detail function
     * private route
     */


    public function user_detail(Request $request){
        $users = $this->authrepository->all_users();
        return $users;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}



