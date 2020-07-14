<?php

namespace App\Http\Controllers\Core\Batch;

use App\Http\Controllers\Controller;
use App\Repositories\Core\Batch\BatchRepository;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    //
    protected $batchRepository;

    public function __construct(BatchRepository $batchRepository)
    {
        $this->batchRepository = $batchRepository;
    }

    /**
     * Display the specified resource.
     * @GET api/v1/batch
     * @param \Illuminate\Http\Request  $request
     * @return
     */

    public function get($id=null,Request$request){
        $request->merge(['filters'=>json_decode($request->filters,true)]);
        $query_builder = $this->batchRepository->filter($request->filters);
        if(filled($id)){
            if(!is_array($id)){
                $id=explode(',', trim($id));
            }
            $query_builder = $this->batchRepository->getByIds($query_builder,$id);
        }
        return $query_builder->get();
    }

}
