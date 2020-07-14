<?php


namespace App\Repositories\Core\Batch;


use App\Models\Core\Batch\RefBatch;

class BatchRepository
{
    protected $batch;

    public function __construct(RefBatch $batch)
    {
        $this->batch = $batch;
    }
    /**
     * Retrive all the Batch in according to filters
     * @filter
     *
     * @return
     * @filter function
     *
     */
    public function filter($request){
        return $this->batch::where($request);
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
        return $builder->whereIn((new $this->batch)->primaryKey?:'id',$ids);
    }
    /**
     * all batches
     * @Get
     *
     * @return
     * @GETbYiD function
     *
     */
    public function all(){
        return $this->batch::all();
    }
}
