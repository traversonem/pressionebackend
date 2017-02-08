<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('lib/rb.php');
R::setup('mysql:host=127.0.0.1;dbname=pa', 'pa', 'pressione');

$table = 'temperatura';

$record = (empty($_REQUEST['id'])) ? R::dispense($table) : R::load($table, intval($_REQUEST['id']));
try {
    if ($record && !empty($_REQUEST['act']) && $_REQUEST['act'] == 'del')
        R::trash($record);

//                if(!empty($_REQUEST['act']) && $_REQUEST['act']=="new"){
//                    //die(print_r(json_decode(file_get_contents('php://input'), true),1));
//                    $new = json_decode(file_get_contents('php://input'),true);
//                }

    $new = json_decode(file_get_contents('php://input'), true);

    if (!empty($new)) {
        foreach ($new as $k => $v) {
            $record[$k] = $new[$k];
        }
        //die(print_r($new,1));
        R::store($record);
    }
} catch (RedBeanPHP\RedException\SQL $e) {
    ?>
    <h4 class="msg label error">
    <?= $e->getMessage() ?>
    </h4>
    <?php
}


$pa = R::find($table);

echo json_encode($pa);


?>