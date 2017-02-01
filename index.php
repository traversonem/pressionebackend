<?php 
	//REF: http://www.redbeanphp.com/index.php
	require_once('lib/rb.php');
	R::setup( 'mysql:host=127.0.0.1;dbname=pa','pa', 'pressione' );
	
	$pg=(empty($_REQUEST['p'])) ? 'home' : $_REQUEST['p'];
	$pg='pgs/'.$pg.'.php';

?>
<!doctype html>
<html lang="it">
	<head>
		<meta charset="utf8" />
		<title>Pressione Arteriosa</title>
	</head>
	<body>
		<? if (file_exists($pg)) include_once($pg); ?>
	</body>
</html>