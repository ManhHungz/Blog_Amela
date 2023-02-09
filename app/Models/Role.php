<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The users that are belong to the role
     *
     */
    public function users($id)
    {
        return $this->belongsToMany(User::class, 'roles_users', 'role_id', $id);
    }
}
