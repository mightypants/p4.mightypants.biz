var solution = [5,1,3,6,9,8,2,4,7,7,6,4,1,5,2,8,3,9,2,9,8,7,3,4,5,6,1,6,5,9,3,2,7,1,8,4,8,4,7,5,6,1,9,2,3,1,3,2,4,8,9,7,5,6,4,7,5,8,1,6,3,9,2,9,8,6,2,7,3,4,1,5,3,2,1,9,4,5,6,7,8];	    
var elWithFocus;



/***********************************************************************************
event listeners
***********************************************************************************/

$('.userCell').click(function(){
		console.log('clicked');
		giveFocus(this);
		//console log working but focus not
});

$('body').keydown(function(){
	enterNum(event.which);
	console.log('key pressed');

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
	
$('#process-btn').click(function() {
	$.ajax({
	    type: 'POST',
	    url: 'process.php',
	    success: function(response) { 
	        // Enject the results received from process.php into the results div
	        $('#results').html(response);
	    },
	    data: {
	        name: $('#name').val(),
	    },
	}); // end ajax setup
});

function giveFocus(el){
	if (elWithFocus != null) {
		loseFocus();
	}
	
	elWithFocus = el;
	$(el).css('background-color', 'eef0ff');	
}

function loseFocus(){
	$(elWithFocus).css('background-color', 'ffffff');
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
}

function clearCell(){
	$(elWithFocus).empty();
	$(elWithFocus).removeClass('errorCell');
	loseFocus();
}

function clearAll(){
	$('.userCell').empty();
	$(elWithFocus).removeClass('errorCell');	
	loseFocus();
}

function checkAnswers(){
	var allCells = $('.cell');
	var userAnswers = [];

	for (i = 0; i < allCells.length; i++) {
		var cellAnswer = $('#cell' + i).text();
		
		if (cellAnswer != 0) {
			if (cellAnswer != solution[i]) {
				$('#cell' + i).addClass('errorCell');
			}
		}
	}
}
		

