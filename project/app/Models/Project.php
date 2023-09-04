<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'description'
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function TaskInfo()
    {
        return $this->hasMany('App\Models\Task','project_id','id');
    }
}
