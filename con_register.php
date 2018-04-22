<?php
error_reporting( E_ALL&~E_NOTICE );
include ('include_fns.php');

$email = $_POST['email'];
$username = $_POST['username'];
$passwd = $_POST['passwd'];
$passwd2 = $_POST['passwd2'];
$yanzheng = $_POST['yanzheng'];

session_start();

if(!filled_out($_POST)){
	echo "<div class=\"alert alert-danger\" role=\"alert\">信息没填满呢</div>";
}else if(!valid_email($email)){
	echo "<div class=\"alert alert-danger\" role=\"alert\">这邮箱不行啊</div>";
}else if($passwd != $passwd2){
	echo "<div class=\"alert alert-danger\" role=\"alert\">两次密码不一样哦</div>";
}else if($yanzheng != @$_SESSION['randNum']){
	echo "<div class=\"alert alert-danger\" role=\"alert\">验证码错误</div>";
}else{
	if(register($username,$email,$passwd) == true){
		$_SESSION['valid_user'] = $username;
		echo '1';
	}
}

?>