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
        //
        try {
            $user = $this->authrepository->login($request);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e],422);
        }
        return response()->json(['success'=>$user],200);
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
        $input = $request->all();
        //todo:: need to encryption key(secret key)
        //todo:: need to handle the teacher data for batch
        //todo:: need to make a shorthand name
        $input["password"] = bcrypt($input["password"]);
        $snaked_request = Helper::changeRequestSnakeCase($input);
        try {
            $user = $this->authrepository->register($snaked_request);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e],422);
        }
        return response()->json(['success'=>$user],201);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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



