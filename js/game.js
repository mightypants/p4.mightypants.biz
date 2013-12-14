var solution = [5,1,3,6,9,8,2,4,7,7,6,4,1,5,2,8,3,9,2,9,8,7,3,4,5,6,1,6,5,9,3,2,7,1,8,4,8,4,7,5,6,1,9,2,3,1,3,2,4,8,9,7,5,6,4,7,5,8,1,6,3,9,2,9,8,6,2,7,3,4,1,5,3,2,1,9,4,5,6,7,8];	    
var elWithFocus;
var noHintCells = $('.userCell').length;
console.log(noHintCells);
var answeredCells = 0;
var timerSeconds = 0;


/***********************************************************************************
event listeners
***********************************************************************************/

$('.userCell').click(function(){
		giveFocus(this);
});

$('body').keydown(function(){
	enterNum(event.which);
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

$('#startTimer').click(function(){
	startTimer();
});

$('#pauseTimer').click(function(){
	pauseTimer();
});
	
$('#saveGame').click(function(){
	saveGame();
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
	}

	answeredCells++;
	if (answeredCells == noHintCells) {
		checkAnswers();
	}
}

function clearCell(){
	$(elWithFocus).empty();
	$(elWithFocus).removeClass('errorCell');
	loseFocus();

	answeredCells--;
}

function clearAll(){
	$('.userCell').empty();
	$(elWithFocus).removeClass('errorCell');	
	loseFocus();

	answeredCells = 0;
}

function checkAnswers(){
	var allCells = $('.cell');

	for (i = 0; i < allCells.length; i++) {
		var cellAnswer = $('#cell' + i).text();
		
		if (cellAnswer != 0) {
			if (cellAnswer != solution[i]) {
				$('#cell' + i).addClass('errorCell');
			}
		}
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
}

function pauseTimer(){
	clearInterval(intervalHandle);
}

function saveGame(){
	var allCells = $('.cell');
	var cellAnswers = '';

	for (i = 0; i < allCells.length; i++) {
		var cellAnswer = $('#cell' + i).text();
		
		if (!cellAnswer) {
			cellAnswer = '0';
		} 

		cellAnswers += cellAnswer;
	}

	var gameID = $('#gameID').text();
	var ajax_load = "<img src='images/tooltip.png' alt='loading...' />";  
    var loadUrl = '/puzzles/save_game';
	$("#results").html(ajax_load).load(loadUrl, {time: timerSeconds, answers: cellAnswers, gameID: gameID});
	//console.log('time = ' + timerSeconds + ' seconds; answers: ' + cellAnswers);
	return false;

}
	

