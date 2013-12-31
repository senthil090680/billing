<?php
//To get URL of current page.

$currentworkingdomain = $_SERVER['SERVER_NAME'];

$currentworkingdomain = 'http://'.$currentworkingdomain;

echo $currentworkingdomain;

?>