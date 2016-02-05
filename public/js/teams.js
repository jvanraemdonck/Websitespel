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
		teams: [],
		teamsCount: 0,
		search: '',

		current: {
			id: '',
			teamname: '',
			username: '',
			avatar: '',
			color: '',
			extra_tips: '',
		}
	},

	ready: function() {
		this.fetchTeams();
	},

	methods: {
		/**
		 * fetches the questions in the current page
		 * 
		 * @param  {integer} page the current page
		 * @return {json}    questions and number of available pages
		 */
		fetchTeams: function() {
			var that  = this; // this & that

			this.$http.get('/api/v1/teams', function(teams) { // ajax to api
				that.teams = teams.teams; // get questions array from json
				that.teamsCount = teams.teamsCount; // total number of questions
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
			this.current.teamname = a.teamname;
			this.current.username = a.username;
			this.current.avatar = a.avatar;
			this.current.color = a.color;
			this.current.extra_tips = a.extra_tips;
		}
	} 
});

