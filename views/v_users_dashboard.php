<p>Pick one of your saved puzzles to resume, or start a new one.  Note: you can only have one saved puzzle per difficulty level at a time.</p>

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
				<p><a href="<?=$game['game_token']?>" class="loadGameLink spaceInlineLeft">Resume</a> <a href="/puzzles/start_puzzle/<?=$game['difficulty']?>" class="ajaxLink startNew">New</a></p>
			<?php else: ?>
				<p><span class="spaceInlineLeft">no games</span> <a href="/puzzles/start_puzzle/<?=$game?>" class="ajaxLink startNew">New</a></p>         
			<?php endif; ?>		
		<?php endforeach; ?>

	<?php else: ?>
		<p>You haven't started any puzzles yet.</p>         
	<?php endif; ?> 
</div>

<br class="clearfloat" />

<div id="results"></div>

<script type="text/javascript" src="/js/form.js"></script>
