<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'id' , 'training_id' , 'user_id' 
    ];

    public function training(){
    	
    	return $this->belongsTo(Training::class);
    }

     public function user(){
        return $this->belongsTo(User::class);
    }
}
