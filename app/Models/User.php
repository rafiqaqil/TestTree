<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
         'username',
        'phone',
         'sponsor',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    //CREATE PROFILES AFTER USER IS CREATED
     protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'name' => $user->username,
                   'email' => $user->email,
                'membership_type' => '-1',
                 'phone' => $user->phone,
                'affiliate_sponsor' => $user->sponsor,
                
            ]);
            
            \Illuminate\Support\Facades\Mail::raw('New User has been registered Username: '.$user->username.'  Phone :'. $user->phone."  email :".$user->email , function ($message){
            $message->to(env('NOTI_MAILBOX'))->subject("New User Registeration");
            });
            
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\NewUserWelcomeMail());
            
            /*
              \Illuminate\Support\Facades\Mail::raw('New User has been registered Username: '.$user->username.'  Phone :'. $user->phone."  email :".$user->email , function ($message){
            $message->to('rahman.edm5@gmail.com')->subject("New User Registeration");
            });

            //Mail::to($user->email)->send(new NewUserWelcomeMail());
             */
        });
    }
      public function payment()
    {
        return $this->hasMany(payment::class);
    }
    
    public function DM5()
    {
        return $this->hasMany(DM5tree::class);
    }
    public function DM3()
    {
        return $this->hasMany(DM3tree::class);
    }
    public function sponsor()
    {
        return $this->hasOne(sponsor::class);
    }
    
      public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
