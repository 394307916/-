<?php

include ('include_fns.php');

error_reporting( E_ALL&~E_NOTICE );

session_start();

$num = $_GET['page'];

$page = new userPage();

if($num == 1){
	$page->dispModify();
}else if($num == 2){
	$page->dispUserMessage();
}

?>