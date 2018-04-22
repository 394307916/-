<?php

include ('include_fns.php');

class indexPage{

  function __construct(){}

  function dispIndex(){

    $this->do_html_header("index page");

    $this->display_article();

    $this->display_new_post_form1(0,'','','','');

    $this->do_html_footer();

  }


  function do_html_header($title = '') {
  // print an HTML header including cute logo :)
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title><?php echo $title; ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <bgsound src="music/auror.mp3" loop="-1" autostart="true">

      <link rel="stylesheet" type="text/css" href="css/jq22.css">
      <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">    
      <script src="https://ajax.googleapis.bootcss.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
      <script type="text/javascript" src="wangEditor/release/wangEditor.min.js"></script>
      <script type="text/javascript" src="control.js"></script>
      <script src="js/canvas_clock.js"></script>
      <script type="text/javascript" src="js/canvas-particle.js"></script>
      <script type="text/javascript" src="point.js"></script>

      <style>

      body{
      	background-color: #2D2D2D;
      	color: #F0FFFF;
      }

      a{
      	color: white;
      }
      a:hover{
      	color: white;
        text-decoration: none;
        text-shadow:0 0 0.2em #f87,
                -0 -0 0.2em #f87;
      }

      .page_yejiao{
        
      }
      .article_bo{
        border: double #C0C0C0;
        color: #F0FFFF;
      }

      .title_a{
        color: black;
      }

      .by{
        text-align:center;

      }

      .num{
        text-align:center;
      }

      hr{
        height:1px;border:none;border-top:1px solid #555555;
      }


      /* Remove the navbar's default margin-bottom and rounded borders */ 
      .navbar {
        margin-bottom: 0;
        border-radius: 0;
      }

      /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
      .row.content {height: 90vh}

      /* Set gray background color and 100% height */
      .sidenav {
        margin-top: 9.5vh;
        background-color: white;
        height: 200%;
      }

      /* Set black background color, white text and some padding */
      footer {
        background-color: #555;
        color: white;
        padding: 3vh;
      }

      /* On small screens, set height to 'auto' for sidenav and grid */
      @media screen and (max-width: 767px) {
        .sidenav {
          height: auto;
          padding: 15px;
        }
        .row.content {height:auto;} 
      }
    </style>



</head>

<body>
  <?php

  if(!$_SESSION['ip']){
     add_click();
  }
  $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
 
  ?>
  <div id="mydiv" style="height:auto">
    <div id="content_all" >
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header" >
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="index.php?page=1">Long</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php?page=1">主页</a></li>
          <li><a href="index.php?area=video">myVideos</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <?php
          if(!$_GET['page']){
            $_GET['page'] = 1;
          }

          if(check_valid_user()){
            echo "<li><a href=\"view_user.php?page=1\">".$_SESSION['valid_user']."</a></li>";
            echo "<li><a href=\"con_logout.php\"><span class=\"glyphicon glyphicon-log-in\"></span> 注销</a></li>";
          }else{
            echo "<li><a href=\"view_register.php\"><span class=\"glyphicon glyphicon-user\"></span> 注册</a></li>";
            echo "<li><a href=\"view_login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> 登录</a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container-fluid text-center">    
    <div class="row content">  
      <div class="col-sm-2" style="padding-left:0px;margin-top: 3vh">
        
        <p style="padding-top: 10vh">帮助链接
        <?php 
        if($_SESSION['valid_user'] == "admin"){
          echo "<a data-toggle=\"modal\" data-target=\"#link\"><span class=\"glyphicon glyphicon-plus\"></span></a></p>";
        }
        ?>
        <div class="modal fade" id="link" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div class="modal-body">
                <input type="text" id="link_name" class="form-control" name="link_name" placeholder="链接名" autocomplete="off"><br>
                <input type="text" id="link_value" class="form-control" name="link" placeholder="链接" autocomplete="off"><br>
                <input type="button" name="button" class="btn btn-primary" value="提交" id="add_link">
              </div>

            </div>
          </div>
        </div>
        
        <?php

        printf_link() 

        ?>
      
      </div>

          <div class="col-sm-8 text-left">
      
        <br><br><br>
        <?php
      }

  function do_html_footer() {
      ?>
    </div>
    <div class="col-sm-2" style="margin-top:10vh">
      
      
       <p>本网站仅供学习参考，所有文章来源于网络。如有侵权请留言。</p>
    

    
       <p>坤爷真的帅</p>

       <p>想在本网站留言或发表文章请注册登录，最近有个家伙老炸我数据库所以我关闭匿名回复权限不好意思了</p><br>
     
    
       <?php printf_click() ?>
    
     <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=200 height=86 src="//music.163.com/outchain/player?type=2&id=29027341&auto=0&height=66"></iframe>
   </div>
 </div>
 </div>
</div>

    <footer class="container-fluid text-center">
     <p>bug</p>
    </footer>
</div>
    <script type="text/javascript" src="wang.js"></script>


  </body>
  </html>
  <?php
  }

  function display_post($post,$row) {

    if(!$post) {
      return;
    }
    ?>

    <?php 
    if($row == false){
      ?>
      <div id="create-answer0" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">修改文章</h4>
          </div>

          <div class="modal-body">
            <form>   
              <div id="div1">
                <?php echo $post['message']; ?>
              </div>

              <div align="center"><input type="button" value="提交" class="btn btn-info" id="button_x"></div><br />
            </form>
          </div>

        </div>
      </div>
    </div>

      <?php
      echo "<div class=\"panel panel-default\">";
    }
      $this->display_new_post_form($post['postid'],'','','',$_GET['postid'],$post['poster']);
     ?>


    <div class="panel-heading">
      <strong><?php if($row != false){echo $row."楼";} ?></strong>
      <strong>&nbsp <?php echo "<span class=\"glyphicon glyphicon-time\"></span>".$post['posted'];?></strong>
      <strong>| 作者: <?php echo $post['poster'];?></strong>
      
      
      <?php
        if($_SESSION['valid_user']){
        	echo "<button data-target=\"#create-answer".$post['postid']."\" class=\"btn btn-default btn-xs\" data-toggle=\"modal\" >回复</button>";
        }

        if($row == false && $_SESSION['valid_user'] == $post['poster'] || $row == false && $_SESSION['valid_user'] == "admin" ){
        	
          echo "<input type=\"hidden\" value=\"".$post['postid']."\" id=\"postid_d\">
          &nbsp<button class=\"btn btn-default btn-xs\" id=\"button_d\">删帖</button>
          &nbsp<button data-target=\"#create-answer0\" class=\"btn btn-default btn-xs\" data-toggle=\"modal\">修改</button>";
        }
        //echo "<a href=\"new_post.php?parent=".$post['postid']."&article_id=".$_GET['postid']."\">回复</a>";//***********
      
      ?>
    </div>

    <div class="panel-body">
      <?php 
      if($row == false){
        echo "<h1>".$post['title']."</h1><br>";
      }
      echo "<strong>".$post['message']."</strong>";?>
    </div>

  </div>
  <?php
  }

  function display_parent_post($post) {

  if(!$post) {
    return;
  }
  ?>

  <div class="panel panel-info">
    <table cellpadding="4" cellspacing="0">
      <tr>
        <td>
          <p>
            From: <?php echo $post['poster'];?>
            Posted: <?php echo $post['posted'];?> 
          </p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <?php echo nl2br($post['message']);?>
        </td>
      </tr>
    </table>
    <?php
  }

  function display_new_post_form($parent = 0, $title='', $message='', $poster='',$article_id,$r_poster) {
    echo "<div id=\"create-answer".$parent."\" class=\"modal fade\" role=\"dialog\">";
    ?>
    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">回复:<?php echo $r_poster ?></h4>
        </div>

        <div class="modal-body">
          <form action="con_storePost.php" method="post">   

            <?php 
            if($parent == 0){
              echo "
              <div class=\"form-group\"><input type=\"text\" name=\"title\" placeholder=\"title\"
              value=\"\" size=\"20\" class=\"form-control\" maxlength=\"20\" style=\"width:120px;margin:0 auto\" /></div>";
            }else{
              echo "<input type=\"hidden\" name=\"title\"
              value=\" \"  size=\"20\" maxlength=\"20\" />";
            }
            ?>

            <div class="form-group">
              <textarea class="form-control" rows="4" id="message" name="message" placeholder="message" required></textarea>
            </div>

            <div align="center"><input type="submit" value="post" class="btn btn-info"></div><br />


            <input type="hidden" name="parent" value="<?php echo $parent; ?>">

            <?php 
            if($parent != 0){
              echo "<input type=\"hidden\" name=\"article_id\" value=\"".$article_id."\">";
            }

            if(check_valid_user()){
              echo "<input type=\"hidden\" name=\"poster\" value=\"".$_SESSION['valid_user']."\" size=\"20\" maxlength=\"20\">";
            }else{
              echo "<input type=\"hidden\" name=\"poster\" value=\"匿名用户\" size=\"20\" maxlength=\"20\"/>";
            }
            ?>   

          </form>
        </div>

    </div>
    </div>
  </div>

    <?php
  }

  function display_new_post_form1($parent = 0, $title='', $message='', $poster='',$article_id) {
    ?>
    <div id="create-answer0" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">发表文章</h4>
          </div>

          <div class="modal-body">
            <form>   

              <?php 
              if($parent == 0){
                if($_GET['area'] == "video"){
                echo "<input id=\"title_h\" type=\"text\" name=\"title\" placeholder=\"title\"
                value=\"video:\"  class=\"form-control\"  style=\"margin:0 auto\" >";
                }else{
                  echo "<input id=\"title_h\" type=\"text\" name=\"title\" placeholder=\"title\"
                value=\"\"  class=\"form-control\"  style=\"margin:0 auto\" >";
                }
              }
              ?>

              <div id="div1" style="color: black">

              </div>

              <div align="center"><input type="button" value="提交" class="btn btn-info" id="button_h"></div><br />

              <input id="parent_h" type="hidden" name="parent" value="<?php echo $parent; ?>">

              <?php 
              if($parent != 0){
                echo "<input id=\"article_h\" type=\"hidden\" name=\"article_id\" value=\"".$article_id."\">";
              }

              if(check_valid_user()){
                echo "<input id=\"poster_h\" type=\"hidden\" name=\"poster\" value=\"".$_SESSION['valid_user']."\" size=\"20\" maxlength=\"20\">";
              }else{
                echo "<input id=\"poster_h\" type=\"hidden\" name=\"poster\" value=\"匿名用户\" size=\"20\" maxlength=\"20\"/>";
              }      
              ?>

            </form>
          </div>

        </div>
      </div>
    </div>
    <?php
  }

  function display_article(){

    if($_SESSION['valid_user']){
      if($_GET['area'] == "video"){
        echo "<button data-target=\"#create-answer0\" class=\"btn btn-default\" data-toggle=\"modal\" >新video</button>";
      }
      else{
        echo "<button data-target=\"#create-answer0\" class=\"btn btn-default\" data-toggle=\"modal\" >新文章</button>";
      }
    }
  ?>
  
  

  <h4><small>RECENT POSTS</small></h4>

  <?php

  if($_GET['area'] == "video"){
    printf_video();
  }else{
    printf_article(false,false);
  }

 
  }

  function display_answer($postid){

  printf_answer($postid);

  }

}
/////文章类/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class postPage extends indexPage{
  function __construct(){}

  function dispViewPost($title,$post,$postid){

    $this->do_html_header($title);

    $this->display_post($post,false);

    if($post['children']) {
      echo "<br /><br />";
      $this->display_answer($postid);
    }

    $this->do_html_footer();

  }

    function do_html_header($title = '') {
  // print an HTML header including cute logo :)
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title><?php echo $title; ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" type="text/css" href="css/jq22.css">
      <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">    
      <script src="https://ajax.googleapis.bootcss.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
      <script type="text/javascript" src="wangEditor/release/wangEditor.min.js"></script>
      <script type="text/javascript" src="control.js"></script>
      <script src="js/canvas_clock.js"></script>

      <style>

      body{
        background-color: #2D2D2D;
        }


      .by{
        text-align:center;

      }

      .num{
        text-align:center;
      }

      /* Remove the navbar's default margin-bottom and rounded borders */ 
      .navbar {
        margin-bottom: 0;
        border-radius: 0;
      }

      /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
      .row.content {height: 90vh}

      /* Set gray background color and 100% height */
      .sidenav {
        margin-top: 9.5vh;
        background-color: white;
        height: 200%;
      }

      /* Set black background color, white text and some padding */
      footer {
        background-color: #555;
        color: white;
        padding: 3vh;
      }

      /* On small screens, set height to 'auto' for sidenav and grid */
      @media screen and (max-width: 767px) {
        .sidenav {
          height: auto;
          padding: 15px;
        }
        .row.content {height:auto;} 
      }
    </style>

    <script type="text/javascript">
     $(function () {
      $(".navbar-nav").find("li").each(function () {
        var a = $(this).find("a:first")[0];
        var b = $(a).attr("href");
        var c = location.pathname;
        if (c.indexOf(b) >= 0 ) {
          $(this).addClass("active");
        } else {
          $(this).removeClass("active");
        }
      });
    });


  </script>

</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="index.php?page=1">Long</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php?page=1">主页</a></li>
          <li><a href="index.php?area=video">myVideos</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          if(check_valid_user()){
            echo "<li><a href=\"view_user.php?page=1\">".$_SESSION['valid_user']."</a></li>";
            echo "<li><a href=\"con_logout.php\"><span class=\"glyphicon glyphicon-log-in\"></span> 注销</a></li>";
          }else{
            echo "<li><a href=\"view_register.php\"><span class=\"glyphicon glyphicon-user\"></span> 注册</a></li>";
            echo "<li><a href=\"view_login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> 登录</a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container-fluid text-center">    
    <div class="row content">
      
      <div class="col-sm-2 sidenav">
        <div class="jq22-content" style="margin-top: 3vh;padding-left: 0px;">
          <canvas id="clock" width="200px" height="200px"></canvas>
        </div>
        
      </div>

      <div class="col-sm-10 text-left">
      
        <br><br><br>
        <?php
      }

  function do_html_footer() {
      ?>
    </div>


  </div>
</div>

    <footer class="container-fluid text-center">
     <p>bug</p>
    </footer>
    <script type="text/javascript">
      var E = window.wangEditor;
     var editor = new E('#div1');
     editor.customConfig.uploadImgShowBase64 = true;
     editor.customConfig.menus = [
      'head',  // 标题
      'bold',  // 粗体
      'underline',  // 下划线
      'foreColor',  // 文字颜色
      'backColor',  // 背景颜色
      'link',  // 插入链接
      'quote',  // 引用
      'image',  // 插入图片
      'video',  // 插入视频
      'code',  // 插入代码
    ]
     editor.create();

          clockd10_={
      "indicate": true,
      "indicate_color": "#222",
      "dial1_color": "#666600",
      "dial2_color": "#81812e",
      "dial3_color": "#9d9d5c",
      "time_add": 1,
      "time_24h": true,
      "track": "#4b4b00",
    };
    var b = document.getElementById('clock');
    cns10_ = b.getContext('2d');
    clock_planets(200,cns10_,clockd10_);
    </script>
  </body>
  </html>
  <?php
  }

}
//登录类//////////////////////////////////////////////////////////////////////////////////////////////////////////////
class loginPage extends indexPage{

  function __construct(){}

  function dispLogin(){

    $this->do_html_header('login');

    $this->display_login_form();

    $this->do_html_footer();

  }

  function dispRegister(){

    $this->do_html_header('register');

    $this->display_registration_form();

    $this->do_html_footer();
  }

  function dispForgot(){

    $this->do_html_header('reset password');

    $this->display_forgot_form();

    $this->do_html_footer();
  }

  function dispResetPassword(){
    $this->do_html_header('reset password');

    $this->display_Reset_form();

    $this->do_html_footer();
  }

  function do_html_header($title = '') {
  // print an HTML header
  ?>
  <!DOCTYPE html>
  <html class="no-js">
  <head>
    <title><?php echo $title;?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
    <script type="text/javascript" src="control.js"></script> 
    <script src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>

    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">

    <style>

    body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
    li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
    hr { color: #3333cc; }
    a { color: #000000 }

    tbody tr:hover{
        background-color:grey;
        color:white;
      }

      /* Remove the navbar's default margin-bottom and rounded borders */ 
      .navbar {
        margin-bottom: 0;
        border-radius: 0;
      }

      /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
      .row {
        height: 90vh;
        padding-top: 35px;
      }

      /* Set gray background color and 100% height */
      .sidenav {
        padding-top: 20px;
        background-color: #f1f1f1;
        height: 100%;
      }

      /* Set black background color, white text and some padding */
      footer {
        background-color: #555;
        color: white;
        padding:3vh;
      }

      /* On small screens, set height to 'auto' for sidenav and grid */
      @media screen and (max-width: 767px) {
        .sidenav {
          height: auto;
          padding: 15px;
        }
        .row.content {height:auto;} 
      }
    </style>

  </head>
    <body>
     <nav class="navbar navbar-inverse navbar-fixed-top">
       <div class="container-fluid">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="index.php?page=1">Long</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php?page=1">主页</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

          </ul>
        </div>
      </div>
    </nav>
    
  <?php
  }

  function do_html_footer() {
  ?>
    
    <footer class="container-fluid text-center">
     <p>bug</p>
    </footer>  

  </body>

  </html>
  <?php
  }

  function display_login_form() {
  ?>

      <div class="container">     
      <div class="row">
        <div class="col-md-4 col-md-push-7">          
          <!-- Start Sign In Form -->
          <form class="fh5co-form animate-box" data-animate-effect="fadeInRight">
            <p>登录<p>
            <div class="form-group" id="displayresult"> 
            </div>
            <div class="form-group">
              <label for="username" class="sr-only">Username</label>
              <input type="text" class="form-control" id="username" placeholder="帐号" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Password</label>
              <input type="password" class="form-control" id="passwd" placeholder="密码" autocomplete="off">
            </div>
            <div class="form-group">
              <p>还不是会员吗? <a href="view_register.php">注册</a> | <a href="view_forgot.php">忘记密码?</a></p>
            </div>
            <div class="form-group">
              <input type="button" value="登录" class="btn btn-primary" id="login">
            </div>
          </form>
          <!-- END Sign In Form -->
        </div>
      </div>
    </div>
   <?php
  }

  function display_registration_form() {
  ?>
  <div class="container">
  
      <div class="row">
        <div class="col-md-4 col-md-push-7">
          

          <!-- Start Sign In Form -->
          <form class="fh5co-form animate-box" data-animate-effect="fadeInRight">
            <p>注册</p>
            <div class="form-group" id="displayresult">             
            </div>
            <div class="form-group">
              <label for="name" class="sr-only">Name</label>
              <input type="text" class="form-control" id="username" placeholder="帐号(只能是数字或者字母)" autocomplete="off" size="16" maxlength="16">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Password</label>
              <input type="password" class="form-control" id="passwd" placeholder="密码(只能是数字或者字母6-16位)" autocomplete="off" size="16" maxlength="16">
            </div>
            <div class="form-group">
              <label for="re-password" class="sr-only">Re-type Password</label>
              <input type="password" class="form-control" id="passwd2" placeholder="再次输入密码" autocomplete="off" size="16" maxlength="16">
            </div>
            <div class="form-group">
              <label for="email" class="sr-only">Email</label>
              <input type="email" class="form-control" id="email" placeholder="邮箱" autocomplete="off" maxlength="100">
            </div>
            <div class="form-group">
              <label for="ryanzheng" class="sr-only">验证码</label>
              <input type="text" class="form-control" id="yanzheng" placeholder="验证码" autocomplete="off" size="16" maxlength="16">             
            </div>
            <div class="form-group">
              <p>已经是会员了? <a href="view_login.php">登录</a></p>
            </div>
            <div class="form-group">
              <input type="button" value="注册" class="btn btn-primary" id="register">
              <input type="button" class="btn btn-primary" onclick="javascript:settime_Yanzheng(this)" value="获取验证码">
            </div>
          </form>
          <!-- END Sign In Form -->
        </div>
      </div>

    </div>
 <?php
  }

  function display_forgot_form() {
  // display HTML form to reset and email password
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-push-7">
          

          <!-- Start Sign In Form -->
          <form class="fh5co-form animate-box" data-animate-effect="fadeInRight">
            <p>忘记密码</p>
            <div class="form-group" id="displayresult"> 
            </div>
            <div class="form-group">
              <label for="username" class="sr-only">Username</label>
              <input type="text" class="form-control" id="username" placeholder="帐号" autocomplete="off">
            </div>
            <div class="form-group">
              <p><a href="view_login.php">登录</a> or <a href="view_register_form.php">注册</a></p>
            </div>
            <div class="form-group">
              <input id="forgot1" type="button" value="找回密码" class="btn btn-primary" onclick="javascript:resetPassword()">
            </div>
          </form>
          <!-- END Sign In Form -->

        </div>
      </div>
    </div>
 <?php
  }

  function display_Reset_form() {
  ?>

      <div class="container">     
      <div class="row">
        <div class="col-md-4 col-md-push-4">          
          <!-- Start Sign In Form -->
          <form class="fh5co-form animate-box" data-animate-effect="fadeInRight">
            <p>修改密码</p>
            <div class="form-group" id="displayresult"> 
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">新密码</label>
              <input type="password" class="form-control" id="new_passwd" placeholder="密码" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password2" class="sr-only">再次输入密码</label>
              <input type="password" class="form-control" id="new_passwd2" placeholder="再次输入密码" autocomplete="off">
            </div>
            <div class="form-group">
              <input type="button" value="提交" class="btn btn-primary" id="change_password">
            </div>
          </form>
          <!-- END Sign In Form -->
        </div>
      </div>
    </div>
   <?php
  }

}
//用户界面/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class userPage extends indexPage{

  function __construct(){}

  function dispModify(){

    $this->do_html_header('修改密码');

    $this->display_modify_form();

    $this->do_html_footer();
  }

  function dispUserMessage(){

    $this->do_html_header('个人信息');

    $this->display_message_form();

    $this->do_html_footer();
  }

  function do_html_header($title = '') {
  // print an HTML header including cute logo :)
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title><?php echo $title; ?></title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">    
      <script src="https://ajax.googleapis.bootcss.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
      <script type="text/javascript" src="control.js"></script>

      <style>

      /*.row.content {overflow:hidden}*/
      a:hover{
        text-decoration: none;
        text-shadow:0 0 0.2em #f87,
                -0 -0 0.2em #f87;
      }
      .article_bo{
        border: double #C0C0C0;
      }

      tbody tr:hover{
        background-color:grey;
        color:white;
      }

      /* Remove the navbar's default margin-bottom and rounded borders */ 
      .navbar {
        margin-bottom: 0;
        border-radius: 0;
      }

      /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
   

      /* Set gray background color and 100% height */
      .sidenav {
        padding-top: 20px;
        background-color: #f1f1f1;
        height: 100vh;;
        position: fixed;
        z-index: 9;
        padding-left: 0px;
        padding-right: 0px;

      }

      .sidenav a {
        display: block;
        text-decoration: none;
        font-size: 20px;
        padding-bottom: 20px;
        padding-top: 20px;
      }

      .sidenav a.active{
        background-color: grey;
        color:#ffffff;
      }


      /* Set black background color, white text and some padding */
      footer {
        background-color: #555;
        color: white;
        padding: 15px;
      }

      /* On small screens, set height to 'auto' for sidenav and grid */
      @media screen and (max-width: 767px) {
        .sidenav {
          height: auto;
          padding: 15px;
        }
        .row.content {height:auto;} 
      }
    </style>

    <script type="text/javascript">
     $(function () {
      $(".sidenav").find("a").each(function () {
        //var a = $(this).find("first")[0];
        var b = $(this).attr("href");
        var c = window.location.href;
        /*alert("b:"+b+"c:"+c);*/
        if (c.indexOf(b) >= 0) {
          $(this).addClass("active");
        } else {
          $(this).removeClass("active");
        }
      });
    });
  </script>

</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="index.php?page=1">Blog</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php?page=1">主页</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          if(check_valid_user()){
            echo "<li><a href=\"view_user.php?page=1\">".$_SESSION['valid_user']."</a></li>";
            echo "<li><a href=\"con_logout.php\"><span class=\"glyphicon glyphicon-log-in\"></span> 注销</a></li>";
          }else{
            echo "<li><a href=\"view_register.php\"><span class=\"glyphicon glyphicon-user\"></span> 注册</a></li>";
            echo "<li><a href=\"view_login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> 登录</a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container-fluid text-center">    
    <div class="row content">
      <div class="col-sm-2 sidenav"> 
        
          <br><br><br>
        <a href="view_user.php?page=1">修改密码</a>
        <a href="view_user.php?page=2">我的文章</a>
       
      </div>

      <div class="col-sm-8 text-left">
        
        <?php
  }

  function do_html_footer() {
      ?>
      </div>
      <div class="col-sm-2 ">

      </div>
    </div>
  </div>



  </body>
  </html>
  <?php
  }

  function display_modify_form() {
  ?>
      
      <div class="container" style="padding-top: 25vh">     
      <div class="row">
        <div class="col-md-4 col-md-push-5">          
          <!-- Start Sign In Form -->
          <form class="fh5co-form animate-box" data-animate-effect="fadeInRight">
            <p>修改密码</p>
            <div class="form-group" id="displayresult"> 
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">新密码</label>
              <input type="password" class="form-control" id="new_passwd" placeholder="密码" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password2" class="sr-only">再次输入密码</label>
              <input type="password" class="form-control" id="new_passwd2" placeholder="再次输入密码" autocomplete="off">
            </div>
            <div class="form-group">
              <input type="button" value="提交" class="btn btn-primary" id="change_password">
            </div>
          </form>
        </div>

      </div>
    </div>
   <?php
  } 

  function display_message_form(){
    ?>
    <br><br><br><br><br><br>
    <div class="container">     
      <div class="row">
        <div class="col-md-4 col-md-push-5">          
          <!-- Start Sign In Form -->
          <h1>我发布过的文章</h1>

            <?php

            printf_article($_SESSION['valid_user'],true);
            ?>
          </div>

        </div>
      </div>
   <?php
  }
}

?>
