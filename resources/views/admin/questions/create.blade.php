@extends('admin-base', array('title' => 'HHDA -- Nieuwe vraag'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/questions">Vragen</a></li>
	<li class="active">Nieuw</li>
@endsection

@section('content')
	<h1>Nieuwe vraag</h1><hr>

	{!! Form::open(array('url' => '/admin/questions', 'method' => 'POST')) !!}
		<div class="form-group">
			<label for="question">Vraag</label>
			<textarea class="form-control" name="question" id="question"></textarea>
		</div>

		<div class="form-group">
			<label for="tip">Tip</label>
			<textarea class="form-control" name="tip" id="tip"></textarea>
		</div>

		<div class="form-group">
			<label for="tip_alters_question"><input type="checkbox" name="tip_alters_question" id="tip_alters_question">Tip veranderd de vraag</label>
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
	{!! Form::close() !!}
@endsection

@section('scripts')
	<script src="/js/ckeditor/ckeditor.js"></script>
	<script src="/js/create-question.js"></script>
	<script src="/js/all.js"></script>
@endsection