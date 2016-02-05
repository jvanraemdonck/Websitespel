@extends('admin-base', array('title' => 'HHDA -- Nieuw antwoord'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li><a href="/admin/questions">Vragen</a></li>
	<li><a href="/admin/questions/{{$qId}}">Vraag {{$qId}}</a></li>
	<li><a href="/admin/questions/{{$qId}}/answers">Antwoorden</a></li>
	<li class="active">Nieuw</li>
@endsection

@section('content')
	<h1>Nieuw antwoord</h1><hr>

	{!! Form::open(array('url' => '/admin/questions/'.$qId.'/answers', 'method' => 'POST')) !!}
		<div class="form-group">
			<label for="answers">Antwoord</label>
			<input type="text" class="form-control" name="answer" id="answer"></input>
		</div>

		<input type="submit" class="btn btn-primary" value="Bewaar antwoord"/>
	{!! Form::close() !!}
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
@endsection