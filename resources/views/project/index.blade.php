<!-- app/views/show.blade.php -->
@extends('layouts.master')

@section('content')
<div class="container">

    @foreach ($projects as $project)
    <!-- https://getbootstrap.com/docs/4.1/components/card/
    Header and Footer card, header div nélkül -->
    	<div class="card">
		  <div class="card-body">
		    <h5 class="card-title">{{$project->title}}</h5>
		    <p class="card-text">{{$project->owner->first()->name.' ('.$project->owner->first()->email.')'}}</p>
            <p class="card-text">{{$project->status->first()->name}}</p>
		    <!-- https://getbootstrap.com/docs/4.1/components/buttons/ -->
		    <a href="{{ route('project.show', $project->id) }}" class="btn btn-primary">Szerkesztés</a>
		    <button class="btn btn-danger" onclick="myFunction('{{$project->id}}')">Törlés</button>

		  </div>
		</div>
    @endforeach
    {{ $projects->links() }}
</div>

<script>
  function myFunction(id) {
    $.ajax({
            url: '/project/'+id,
            type: 'DELETE',
            success: function(result) {
                alert('Sikeres törlés!');
                window.location='/project'
            }
        });
  }
</script>
@stop

