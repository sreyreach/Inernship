<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCv extends Model
{
    protected $table = "postcv";

    protected $fillable = [
        'pdf','title','experience','email', 'phone_number',
    ];
}
