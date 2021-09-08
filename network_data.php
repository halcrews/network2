<?php
require 'assets/rb.php';
R::setup( 'mysql:host=localhost;dbname=test', 'root', '' );


if(!R::testConnection()){
    die('Не удалось подключиться к базе!');
}


$cursor = R::getCursor('SELECT * FROM `pc` INNER JOIN `domains` ON `pc`.`domain_name` = `domains`.`domain_name`;');

while($row = $cursor->getNextItem()){
    $arr[] = $row;
}
$json_response = json_encode($arr);
?>
