<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
    protected $table = "roles";

    /**
     * Fiels
     * @var [array]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Date Fiels
     * @var [array]
     */
    protected $dates = ['created_at', 'updated_at'];

    /**  */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
