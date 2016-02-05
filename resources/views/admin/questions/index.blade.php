@extends('admin-base', array('title' => 'HHDA -- Vragen'))

@section('crumbs')
	<li><a href="/admin">Dashbord</a></li>
	<li class="active">Vragen</li>
@endsection

@section('content')
	<div id="questions">

		<h1>Vragen</h1>
		<a class="btn btn-primary" href="/admin/questions/create">Nieuwe vraag</a>
		<hr>

		<div class="form-group">
			<input type="text" class="form-control" v-model="search" placeholder="Zoek vragen">
		</div>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>Volgorde</th>
					<th>Vraag</th>
					<th>Tip</th>
					<th>Type</th>
					<th>Antwoorden</th>
					<th>Acties</th>
				</tr>
			</thead>
			<tbody>
				<tr v-repeat="question in questions | filterBy search">
					<td>
						<i v-on="click: changeSequence(question, 'up', $event)" v-if="question.sequence > 1" class="fa fa-chevron-up pointer"></i><br>
						&nbsp;@{{ question.sequence }}<br>
						<i v-on="click: changeSequence(question, 'down', $event)" v-if="question.sequence < questionsCount" class="fa fa-chevron-down pointer"></i>
					</td>
					<td>@{{ question.question }}</td>
					<td>@{{ question.tip }}</td>
					<td>@{{ question.question_type }}</td>
					<td v-class="red: question.answersCount == 0">@{{ question.answersCount }}</td>
					<td class="narrow-col">
						<a class="table-button btn btn-info" href="/admin/questions/@{{question.id}}">
							<i class="fa fa-eye"></i>
							<span>details</span>
						</a>
						<a class="table-button btn btn-warning" href="/admin/questions/@{{question.id}}/edit">
							<i class="fa fa-pencil"></i>
							<span>bewerk</span>
						</a>
						<a class="table-button btn btn-danger" v-on="click: setCurrent(question, $event)" data-toggle="modal" data-target="#deleteModal">
							<i class="fa fa-trash"></i>
							<span>verwijder</span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>

		<a class="btn btn-primary" href="/admin/questions/create">Nieuwe vraag</a>
	</div>
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
	<script src="/js/questions.js"></script>
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