<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Training extends Model
{


	 protected $fillable = [
        'id', 'user_id' , 'day' , 'start' , 'end' , 'capacity' , 'enroll' , 'description'
    ];

    protected $dates = ['day' , 'start' , 'end'];


  /* public function users(){

   		return $this->belongsToMany(User::class);
   }*/

    public function reservation(){

   		return $this->hasMany(Reservation::class);
   }

    public function user(){
   		return $this->belongsTo(User::class);
   }




}
