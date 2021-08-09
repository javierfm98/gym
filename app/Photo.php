<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'route'
    ];

    protected $hidden = [
        'created_at' , 'updated_at' ,
    ];
}
