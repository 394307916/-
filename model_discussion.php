<?php


function get_post($postid) {
  // extract one post from the database and return as an array

  if(!$postid) {
    return false;
  }

  $conn = db_connect();

  //get all header information from 'header'
  $query = "select * from header where postid = '".$postid."'";
  $result = $conn->query($query);
  if($result->num_rows!=1) {
    return false;
  }
  $post = $result->fetch_assoc();

  // get message from body and add it to the previous result
  $query = "select * from body where postid = '".$postid."'";
  $result2 = $conn->query($query);
  if($result2->num_rows>0)  {
    $body = $result2->fetch_assoc();
    if($body) {
      $post['message'] = stripslashes($body['message']);
    }
  }
  return $post;
}

function get_post_title($postid) {
  // extract one post's name from the database

  if(!$postid) {
    return '';
  }

  $conn = db_connect();

  //get all header information from 'header'
  $query = "select title from header where postid = '".$postid."'";
  $result = $conn->query($query);
  if($result->num_rows!=1) {
    return '';
  }
  $this_row = $result->fetch_array();
  return  $this_row[0];

}

function get_post_message($postid) {
  // extract one post's message from the database

  if(!$postid) {
    return '';
  }

  $conn = db_connect();

  $query = "select message from body where postid = '".$postid."'";
  $result = $conn->query($query);
  if($result->num_rows>0)   {
    $this_row = $result->fetch_array();
    return stripslashes($this_row[0]);
  }
}

function store_new_post($post) {
  // validate clean and store a new post

  $conn = db_connect();
  // check no fields are blank
  if(!filled_out($post))  {
    echo 'error 1';
    return false;
  }
//  $post = clean_all($post);

  //check parent exists
  if($post['parent']!=0)   {
    $query = "select postid from header where postid = '".$post['parent']."'";
    $result = $conn->query($query);
    if($result->num_rows!=1)  {
      echo 'error2';
      return false;
    }
  }

  // check not a duplicate
/*  $query = "select header.postid from header, body where
            header.postid = body.postid and
            header.parent = ".$post['parent']." and
            header.poster = '".$post['poster']."' and
            header.title = '".$post['title']."' and
            body.message = '".$post['message']."'";

  $result = $conn->query($query);
  if (!$result) {
     return false;
     echo 'error 3';
  }

  if($result->num_rows>0) {
     $this_row = $result->fetch_array();
     return $this_row[0];
  }*/
  if($post['parent'] == 0){
    $query = "insert into header values
            ('".$post['parent']."',
             '".$post['poster']."',
             '".$post['title']."',
             0,0,
             now(),
             NULL
            )";
  }else{
    $query = "insert into header values
            ('".$post['parent']."',
             '".$post['poster']."',
             '".$post['title']."',
             0,'".$post['article_id']."',
             now(),
             NULL
            )";
  }

  $result = $conn->query($query);
  if (!$result) {
     echo 'error 4';
     return false;
  }

  // note that our parent now has a child
  $query = "update header set children = 1 where postid = '".$post['parent']."'";
  $result = $conn->query($query);
  if (!$result) {
    echo 'error 5';
     return false;
  }
//--------------------------------------------------------------------------
  $query = "select postid from header where area = 0 and parent = 0";
  $result = $conn->query($query);
  if (!$result) {
    echo 'error 6';
     return false;
  }

  if($result->num_rows>0) {
  $this_row = $result->fetch_array();
  $id = $this_row[0];
  }

  $query = "update header set area = '".$id."' where postid = '".$id."'";
  $result = $conn->query($query);
  if (!$result) {
    echo 'error 7';
     return false;
  }


  $query = "select header.postid from header left join body on header.postid = body.postid
                   where parent = '".$post['parent']."'
                   and poster = '".$post['poster']."'
                   and title = '".$post['title']."'
                   and body.postid is NULL";

  $result = $conn->query($query);
  if (!$result)  {
    echo 'error 8';
     return false;
  }

  if($result->num_rows>0) {
    $this_row = $result->fetch_array();
    $id = $this_row[0];
  }


  $message1 = addslashes($post['message']);
  $message2 = str_replace("<div", "<p", $message1);
  $message3 = str_replace("</div","</p",$message2);

  if($id) {
     $query = "insert into body values ($id, '".$message3."')";
     $result = $conn->query($query);
     if (!$result) {
      echo 'error 9';
       return false;
     }

    return $id;
  }

}

function reset_post($postid,$message){
  $conn = db_connect();

  $query = "update body set message = '".$message."' where postid = '".$postid."'";
  $result = $conn->query($query);
  if(!$result){
    return false;
  }
  return true;
}

function delete_post($postid){
  $conn = db_connect();

  $query = "select postid from header where area = '".$postid."'";
  $result = $conn->query($query);
  if(!$result){
    return false;
  }

  for($i = 0;$i < $result->num_rows;$i++){
    $row = $result->fetch_assoc();

    $postid_sz[$i] = $row['postid'];
  }

  foreach ($postid_sz as $key => $value) {

    $query = "delete from body where postid ='".$value."'";

    $result = $conn->query($query);

    if(!$result){
      return false;
    }
  }

  $query = "delete from header where area = '".$postid."'";

  $result = $conn->query($query);
  if(!$result){
    return false;
  }

  return true;

}

function is_root($postid){
  $conn = db_connect();

  $query = "select * from header where postid = '".$postid."'";
  $result = $conn->query($query);
  if($result->num_rows!=1) {
    return false;
  }
  $post = $result->fetch_assoc();

  if($post['parent'] == 0){
    return true;
  }else{
    return false;
  }
}

function printf_video(){
  $conn = db_connect();

  $query = "select * from header where parent = 0 order by postid desc";
  $result = $conn->query($query);
  if(!$result) {
    return false;
  }
  $ding = 1;
  for($num = 1;$row = $result->fetch_assoc();$num++){
    if(stristr($row['title'], "video:")){
      $query = "select * from body where postid = '".$row['postid']."'";
      $result_m = $conn->query($query);
      $row_m = $result_m->fetch_assoc();

      $message_t = explode('，',$row_m['message']);

      echo "<a href=\"view_post.php?postid=".$row['postid']."\" style=\"color:black\"><div class=\"article_bo\"><h4><strong>".$row['title']."</strong></h4>"."<h5><strong><span class=\"glyphicon glyphicon-time\"></span> Post by ".$row['poster']."&nbsp".$row['posted']."</strong></h5>"."<p>查看详情请点击</p></div><br></a>";
    }
  }
}



function printf_article($user,$flag){
  $conn = db_connect();

  if($flag != true){
    $query = "select * from header where parent = 0 order by postid desc";
    $result = $conn->query($query);
    if(!$result) {
      return false;
    }

    $ding = 1;
    for($num = 1;$row = $result->fetch_assoc();$num++){
      if(!stristr($row['title'], "video:")){
        $query = "select * from body where postid = '".$row['postid']."'";
        $result_m = $conn->query($query);
        $row_m = $result_m->fetch_assoc();

        $message_t = explode('，',$row_m['message']);

        $article = "<a href=\"view_post.php?postid=".$row['postid']."\" style=\"color:black\"><div class=\"article_bo\"><h4><strong>".$row['title']."</strong></h4>"."<h5><strong><span class=\"glyphicon glyphicon-time\"></span> Post by ".$row['poster']."&nbsp".$row['posted']."</strong></h5>"."<p>".$message_t[0]."........</p></div><br></a>";

        $ar_s[$ding] = $article;
        $ding++;
      }
    }

    $j = $_GET['page'] * 4 - 3;
    $i = $_GET['page'] * 4;
    for($j;$j <= $i;$j++){
      echo $ar_s[$j];
    }

    echo "<ul class=\"pagination\">";

    $num = ceil(count($ar_s)/4);

    for($i = 1;$i <= $num ;$i++){
      if($_GET['page'] == $i){
        echo "<li class=\"active\"><a href=\"index.php?page=".$i."\">".$i."</a><li>";
      }else{
        echo "<li><a href=\"index.php?page=".$i."\">".$i."</a><li>";
      }
    }

    echo "</ul>";

  }else{
    $query = "select * from header where parent = 0 and poster = '".$user."' order by postid desc";
    $result = $conn->query($query);
    if(!$result) {
      return false;
    }

    for($num = 1;$row = $result->fetch_assoc();$num++){
      $query = "select * from body where postid = '".$row['postid']."'";
      $result_m = $conn->query($query);
      $row_m = $result_m->fetch_assoc();
      echo "<a href=\"view_post.php?postid=".$row['postid']."\" style=\"color:black\"><div class=\"article_bo\"><h4><strong>".$row['title']."</strong></h4>";
      echo "<h5><strong><span class=\"glyphicon glyphicon-time\"></span> Post by ".$row['poster']."&nbsp".$row['posted']."</strong></h5>";

      $message_t = explode('，',$row_m['message']);
      echo "<p>查看详情请点击</p></div><br></a>";
    }
  }



}

function printf_answer($postid){
  $conn = db_connect();

  $page = new indexPage();

  $query = "select * from header where area = '".$postid."' and parent order by posted";
  $result = $conn->query($query);
  if(!$result) {
    return false;
  }

  for($num = 0;$row = $result->fetch_assoc();$num++){
      if($row['parent'] != $row['area']){
        $post_p = get_post($row['parent']);
        $page->display_parent_post($post_p);
      }else{
        echo "<div class=\"panel panel-info\">";
      }
      $row['message'] = get_post_message($row['postid']);

      $page->display_post($row,$num + 1);
  }
}

function add_link($name,$value){
  $conn = db_connect();

  $query = "insert into my_link values ('".$name."','".$value."')";
  $result = $conn->query($query);
  if(!$result){
    return false;
  }

  return true;
}

function del_link($name){
  $conn = db_connect();

  $query = "delete from my_link where name = '".$name."'";
  $result = $conn->query($query);
  if(!$result){
    return false;
  }

  return true;
}

function printf_link(){
  $conn = db_connect();

  $query = "select * from my_link";
  $result = $conn->query($query);

  if(!$result){
    return false;
  }

  for($num = 0;$row = $result->fetch_assoc();$num++){

    if($_SESSION['valid_user'] == "admin"){
      echo "<a href='".$row['link']."'>".$row['name']."</a>";
      echo "<a class='del_link' title='".$row['name']."'><span class=\"glyphicon glyphicon-remove\"></span></a>";
      echo "<br>";
    }else{
      echo "<a href='".$row['link']."'>".$row['name']."</a>";
      echo "<br>";
    }
  }

}

function add_click(){
  $conn = db_connect();

  $query = "update click_num set num = num+1";
  $result = $conn->query($query);

  if(!$result){
    return false;
  }

}

function printf_click(){
  $conn = db_connect();

  $query = "select * from click_num";
  $result = $conn->query($query);

  if(!$result){
    return false;
  }

  $row = $result->fetch_assoc();

  echo "<p>点击量:".$row['num']."</p>";

}

?>
