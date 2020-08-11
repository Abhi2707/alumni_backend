<?php

namespace App\Models\Profile\Qualification;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    //
    protected $table = "qualifications";

    protected $fillable = [
        'user_id',
        'name',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
