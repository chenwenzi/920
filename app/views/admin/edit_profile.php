<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <script type="text/javascript" src="/org/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/org/ueditor/ueditor.all.min.js"></script>
    <title>编辑</title>
    <style type="text/css">
        span{
            color: #f00;
        }
        body{margin: 0; padding: 0}
        .form-table tr,.form-table td{border: none !important;}

    </style>
</head>
<body>
<form action="/admin/profile/do_edit" method="POST" enctype="multipart/form-data">
    <table class="form-table" border="0" style="width: 100%;border: none">
        <tr >
            <th>编辑档案</th>
        </tr>
        <tr>
            <td><input type="text" value="<?php echo $this->session->username ?>" title="名字 不可修改" disabled /></td>
        </tr>
        <tr>
            <td>
                <input type="text" value="<?php echo $profile['s_title'] ?>" disabled title="所属学校 不可修改" />
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo $profile['avatar'] ?>" border="0" style="width:100px">
                <input type="file" name="avatar" />
                <br><br>
                <span style="color: #999">头像尺寸：高400*宽300像素,小于2.5M<br><a href="/admin/profile/h5_upload" target="_top">或点此使用高级头像上传</a></span>
            </td>
        </tr>
        <tr style="display: none">
            <td>
                轮询图：
                <?php
//                $imgs = json_decode($profile['imgs'], 1);
//                if(is_array($imgs)) {
//                    foreach ($imgs as $v) {
//                        echo '<img src="'.$v.'" style="height:50px">';
//                    }
//                }else{
//                    echo '<img src="'.$profile['imgs'].'" style="height:50px">';
//                }
                ?>
                <input type="file" name="imgs" placeholder="图片" value="<?php echo set_value('imgs') ?>"  />
                <?php echo form_error('imgs', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="wx" placeholder="微信号" value="<?php echo $profile['wx'] ?>" />
            </td>
        </tr>
        <tr style="display:none">
            <td>
                <input type="text" name="wx_qr" placeholder="微信二维码" value="<?php echo $profile['wx_qr'] ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="info" placeholder="参赛口号" value="<?php echo $profile['info'] ?>" />
                <?php echo form_error('info', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:95%;">
                    <textarea id="intro" name="intro" placeholder="个人介绍" style="height: 150px"><?php echo $profile['intro'] ?></textarea>
                </div>
                <?php echo form_error('intro', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td><input type="submit" class="input_button" value=" 更新 &rsaquo; "/></td>
        </tr>
    </table>
</form>
</body>
</html>