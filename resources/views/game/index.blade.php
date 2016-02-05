@extends('game-base', array('title' => 'Index'))

@section('content')
	@if ($question != null)
		<div>{!! $question->question !!}</div>
		@if ($tip)
			<div>{!! $question->tip !!}</div>
		@endif


		{!! Form::open(array('method' => 'POST', 'url' => '/')) !!}
			<div class="form-group">
				<label for="answer">Antwoord: </label>
				<input type="text" class="form-control" id="answer" name="answer"/>
			</div>
			<input type="submit" class="form-control"/>
		{!! Form::close() !!}
		
		@if(! $tip)
		<a class="btn btn-danger" data-toggle="modal" data-target="#tipModal">Geef een tip!</a>
		@endif

		@if ($errors->any())
			<div class="alert alert-danger" role="alert">
				@foreach ($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
	@else
		<p>klaar met het spel</p>
		<p>{{$end_time}}</p>
	@endif
@endsection

@section('modals')
	<!-- Modal -->
	<div id="tipModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Ben je zeker dat je een tip wil?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Het vragen van een tip zorgt ervoor dat jouw team een onherroepelijke straftijd krijgt van 24u!! Ben je helemaal zeker dat je een tip wilt voor deze vraag?</p>
	      </div>
	      <div class="modal-footer">
	      	{!! Form::open(array('url' => '/tip', 'method' => 'POST')) !!}
	      	<button class="btn btn-danger">Ik wil een tip!</button>
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Ik wil geen tip!</button>
	      	{!! Form::close() !!}
	        
	      </div>
	    </div>

	  </div>
	</div>
@endsection

@section('scripts')
	<script src="/js/all.js"></script>

	<script>
	$(function() {
		$("#answer").focus();
	});
	</script>
@endsection