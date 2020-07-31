<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    protected $table = "postjob";

    protected $fillable = [
        'company_name','term','title','requirement','experience','email','last_date','address','phone_number','image',
       
    ];

}
