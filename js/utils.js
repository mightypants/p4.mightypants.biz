
$.ajaxSetup ({  
    cache: false  
});  
    
var ajax_load = "<img src='/images/loading.gif' alt='loading...' />";  
      
//load() functions  
$(".ajaxLink").click(function(){  
    var loadUrl = $(this).attr('href');
	$("#contentRight").html(ajax_load).load(loadUrl);

	return false;
}); 

$("#startPuzzle").click(function(){  
    var loadUrl = '/puzzles/start_puzzle/' + difficulty;
	$("#contentRight").css('display','none');
	$("#contentRight").html(ajax_load).load(loadUrl);
	$("#contentRight").fadeIn('slow');

	return false;
});

$('.loadGameLink').click(function(){  
    var loadUrl = '/puzzles/load_game/' + $(this).attr('href');
    $("#contentRight").css('display','none');
	$("#contentRight").html(ajax_load).load(loadUrl);
	$("#contentRight").fadeIn('slow');

	return false;
});  

$('.difficultySelect').click(function(){
	setDifficulty(this);
});

var difficulty = 0;

var diffMap = {'easy': 0, 'medium': 1, 'hard': 2, 'vhard': 3}

function setDifficulty(btn){
	if (difficulty != null) {
		unsetDifficulty();
	}

	console.log(btn.id);
	difficulty = diffMap[btn.id];
	$(btn).addClass('selected');
	console.log(difficulty);

}

function unsetDifficulty(){

	var diffBtns = $('.difficultySelect');
	for (i = 0; i < diffBtns.length; i++) {
		$(diffBtns[i]).removeClass('selected');
			
	}
}

function disableBtn(btn){
	$(btn).attr("disabled", "disabled");
	$(btn).addClass('disabledBtn');
	$(btn).removeClass('puzzleBtn');
}