<?php

include ('include_fns.php');

session_start();
@$old_user = $_SESSION['valid_user'];

unset($_SESSION['valid_user']);
$result_dest = session_destroy();


if(!empty($old_user)){
	if($result_dest){
		echo 'Logged out.<br />';
		header('Location:index.php');
	}else{
		echo 'Could not log you out.<br />';
	}
}else{
	echo 'You were not logged in,and so have not been logged out.<br />';
	header('Location:index.php');
}


?>

