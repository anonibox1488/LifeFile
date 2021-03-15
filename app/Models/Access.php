<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    /**
     * $primaryKey
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * Table
     * @var string
     */
    protected $table ="access";
    
    /**
     * Fiels
     * @var [array]
     */
    protected $fillable = [
        'department_id', 'user_id', 'access', 'code'
    ];

    /**
     * Date Fiels
     * @var [array]
     */
    protected $dates = ['created_at', 'updated_at'];


    public function department() 
    {
        return $this->belongsTo(Department::class);
    }

    public function User() 
    {
        return $this->belongsTo(User::class);
    }

    public function GetAccessAttribute($value)
    {
        return $this->attributes['access'] = ($value) ? 'Allowed': 'Denied';
    }

}
