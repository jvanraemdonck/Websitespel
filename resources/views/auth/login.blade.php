@extends('app', array('title' => 'Login'))

@section('content')
	<div class="container">

		<div class="login" id="login">
			<h1 class="page-heading center">Inloggen</h1>

			{!! Form::open() !!}
				<div class="row">
					<div class="col-xs-10">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
								{!! Form::text('username', null, ['v-model' => 'user', 'placeholder' => 'gebruikersnaam', 'class' => 'form-control', 'required']) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
								{!! Form::password('password', ['v-model' => 'pass', 'placeholder' => 'paswoord', 'class' => 'form-control', 'required']) !!}
							</div>
						</div>
					</div>
					
					<div class="col-xs-2">
						<div class="form-group">
							<button class="form-control btn-login"
								v-class="
									btn-login--red: !allowed,
									btn-login--green: allowed">
								<span class="glyphicon glyphicon-lock" 
									v-class="
										glyphicon-lock: !allowed,
										glyphicon-ok: allowed">
								</span>
							</button>
						</div>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('remember', 'aangemeld blijven') !!}
					{!! Form::checkbox('remember', false) !!}
				</div>
			{!! Form::close() !!}
		</div>

		@if ($errors->any())
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
@endsection