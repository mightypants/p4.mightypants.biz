/***********************************************************************************
ajax links
***********************************************************************************/

$.ajaxSetup ({  
    cache: false  
});  
    
var ajax_load = "<img src='images/tooltip.png' alt='loading...' />";  
      
//load() functions  
$(".ajaxLink").click(function(){  
    var loadUrl = $(this).attr('href');
    $("#contentRight").css('display','none');
	$("#contentRight").html(ajax_load).load(loadUrl);
	$("#contentRight").fadeIn('slow');

	return false;
}); 

$("#startPuzzle").click(function(){  
    var loadUrl = '/puzzles/start_puzzle';
	$("#contentRight").css('display','none');
	$("#contentRight").html(ajax_load).load(loadUrl);
	$("#contentRight").fadeIn('slow');

	return false;
}); 

$('.difficultySelect').click(function(){
	setDifficulty(this);
});

var difficulty;

var diffMap = {'easy': 0, 'medium': 1, 'hard': 2, 'vhard': 3}

function setDifficulty(btn){
	if (difficulty != null) {
		unsetDifficulty();
	}

	difficulty = diffMap[btn.id];
	btn.src = '/images/' + btn.id + '_set.png';
}

function unsetDifficulty(){
	var diffBtns = $('.difficultySelect');
	for (btn in diffBtns) {
		btn.src = '/images/' + btn.id + '.png';
			console.log(btn.id);
	}
}