@extends('admin-base', array('title' => 'HHDA -- Toon team', 'type' => 'Team'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/teams">Teams</a></li>
	<li class="active">Team {{$team->id}}</li>
@endsection

@section('content')
	<h1>Team</h1><hr>

	<div class="form-group">
		<label>Teamnaam</label>
		<div>{{$team->teamname}}</div>
	</div>

	<div class="form-group">
		<label>Gebruikersnaam</label>
		<div>{{$username}}</div>
	</div>

	<div class="form-group">
		<label>avatar</label>
		<div><img src="{{$team->avatar}}" alt="{{$team->teamname}} avatar"></div>
	</div>

	<div class="form-group">
		<label>Kleur</label>
		<div>{{$team->color}}</div>
	</div>

	@if (session('password') != "")
	<div class="form-group">
		<label>Paswoord</label>
		<div>{{session('password')}}</div>
	</div>
	@endif

	{!! Form::open(array('url' => '/admin/teams/'.$team->id.'/reset', 'method' => 'POST')) !!}
		<input type="submit" class="btn btn-primary" value="Reset paswoord" />
	{!! Form::close() !!}

	<a href="/admin/teams" class="btn btn-default">Ga terug naar overzicht</a><br>
	<a href="/admin/teams/{{$team->id}}/edit" class="btn btn-warning">Bewerk dit team</a>
	<a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Verwijder dit team</a><br>
	
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