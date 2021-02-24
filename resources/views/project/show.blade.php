<!-- app/views/show.blade.php -->
@extends('layouts.master')

@section('content')
<div class="container">

	@if($project==null)
		<form action="/project" method="post" class="needs-validation" novalidate>
		
	@else 
		<form action="/project/{{$project->id}}" method="post" class="needs-validation" novalidate>
	
	@endif
	    <div class="form-group">
	      <label for="title">Cím</label>
	      <input type="text" class="form-control" id="title" name="title" value="{{ $project!=null ? $project->title : '' }}" required>
	      <div class="valid-feedback"></div>
      	  <div class="invalid-feedback">A mező kitöltése kötelező!</div>
	    </div>

	    <div class="form-group">
	      <label for="description">Leírás</label>
	      <textarea class="form-control" rows="5" id="description" name="description" required>{{ $project!=null ? $project->description : '' }}</textarea>
	      <div class="valid-feedback"></div>
      	  <div class="invalid-feedback">A mező kitöltése kötelező!</div>
	    </div>

	    <div class="form-group">
	    	<label for="statusId">Select list:</label>
			  <select class="form-control" id="statusId" name="statusId" >
			    @foreach ($statuses as $status)
			    	@if($project!=null)
						@if($project->status->first()->id ==$status->id)
							<option selected value="{{$status->id}}">{{$status->name}}</option>
						@else 
							<option value="{{$status->id}}">{{$status->name}}</option>
						@endif
					@else 
						<option value="{{$status->id}}">{{$status->name}}</option>
					@endif
			    	
				@endforeach
			  </select>
	    </div>

	    <div class="form-group">
	      <label for="ownerName">Kapcsolattartó neve</label>
	      <input type="text" class="form-control" id="ownerName" name="ownerName" value="{{ $project!=null ? $project->owner->first()->name : '' }}" required>
	      <div class="valid-feedback"></div>
      	  <div class="invalid-feedback">A mező kitöltése kötelező!</div>
	    </div>

	    <div class="form-group">
	      <label for="ownerEmail">Kapcsolattartó e-mail címe</label>
	      <input type="text" class="form-control" id="ownerEmail" name="ownerEmail" value="{{ $project!=null ? $project->owner->first()->email : '' }}" required>
	      <div class="valid-feedback"></div>
      	  <div class="invalid-feedback">A mező kitöltése kötelező!</div>
	    </div>

	    <button type="submit" class="btn btn-primary">Mentés</button>
  	</form>
</div>
	
<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@stop

