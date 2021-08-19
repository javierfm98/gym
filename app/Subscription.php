<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'rate_id', 'status' , 'end_at'
    ];

    protected $dates = ['end_at'];

    protected $hidden = [
       'updated_at' , 'end_at'
    ];

    protected $appends = [
         'subs_end' 
    ];

    public function user(){
        return $this->belongsTo(User::class);
   }

    public function rate(){

        return $this->belongsTo(Rate::class);
    }

    public function getSubsEndAttribute() {
        return (new Carbon($this->end_at))->format('d/m/Y');
    }

}
