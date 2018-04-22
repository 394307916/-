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

     clockd4_={
      "indicate": true,
      "indicate_color": "#222",
      "dial1_color": "#666600",
      "date_add":3,
      "date_add_color": "#999",
    };
    var c = document.getElementById('clock4_');
    cns4_ = c.getContext('2d');
    clock_binary(200,cns4_,clockd4_);

    window.onload = function() {
        //配置
        var config = {
            vx: 4,  //小球x轴速度,正为右，负为左
            vy: 4,  //小球y轴速度
            height: 2,  //小球高宽，其实为正方形，所以不宜太大
            width: 2,
            count: 200,   //点个数
            color: "121, 162, 185",   //点颜色
            stroke: "130,255,255",    //线条颜色
            dist: 6000,   //点吸附距离
            e_dist: 20000,  //鼠标吸附加速距离
            max_conn: 10  //点到点最大连接数
        }

        //调用
        CanvasParticle(config);
      }