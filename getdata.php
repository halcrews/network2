<?php
require 'assets/rb.php';
R::setup( 'mysql:host=localhost;dbname=test', 'root', '' );
//R::fancyDebug(TRUE);

if(!R::testConnection()){
    die('Не удалось подключиться к базе!');
}

$jsondata = file_get_contents('php://input');//Принимаем json с машины
$jsondata_dec = json_decode($jsondata, true);



$pc = R::dispense('pc');
R::exec("ALTER TABLE `pc` ADD UNIQUE(`pcid`);");

if (isset($jsondata_dec['network_data'])) {
    $array_length = count($jsondata_dec['network_data']);
    for ($i = 0; $i < $array_length; ++$i) {
        $pc->pcid = base64_decode($jsondata_dec['network_data'][$i]['pcid']);
        $pc->net_architect = base64_decode($jsondata_dec['network_data'][$i]['net_architect']);
        $pc->os_version = base64_decode($jsondata_dec['network_data'][$i]['os_version']);
        $pc->domain_name = base64_decode($jsondata_dec['network_data'][$i]['domain_name']);
        $pc->pc_role = base64_decode($jsondata_dec['network_data'][$i]['pc_role']);
        $pc->user_name = base64_decode($jsondata_dec['network_data'][$i]['user_name']);
        $pc->pc_name = base64_decode($jsondata_dec['network_data'][$i]['pc_name']);
        $pc->ram = base64_decode($jsondata_dec['network_data'][$i]['ram']);
        $pc->proc = base64_decode($jsondata_dec['network_data'][$i]['proc']);
        $pc->os_language = base64_decode($jsondata_dec['network_data'][$i]['os_language']);
        $pc->proccesses_list = base64_decode($jsondata_dec['network_data'][$i]['proccesses_list']);
        $pc->servicies_list = base64_decode($jsondata_dec['network_data'][$i]['servicies_list']);
        $pc->disks = base64_decode($jsondata_dec['network_data'][$i]['servicies_list']);
        $pc->net_topology = base64_decode($jsondata_dec['network_data'][$i]['net_topology']);
        $pc->bin_list = base64_decode($jsondata_dec['network_data'][$i]['bin_list']);
        R::store($pc);
    }
}

$domains = R::dispense('domains');
R::exec("ALTER TABLE `domains` ADD UNIQUE(`domain_name`);");
if (isset($jsondata_dec['network_data'])) {
    $array_length = count($jsondata_dec['network_data']);
    for ($i = 0; $i < $array_length; ++$i) {
        $domains->domain_name = base64_decode($jsondata_dec['network_data'][$i]['domain_name']);
        R::store($domains);
    }
}