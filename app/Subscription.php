<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'rate_id', 'status' , 'end_at'
    ];

    protected $dates = ['end_at'];

    public function user(){
        return $this->belongsTo(User::class);
   }

    public function rate(){

        return $this->belongsTo(Rate::class);
    }
}
