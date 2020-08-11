<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    protected $table = "postjob";

    protected $fillable = [
        'company_name','title','term','requirement',
        'email','address','image','phone_number','user_id','last_date','experience',
       
    ];

    public function employer(){
        return $this->belongsTo('App\User', 'id');
    }

}
