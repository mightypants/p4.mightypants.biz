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