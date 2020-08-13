<?php


namespace App\Repositories\Profile\Experience;


use App\Helpers\Helper;
use App\Models\Profile\Experience\Experience;

class ExperienceRepository
{
    protected $experience;

    public function __construct(Experience $experience)
    {
        $this->experience = $experience;
    }

    /**
     * Retrive all the experience in according to filters
     * @filter
     *
     * @return
     * @filter function
     *
     */
    public function filter($request){
        return $this->experience->where($request);
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
        return $builder->whereIn((new $this->experience)->primaryKey?:'id',$ids);
    }
    /**
     * all experience
     * @Get
     *
     * @return
     * @GETbYiD function
     *
     */
    public function all(){
        return $this->experience::all();
    }
    /**
     * Store the experience in according to request
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
                $data = $this->experience::find($value["id"]);
                $data->update($value);
                continue;
            }
            $data = $this->experience::create($value);
        }
        if (filled($data)) {
            $id = $data->pluck('user_id')->first();
            $value = $this->experience::where('user_id','=',$id)
                        ->where('is_current','=',1);
            return response($value->get());
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
        $response = $this->experience->where("user_id",'=',$id);
        return $response->get();
    }
}
