@extends('admin-base', array('title' => 'HHDA -- Bewerk team', 'type' => 'Team'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/teams">Teams</a></li>
	<li><a href="/admin/teams/{{$team->id}}">Team {{$team->id}}</a></li>
	<li class="active">Bewerken</li>
@endsection

@section('content')
	<h1>Bewerk Team</h1>
	<a href="/admin/teams" class="btn btn-default">Ga terug naar overzicht</a>
	<hr>

	{!! Form::open(array('url' => '/admin/teams/'.$team->id, 'method' => 'PUT')) !!}
		<div class="form-group">
			<label for="teamname">Teamnaam</label>
			<input type="text" class="form-control" name="teamname" id="teamname" value="{!!$team->teamname!!}"></input>
		</div>

		<div class="form-group">
			<label for="username">Gebruikersnaam</label>
			<input type="text" class="form-control" name="username" id="username" value="{!!$username!!}"></input>
		</div>

		<div class="form-group">
			<label for="avatar">Avatar</label>
			<input type="text" class="form-control" name="avatar" id="avatar" value="{!!$team->avatar!!}"></input>
		</div>

		<div class="form-group">
			<label for="type">Kleur:</label>
			<select class="form-control" name="color" id="color" value="{{$team->color}}">
				<option value="grey">Grijs</option>
				<option value="blue">Blauw</option>
				<option value="green">Groen</option>
			</select>
		</div>

		<input type="submit" class="btn btn-primary" value="Bewaar team"/>
		<a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Verwijder dit team</a>
	{!! Form::close() !!}
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
@endsection

@section('modals')
	<!-- Modal -->
	<div id="deleteModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Dit team verwijderen?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Ben je zeker dat je dit team wil verwijderen?</p>
	      </div>
	      <div class="modal-footer">
	      	{!! Form::open(array('url' => '/admin/teams/'.$team->id, 'method' => 'DELETE')) !!}
	      	<button class="btn btn-danger">Verwijderen</button>
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
	      	{!! Form::close() !!}
	        
	      </div>
	    </div>

	  </div>
	</div>
@endsection