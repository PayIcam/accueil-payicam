var clock;
			
$(document).ready(function() {
	// Set dates.
	var futureDate  = new Date("October 4, 2018 18:30:00");
	var currentDate = new Date();

	// Calculate the difference in seconds between the future and current date
	var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

	// Calculate day difference and apply class to .clock for extra digit styling.
	function dayDiff(first, second) {
		return (second-first)/(1000*60*60*24);
	}

	if (dayDiff(currentDate, futureDate) < 100) {
		$('.clock').addClass('twoDayDigits');
	} else {
		$('.clock').addClass('threeDayDigits');
	}

	if(diff < 0) {
		diff = 0;
	}

	// Instantiate a coutdown FlipClock
	clock = $('.clock').FlipClock(diff, {
		clockFace: 'DailyCounter',
		countdown: true
	});
});