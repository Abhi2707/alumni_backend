<?php

namespace App\Models\Core\Batch;

use Illuminate\Database\Eloquent\Model;

class RefBatch extends Model
{
    //
    protected $table = "ref_batch";
    protected $fillable = [
        "batch"
    ];
}
