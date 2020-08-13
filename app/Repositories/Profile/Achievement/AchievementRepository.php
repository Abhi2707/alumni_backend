<?php


namespace App\Repositories\Profile\Achievement;


use App\Helpers\Helper;
use App\Models\Profile\Achievement\Achievement;

class AchievementRepository
{
    protected $achievement;

    public function __construct(Achievement $achievement)
    {
        $this->achievement = $achievement;
    }

    /**
     * Retrive all the achievement in according to filters
     * @filter
     *
     * @return
     * @filter function
     *
     */
    public function filter($request){
        return $this->achievement->where($request);
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
        return $builder->whereIn((new $this->achievement)->primaryKey?:'id',$ids);
    }
    /**
     * all achievement
     * @Get
     *
     * @return
     * @GETbYiD function
     *
     */
    public function all(){
        return $this->achievement::all();
    }
    /**
     * Store the achievement in according to request
     * @store
     *
     * @return
     * @filter function
     *
     */
    public function create($request){
        $snaked_request = Helper::multiArraySnakeCase($request);
        foreach ($snaked_request as $value){
            if (@filled($value["id"])){
                $data = $this->achievement::find($value["id"]);
                $data->update($value);
                continue;
            }
            $data = $this->achievement::create($value);
        }
        if (filled($data)) {
            return response($data->get());
        }
        return response([],201);
    }
    /**
     * Retrive all the achievement in according to userId
     * @getByUserId
     *
     * @return
     * @filter function
     *
     */
    public function findByUserId($id){
        $response = $this->achievement->where("user_id",'=',$id);
        return $response->get();
    }

}
