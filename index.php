<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);  
        
	REF: http://www.redbeanphp.com/index.php
	require_once('lib/rb.php');
	R::setup( 'mysql:host=127.0.0.1;dbname=pa','pa', 'pressione' );
	
	$pg=(empty($_REQUEST['p'])) ? 'home' : $_REQUEST['p'];
	$pg='pgs/'.$pg.'.php';

?>
<!doctype html>
<html lang="it">
	<head>
            <meta charset="utf-8" />
            
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/af-2.1.3/datatables.min.css"/>
            
		<title>Pressione Arteriosa</title>
	</head>
	<body>
		<?php if (file_exists($pg)) include_once($pg); ?>
            <footer>
             <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
             <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/af-2.1.3/datatables.min.js"></script>
            </footer>
	</body>
        
</html>