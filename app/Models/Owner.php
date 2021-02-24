<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'owners';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'email'];
    protected $hidden = ['pivot'];
    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_owner_pivot'); //összekötjük az ownert a projektekkel
    }
}
