<?php

error_reporting( E_ALL&~E_NOTICE );

include ('include_fns.php');

session_start();

$username = $_POST['username'];
if($username == ''){
	echo "<div class=\"alert alert-danger\" role=\"alert\">请输入帐号</div>";
}else{
	reset_password($username);
}
?>