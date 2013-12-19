<p>Pick a saved game to resume, or start a new game.</p>

<div id="difficultySelection">
	<p>Easy:</p>
	<p>Medium:</p>
	<p>Hard:</p>
	<p>Run away screaming:</p>
</div>
<div id="currentGames">
	<?php if(!empty($current_games)): ?> 
		<?php foreach($current_games as $game): ?>	
			<?php if(($game != 0) && ($game != 1) && ($game != 2) && ($game != 3)): ?> 
				<p><a href="<?=$game['game_token']?>" class="loadGameLink"><?=$game['time']?></a> <a href="<?=$game['difficulty']?>" class="startNew">New</a></p>
			<?php else: ?>
				<p>no games <a href="<?=$game?>" class="startNew">New</a></p>         
			<?php endif; ?>		
		<?php endforeach; ?>

	<?php else: ?>
		<p>You haven't started any puzzles yet.</p>         
	<?php endif; ?> 
</div>

<br class="clearfloat" />

<div id="results"></div>
<input type="button" class="submitBtn" value="Start Puzzle" id="startPuzzle" />
<!--<img class="difficultySelect" id="easy" src="/images/easy.png" />
<img class="difficultySelect" id="medium" src="/images/medium.png" />
<img class="difficultySelect" id="hard" src="/images/hard.png" />
<img class="difficultySelect" id="vhard" src="/images/vhard.png" />-->

<script type="text/javascript" src="/js/form.js"></script>
