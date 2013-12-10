<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="/css/styles.css" />	
	<link rel="stylesheet" type="text/css" href="/css/form.css" />	
	<link rel="stylesheet" type="text/css" href="/css/puzzle.css" />	
	<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.form.js"></script>


	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

	<div id="nav">
        <a href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/users/logout'>Logout</a>
            <a href='/users/profile'>Profile</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign up</a>
            <a href='/users/login'>Log in</a>

        <?php endif; ?>

	</div>
	<div id="wrapper">

	
	<?php if(isset($content)) echo $content; ?>
	<?php if(isset($contentLeft)) echo 
		"<div id=\"contentLeft\"> 
			$contentLeft 
		</div>"; 
	?>
	<?php if(isset($contentRight)) echo 
		"<div id=\"contentRight\"> 
			$contentRight 
		</div>
		" ; 
	?>
	<br class="clearfloat" />

	</div>

	<script type="text/javascript" src="js/utils.js"></script>


</body>
</html>