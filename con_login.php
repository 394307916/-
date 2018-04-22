<?php

error_reporting( E_ALL&~E_NOTICE );

include ('include_fns.php');

session_start();

$username = $_POST['username'];
$passwd = $_POST['passwd'];

if($username && $passwd){
	if(login($username,$passwd)){
		$_SESSION['valid_user'] = $username;
		echo '1';
	}
}else{
	echo "<div class=\"alert alert-danger\" role=\"alert\">Please enter password or username</div>";
}

?>




