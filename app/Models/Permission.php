<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','price','guard_name'
    ];
    /**
     * The roles that are belong to the permission
     *
     */
    public function roles()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'id');
    }
}
