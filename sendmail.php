<?php

require_once("mail.php");

function sendPassword($smtpemailto,$mailcontent){

	$flag = sendMail($smtpemailto,'重置密码',$mailcontent);

	if(!$flag){
		echo "<div class=\"alert alert-danger\" role=\"alert\">发送失败，请重新尝试</div>";
		return false;
	}else
		echo "<div class=\"alert alert-success\" role=\"alert\">发送成功，请登录邮箱查看</div>";
}

function sendYanzheng($smtpemailto,$mailcontent){


	$flag = sendMail($smtpemailto,'验证码',$mailcontent);

	if(!$flag){
		echo "<div class=\"alert alert-danger\" role=\"alert\">发送失败，请重新尝试</div>";
		exit;
	}
	echo "<div class=\"alert alert-success\" role=\"alert\">发送成功，请登录邮箱查看</div>";

}

?>