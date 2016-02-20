@extends('admin-base', array('title' => 'HHDA -- Team Answers', 'type' => 'TeamAnswers'))

@section('crumbs')
	<li class="active">Team antwoorden</li>
@endsection

@section('content')
	<div id="answers">
		
	</div>
@endsection

@section('scripts')
	<script src="/js/all.js"></script>

	<script>
		new Vue({
			el: '#answers', 

			data: {
				answers: []
			},

			ready: function() {
				
			},

			methods: {
				
			} 
		})
	</script>
@endsection

/*

this.$http.get('/api/v1/answers/'+qId, function(answers) { // ajax to api
						that.answers = answers.answers; // get questions array from json
						that.answersCount = answers.answersCount; // total number of questions
					});
 */