<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>920能力风暴教师节活动</title>
    <link href="/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/slick/slick-theme.css" rel="stylesheet">
    <link href="/css/video-js.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
    <link rel="stylesheet" href="/css/lightbox.min.css">
     <link href="/css/style.css?4562" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/lightbox-plus-jquery.js"></script>
    <script src="/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>
    <script type="text/javascript" src="/js/video.min.js"></script>
    <script type="text/javascript" src="/js/theme.js"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- 视频播放 -->
<div class="modal fade" id="video-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!--登录 -->
<div class="modal fade" id="login_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">登录</h4>
            </div>
            <div class="modal-body">
                <form id="pop_login" action="/admin/login/login_in.html" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                            <label for="inputEmail" class="sr-only">账号</label>
                            <input type="text" name="username" id="inputEmail" class="form-control" 　aria-describedby="basic-addon1" placeholder="姓名/学校" autofocus="" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2"><span class="fa fa-lock fa-lg"></span></span>
                            <label for="inputPassword" class="sr-only">密码</label>
                            <input type="password" name="passwd" id="inputPassword" class="form-control" aria-describedby="basic-addon2" placeholder="密码">
                        </div>
                        <span id="errpassword" class="error_txt">请输入密码。</span>
                    </div>
                    <button class="btn btn-lg btn-warning btn-block" id="Sign_in" type="submit">登   录</button>
                    <!--<div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" value="remember-me"> 记住我
                        </label>
                    </div>
                    <a href="http://reg.wercontest.org/index.php/forgot" class="fl_r forg_passw">忘记密码？</a>-->
                    <div class="clear"></div>
                </form>
            </div>

        </div>
    </div>
</div>
<header>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="//abilix.com"><img src="/images/logo.png" alt="能力风暴" style="height: 100%;"></a>
            </div>
            <div class="collapse navbar-collapse" id="head_nav">
                <ul class="nav navbar-nav menu">
                    <li><a href="/"  <?php echo $this->router->fetch_method()=='index' ? ' class="active"' : '' ?>>主页</a></li>
                    <li><a href="/s/" <?php echo $this->router->fetch_method()=='school' ?' class="active"' : ''  ?>>校区主页</a></li>
                    <li><a href="/u/" <?php echo $this->router->fetch_method()=='profile' ? ' class="active"' : '' ?>>教师主页</a></li>
                </ul>
                <div class=" navbar-right">
                    <ul class="nav navbar-nav pull-right" id="login1">
                        <?php
                            echo !empty($_SESSION['uid']) ? '<li><a href="javascript:;" class="line login-out">退出</a></li><li><a href="/admin/admin/" class="read" > '.$_SESSION['username'].'</a></li>' : '<li><a href="#" data-toggle="modal" data-target="#login_box">登录</a></li>';
                        ?>
                    </ul>
                    <form class="navbar-form  " action="/u" id="cse-search-box">
                        <div class="form-group">
                            <input type="search" name="q" class="form-control input-sm" placeholder="教师名字" >
                            <i class="fa fa-search"></i>
                        </div>
                    </form>
                </div>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<div class="bs-example">
    <nav id="navbar-example" class="navbar navbar-default navbar-static">
      <div class="container-fluid">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="//abilix.com"><img src="/images/logo.png" alt="能力风暴" class="logo"></a>
         <div class=" navbar-right">
                             <ul class="nav navbar-nav pull-right" id="login">
                                 <?php
                                     echo !empty($_SESSION['uid']) ? '<li class="name"><a href="/admin/admin/" class="read" > '.$_SESSION['username'].'</a></li><li><a href="javascript:;" class="line login-out">退出</a></li>' : '<li><a href="#" data-toggle="modal" data-target="#login_box">登录</a></li>';
                                 ?>
                             </ul>
                         </div>
        </div>
        <div class="navbar-collapse bs-example-js-navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav">
			 <li><a href="/"  <?php echo $this->router->fetch_method()=='index' ? ' class="active"' : '' ?>>主页</a></li>
			 <li><a href="/s/" <?php echo $this->router->fetch_method()=='school' ?' class="active"' : ''  ?>>校区主页</a></li>
			 <li><a href="/u/" <?php echo $this->router->fetch_method()=='profile' ? ' class="active"' : '' ?>>教师主页</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container-fluid -->
    </nav> <!-- /navbar-example -->
  </div>
<script>
    $('.login-out').click(function () {
        $.ajax({
            url: '/admin/login/j_login_out',
            dateType: 'json',
            success:function (i) {
                if(i.code == 0){
                    $('#login1,#login').html('<li><a href="#" data-toggle="modal" data-target="#login_box">登录</a></li>')
                }
            }
        })
    })
</script>
