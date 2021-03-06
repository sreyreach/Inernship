<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCv extends Model
{
    protected $table = "postcv";

    protected $fillable = [
        'pdf','title','experience','description','user_id',
    ];

    public function employees(){
        return $this->belongsTo('App\User', 'id');
    }
}
