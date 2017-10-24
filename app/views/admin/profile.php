<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <link rel="stylesheet" type="text/css" href="/style/admin/uikit/css/uikit.almost-flat.min.css" >
    <title>档案</title>
</head>
<body>
<?php if(!empty($profile['id'])){ ?>
<table class="form-table" border="1">
    <tbody>档案</tbody>

    <tr>
        <th class="td3">名字</th>
        <th>头像</th>
        <th class="td2">参赛口号</th>
        <th>学校</th>
        <th>个人票数</th>
        <th class="td4">微信</th>
        <th class="td5">更新时间</th>
        <th>操作</th>
    </tr>
    <tr>
        <td class="td3"><?php echo $profile['title'] ?></td>
        <td><?php echo '<img src="'.$profile['avatar'].'" style="width:100px" border=0>'; ?></td>
        <td class="td2"><?php echo $profile['info'] ?></td>
        <td><?php echo $profile['s_title'] ?></td>
        <td ><?php echo $profile['vote'] ?></td>
        <td class="td4"><?php echo $profile['wx'] ?></td>
        <td  class="td5"><?php echo $profile['regtime'] ?></td>
        <td>
<!--            <a href="/u/--><?php //echo $profile['id'] ?><!--.html" target="_blank" title="查看"><span><i class="uk-icon uk-icon-eye"></i> 查看</span></a> &nbsp;           &nbsp;-->
            <a href="/admin/profile/edit/<?php echo $profile['id'] ?>" title="编辑"><span><i class="uk-icon uk-icon-edit"></i> 编辑</span></a> &nbsp;
        </td>
    </tr>

</table>
<?php }else{ ?>
<table class="form-table" border="0" style="margin-top: 200px;">
    <tr>
        <td align="center"><a href="/admin/profile/news/">还没有档案， 点此创建。</a></td>
    </tr>
</table>
<?php } ?>
</body>
</html>