@extends('admin-base', array('title' => 'HHDA -- Questions'))

@section('crumbs')
	<li><a href="#">Dashbord</a></li>
	<li><a href="#">Questions</a></li>
	<li class="active">Data</li>
@endsection

@section('content')
	<div id="questions">

		<h1>Vragen
			<button v-on="click: showCreateForm()" class="btn btn-primary">Nieuw</button>
		</h1>
		<hr>
		

		<form method="POST" v-on="submit: saveQuestion" id="create" class="form">

			<h3>Nieuwe vraag</h3>
			<div class="form-group">
				<label for="question">Vraag:
					<span v-show="!newQuestion.question" class="form-error">*</span>
				</label>
				<input id="question" v-model="newQuestion.question" class="form-control" type="text">
			</div>
			<div class="form-group">
				<label for="tip">Tip:
					<span v-show="!newQuestion.tip" class="form-error">*</span>
				</label>
				<input id="tip" v-model='newQuestion.tip' class="form-control" type="text">
			</div>
			<div class="checkbox">
				<label><input type="checkbox" v-model="newQuestion.tip_alters_question" id="taq">Tip veranderd de vraag</label>
			</div>
			<div class="form-group">
				<label for="type">Type:</label>
				<select id="type" v-model="newQuestion.question_type" class="form-control">
					<option value="0">normal</option>
					<option value="1">item 1</option>
					<option value="2">item 2</option>
					<option value="3">item 3</option>
				</select>
			</div>

			<button type="submit" v-class="disabled: errors" v-attr="disabled: errors" class="btn btn-primary">Bewaar</button>
			<button type="button" v-on="click: discardCreateForm()" class="btn btn-warning">Annuleer</button>
		</form>

		<div class="page-navigator">
			<a class="btn btn-default" 
				v-class="disabled: page == 1"
				v-on="click: changePage(page-1, $event)">&lt;</a>
			<a class="btn btn-default"
				v-repeat="n in pages" 
				v-on="click: changePage(n+1, $event)"
				v-class="active: page == n+1">@{{ n+1 }}</a>
			<a class="btn btn-default" 
				v-class="disabled: page == pages"
				v-on="click: changePage(page+1, $event)">&gt;</a>
		</div>

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
					<td>@{{ question.sequence }}</td>
					<td>@{{ question.question }}</td>
					<td>@{{ question.tip }}</td>
					<td>@{{ question.question_type }}</td>
					<td>@{{ question.answersCount }}</td>
					<td>
						<button class="table-button btn btn-warning" v-on="click: editQuestion(question)">
							<i class="fa fa-pencil"></i>
							<span>edit</span>
						</button>
						<button class="table-button btn btn-danger" v-on="click: overview(question)">
							<i class="fa fa-trash"></i>
							<span>delete</span>
						</button>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="page-navigator">
			<a class="btn btn-default" 
				v-class="disabled: page == 1"
				v-on="click: changePage(page-1, $event)">&lt;</a>
			<a class="btn btn-default"
				v-repeat="n in pages" 
				v-on="click: changePage(n+1, $event)"
				v-class="active: page == n+1">@{{ n+1 }}</a>
			<a class="btn btn-default" 
				v-class="disabled: page == pages"
				v-on="click: changePage(page+1, $event)">&gt;</a>
		</div>

		<button v-on="click: showCreateForm()" class="btn btn-primary center-block">Nieuw</button>

		<!--pre>
			@{{ $data | json }}
		</pre-->
	</div>

	
@endsection

@section('scripts')
	<script src="/js/all.js"></script>
@endsection