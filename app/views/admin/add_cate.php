<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/style/admin/css/public.css' ?>">
    <title>Document</title>
    <style type="text/css">
        span{
            color: #f00;
        }
    </style>
</head>
<body>
<form action="/admin/category/add" method="POST">
    <table class="form-table" border="1">
        <tr>
            <td class="th" colspan="3">添加分类</td>
        </tr>
        <tr>
            <td style="width:100px">名称</td>
            <td style="width:300px"><input type="text" name="cname" value="<?php echo set_value('cname') ?>"/><?php echo form_error('cname', '<span>', '</span>') ?></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="width:100px">&nbsp;</td>
            <td colspan="2"><input type="submit" value="添加" class="input_button"/></td>
        </tr>
    </table>
</form>
</body>
</html>