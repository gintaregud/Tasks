<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $fillable = ['task_name', 'task_description', 'status_id'];

    public function Status()
    {
        return $this->hasMany('App\Status');
    }
}
