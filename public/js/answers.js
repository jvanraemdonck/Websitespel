var mainnavdown = false;
$('#main-nav-ham').click(function() {
	if (!mainnavdown) {
		$('#main-nav').slideDown();
		mainnavdown = true;
	} else {
		$('#main-nav').slideUp();
		mainnavdown = false;
	}
});

$.mCustomScrollbar.defaults.scrollButtons.enable=true;
$.mCustomScrollbar.defaults.axis="y";
$('.scroll').mCustomScrollbar({
    theme:"minimal-dark"
});

/** questions vue instance */
/** ---------------------- */
new Vue({
	el: 'body', 

	data: {
		answers: [],
		answersCount: 0,
		qId: 0,
		search: '',

		current: {
			id: '',
			answer: ''
		}
	},

	ready: function() {
		this.qId = window.location.pathname.split( '/' )[3];
		this.fetchAnswers(this.qId);
	},

	methods: {
		/**
		 * fetches the questions in the current page
		 * 
		 * @param  {integer} page the current page
		 * @return {json}    questions and number of available pages
		 */
		fetchAnswers: function(qId) {
			var that  = this; // this & that

			this.$http.get('/api/v1/answers/'+qId, function(answers) { // ajax to api
				that.answers = answers.answers; // get questions array from json
				that.answersCount = answers.answersCount; // total number of questions
			});
		},

		/**
		 * Set the current active question
		 * 
		 * @param {question} q the question
		 * @param {event} e the click event
		 */
		setCurrent: function(a, e) {
			e.preventDefault();
			this.current.id = a.id;
			this.current.answer = a.answer;
		}
	} 
});

