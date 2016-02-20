@extends('admin-base', array('title' => 'HHDA -- Nieuw team', 'type' => 'Team'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/teams">Teams</a></li>
	<li class="active">Nieuw</li>
@endsection

@section('content')
	<h1>Nieuw team</h1><hr>

	{!! Form::open(array('url' => '/admin/teams', 'method' => 'POST')) !!}
		<div class="form-group">
			<label for="team">Teamnaam</label>
			<input type="text" class="form-control" name="teamname" id="teamname"></input>
		</div>

		<div class="form-group">
			<label for="username">Gebruikersnaam</label>
			<input type="text" class="form-control" name="username" id="username"></input>
		</div>

		<div class="form-group">
			<label for="avatar">Avatar</label>
			<input type="text" class="form-control" name="avatar" id="avatar"></input>
		</div>

		<div class="form-group">
			<label for="color">Kleur</label>
			<select class="form-control" name="color" id="color">
				<option value="grey">Grijs</option>
				<option value="blue">Blauw</option>
				<option value="green">Groen</option>
			</select>
		</div>

		<input type="submit" class="btn btn-primary" value="Bewaar team"/>
	{!! Form::close() !!}
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
@endsection