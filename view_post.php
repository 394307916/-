<?php
  
  error_reporting( E_ALL&~E_NOTICE );

  include ('include_fns.php');

  session_start();

  $postid = $_GET['postid'];
  
  $post = get_post($postid);

  $page = new postPage();

  $page->dispViewPost($post['title'],$post,$postid);

?>
