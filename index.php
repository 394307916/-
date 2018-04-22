<?php

include ('include_fns.php');

error_reporting( E_ALL&~E_NOTICE );

session_start();

$page = new indexPage();

$page->dispIndex();

?>
