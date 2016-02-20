<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Websitespel 2016</title>
	<meta id="timeleft" value="{{ $countDown->start_date }}" />
	<style>
		@font-face {
		    font-family: Digital;
		    src: url(fonts/SFDigitalReadout-Medium.TTF);
		}

		html, body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			//overflow-y: hidden;

			display: flex;
			justify-content: center;
			align-items: center;
			background-color: #010101;
		}

		#countdown {
			font-family: 'Digital';
			font-size: 15vw;
			color: #B9121B;
			text-shadow: 2px 2px 0.1em #B9121B;
			letter-spacing: 0.1em;
		}

	</style>
</head>
<body>
	<div>
		<h1 id="countdown"></h1>
	</div>

	<script>
		var date_future = new Date(document.querySelector('#timeleft').getAttribute('value'));
		var date_now = new Date();
		var totalSeconds = (date_future - date_now);
		var delta = Math.abs(date_future - date_now) / 1000;

		var days, hours, minutes, seconds, millis;

		function timer(time,update,complete) {
		    var start = new Date().getTime();
		    var interval = setInterval(function() {
		        var now = time-(new Date().getTime()-start);
		        if( now <= 0) {
		            clearInterval(interval);
		            complete();
		        }
		        else update(Math.floor(now/1000));
		    },1); // the smaller this number, the more accurate the timer will be
		}

		timer(
		    totalSeconds > 30000 ? 30000 : totalSeconds, // milliseconds
		    function(timeleft) { // called every step to update the visible countdown
		    	date_now = new Date();
				delta = Math.abs(date_future - date_now) / 1000;

				// calculate (and subtract) whole days
				days = Math.floor(delta / 86400);
				delta -= days * 86400;

				// calculate (and subtract) whole hours
				hours = Math.floor(delta / 3600) % 24;
				delta -= hours * 3600;

				// calculate (and subtract) whole minutes
				minutes = Math.floor(delta / 60) % 60;
				delta -= minutes * 60;

				// what's left is seconds
				seconds = Math.floor(delta % 60);

		        document.getElementById('countdown').innerHTML = addLeadingZeros(String(days),2) + ":" + addLeadingZeros(String(hours),2) + ":" + addLeadingZeros(String(minutes),2) + ":" + addLeadingZeros(String(seconds),2);

		        console.log(totalSeconds);
		    },
		    function() { // what to do after
		        location.reload();
		    }
		);

		function addLeadingZeros(sNum, len) {
		    len -= sNum.length;
		    while (len--) sNum = '0' + sNum;
		    return sNum;
		}
	</script>
</body>
</html>