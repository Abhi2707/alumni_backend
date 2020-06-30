<?php


namespace App\Repositories\Auth;



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
        $user = $this->userRepository->create($request);
        //todo ::  need to build a email functionality later
        //$user->notify(new RegisterSuccessMail($user->name));
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return $success;
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
            $success['userName'] = $user->first_name;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

}
