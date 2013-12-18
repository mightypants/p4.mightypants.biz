<p>Pick a saved game to resume, or start a new game.</p>


<?php if(!empty($completed_games)): ?> 
	<?php foreach($completed_games as $game): ?>	
		<p><?=$game['game_token']?></p>

		
	<?php endforeach; ?>

<?php else: ?>
	<p>There is no content to view at this time.  Try following some other users or adding your own posts.</p>         
<?php endif; ?> 

<div id="results"></div>
<input type="button" class="submitBtn" value="Start Puzzle" id="startPuzzle" />
<img class="difficultySelect" id="easy" src="/images/easy.png" />
<img class="difficultySelect" id="medium" src="/images/medium.png" />
<img class="difficultySelect" id="hard" src="/images/hard.png" />
<img class="difficultySelect" id="vhard" src="/images/vhard.png" />

<script type="text/javascript" src="/js/form.js"></script>
