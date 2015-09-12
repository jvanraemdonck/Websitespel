new Vue({
	'el': '#login',

	'data': {
		'user': '',
		'pass': ''
	},

	'computed': {
		allowed: function() {
			if (this.user != '' && this.pass != '')
				return true;
			else
				return false;
		}
	}
})

