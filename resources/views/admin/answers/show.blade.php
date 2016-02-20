@extends('admin-base', array('title' => 'HHDA -- Bewerk antwoord', 'type' => 'Antwoord'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/questions">Vragen</a></li>
	<li><a href="/admin/questions/{{$qId}}">Vraag {{$qId}}</a></li>
	<li><a href="/admin/questions/{{$qId}}/answers">Antwoorden</a></li>
	<li class="active">Antwoord @{{answer.id}}</li>
@endsection

@section('content')
	<h1>Antwoord {{$answer->id}}</h1><hr>

	<div class="form-group">
		<label for="question">Antwoord</label>
		<div>{{$answer->answer}}</div>
	</div>

	<a href="/admin/questions/{{$qId}}/answers" class="btn btn-default">Ga terug naar overzicht</a>
	<a href="/admin/questions/{{$qId}}/answers/{{$answer->id}}/edit" class="btn btn-warning">Bewerk dit antwoord</a>
	<a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Verwijder dit antwoord</a><br>
	
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
	        <h4 class="modal-title">Dit antwoord verwijderen?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Ben je zeker dat je dit antwoord wil verwijderen?</p>
	      </div>
	      <div class="modal-footer">
	      	{!! Form::open(array('url' => '/admin/questions/'.$qId.'/answers/'.$answer->id, 'method' => 'DELETE')) !!}
	      	<button class="btn btn-danger">Verwijderen</button>
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
	      	{!! Form::close() !!}
	        
	      </div>
	    </div>

	  </div>
	</div>
@endsection