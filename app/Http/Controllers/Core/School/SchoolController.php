<?php

namespace App\Http\Controllers\Core\School;

use App\Http\Controllers\Controller;
use App\Imports\importSchool;
use App\Models\Core\School\Ref_school;
use App\Repositories\Core\School\SchoolRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SchoolController extends Controller
{
    //
    protected $schoolRepository;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    /**
     * Display the specified resource.
     * @GET api/v1/school
     * @param \Illuminate\Http\Request  $request
     * @return
     */

    public function get($id=null,Request$request){
        $request->merge(['filters'=>json_decode($request->filters,true)]);
        $query_builder = $this->schoolRepository->filter($request->filters);
        if(filled($id)){
            if(!is_array($id)){
                $id=explode(',', trim($id));
            }
            $query_builder = $this->schoolRepository->getByIds($query_builder,$id);
        }
        return $query_builder->get();
    }

    /**
     * Store  the specified resource.
     * @POST api/v1/school
     * @param \Illuminate\Http\Request  $request
     * @return
     */

    public function store(Request $request){
        $this->schoolRepository->create($request);
    }

    /**
     * Upload csv the specified resource.
     * @POST api/v1/school/upload_csv
     * @param \Illuminate\Http\Request  $request
     * @return
     */

    public function upload_csv(Request $request){
        if($request->hasFile('import_file')) {
            $data = Excel::toArray(new ImportSchool, $request->file('import_file'))[0];
            foreach ($data as $datum){
               $value = [
                   "school_name" => @$datum[2],
                   "district" => @$datum[1],
                   "address" => @$datum[3],
               ];
               Ref_school::create($value);
            }
        }
    }
}
