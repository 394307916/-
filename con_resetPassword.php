<?php

error_reporting( E_ALL&~E_NOTICE );

include ('include_fns.php');

session_start();

if($_SESSION['valid_user']){
	$_SESSION['reset_passwd'] = $_SESSION['valid_user'];
}

$new_passwd = $_POST['new_passwd'];
$new_passwd2 = $_POST['new_passwd2'];

if(!filled_out($_POST)){
	echo "<div class=\"alert alert-danger\" role=\"alert\">信息没填满</div>";
}
else if($new_passwd != $new_passwd2){
	echo "<div class=\"alert alert-danger\" role=\"alert\">两次密码不一致</div>";
}
else if((strlen($new_passwd) > 16) || (strlen($new_passwd) < 6)){
	echo "<div class=\"alert alert-danger\" role=\"alert\">密码必须6-16位</div>";
}else{
	if(reset_change_password($_SESSION['reset_passwd'],$new_passwd) == true){
		echo '1';
		if(!$_SESSION['valid_user']){
			unset($_SESSION['reset_passwd']);
			session_destroy();
		}
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">修改失败</div>";
	}
}


?>