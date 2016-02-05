@extends('admin-base', array('title' => 'HHDA -- Antwoorden'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/questions">Vragen</a></li>
	<li><a href="/admin/questions/{{$qId}}">Vraag {{$qId}}</a></li>
	<li class="active">Antwoorden</li>
@endsection

@section('content')
	<div id="answers">

		<h1>Antwoorden</h1>
		<a class="btn btn-primary" href="/admin/questions/{{$qId}}/answers/create">Nieuw antwoord</a>
		<hr>

		<div class="form-group">
			<input type="text" class="form-control" v-model="search" placeholder="Zoek antwoorden">
		</div>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>Antwoord</th>
					<th>Acties</th>
				</tr>
			</thead>
			<tbody>
				<tr v-repeat="answer in answers | filterBy search">
					<td>@{{ answer.answer }}</td>
					<td>
						<a class="table-button btn btn-info" href="/admin/questions/{{$qId}}/answers/@{{answer.id}}">
							<i class="fa fa-eye"></i>
							<span>details</span>
						</a>
						<a class="table-button btn btn-warning" href="/admin/questions/{{$qId}}/answers/@{{answer.id}}/edit">
							<i class="fa fa-pencil"></i>
							<span>bewerk</span>
						</a>
						<a class="table-button btn btn-danger" v-on="click: setCurrent(answer, $event)" data-toggle="modal" data-target="#deleteModal">
							<i class="fa fa-trash"></i>
							<span>verwijder</span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
	<script src="/js/answers.js"></script>
@endsection

@section('modals')
	<!-- Modal -->
	<div id="deleteModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Dit antwoord verwijderen?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Ben je zeker dat je dit antwoord wil verwijderen?</p>
	      </div>
	      <div class="modal-footer">
	      	{!! Form::open(array('url' => '/admin/questions/'.$qId.'/answers/@{{current.id}}', 'method' => 'DELETE')) !!}
	      	<button class="btn btn-danger">Verwijderen</button>
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
	      	{!! Form::close() !!}
	        
	      </div>
	    </div>

	  </div>
	</div>
@endsection