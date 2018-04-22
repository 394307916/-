<?php

function db_connect() {
   $result = new mysqli('localhost', 'discussion', 'password', 'discussion');
   $result->query("set names utf8");
   if (!$result) {
      return false;
   }
   return $result;
}

function db_connect_safe(){
	$result = new mysqli('localhost','bm_user','password','bookmarks');
	$result->query('set names utf8');
	if(!$result){
		echo "<p class=\"warn\">来自数据库的未知错误</p>";
	}else{
		return $result;
	}
}

?>
