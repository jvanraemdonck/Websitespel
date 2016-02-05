@extends('admin-base', array('title' => 'HHDA -- Bewerk vraag'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/questions">Vragen</a></li>
	<li class="active">Vraag {{$question->id}}</li>
@endsection

@section('content')
	<h1>Vraag {{$question->sequence}}</h1><hr>

	<div class="form-group">
		<label for="question">Vraag</label>
		<div>{!!$question->question!!}</div>
	</div>

	<div class="form-group">
		<label for="tip">Tip</label>
		<div>{!!$question->tip!!}</div>
	</div>

	<div class="form-group">
		<label>Tip veranderd de vraag:&nbsp;</label><?php if ($question->tip_alters_question == true) echo "Ja"; else echo "Neen"; ?>
	</div>

	<div class="form-group">
		<label for="type">Type vraag:&nbsp;</label><?=$question->question_type?>
	</div>

	<a href="/admin/questions" class="btn btn-default">Ga terug naar overzicht</a>
	<a href="/admin/questions/{{$question->id}}/answers" class="btn btn-default">Antwoorden</a><br>
	<a href="/admin/questions/{{$question->id}}/edit" class="btn btn-warning">Bewerk deze vraag</a>
	<a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Verwijder deze vraag</a><br>
	
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
	        <h4 class="modal-title">Deze vraag verwijderen?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Ben je zeker dat je deze vraag wil verwijderen?</p>
	      </div>
	      <div class="modal-footer">
	      	{!! Form::open(array('url' => '/admin/questions/@{{current.id}}', 'method' => 'DELETE')) !!}
	      	<button class="btn btn-danger">Verwijderen</button>
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
	      	{!! Form::close() !!}
	        
	      </div>
	    </div>

	  </div>
	</div>
@endsection