<?php
require_once("mail.php");

function register($username,$email,$password){
	$conn = db_connect_safe();

	$result = $conn->query("select * from user where username='".$username."'");

	if(!$result){
		echo "<div class=\"alert alert-danger\" role=\"alert\">数据库查询出错</div>";
		exit;
	}
	if($result->num_rows > 0){
		echo "<div class=\"alert alert-danger\" role=\"alert\">此帐号已存在</div>";
		exit;
	}

	$result = $conn->query("insert into user values ('".$username."','".$password."','".$email."')");

	if(!$result){
		echo "<div class=\"alert alert-danger\" role=\"alert\">数据库繁忙，请稍后再试</div>";
		exit;
	}

	return true;
}

function login($username,$password){
	$conn = db_connect_safe();

	$result = $conn->query("select * from user where username='".$username."'and passwd = '".$password."'");

	if(!$result){
		echo "<div class=\"alert alert-danger\" role=\"alert\">username or password error</div>";
	}

	if($result->num_rows > 0){
		return true;
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">username or password error</div>";
	}
}


function check_if_user(){
	if(isset($_SESSION['valid_user'])){
		echo "Logged in as ".$_SESSION['valid_user'].".<br />";
	}else{
		echo 'You are not logged in it.<br />';
		do_html_url('index.php?page=1','Login');
		do_html_footer();
		exit;
	}
}


function change_password($username,$old_password,$new_password){

	login($username,$old_password);

	$conn = db_connect_safe();
	$result = $conn->query("update user set passwd = sha1('".$new_password."') where username = '".$username."'");

	if(!$result){
		throw new Exception("Password could not be changed");
	}else{
		return true;
	}
}

function reset_change_password($username,$new_password){
	$conn = db_connect_safe();
	$result = $conn->query("update user set passwd = sha1('".$new_password."') where username = '".$username."'");

	if(!$result){
		echo "<p class=\"warn\">重置失败</p>";
		return false;
	}else{
		return true;
	}
}

function reset_password($username){

	$conn = db_connect_safe();

	$result = $conn->query("select email from user where username = '".$username."'");
	if($result->num_rows == 0){
		echo "<div class=\"alert alert-danger\" role=\"alert\">帐号不存在</div>";
		exit;
	}
	$em = $result->fetch_object();
	$toemail = $em->email;

	$_SESSION['reset_passwd'] = $username;
	$secret = rand(100000000,999999999);
//	$reset_page = 'http://localhost/discussion_2/view_resetPassword.php?username='.$username.'&secret='.$secret;
	$reset_page = 'http://www.zilongnet.cn/view_resetPassword.php?username='.$username.'&secret='.$secret;
	$content = "请点击该页面修改密码:".$reset_page."。请不要向他人泄露您的消息。--------www.zilongnet.cn";

	sendPassword($toemail,$content);

	
}


?>