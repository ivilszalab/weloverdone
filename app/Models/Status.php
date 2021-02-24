<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = ['pivot'];
    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_status_pivot'); //a státuszt összekötjük a projektekkel
    }
}
