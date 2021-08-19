<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
{

    protected $fillable = [
        'id' , 'user_id' , 'stat_id' , 'goal' , 'date'
    ];

    protected $hidden = [
        'created_at' , 'updated_at' , 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stat(){

        return $this->belongsTo(Stat::class);
    }
}

