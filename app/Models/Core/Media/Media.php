<?php

namespace App\Models\Core\Media;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'media';

    protected $casts = [
      'meta' => 'json',
      'tags' => 'json'
    ];

    protected $fillable = [
        'name',
        'title',
        'meta',
        'tags',
        'mime_type',
        'size',
        'hash',
        'url'
    ];


}
