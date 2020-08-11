<?php

namespace App\Models\Profile\Experience;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    protected $table = 'experiences';

    protected $fillable = [
        'user_id',
        'from_year',
        'to_year',
        'company_name',
        'designation',
        'is_current',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
