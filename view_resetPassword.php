<?php

error_reporting( E_ALL&~E_NOTICE );

include ('include_fns.php');

session_start();

if(isset($_SESSION['reset_passwd'])){
	$page = new loginPage();

	$page->dispResetPassword();
}else{
	echo '页面已过期';
}

?>