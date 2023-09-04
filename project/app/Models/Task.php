<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'project_id',
        'description',
        'due_date',
        'status'
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function ProjectInfo()
    {
        return $this->belongsTo('App\Models\Project','project_id','id');
    }
}
