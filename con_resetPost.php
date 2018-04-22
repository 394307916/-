<?php

  error_reporting( E_ALL&~E_NOTICE );

  include ('include_fns.php');

  session_start();

  $postid = $_POST['postid'];
  $message = addslashes($_POST['message']);

  if((reset_post($postid,$message))){
  	echo "修改成功";
  }else{
  	echo "修改失败";
  }

?>