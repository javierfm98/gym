<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Training extends Model
{


	 protected $fillable = [
        'id', 'user_id' , 'day' , 'start' , 'end' , 'capacity' , 'enroll' , 'description'
    ];

    protected $dates = [
        'day' , 'start' , 'end'
    ];

     protected $hidden = [
         'created_at' , 'updated_at' , 'start' , 'end' , 'day'
    ];

    protected $appends = [
        'training_time' , 'training_day'
    ];

    public function getTrainingTimeAttribute() {

        $start = (new Carbon($this->start))->format('H:i');
        $end = (new Carbon($this->end))->format('H:i');

        return $start .' - '. $end;
    }

    public function getTrainingDayAttribute() {
        return (new Carbon($this->day))->format('d/m/Y');
    }


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
