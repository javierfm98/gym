<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements JWTSubject  /*implements MustVerifyEmail*/
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname' , 'phone' , 'role_id' , 'username' , 'photo_id' , 'registration_token' , 'payment_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at' , 'created_at' , 'updated_at' , 'photo_id' , 'registration_token'/* , 'payment_status' */
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){

        return $this->belongsTo(Role::class);
    }

    public function trainings(){
        
        return $this->hasMany(Training::class);
    }

    public function reservation(){

        return $this->hasMany(Reservation::class);
    }

    public function body(){

        return $this->hasMany(Body::class);
    }

    public function photo(){

        return $this->belongsTo(Photo::class);
    }

    public function subscription(){
        return $this->hasMany(Subscription::class);
    }

    
    public function scopeClients($query){
        return $query->where('role_id' , 3);
    }

    public function scopeTrainers($query){
        return $query->where('role_id' , 2);
    }

     public function scopeName($query , $name){
       if($name){
            return $query->where('name' , 'LIKE' , "%$name%");
       }
    }

    public function hasRole(array $roles){

       foreach ($roles as $role) {
           if($this->role->name === $role){
                return true;
           }
       }

       return false;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
