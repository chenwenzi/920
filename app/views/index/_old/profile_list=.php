
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>头票管理系统</title>
<link href="/style/index/css/category.css" rel="stylesheet" />
<?php $this->load->view('index/head') ?>
<div id="main">
    <h1>个人档列表</h1>
    <div class='news'>

        <?php foreach($profile as $v): ?>
            <div class='newsList'>
                <div class='newsImage'>
                    <a href="/u/<?php echo $v['id'] ?>.html"><img src="<?php echo $v['avatar'] ?>"/></a>
                </div>
                <div class='newsContent'>
                    <h3><a href="/u/<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a></h3>
                    <p><?php echo $v['info'] ?></p>
                    <a href="/u/<?php echo $v['id'] ?>.html" class='more'>详情 &raquo;</a>
                </div>
            </div>
        <?php endforeach ?>

    </div>
    <?php $this->load->view('index/right') ?>
</div>

<?php $this->load->view('index/foot') ?>
</body>
</html>