/***********************************************************************************
global variables and initializers
***********************************************************************************/
var elWithFocus;
var timerSeconds = 0;
var pauseKey = 1;
var puzzleCompleted = false;
var cookies = document.cookie;

//get time for saved games
$.post('/puzzles/get_time',function(response){
		if (response > 0) {
			timerSeconds = response;
		}
});	

//disable save button when no player logged in
regPlayerToken = /[^_]token/;
if (!regPlayerToken.test(cookies)) {
	disableBtn($('#saveGame'));
}

window.onbeforeunload = function() {
    if(!puzzleCompleted) {
    	return "If you leave now, you'll lose any unsaved progress and be very sad.  :(";
    }
}


/***********************************************************************************
event listeners
***********************************************************************************/

$('.userCell').click(function(){
	giveFocus(this);
});

$(document).keydown(function(e){
	var keyID = (window.event) ? event.which : e.keyCode;
	enterNum(keyID);
	checkRemainingCells();
});

$('#clearCell').click(function(){
	clearCell();
});

$('#clearAll').click(function(){
	clearAll();
});

$('#checkAnswers').click(function(){
	checkAnswers();
});

$('#pauseBtn').click(function(){
	toggleStartPause();
});
	
$('#saveGame').click(function(){
	saveGame('no');
});

$('#hidePuzzle').click(function(){
	$(this).fadeOut();
	toggleStartPause();
});

//$('.disabledBtn').hover(function(){
//	$('#results').text('You must be logged in to save your progress.')
//});

/***********************************************************************************
focus handlers
***********************************************************************************/

function giveFocus(el){
	if (elWithFocus != null) {
		loseFocus();
	}
	
	elWithFocus = el;
	$(el).addClass('focusCell');
}

function loseFocus(){
	$(elWithFocus).removeClass('focusCell');
	elWithFocus = null;
}


/***********************************************************************************
keyboard entry
***********************************************************************************/

function mapKeys(keyID) {
	keyMap = {
		49: 1,
		50: 2,
		51: 3,
		52: 4,
		53: 5,
		54: 6,
		55: 7,
		56: 8,
		57: 9
	}
	
	if (keyID in keyMap) {
		return keyMap[keyID];
	}
}

function enterNum(keyPressed){
	var numkeyPressed = mapKeys(keyPressed);

	if (numkeyPressed) {
		$(elWithFocus).text(numkeyPressed);
		$(elWithFocus).removeClass('errorCell');
	}

}


/***********************************************************************************
clear answers, current cell or all cells
***********************************************************************************/

function clearCell(){
	$(elWithFocus).empty();
	$(elWithFocus).removeClass('errorCell');
	loseFocus();
}

function clearAll(){
	confirmed = warnClearCells();

	if(confirmed) {
		$('.userCell').empty();
		$('.userCell').removeClass('errorCell');	
		loseFocus();
	}
}

function warnClearCells() {
	return confirm('Are you sure you want to clear ALL your answers?  You worked so hard for those.');
}


/***********************************************************************************
check answers
***********************************************************************************/

//for use with checkAnswers and saveGame
function collectAnswers() {
	var allCells = $('.cell');
	var cellAnswers = '';

	for (i = 0; i < allCells.length; i++) {
		var cellAnswer = $('#cell' + i).text();
		
		if (!cellAnswer) {
			cellAnswer = '0';
		} 

		cellAnswers += cellAnswer;
	}

	return cellAnswers;
}

function checkAnswers(remaining){
	cellAnswers = collectAnswers();

	var ajax_load = "<img src='images/loading.gif' alt='loading...' />";  
    var loadUrl = '/puzzles/check_answers';
	$.post(loadUrl, {answers: cellAnswers}, function(response){
		responseArray = JSON.parse(response);
		showErrors(responseArray, remaining);
	});	
}

function checkRemainingCells(){
	remainingCells = 0;
	allUserCells = $('.userCell')
	
	for (i = 0; i < allUserCells.length; i++) {
		if($(allUserCells[i]).text() == ''){
			remainingCells++;
		}
	}

	if (remainingCells == 0) {
		checkAnswers(remainingCells);
	}
	
}

function showErrors(results, remaining){
	var errorCells = 0;
	
	for (i = 0; i < 81; i++) {
		if (results[i] == 0) {
			$('#cell' + i).addClass('errorCell');
			errorCells++;
		}
	}

	if (errorCells == 0 && remaining == 0) {
		puzzleComplete();
	}
}


/***********************************************************************************
timer functions
***********************************************************************************/

function tick(){
	timerSeconds++;

	var min = Math.floor(timerSeconds / 60);
	var sec = timerSeconds - (min * 60);

	if (sec < 10) {
		sec = '0' + sec;
	}

	var readout = min.toString() + ':' + sec;

	$('#timer').text(readout);
}

function startTimer(){
	intervalHandle = setInterval(tick, 1000)

}

function pauseTimer(){
	clearInterval(intervalHandle);
	loseFocus();
}

function toggleStartPause() {
	if (pauseKey == 0) {
		pauseTimer();
		$('#pauseBtn').val('Resume');
		$('#puzzleMsg').text('Resume');
		$('#hidePuzzle').show();
		pauseKey = 1;
	}
	else {
		startTimer();
		$('#pauseBtn').val('Pause');
		$('#hidePuzzle').hide();
		pauseKey = 0;		
	}
}


/***********************************************************************************
save game
***********************************************************************************/

function saveGame(complete){
	cellAnswers = collectAnswers();
    var loadUrl = '/puzzles/save_game';
	
	$("#results").load(loadUrl, {time: timerSeconds, answers: cellAnswers, complete: complete});
	
	setTimeout(function(){
		$('#results').empty();
	}, 3000);
	return false;
}

function puzzleComplete(){
	pauseTimer();
	saveGame('yes');
	$('#winMsg').css('display','block');

	//redirect to dash after completion
	puzzleCompleted = true;
	setTimeout(function(){
		window.location.href = '/users/dashboard';
	}, 3000);
}
	



