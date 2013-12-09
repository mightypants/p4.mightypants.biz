/***********************************************************************************
ajax links
***********************************************************************************/

$.ajaxSetup ({  
    cache: false  
});  
    
var ajax_load = "<img src='images/tooltip.png' alt='loading...' />";  
      
//load() functions  
$("a").click(function(){  
    var loadUrl = $(this).attr('href');
	$("#contentRight").html(ajax_load).load(loadUrl);
	return false;
}); 

$("#startPuzzle").click(function(){  
    var loadUrl = '/puzzles/start_puzzle';
	$("#contentRight").html(ajax_load).load(loadUrl);
	return false;
}); 