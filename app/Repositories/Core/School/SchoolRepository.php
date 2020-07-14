<?php


namespace App\Repositories\Core\School;


use App\Models\Core\School\Ref_school;

class SchoolRepository
{
    protected $school;

    public function __construct(Ref_school $school)
    {
        $this->school =  $school;
    }

    /**
     * Retrive all the School in storage.
     * @schools
     *
     * @return
     * @schools function
     *
     */

    public function all(){
        return $this->school::all();
    }

    /**
     * Retrive all the School in according to filters
     * @filter
     *
     * @return
     * @filter function
     *
     */
    public function filter($request){
        return $this->school::where($request);
    }
    /**
     * Store all the School in according to filters
     * @store
     *
     * @return
     * @filter function
     *
     */
    public function create($request){
        return $this->school::create($request->all());
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
        return $builder->whereIn((new $this->school)->primaryKey?:'id',$ids);
    }

}
