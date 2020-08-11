<?php

namespace App\Http\Controllers\Profile\Achievement;

use App\Http\Controllers\Controller;
use App\Repositories\Profile\Achievement\AchievementRepository;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    protected $achievementRepository;

    public function __construct(AchievementRepository $achievementRepository)
    {
        $this->achievementRepository = $achievementRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id=null,Request$request)
    {
        $request->merge(['filters'=>json_decode($request->filters,true)]);
        $query_builder = $this->achievementRepository->filter($request->filters);
        if(filled($id)){
            if(!is_array($id)){
                $id=explode(',', trim($id));
            }
            $query_builder = $this->achievementRepository->getByIds($query_builder,$id);
        }
        return $query_builder->get();
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
