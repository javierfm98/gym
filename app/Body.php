<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Body extends Model
{

    protected $fillable = [
        'id' , 'user_id' , 'stat_id' , 'value'  , 'date'
    ];

    protected $hidden = [
        'created_at' , 'updated_at' , 'date'
    ];

    protected $dates = [
        'date'
    ];

    protected $appends = [
        'date_format' , 'date_beauty_format'
    ];

    public function getDateFormatAttribute() {
        return (new Carbon($this->date))->format('Y-m-d');
    }

    public function getDateBeautyFormatAttribute() {
        return (new Carbon($this->date))->format('d/m/Y');
    }
 
 

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stat(){

        return $this->belongsTo(Stat::class);
    }
}

