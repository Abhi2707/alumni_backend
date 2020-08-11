<?php

namespace App\Models\Profile\Achievement;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    //
    protected $table = 'achievements';

    protected $fillable = [
        'user_id',
        'name',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
