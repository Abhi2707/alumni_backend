<?php


namespace App\Repositories\Profile\Qualification;


use App\Helpers\Helper;
use App\Models\Profile\Qualification\Qualification;

class QualificationRepository
{
    protected $qualification;

    public function __construct(Qualification $qualification)
    {
        $this->qualification = $qualification;
    }

    /**
     * Retrive all the qualification in according to filters
     * @filter
     *
     * @return
     * @filter function
     *
     */
    public function filter($request){
        return $this->qualification->where($request);
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
        return $builder->whereIn((new $this->qualification)->primaryKey?:'id',$ids);
    }
    /**
     * all qualification
     * @Get
     *
     * @return
     * @GETbYiD function
     *
     */
    public function all(){
        return $this->qualification::all();
    }
    /**
     * Store the qualification in according to request
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
                $data = $this->qualification::find($value["id"]);
                $data->update($value);
                continue;
            }
            $data = $this->qualification::create($value);
        }
        if (filled($data)) {
            return response($data->get());
        }
        return response([],201);
    }

    /**
     * Retrive all the experience in according to filters
     * @getByUserId
     *
     * @return
     * @filter function
     *
     */
    public function findByUserId($id){
        $response = $this->qualification->where("user_id",'=',$id);
        return $response->get();
    }
}
