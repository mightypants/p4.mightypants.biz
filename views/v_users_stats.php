<div>
<h3><?= $user; ?>'s stats</h3>
<a class="smallLink2" href="/users/logout">log out</a>

<h4>Easy</h4>
<p class="stat"><span class="spaceInlineLeft">Average:</span> <span class="spaceInlineRight"><?=$average[0]; ?></span></p> 
<p class="stat"><span class="spaceInlineLeft">Best:</span> <span class="spaceInlineRight"><?=$best[0]; ?></span></p> 

<h4>Medium</h4> 
<p class="stat"><span class="spaceInlineLeft">Average:</span> <span class="spaceInlineRight"><?=$average[1]; ?></span></p> 
<p class="stat"><span class="spaceInlineLeft">Best:</span> <span class="spaceInlineRight"><?=$best[1]; ?></span></p> 

<h4>Hard</h4> 
<p class="stat"><span class="spaceInlineLeft">Average:</span> <span class="spaceInlineRight"><?=$average[2]; ?></span></p> 
<p class="stat"><span class="spaceInlineLeft">Best:</span> <span class="spaceInlineRight"><?=$best[2]; ?></span></p> 

<h4>Run away screaming</h4> 
<p class="stat"><span class="spaceInlineLeft">Average:</span> <span class="spaceInlineRight"><?=$average[3]; ?></span></p> 
<p class="stat"><span class="spaceInlineLeft">Best:</span> <span class="spaceInlineRight"><?=$best[3]; ?></span></p> 


<script type="text/javascript" src="/js/form.js"></script>
</div>