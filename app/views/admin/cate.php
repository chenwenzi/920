<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <link rel="stylesheet" type="text/css" href="/style/admin/uikit/css/uikit.almost-flat.min.css" >
    <title>Document</title>
</head>
<body>
<table class="form-table" border="1">
    <tbody>分类</tbody>
    <tr>
        <td>ID</td>
        <td>名称</td>
        <td>操作</td>
    </tr>

    <?php foreach($category as $v): ?>
        <tr>
            <td><?php echo $v['cid'] ?></td>
            <td><?php echo $v['cname'] ?></td>
            <td>
                <a href="/admin/category/edit/<?php echo $v['cid'] ?>"title="编辑"><i class="uk-icon uk-icon-edit"></i></a>
                &nbsp;
                <a href="/admin/category/del/<?php echo $v['cid'] ?>" title="删除" style="display: none"><i class="uk-icon uk-icon-trash"></i></a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
</body>
</html>