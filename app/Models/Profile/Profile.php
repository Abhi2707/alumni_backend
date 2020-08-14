<?php

namespace App\Models\Profile;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $table = 'profiles';
    protected $casts = [
        'current_work_status' => 'json',
        'phone_number1' => 'json'  ,
        'phone_number2' => 'json'
    ];

    protected $fillable = [
        'user_id',
        'gender',
        'cover_image_url',
        'profile_image_url',
        'current_location',
        'current_work_status',
        'date_of_birth',
        'phone_number1',
        'phone_number2',
        'cover_image_id',
        'profile_image_id',
        'joined_in_year',
        'left_in_year'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
