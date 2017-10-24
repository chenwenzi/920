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
<form action="/admin/profile/add" method="POST" enctype="multipart/form-data">
    <table class="form-table" border="1">
        <tr >
            <td class="th" colspan="10">添加档案</td>
        </tr>
        <tr>
            <td><input type="text" value="<?php echo $this->session->username ?>" disabled />
            </td>
        </tr>
        <tr>
            <td>
                头像：
                <input type="file" name="avatar" value="<?php echo set_value('avatar') ?>" /> <span style="color: #999"> （必填，高宽400*300px，小于2M，<a href="/images/teacher.jpg" target="_blank">查看示例</a>)</span>
                <?php echo form_error('avatar', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="wx" placeholder="微信号" value="<?php echo set_value('wx') ?>" />
            </td>
        </tr>
        <tr style="display:none">
            <td>
                <input type="text" name="wx_qr" placeholder="微信二维码" value="<?php echo set_value('wx_qr') ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="info" placeholder="口号" value="<?php echo set_value('info') ?>" />
                <?php echo form_error('info', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <select name="sid" id="">
                    <option value="">所属学校</option>
                    <?php foreach($school as $v): ?>
                        <option value="<?php echo $v['id']; ?>" <?php echo set_select('sid', $v['id']) ?>><?php echo $v['title']; ?></option>
                    <?php endforeach; ?>
                </select> <span style="color: #999"> （必填)</span>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:95%;">
                    <textarea id="intro" name="intro" placeholder="个人介绍" style="height: 150px"><?php echo set_value('intro', '', false) ?></textarea>
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