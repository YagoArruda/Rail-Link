<?php

session_start();

$uid = $_SESSION['uid'];

$url = "https://api.mihomo.me/sr_info_parsed/$uid?lang=en";

header('Content-Type: application/json');

echo file_get_contents($url);

?>