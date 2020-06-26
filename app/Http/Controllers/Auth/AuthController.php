<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Mail\RegisterMail;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    protected $authrepository;
    protected $registerFormRequest;

    public function __construct(AuthRepository $AuthRepository,RegisterFormRequest $registerFormRequest)
    {
       $this->authrepository = $AuthRepository;
       $this->registerFormRequest = $registerFormRequest;
    }
    /**
     * Store a newly created resource in storage.
     * @POST api/v1/register
     * @param  \Illuminate\Http\Request  $request
     * @return
     * @register function
     * public route
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $validateRequest = $this->registerFormRequest($input);
        dd($validateRequest);
        //todo:: need to encryption key(secret key)
        //todo:: need to handle the teacher data for batch
        //todo:: need to make a shorthand name
        $input["password"] = bcrypt($input["password"]);
        $snaked_request = Helper::changeRequestSnakeCase($input);
        try {
            $user = $this->authrepository->createUser($snaked_request);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e],422);
        }
        return response()->json(['success'=>$user],201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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



