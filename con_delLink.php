<?php

  error_reporting( E_ALL&~E_NOTICE );

  include ('include_fns.php');

  session_start();

  $link_name = $_POST['link_name'];

  if((del_link($link_name)) == true){
  	echo "删除成功";
  }else{
  	echo "删除失败";
  }

?>