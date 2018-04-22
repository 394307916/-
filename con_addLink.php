<?php

  error_reporting( E_ALL&~E_NOTICE );

  include ('include_fns.php');

  session_start();

  if(!$_POST){
    echo "你不该来这里";
    return;
  }else{
    $link_name = $_POST['link_name'];
    $link_value = $_POST['link_value'];

    if((add_link($link_name,$link_value)) == true){
     echo "添加成功";
   }else{
     echo "添加失败";
   }
 }

?>