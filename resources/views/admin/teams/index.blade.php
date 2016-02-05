@extends('admin-base', array('title' => 'HHDA -- Teams'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li class="active">Teams</li>
@endsection

@section('content')
	@if (session('csv') != "")
		<?php $csv = session('csv'); $csv->output('hhd_teams.csv'); ?>
	@endif

	<div id="teams">

		<h1>Teams</h1>
		<a class="btn btn-primary" href="/admin/teams/create">Nieuw team</a>
		<hr>

		<div class="form-group">
			<input type="text" class="form-control" v-model="search" placeholder="Zoek teams">
		</div>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>Teamnaam</th>
					<th>Username</th>
					<th>Avatar</th>
					<th>Kleur</th>
					<th>Extra tips</th>
					<th>Acties</th>
				</tr>
			</thead>
			<tbody>
				<tr v-repeat="team in teams | filterBy search">
					<td>@{{ team.teamname }}</td>
					<td>@{{ team.username }}</td>
					<td>@{{ team.avatar }}</td>
					<td>@{{ team.color }}</td>
					<td>@{{ team.extra_tips }}</td>
					<td class="narrow-col">
						<a class="table-button btn btn-info" href="/admin/teams/@{{team.id}}">
							<i class="fa fa-eye"></i>
							<span>details</span>
						</a>
						<a class="table-button btn btn-warning" href="/admin/teams/@{{team.id}}/edit">
							<i class="fa fa-pencil"></i>
							<span>bewerk</span>
						</a>
						<a class="table-button btn btn-danger" v-on="click: setCurrent(team, $event)" data-toggle="modal" data-target="#deleteModal">
							<i class="fa fa-trash"></i>
							<span>verwijder</span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>

		<a class="btn btn-danger" data-toggle="modal" data-target="#resetModal">Reset ALL Passwords</a>
		<a class="btn btn-primary" href="/admin/teams/create">Nieuw team</a>
	</div>
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
	<script src="/js/teams.js"></script>
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
	      	{!! Form::open(array('url' => '/admin/teams/@{{current.id}}', 'method' => 'DELETE')) !!}
	      	<button class="btn btn-danger">Verwijderen</button>
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
	      	{!! Form::close() !!}
	        
	      </div>
	    </div>

	  </div>
	</div>

	<div id="resetModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Alle paswoorden resetten?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Ben je zeker dat je alle paswoorden wil resetten? Alle huidige paswoorden zullen worden verwijderd!!!!!</p>
	      </div>
	      <div class="modal-footer">
	      	{!! Form::open(array('url' => '/admin/teams/resetPasswords', 'method' => 'POST')) !!}
	      	<button class="btn btn-danger">Resetten</button>
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
	      	{!! Form::close() !!}
	        
	      </div>
	    </div>

	  </div>
	</div>
@endsection