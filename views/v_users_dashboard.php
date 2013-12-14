<p>Pick a saved game to resume, or start a new game.</p>


<?php if(!empty($recent_games)): ?> 
	<?php foreach($recent_games as $game): ?>	
		<p><?=$game['game_token']?></p>

		
	<?php endforeach; ?>

<?php else: ?>
	<p>There is no content to view at this time.  Try following some other users or adding your own posts.</p>         
<?php endif; ?> 

<div id="results"><?= $message; ?></div>

<script type="text/javascript" src="/js/form.js"></script>
