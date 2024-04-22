<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $appends = ['unseenOffers'];
    function reservations()
    {
        // return $this->hasMany(Reservation::class);
    }
    function rule()
    {
        return $this->belongsTo(Rule::class);
    }
    function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function getUnseenOffersAttribute()
    {
        if ($this->role == 'admin') {
            return Offer::where('admin_seen_at', null)->get();
        } elseif ($this->role == 'operator') {
            return Offer::where('operator_seen_at', null)->get();
        }

        return null; // Return null if the user is not an admin
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'role',
        'country_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'remember_token',
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function hasAnyRole($roles)
    {
        return in_array($this->role, (array) $roles);
    }


}
