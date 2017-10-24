<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台管理首页</title>
    <link rel="stylesheet" href="/style/admin/css/admin.css?" />
    <script type="text/javascript" src="/style/admin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/style/admin/js/admin.js"></script>
    <!-- 默认打开目标 -->
    <base target="iframe"/>
</head>
<body>
<!-- 头部 -->
<div id="top_box">
    <div id="top">
        <p id="top_font">920教师节能力风暴活动</p>
    </div>
    <div class="top_bar">
        <p class="adm">
            <span><?php echo $this->session->is_admin ? '管理员：' : '用户：'; ?></span>
            <span class="adm_people"><?php echo $this->session->username ?></span>
        </p>

        <p class="out">
            <a href="/admin/login/login_out" target="_self">退出</a>
        </p>
    </div>
</div>
<!-- 左侧菜单 -->
<div id="left_box" style="display: none">
<!--    <p class="use">功能管理</p>-->
    <?php
    if((int)$this->session->user_type == 1){
        echo '<div class="menu_box">
                <h2>信 息</h2>
                <div class="text">
                    <ul class="con">
                        <li class="nav_u">
                            <a href="/admin/profile/index/'.$this->session->uid.'" class="pos">个人档案</a>
                        </li>
                    </ul>
                </div>
            </div>';
    }else if((int)$this->session->user_type == 2){
        echo '<div class="menu_box">
                <h2>信 息</h2>
                <div class="text">
                    <ul class="con">
                        <li class="nav_u">
                            <a href="/admin/school/index/'.$this->session->uid.'" class="pos">学校档案</a>
                        </li>
                    </ul>
                </div>
            </div>';
    }
    ?>
    <div class="menu_box" <?php if((int)$this->session->user_type == 2){echo '';} ?>>
        <h2>作 品</h2>
        <div class="text">
            <ul class="con">
                <li class="nav_u">
                    <a href="/admin/article/news" class="pos">发表作品</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="/admin/article/index" class="pos">作品列表</a>
                </li>
            </ul>

        </div>
    </div>
    <div class="menu_box">
        <h2>分 类</h2>
        <div class="text">
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo site_url('admin/category/index') ?>" class="pos">查看分类</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo site_url('admin/category/add_cate') ?>" class="pos">添加分类</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="menu_box">
        <h2>功 能</h2>
        <div class="text">
            <ul class="con">
                <li class="nav_u">
                    <a href="/" class="pos" target="_top">前台首页</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $myhomepage ?>" class="pos" target="_top">我的主页</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo site_url('admin/admin/change') ?>" class="pos">密码修改</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<style>
    .form-table th{text-align: center !important;}
</style>
<div id="admin-menu">
<table class="form-table" border="1">
    <tr>
        <th><a href="/" class="pos" target="_top">前台首页</a>
        </th>
        <th><a href="<?php echo $myhomepage ?>" class="pos" target="_top">我的主页</a>
        </th>
        <th><a href="/admin/admin/change" class="pos">修改密码</a>
        </th>
    </tr>
    <tr>
        <th>
            <?php echo (int)$this->session->user_type == 0 ? '<a href="/admin/article/userlist/" class="pos">用户列表</a>' : '';  ?>
            <?php echo (int)$this->session->user_type == 1 ? '<a href="/admin/profile/index/" class="pos">我的档案</a>' : '';  ?>
            <?php echo (int)$this->session->user_type == 2 ? '<a href="/admin/school/index/" class="pos">学校档案</a>' : '';  ?>
        </th>
        <th><a href="/admin/article/news" class="pos">发布作品</a>
        </th>
        <th><a href="/admin/article/index" class="pos">作品列表</a>
        </th>
    </tr>
</table>

</div>
<!-- 右侧 -->
<div id="right">
    <iframe frameborder="0" scrolling="auto" height="1000" width="98%" style="width: 100%;min-height: 800px; height: 1000px" name="iframe" src="/admin/admin/copy"></iframe>
</div>
<!-- 底部 -->
<div id="foot_box">
    <div class="foot">
        <p>@Copyright © 2017 All Rights Reserved. @wenzi</p>
    </div>
</div>

</body>
</html>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo base_url() . 'style/admin/' ?>js/iepng.js"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('.adm_pic, #left_box .pos, .span_server, .span_people', 'background');
</script>
<![endif]-->
