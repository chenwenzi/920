<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <script src="/style/index/js/jquery-1.7.2.min.js" type="text/javascript"></script>
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
<form action="/admin/school/do_edit" method="POST" enctype="multipart/form-data">
    <table class="form-table" border="0" style="width: 98%;border: none">
        <tbody> 编辑学校档案</tbody>
        <tr>
            <td><input type="text" value="<?php echo $this->session->username ?>" disabled />
                <input type="hidden" name="edit" value="1">
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo $school['avatar'] ?>" border="0" style="height: 50px">
                <input type="file" name="avatar" />
                <br><span style="color: #999"> 头像尺寸：高宽380*320px，小于2M <br><a href="/admin/school/h5_upload" target="_top"> 或点此使用高级头像上传</a></span></span>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="wx" placeholder="微信号" value="<?php echo $school['wx'] ?>" />
            </td>
        </tr>
        <tr style="display:none">
            <td>
                <input type="text" name="wx_qr" placeholder="微信二维码" value="<?php echo $school['wx_qr'] ?>" />
            </td>
        </tr>




        <tr>
            <td>
                <input type="text" name="contact" placeholder="联系人" value="<?php echo $school['contact'] ?>" />
                <?php echo form_error('contact', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="address" placeholder="地址" value="<?php echo $school['address'] ?>" />
                <?php echo form_error('address', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="tel" placeholder="电话" value="<?php echo $school['tel'] ?>" />
                <?php echo form_error('tel', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr style="display: none">
            <td>
                <?php echo $school['good_teacher'] ?>
                <br>
                <select name="good_teacher" id="">
                    <option value="">该校教师列表</option>
                    <?php foreach($teachers as $v): ?>
                        <option value="<?php echo $v['id']; ?>" <?php echo set_select('id', $v['id']) ?>><?php echo $v['title']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span style="color: #999"> 选择该校优秀教师</span>
            </td>
        </tr>
        <tr >
            <td>
                <span style="color: #999; font-size: 18px">选择联战校区：</span>
                <br>
                <table border="1">
                    <?php
                    $i = 0;$c = count($schools)-1;$relate_sid = json_decode($school['relate_sid'],true);
                    foreach($schools as $v){
                        if($v['id'] == $school['id']){
                            continue;
                        }
                        $checked = is_array($relate_sid) && in_array($v['id'], $relate_sid) ? 'checked' : '';
                        if($i % 7 == 0){
                            echo '<tr>';
                        }
                        echo '<td><input type="checkbox" name="relate_sid[]" value="'.$v['id'].'" id="s'.$v['id'].'" '.$checked.'><label for="s'.$v['id'].'">'.$v['title'].'</label></td>';
                        if($i % 7 == 6 || $i == $c){
                            echo '</tr>';
                        }
                        $i++;
                    } ?>
                </table>
            </td>
        </tr>
        <tr style="display: none">
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <div style="width:95%;">
                    <script type="text/plain" name="intro" id="intro" style="width:100%;height:300px;"><?php echo set_value('intro', $school['intro'], false) ?></script>
                    <script></script>
                </div>
                <?php echo form_error('intro', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td colspan="10"><input type="submit" class="input_button" value=" 更新 &rsaquo; "/></td>
        </tr>
    </table>
</form>
<script>
    var editor = UE.getEditor('intro', {
        autoHeight: true,
        toolbars: [['fullscreen', 'undo', 'redo', 'insertimage', 'bold']]
    });
    UE.Editor.prototype.placeholder = function (justPlainText) {
        var _editor = this;
        _editor.addListener("focus", function () {
            var localHtml = _editor.getPlainTxt();
            if ($.trim(localHtml) === $.trim(justPlainText)) {
                _editor.setContent(" ");
            }
        });
        _editor.addListener("blur", function () {
            var localHtml = _editor.getContent();
            if (!localHtml) {
                _editor.setContent(justPlainText);
            }
        });
        _editor.ready(function () {
            _editor.fireEvent("blur");
        });
    };
    editor.placeholder("支持上传图片哦，单个图片小于2M！");
</script>
</body>
</html>