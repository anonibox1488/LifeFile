<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
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
    protected $table = "departments";

    /**
     * Fiels
     * @var [array]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Date Fiels
     * @var [array]
     */
    protected $dates = ['created_at', 'updated_at'];
    

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
