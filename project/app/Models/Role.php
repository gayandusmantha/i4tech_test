<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'type',
        'name',
        'guard_name'
    ];

    protected $with = [
        'permissions',
    ];
    protected $hidden = ['updated_at', 'updated_at'];
}
