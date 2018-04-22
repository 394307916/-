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



