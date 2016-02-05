@extends('admin-base', array('title' => 'HHDA -- Bewerk vraag'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/questions">Vragen</a></li>
	<li><a href="/admin/questions/{{$question->id}}">Vraag {{$question->id}}</a></li>
	<li class="active">Bewerken</li>
@endsection

@section('content')
	<h1>Bewerk vraag</h1>
	<a href="/admin/questions" class="btn btn-default">Ga terug naar overzicht</a>
	<a href="/admin/questions/{{$question->id}}/answers" class="btn btn-default">Antwoorden</a>
	<hr>

	{!! Form::open(array('url' => '/admin/questions/'.$question->id, 'method' => 'PUT')) !!}
		<div class="form-group">
			<label for="question">Vraag</label>
			<textarea class="form-control" name="question" id="question">{!!$question->question!!}</textarea>
		</div>

		<div class="form-group">
			<label for="tip">Tip</label>
			<textarea class="form-control" name="tip" id="tip">{!!$question->tip!!}</textarea>
		</div>

		<div class="form-group">
			<label for="tip_alters_question"><input type="checkbox" <?php if ($question->tip_alters_question) echo "checked='checked'" ?> name="tip_alters_question" id="tip_alters_question">Tip veranderd de vraag</label>
		</div>

		<div class="form-group">
			<label for="type">Type vraag:</label>
			<select class="form-control" name="question_type" id="question_type">
				<option value="1">één</option>
				<option value="2">twee</option>
				<option value="3">drie</option>
			</select>
		</div>

		<input type="submit" class="btn btn-primary" value="Bewaar vraag"/>
		<a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Verwijder deze vraag</a>
	{!! Form::close() !!}
@endsection

@section('scripts')
	<script src="/js/ckeditor/ckeditor.js"></script>
	<script src="/js/create-question.js"></script>
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