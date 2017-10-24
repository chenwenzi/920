<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" xmlns="http://www.w3.org/1999/html">
<title>头票管理系统</title>
<link href="/style/index/css/details.css" rel="stylesheet" />
<?php $this->load->view('index/head') ?>
<div id="main">
    <div class='details'>
        <h1><?php echo $profile['title'] ?> <img src="<?php echo $profile['avatar'] ?>" border="0" style="height:50px"> 的个人档 </h1>
        <div class='info'>
            <div class='base'>

                <em>发表于 <?php echo $profile['regtime'] ?></em>
            </div>
        </div>
        <div class='content'>
            <p><strong><?php echo $profile['info'] ?></strong></p>
            <p>微信号：<?php echo $profile['wx'] ?></p>
            <p>微信：<?php echo $profile['wx_qr'] ?></p>
            <p>口号：<?php echo $profile['intro'] ?></p>
        </div>
        <input type="hidden" id="pid" value="<?php echo $profile['id'] ?>">
        <div style="width: 100%; text-align: center; margin: 0 auto"><img class="like" src="/style/index/images/z.jpg" border="0" width="150" style="cursor:pointer;"></div>
    </div>
    <script>
        $('.like').click(function () {
            $.ajax({
                url: '/z/'+$('#pid').val(),
                method: 'get',
                dataType: 'json',
                success:function (r) {
                    if(r.code == 0){
                        alert('点赞成功！');
                    }else{
                        alert('已经赞过啦！');
                    }
                }
            });
        });
    </script>
    <?php $this->load->view('index/right') ?>
</div>
<?php $this->load->view('index/foot') ?>
</body>
</html>