<?php

namespace App\Http\Controllers\Core\Media;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Core\Media\MediaRequest;
use App\Http\Requests\Profile\ProfileRequest;
use App\Repositories\Core\Media\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    //
    protected $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Display the specified resource.
     * @GET api/v1/profile
     * @param \Illuminate\Http\Request  $request
     * @return
     */

    public function get($id=null,Request$request){
        $request->merge(['filters'=>json_decode($request->filters,true)]);
        $query_builder = $this->mediaRepository->filter($request->filters);
        if(filled($id)){
            if(!is_array($id)){
                $id=explode(',', trim($id));
            }
            $query_builder = $this->mediaRepository->getByIds($query_builder,$id);
        }
        return $query_builder->get();
    }


    /**
     * Store a profile of logged in user resource in storage.
     * @POST api/v1/profile
     * @return
     * @store function
     * public route
     */
    public function store($string,$image_type){
        $base64_image = "data:image/jpeg;base64, $string";
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);
            $pos  = strpos($base64_image, ';');
            $type = explode(':', substr($base64_image, 0, $pos))[1];
            $data = base64_decode($data);
            $name = Str::random(6);
            if ($image_type === "profile"){
                Storage::disk('local')->put('profile/'.$name.'.'.Str::afterLast($type,'/'),$data);
                $url = Storage::disk('local')->url($name);
            }
            elseif ($image_type === "cover"){
                Storage::disk('local')->put('cover/'.$name.'.'.Str::afterLast($type,'/'),$data);
                $url = Storage::disk('local')->url($name);

            }
            else{
                Storage::disk('local')->put('other/'.$name.'.'.Str::afterLast($type,'/'),$data);
                $url = Storage::disk('local')->url($name);
            }

        }
        $input = ["name" => $name,'url' => $url,'mime_type'=> Str::afterLast($type,'/')];
        $snaked_request = Helper::changeRequestSnakeCase($input);
        $response = json_decode($this->mediaRepository->create($snaked_request)->getContent(),true);
        $response = Helper::changeResponseCamelCase($response);
        return $this->successResponse($response,'created',201);
    }

}
