<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <script type="text/javascript" src="/org/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/org/ueditor/ueditor.all.min.js"></script>
    <title>添加档案</title>
    <style type="text/css">
        span{
            color: #f00;
        }
        body{margin: 0; padding: 0}
    </style>
</head>
<body>
<form action="/admin/school/add" method="POST" enctype="multipart/form-data">
    <table class="form-table" border="1">
        <tr >
            <td class="th" colspan="10">添加学校档案</td>
        </tr>
        <tr>
            <td><input type="text" value="<?php echo $this->session->username ?>" disabled />
            </td>
        </tr>
        <tr>
            <td>
                轮询图：
                <input type="file" name="imgs" placeholder="图片" value="<?php echo set_value('imgs') ?>"  />
                <?php echo form_error('imgs', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="wx" placeholder="微信号" value="<?php echo set_value('wx') ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="wx_qr" placeholder="微信二维码" value="<?php echo set_value('wx_qr') ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="contact" placeholder="联系人" value="<?php echo set_value('contact') ?>" />
                <?php echo form_error('contact', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="address" placeholder="地址" value="<?php echo set_value('address') ?>" />
                <?php echo form_error('address', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="tel" placeholder="电话" value="<?php echo set_value('tel') ?>" />
                <?php echo form_error('tel', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>优秀教师：
                <select name="good_teacher" id="">
                    <option value="">该校教师列表</option>
                    <?php foreach($teachers as $v): ?>
                        <option value="<?php echo $v['id']; ?>" <?php echo set_select('id', $v['id']) ?>><?php echo $v['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>学校联盟：
                <select name="relate_sid" id="">
                    <option value="">学校列表</option>
                    <?php foreach($schools as $v): ?>
                        <option value="<?php echo $v['id']; ?>" <?php echo set_select('id', $v['id']) ?>><?php echo $v['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                头像：
                <input type="file" name="avatar" value="<?php echo set_value('avatar') ?>" /> (尺寸200*200px)
                <?php echo form_error('avatar', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr style="display: none">
            <td>
                <textarea style="width:550px;height:50px;"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:95%;">
                    介绍：<br>
                    <script type="text/plain" name="intro" id="intro" style="width:auto;height:300px;">
                        <?php echo set_value('intro', '', false) ?>
                    </script>
                    <script type="text/javascript">
                    var editor = UE.getEditor('intro', {
                        autoHeight: true,
                        toolbars: [['fullscreen', 'undo', 'redo', 'insertimage', 'bold']]
                    });
                    </script>
                </div>
                <?php echo form_error('intro', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td colspan="10"><input type="submit" class="input_button" value=" 添加 &rsaquo; "/></td>
        </tr>
    </table>
</form>
</body>
</html>