<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	
	<link rel="stylesheet" type="text/css" href="/css/project4.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Vampiro+One' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

					
	<!-- Controller Specific JS/CSS -->
	<!--<?php if(isset($client_files_head)) echo $client_files_head; ?>-->

	
</head>

<body>	

	<!--<?php if(isset($content)) echo $content; ?>-->

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	<div id='menu'>

		<a href='/'>Home&nbsp;&nbsp;&nbsp;</a>

		<?php if($user): ?>

			<a href='/users/logout'>Logout&nbsp;&nbsp;&nbsp;</a>
			<a href='/users/profile'>Profile&nbsp;&nbsp;&nbsp;</a>
			<a href='/posts'>See your Recipes&nbsp;&nbsp;&nbsp;</a>
			<a href='/posts/add'>Add a Recipe!</a>

		<?php else: ?>

			<a href='/users/signup'>Sign up&nbsp;&nbsp;&nbsp;</a>
			<a href='/users/login'>Log in</a>
		<?php endif; ?>

	</div>

	<br>

	<?php if(isset($content)) echo $content; ?>
	<script src="/js/project4.js"></script>
</body>
</html>