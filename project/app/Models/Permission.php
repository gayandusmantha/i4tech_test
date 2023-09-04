<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
class Permission extends SpatieRole
{
    use HasFactory;
    protected $table = 'permissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'type',
        'guard_name',
        'name',
        'description',
        'parent_id',
        'sort'
    ];
    protected $hidden = ['updated_at', 'updated_at'];
}
