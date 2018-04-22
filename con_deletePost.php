<?php

  error_reporting( E_ALL&~E_NOTICE );

  include ('include_fns.php');

  session_start();

  $postid = $_POST['postid'];

  if((delete_post($postid)) == true){
  	echo "删除成功";
  }else{
  	echo "删除失败";
  }

?>