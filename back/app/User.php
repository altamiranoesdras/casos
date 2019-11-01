<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles,SoftDeletes;

    protected $with = ['permissions'];

    protected $appends = ['all_permissions','text'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password','empresa_id','oficina_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)->orWhere('username', $identifier)->first();
    }

    public static $rules = [
        'name'     => 'required|max:255',
        'username' => 'sometimes|required|max:255|unique:users',
        'email'    => 'required|email|max:255',
//        'password' => 'required|min:6|confirmed',
    ];


    public function getAllPermissionsAttribute()
    {
        return $this->getAllPermissions();
    }

    public function getTextAttribute()
    {
        return $this->name;
    }
}
