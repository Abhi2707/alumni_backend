<?php


namespace App\Http\Controllers\Profile;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Media\MediaController;
use App\Http\Requests\Profile\ProfileRequest;
use App\Repositories\Profile\Achievement\AchievementRepository;
use App\Repositories\Profile\Experience\ExperienceRepository;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Profile\Qualification\QualificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    protected $profileRepository;
    protected $achievementsRepository;
    protected $experienceRepository;
    protected $qualificationRepository;
    protected $mediaController;

    public function __construct(ProfileRepository $profileRepository,AchievementRepository $achievementRepository,ExperienceRepository $experienceRepository,QualificationRepository $qualificationRepository,MediaController $mediaController)
    {
        $this->profileRepository = $profileRepository;
        $this->achievementsRepository = $achievementRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->experienceRepository = $experienceRepository;
        $this->mediaController = $mediaController;
    }

    public function bootstrap(){
        return response(['success' => true],200);
    }

    /**
     * Display the specified resource.
     * @GET api/v1/profile
     * @param \Illuminate\Http\Request  $request
     * @return
     */

      public function get($id=null,Request$request){
        $request->merge(['filters'=>json_decode($request->filters,true)]);
        $query_builder = $this->profileRepository->filter($request->filters);
        if(filled($id)){
            if(!is_array($id)){
                $id=explode(',', trim($id));
            }
            $query_builder = $this->profileRepository->getByIds($query_builder,$id);
        }
        /*return collect($query_builder->get())->map(function ($item,$key) { return collect($item)
            ->flatMap(function ($item1,$key1) { return [Str::camel($key1)=>$item1];});});*/
          return Helper::customResponseCamelCase($query_builder->get());
      }

    /**
     * Store a profile of logged in user resource in storage.
     * @POST api/v1/profile
     * @param  \Illuminate\Http\Request  $request
     * @return
     * @store function
     * public route
     */
    public function store(ProfileRequest $request){
        $input = $request->all();
        if (@filled($input["profileImage"])) {
            $image_data = $this->mediaController->store($input["profileImage"],$type="profile")->getData(true);
            $input["profileImageUrl"] =  $image_data["data"]["url"];
            $input["profileImageId"] =  $image_data["data"]["id"];
        }
        if (@filled($input["coverImage"])) {
            $image_data = $this->mediaController->store($input["coverImage"],$type="cover")->getData(true);
            $input["coverImageUrl"] =  $image_data["data"]["url"];
            $input["coverImageId"] =  $image_data["data"]["id"];
        }
        if (@filled($input["experiences"])){
            $input["currentWorkStatus"] = collect(json_decode($this->experienceRepository->create($input["experiences"])->content(),true))->first();
            $input["currentWorkStatus"] = Helper::changeResponseCamelCase($input["currentWorkStatus"]);
        }
        else{
            $input["current_experience"] = [];
        }
        if (@filled($input["qualifications"])){
            $input["qualifications"] = collect(json_decode($this->qualificationRepository->create($input["qualifications"])->content(),true))->first();
            $input["qualifications"] = Helper::changeResponseCamelCase($input["qualifications"]);
        }
        if (@filled($input["achievements"])){
            $input["achievements"] = collect(json_decode($this->achievementsRepository->create($input["achievements"])->content(),true))->first();
            $input["achievements"] = Helper::changeResponseCamelCase($input["achievements"]);
        }
        $snaked_request = Helper::changeRequestSnakeCase($input);
        $response = json_decode($this->profileRepository->create($snaked_request)->getContent(),true);
        $response = Helper::changeResponseCamelCase($response);
        return $this->successResponse($response,'created',201);
    }
}
