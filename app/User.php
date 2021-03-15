<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Department;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    // , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'middle_name', 'last_name', 'email', 'password', 'code', 'department_id', 'access_room_911'
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

    // protected $dates = ['deleted_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function department() 
    {
        return $this->belongsTo(Department::class);
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }


    public function scopeSearch($q, $search){
        if ($search) {
            return $q->where(function ($query) use ($search) {
                $query->where('name', 'LIKE',"%$search%")
                ->orWhere('middle_name', 'LIKE',"%$search%")
                ->orWhere('last_name', 'LIKE',"%$search%")
                ->orWhere('id',"$search");
            });
        }
    }

    public function scopeDepartment($q, $search){
        if ($search) {
            return $q->where(function ($query) use ($search) {
                $query->where('department_id',$search);
            });
        }
    }

}
