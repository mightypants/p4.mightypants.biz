var solution = [5,1,3,6,9,8,2,4,7,7,6,4,1,5,2,8,3,9,2,9,8,7,3,4,5,6,1,6,5,9,3,2,7,1,8,4,8,4,7,5,6,1,9,2,3,1,3,2,4,8,9,7,5,6,4,7,5,8,1,6,3,9,2,9,8,6,2,7,3,4,1,5,3,2,1,9,4,5,6,7,8];	    
var elWithFocus;
var timerSeconds = 0;
var pauseKey = 1;



/***********************************************************************************
event listeners
***********************************************************************************/

$('.userCell').click(function(){
	giveFocus(this);
});

$('body').keydown(function(){
	enterNum(event.which);
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
		59: 9
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

function clearCell(){
	$(elWithFocus).empty();
	$(elWithFocus).removeClass('errorCell');
	loseFocus();
}

function clearAll(){
	$('.userCell').empty();
	$('.userCell').removeClass('errorCell');	
	loseFocus();
}

function checkAnswers(remaining){
	cellAnswers = collectAnswers();

	var ajax_load = "<img src='images/tooltip.png' alt='loading...' />";  
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
	$('#hidePuzzle').hide();

}

function pauseTimer(){
	clearInterval(intervalHandle);
	$('#hidePuzzle').show();
	loseFocus();
}

function saveGame(complete){
	
	cellAnswers = collectAnswers();

	var ajax_load = "<img src='images/tooltip.png' alt='loading...' />";  
    var loadUrl = '/puzzles/save_game';
	
	$("#results").html(ajax_load).load(loadUrl, {time: timerSeconds, answers: cellAnswers, complete: complete});
	return false;
}

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


function toggleStartPause() {
	if (pauseKey == 0) {
		pauseTimer();
		$('#pauseBtn').val('Resume');
		pauseKey = 1;
	}
	else {
		startTimer();
		$('#pauseBtn').val('Pause');
		pauseKey = 0;		
	}
}

function puzzleComplete(){
	console.log('you did it');
	pauseTimer();
	saveGame('yes');

}
	

