Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

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
		questions: [],
		questionsCount: 0,
		search: '',

		current: {
			id: '',
			question: '',
			tip: '',
			tip_alters_question: '',
			type: '',
		}
	},

	ready: function() {
		this.fetchQuestions();
	},

	methods: {
		/**
		 * fetches the questions in the current page
		 * 
		 * @param  {integer} page the current page
		 * @return {json}    questions and number of available pages
		 */
		fetchQuestions: function() {
			var that  = this; // this & that

			this.$http.get('/api/v1/questions', function(questions) { // ajax to api
				that.questions = questions.questions; // get questions array from json
				that.questionsCount = questions.questionsCount; // total number of questions
			});
		},

		/**
		 * Set the current active question
		 * 
		 * @param {question} q the question
		 * @param {event} e the click event
		 */
		setCurrent: function(q, e) {
			e.preventDefault();
			this.current.id = q.id;
			this.current.question = q.question;
			this.current.tip = q.tip;
			this.current.tip_alters_question = q.tip_alters_question;
			this.current.type = q.type;
		},

		/**
		 * fires a request to change the sequence of 2 records and does the view stuff as well
		 * 
		 * @param  {question} q the question
		 * @param  {int} f the direction
		 * @param  {event} e the event
		 * @return {void}
		 */
		changeSequence: function(q, f, e) {
			e.preventDefault;
			var that = this;

			var sequence = 0;

			if (f == 'up') {
				sequence = q.sequence;
			} else if (f == 'down') {
				sequence = parseInt(q.sequence) + 1;
			}

			this.$http.post('/api/v1/questions/sequence/'+sequence, function(result) {
				this.fetchQuestions();
			});
		}
	} 
});

