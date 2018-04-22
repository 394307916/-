$.getScript("js/sha1.js");
//登录请求
$(function(){
	$("#login").click(function(){
		var username = $("#username").val();
		var passwd = $("#passwd").val();
		if(username == ''){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">帐号不能为空</div>");
			return;
		}
		if(passwd == ''){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">密码不能为空</div>");
			return;
		}
		var url = "con_login.php";
		myRand = parseInt(Math.random()*999999999999999);
		var theURL = url+"?rand="+myRand;
		$.post(theURL,
			   {username:username,passwd:hex_sha1(passwd)},
			   function(data){
			   		if(data == 1){
			   			window.location.href = 'index.php?page=1';
			   		}else{
			   			$("#displayresult").html(data);
			   		}
			   });	
	});
});
//注册请求
$(function(){
	$("#register").click(function(){
		var email = $("#email").val();
		var username = $("#username").val();
		var passwd = $("#passwd").val();
		var passwd2 = $("#passwd2").val();
		var yanzheng = $("#yanzheng").val();
		var url = "con_register.php";
		if(username == ''){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">帐号不能为空</div>");
			return;
		}
		if(passwd == '' || passwd2 == ''){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">密码不能为空</div>");
			return;
		}
		if(email == ''){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">邮箱不能为空</div>");
			return;
		}
		if(yanzheng == ''){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">验证码不能为空</div>");
			return;
		}
		if(passwd.length < 6 && passwd.length > 16){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">密码长度必须为6-16位</div>");
			return;
		}
		var reg = /^[A-Za-z0-9]+$/;
		if(reg.test(username) == false){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">帐号只能为数字或者字母</div>");
			return;
		}
		if(reg.test(passwd) == false){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">密码只能为数字或者字母</div>");
			return;
		}
		if(passwd != passwd2){
			$("#displayresult").html("<div class=\"alert alert-danger\" role=\"alert\">两次密码不一样</div>");
			return;
		}

		

		myRand = parseInt(Math.random()*999999999999999);
		var theURL = url+"?rand="+myRand;
		$.post(theURL,{
			   	email:email,
			   	username:username,
			  	passwd:hex_sha1(passwd),
			   	passwd2:hex_sha1(passwd2),
			   	yanzheng:yanzheng
			   					},
			   function(data){
			   		if(data == 1){
			   			alert('注册成功！');
			   			window.location.href = 'index.php?page=1';
			   		}else{
			   			$("#displayresult").html(data);
			   		}
			   });
			});
});

//重置时修改密码请求
$(function(){
	$("#change_password").click(function(){
		var new_passwd = $("#new_passwd").val();
		var new_passwd2 = $("#new_passwd2").val();
		var url = "con_resetPassword.php";
		myRand = parseInt(Math.random()*999999999999999);
		var theURL = url+"?rand="+myRand;
		$.post(theURL,
			   {new_passwd:new_passwd,
			   	new_passwd2:new_passwd2},
			   function(data){
			   		if(data == 1){
			   			alert('修改成功');
			   			var url = window.location.href;

			   			if(url.indexOf('view_user') < 0){
			   				window.location.href = 'view_login.php';
			   			}else{
			   				window.location.href = 'view_user.php?page=1';
			   			}
			   			
			   		}else{
			   			$("#displayresult").html(data);
			   		}
			   });	
	});
});

//存储文章
$(function(){
	$("#button_h").click(function(){
		var title = $("#title_h").val();

		var message = editor.txt.html();
		if(title == "" || message == "<p><br></p>"){
			alert("请填写内容");
			return;
		}

		if(title.length > 30){
			alert("标题超出长度");
			return;
		}

		var parent = $("#parent_h").val();
		var article_id = $("#article_h").val();
		var poster = $("#poster_h").val();
		var url = "con_storePost.php";
		$.post(url,
		{
			title:title,
			message:message,
			parent:parent,
			article_id:article_id,
			poster:poster
		},
		function(data){
			alert(data);
			window.location.href = "index.php?page=1";
		});
	});
});

//删除文章
$(function(){
	$("#button_d").click(function(){
		var url = "con_deletePost.php";
		var postid = $("#postid_d").val();
		$.post(url,{postid:postid},function(data){
			alert(data);
			window.location.href = "index.php?page=1";
			//window.location.href = "view_post.php?postid="+postid;
		});
	});
});

//修改文章
$(function(){
	$("#button_x").click(function(){
		var url = "con_resetPost.php";
		var postid = $("#postid_d").val();
		var message = editor.txt.html();
		$.post(url,{postid:postid,
					message:message},function(data){
			alert(data);
			//window.location.href = "index.php";
			window.location.href = "view_post.php?postid="+postid;
		});
	});
});

//添加书签
$(function(){
	$("#add_link").click(function(){
		var url = "con_addLink.php";
		var link_name = $("#link_name").val();
		var link_value = $("#link_value").val();
		$.post(url,{link_name:link_name,
			link_value:link_value},function(data){
				alert(data);
				window.location.href = "index.php?page=1";
			});
	});
});

//删除书签
$(function(){
	$(".del_link").click(function(){
		var url = "con_delLink.php";
		var name = $(this).attr("title");
		$.post(url,{link_name:name},function(data){
			alert(data);
			window.location.href = "index.php?page=1";
		})
	})
})
//////////////////////////////////////////////////////////////////
var countdown=60; 
function settime_Yanzheng(val) {
	if(document.getElementById('email').value == ''){
		sendYanzheng();
		return;
	}

	if (countdown == 0) { 
		val.removeAttribute("disabled"); 
		val.value="获取验证码"; 
		countdown = 60;
		return; 
	}else if(countdown == 60) {
		sendYanzheng();
		val.setAttribute("disabled", true);
		val.value="重新发送(" + countdown + ")";
		countdown--; 
	}else { 
		val.setAttribute("disabled", true); 
		val.value="重新发送(" + countdown + ")"; 
		countdown--; 
	} 
	setTimeout(function() { 
		settime_Yanzheng(val) 
	},1000) 
}

function sendYanzheng(){
	var email = $("#email").val();
	var url = "con_sendYz.php";
	myRand = parseInt(Math.random()*999999999999999);
	var theURL = url+"?rand="+myRand;
	$.post(theURL,{email:email},
	function(data){
	   $("#displayresult").html(data);	
	});
}
///////////////////////////////////////////////////////////////////
function settime_resetPassword(val) { 
	if (countdown == 0) { 
		val.removeAttribute("disabled"); 
		val.value="重置"; 
		countdown = 60;
		return; 
	}else if(countdown == 60) {
		val.setAttribute("disabled", true);
		val.value="重置(" + countdown + ")";
		countdown--; 
	}else { 
		val.setAttribute("disabled", true); 
		val.value="重置(" + countdown + ")"; 
		countdown--; 
	} 
	setTimeout(function() { 
		settime_resetPassword(val) 
	},1000) 
}

function resetPassword(){
	var username = $("#username").val();
	var url = "con_forgotPasswd.php";
	myRand = parseInt(Math.random()*999999999999999);
	var theURL = url+"?rand="+myRand;
	$.post(theURL,{username:username},
	function(data){
	   $("#displayresult").html(data);

	   if(data.match("发送成功") != null){
	   		var btn1=document.getElementById('forgot1');
	   		settime_resetPassword(btn1);
	   }
	 });
}
////////////////////////////////////////////////////////////////////////////////

$(function () {
	$(".navbar-nav").find("li").each(function () {
		var a = $(this).find("a:first")[0];
		var b = $(a).attr("href");
		var c = location.pathname;
		var d = b.split("?")[0];
		if (c.indexOf(d) >= 0 ) {
			$(this).addClass("active");
		} else {
			$(this).removeClass("active");
		}
	});
});
