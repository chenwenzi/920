<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <link rel="stylesheet" type="text/css" href="/style/admin/uikit/css/uikit.almost-flat.min.css" >
    <title></title>
</head>
<body>
<?php if(!empty($school['id'])){ ?>
<table class="form-table" border="1">
    <tbody>档案</tbody>

    <tr>
        <td class="td2">名称</td>
        <td>头像</td>
        <td class="td3">联系人</td>
        <td class="td4">电话</td>
        <td class="td5">微信</td>
        <td class="td5">最后更新</td>
        <td>操作</td>
    </tr>
    <tr>
        <td class="td2"><?php echo $school['title'] ?></td>
        <td><?php echo '<img src="'.$school['avatar'].'" style="height:50px" border=0>' ?></td>
        <td class="td3"><?php echo $school['contact'] ?></td>
        <td class="td4"><?php echo $school['tel'] ?></td>
        <td class="td5"><?php echo $school['wx'] ?></td>
        <td class="td5"><?php echo $school['regtime'] ?></td>
        <td>
            <a href="/s/<?php echo $school['id'] ?>.html" target="_blank" title="查看"><span><i class="uk-icon uk-icon-eye"></i> 查看</span></a> &nbsp;           &nbsp;
            <a href="/admin/school/edit/<?php echo $school['id'] ?>" title="编辑"><span><i class="uk-icon uk-icon-edit"></i> 编辑</span></a> &nbsp;
        </td>
    </tr>

</table>
<?php }else{ ?>
<table class="form-table" border="0" style="margin-top: 200px;">
    <tr>
        <td align="center"><a href="/admin/school/news/">还没有档案， 点此创建。</a></td>
    </tr>
</table>
<?php } ?>
</body>
</html>