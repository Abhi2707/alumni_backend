<?php


namespace App\Repositories\Core\Media;


use App\Models\Core\Media\Media;

class MediaRepository
{
    protected $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
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
        return $this->media::where($request);
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
        return $builder->whereIn((new $this->media)->primaryKey?:'id',$ids);
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
        return $this->media::all();
    }
    /**
     * Store the profile in according to request
     * @store
     *
     * @return
     * @filter function
     *
     */
    public function create($request){
        if (@filled($request["id"])){
            $data = $this->media::find($request["id"]);
            $data->update($request);
        }
        else{
            $data = $this->media::create($request);
        }
        if (filled($data)) {
            return response($data);
        }
        return response([],201);
    }
}
