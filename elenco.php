<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);  
        
require_once('lib/rb.php');
R::setup( 'mysql:host=127.0.0.1;dbname=pa','pa', 'pressione' );
	
$table='pressione';
$pa=R::find($table);
	
echo json_encode($pa);

?>


