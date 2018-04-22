<?php
  include ('include_fns.php');

  session_start();
  
  if(!$_POST){
  	echo "你不该来这里";
  }else{

  	if($id = store_new_post($_POST)) {
  		if($_POST['parent'] == 0){
  			echo "保存成功";
  		}else{
  			$address = 'view_post.php?postid='.$_POST['article_id'];
//		include($address);
  			header('Location: '.$address);
  		}
  	}else{
  		echo "服务器出问题";
  	} 
  }

?>
