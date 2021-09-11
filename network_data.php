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

$domains = R::getAll('SELECT `domain_name` FROM `domains` where id>0;');
$domain = json_encode($domains);
?>
