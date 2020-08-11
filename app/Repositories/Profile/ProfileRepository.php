<?php


namespace App\Repositories\Profile;


use App\Helpers\Helper;
use App\Models\Profile\Profile;

class ProfileRepository
{
    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }
    /**
     * Retrive all the Profiles in according to filters
     * @filter
     *
     * @return
     * @filter function
     *
     */
    public function filter($request){
        return $this->profile::with('user')->where($request);
    }
    /**
     * Retrive by Ids
     * @Get
     *
     * @return
     * @GETbYiD function
     *
     */
    public function getByIds($builder,$ids){
        return $builder->whereIn((new $this->profile)->primaryKey?:'id',$ids);
    }
    /**
     * all profiles
     * @Get
     *
     * @return
     * @GETbYiD function
     *
     */
    public function all(){
        return $this->profile::all();
    }
    /**
     * Store the profile in according to request
     * @store
     *
     * @return
     * @filter function
     *
     */
    public function create($request){
        if (@filled($request["id"])){
            $data = $this->profile::find($request["id"]);
            $data->update($request);
        }
        else{
            $data = $this->profile::create($request);
        }
        if (filled($data)) {
            return response($data);
        }
        return response([],201);
    }
}
