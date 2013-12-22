<a href="/" class="confirmNavigate">Go Back</a>
<div id="puzzle"><?= $puzzle_cells; ?>
	<div id="hidePuzzle"><p id="puzzleMsg">Start</p></div>
	<div id="winMsg">PUZZLE SOLUTION'D!</div>
</div>

<div id="console">
	<div id="timer">:</div>
	<input type="button" id="pauseBtn" class="puzzleBtn" value="Start" />
    <input type="button" id="clearCell" class="puzzleBtn" value="Clear Cell" />
    <input type="button" id="clearAll" class="puzzleBtn" value="Clear All" />
	<input type="button" id="checkAnswers" class="puzzleBtn" value="Check Answers" />    
    <input type="button" id="saveGame" class="puzzleBtn" value="Save" />
</div>


<br class="clearfloat" />
<div id="results"></div>


<script type="text/javascript" src="/js/game.js"></script>
