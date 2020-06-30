<?php


namespace App\Repositories\Auth;



use App\Helpers\Helper;
use App\Notifications\RegisterSuccessMail;
use Illuminate\Support\Facades\Auth;


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
     * @param  $request
     * @return $success
     * @register function
     *
     */

    public function register($request){
        try{
            $user = $this->userRepository->create($request);
            //todo ::  need to build a email functionality later
            //$user->notify(new RegisterSuccessMail($user->name));
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            $success["shortName"] = Helper::makeAcronym($user->name);
            return  response()->json($success,201);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e],422);
        }
    }

    /**
     * login functionality request
     * @login
     * @param  $request
     * @return $success
     * @register function
     *
     */

    public function login($request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['id'] = $user->id;
            $success['name'] = $user->name;
            $success["shortName"] = Helper::makeAcronym($user->name);
            return $success;
        }
        else{
            return response()->json(['error'=>'Unauthorised','message' => 'the requested data is invalid'], 401);
        }
    }

}
