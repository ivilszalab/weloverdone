<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
use App\Models\Owner;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['title', 'description'];

    // Projekthez tartozó státusz(ok)
    public function status()
    {
        return $this->belongsToMany(Status::class,'project_status_pivot');
    }

    // Projekthez tartozó kapcsolattartó
    public function owner()
    {
        return $this->belongsToMany(Owner::class,'project_owner_pivot');
    }

    // Ezzel az létrejön egy withAll függvény amivel a Project model összes kapcsolatát le lehet kérdezni
    public function scopeWithAll($query) 
    {
        $query->with('status','owner');
    }
}
