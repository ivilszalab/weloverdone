<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Owner;
use App\Models\Status;

class ProjectController extends Controller
{
    // Projekt lista
    public function index()
    {
    	//$projects = DB::select('select * from projects');
    	$projects = Project::withAll()->paginate(10);
    	return view('project.index', ['projects'=> $projects]);

    }

    // Projekt űrlap
    public function show($id)
    {
    	$statuses = Status::all();
    	$project=null;
    	if ($id!=0) {
    		$project = Project::withAll()->findOrFail($id);
    	}
    	
        return view('project.show', ['project'=> $project, 'statuses'=>$statuses]);

    }

    // Projekt létrehozása
    public function create(Request $request)
    {
    	$newProject = new Project;
    	$newProject->title = $request->input('title');
    	$newProject->description = $request->input('description');
    	$newProject->save();

    	$owner = Owner::updateOrCreate(
    		['email' => $request->input('ownerEmail')],
    		['name' => $request->input('ownerName'), 'email' => $request->input('ownerEmail')],
    	);
    	$owner->projects()->attach($newProject->id); //kapcsolattartóhoz kötjük a projektet

        $status = Status::find($request->input('statusId')); //státuszhoz kötjük a projektet
        $status->projects()->attach($newProject->id);
        $projects = Project::withAll()->paginate(10); //vissza a listára
        return view('project.index', ['projects'=> $projects]);

    }

    // Projekt módosítása
    public function edit(Request $request, $id)
    {
    	$project = Project::withAll()->findOrFail($id);
        $project->title = $request->input('title');
        $project->description =$request->input('description');
        $project->save();

        $owner = Owner::updateOrCreate(
        	['email' => $request->input('ownerEmail')],
        	['name' => $request->input('ownerName'), 'email' => $request->input('ownerEmail')],
        ); // megnézzük van-e már ilyen kapcsolattartó, ha van azt módosítjuk, ha nincs akkor létrehozzuk

        $oldOwner = $project->owner->first();
        //echo $oldOwner->id.' | '.$owner->id;
        if($oldOwner->id != $owner->id) //megnézzük a régi id-ja az ownernek megegyezik-e az újjal
        {
            $oldOwner->projects()->detach($project->id); // ha változik akkor a régit leszedjük
            $owner->projects()->attach($project->id); // és hozzáadjuk az újat
        }

        $status = Status::findOrFail($request->input('statusId')); // megkeressük a státuszt
        $oldStatus = $project->status->first();
        //echo $oldStatus->id.' | '.$status->id;
        if($oldStatus->id != $status->id) // megnézzük a régi id-je a státusznak megegyezik-e az újjal
        {
            $oldStatus->projects()->detach($project->id); // ha változik akkor a régit leszedjük
            $status->projects()->attach($project->id); // és hozzákötjük az újat
        }
        $projects = Project::withAll()->paginate(10); //vissza a listára
        return view('project.index', ['projects'=> $projects]);
    }

    // Projekt törlése
    public function delete($id)
    {
    	$project = Project::withAll()->findOrFail($id);
        $owner = $project->owner->first(); //megkeressük a projekthez kapcsolódó ownert
        $owner->projects()->detach($project->id); //töröljük az adatbázisból a projekt owner kapcsolatot
        $status = $project->status->first(); //megkeressük a projekthez kapcsolódó statust
        $status->projects()->detach($project->id); // töröljük az adatbázisból a projekt status kapcsolatot
        $project->delete(); // töröljük a projektet
    }

}
