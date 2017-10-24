<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" xmlns="http://www.w3.org/1999/html">
<title>头票管理系统</title>
<link href="/style/index/css/details.css" rel="stylesheet" />
<?php $this->load->view('index/head') ?>
<div id="main">
    <div class='details'>
        <h1><?php echo $school['title'] ?> <img src="<?php echo $school['avatar'] ?>" border="0" style="height:50px"> 学校档 </h1>
        <div class='info'>
            <div class='base'>

                <em>发表于 <?php echo $school['regtime'] ?></em>
            </div>
        </div>
        <div class='content'>
            <p><strong><?php echo $school['address'] ?></strong></p>
            <p>微信号：<?php echo $school['wx'] ?></p>
            <p>微信：<?php echo $school['wx_qr'] ?></p>
            <p>优秀教师：<?php echo $school['good_teacher'] ?></p>
            <p>学校联盟：<?php echo $school['relate_sid'] ?></p>
            <p>介绍：<?php echo $school['intro'] ?></p>
        </div>
        <input type="hidden" id="pid" value="<?php echo $school['id'] ?>">

    </div>

    <?php $this->load->view('index/right') ?>
</div>
<?php $this->load->view('index/foot') ?>
</body>
</html>