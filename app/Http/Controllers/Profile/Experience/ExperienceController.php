<?php

namespace App\Http\Controllers\Profile\Experience;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Repositories\Profile\Experience\ExperienceRepository;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    protected $experienceRepository;
    public function __construct(ExperienceRepository $experienceRepository)
    {
        $this->experienceRepository = $experienceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function get($id=null,Request $request)
    {
        //
        $response = $this->experienceRepository->findByUserId($id);
        return $this->successResponse(Helper::customResponseCamelCase($response),'Get experiences By User Id',200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
