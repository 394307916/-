<?php

include ('include_fns.php');

$email = $_POST['email'];

session_start();

if(!filled_out($_POST)){
	echo "<div class=\"alert alert-danger\" role=\"alert\">未输入邮箱</div>";
	exit;
}else if(!valid_email($email)){
	echo "<div class=\"alert alert-danger\" role=\"alert\">这邮箱不行啊</div>";
	exit;
}

@$_SESSION['randNum'] = rand(100000,999999);

$content = "您的验证码为:".$_SESSION['randNum']."。请不要向他人泄露您的消息。--------www.zilongnet.cn";

sendYanzheng($email,$content);

?>