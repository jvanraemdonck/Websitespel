Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

var notinavdown = false;
var messanavdown = false;
var profilenavdown = false;
$('.has-sub').click(function() {
	if ($(this).hasClass('down')) {
		$(this).find('.items').fadeOut({queue: false, duration: 100}).animate({top: "+=20", queue: false}, 100);
		$(this).removeClass('down');
	} else {
		$(this).siblings('.down').removeClass('down').find('.items').fadeOut({queue: false, duration: 100}).animate({top: "+=20", queue: false}, 100);

		$(this).find('.items').fadeIn({queue: false, duration: 100}).animate({top: "-=20", queue: false}, 100);
		$(this).addClass('down');
	}
});

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
	el: '#questions', 

	data: {
		questions: [],
		pages: 0,
		page: 1,
		search: '',

		newQuestion: {
			id: -1,
			question: '',
			tip: '',
			tip_alters_question: false,
			question_type: ''
		}
	},

	ready: function() {
		this.fetchQuestions(this.page);
		$('#create').hide();
	},

	computed: {
		errors: function() {
			if (this.newQuestion.question == '' ||
				this.newQuestion.tip == '' ||
				this.newQuestion.question_type == '')
				return true;
			return false;
		}
	},

	methods: {
		/**
		 * fetches the questions in the current page
		 * 
		 * @param  {integer} page the current page
		 * @return {json}    questions and number of available pages
		 */
		fetchQuestions: function(page) {
			var that  = this; // this & that

			this.$http.get('/api/v1/questions/page/'+page, function(questions) { // ajax to api
				that.questions = questions.questions; // get questions array from json
				that.pages = questions.pages; // get pages integer from json
			});
		},

		/**
		 * changes the currently selected page
		 * 
		 * @param  {integer} n new selected page
		 * @param  {event} e the click event
		 * @return {void}
		 */
		changePage: function(n, e) {
			e.preventDefault(); // prevent the default action
			this.page = n; // set the new selected page

			this.fetchQuestions(this.page); // fetch the new page rows
		},

		/**
		 * Show the create new question form
		 * 
		 * @return {void} 
		 */
		showCreateForm: function() {
			this.resetForm();

			$('#create').slideDown();
			$("html, body").animate({ scrollTop: $('#create').offset().top }, 200);
		},

		/**
		 * Hide the create new question form and set the field to default values
		 * 
		 * @return {void}
		 */
		discardCreateForm: function() {
			var that = this;
			$('#create').slideUp("fast", function() {
				that.resetForm();
			});
		},

		/**
		 * Gets all the fields from the form and sends an ajax post to the server
		 * to create a new question. after that it sets the fields back to the defaults
		 * and refreshes the table. the page is set to the last page so the user can immedeatly
		 * see the new record that has been created.
		 * 
		 * @param  {event} e the form submit event
		 * @return {void}
		 */
		saveQuestion: function(e) {
			var that = this;

			e.preventDefault();
			var data = this.newQuestion;

			if (data.id == -1) {
				this.$http.post('/api/v1/questions', data, function() {
					that.page = that.pages;
					if (that.questions.length == 10)
						that.page++;
					
					that.fetchQuestions(that.page);
				});
			} else {
				this.$http.put('/api/v1/questions/'+data.id, data, function() {
					that.fetchQuestions(that.page);
				});
			}

			$('#create').slideUp("fast", function() {
				that.resetForm();
			});
		},

		editQuestion: function(q) {
			this.newQuestion.id = q.id;
			this.newQuestion.question = q.question;
			this.newQuestion.tip = q.question;
			this.newQuestion.tip_alters_question = q.tip_alters_question;
			this.newQuestion.question_type = q.question_type;

			$('#create').slideDown();
			$("html, body").animate({ scrollTop: $('#create').offset().top }, 200);
		},

		overviewQuestion: function(q) {
			this.newQuestion.id = q.id;
			this.newQuestion.question = q.question;
			this.newQuestion.tip = q.question;
			this.newQuestion.tip_alters_question = q.tip_alters_question;
			this.newQuestion.question_type = q.question_type;
		},

		/**
		 * Set the form fields back to the defaults
		 * 
		 * @return {void}
		 */
		resetForm: function() {
			this.newQuestion.id = -1;
			this.newQuestion.question = '';
			this.newQuestion.tip = '';
			this.newQuestion.tip_alters_question = false;
			this.newQuestion.question_type = '';
		}
	} 
});

