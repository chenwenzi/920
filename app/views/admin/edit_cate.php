<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <title>Document</title>
	<style type="text/css">
		span{
			color: #f00;
		}
	</style>
</head>
<body>
	<form action="/admin/category/do_edit" method="POST">
	<table class="table">
		<tr>
			<td class="th" colspan="3">编辑分类</td>
		</tr>
		<tr>
            <td style="width:100px">名称</td>
			<td style="width:300px"><input type="text" name="cname" value="<?php echo $category[0]['cname'] ?>"/><?php echo form_error('cname', '<span>', '</span>') ?></td>
            <td>&nbsp;</td>
		</tr>
		<tr>
			<input type="hidden" name="cid" value="<?php echo $category[0]['cid'] ?>"/>
            <td style="width:100px">&nbsp;</td>
			<td colspan="2"><input type="submit" value="更新 &raquo; " class="input_button"/></td>
		</tr>
	</table>
	</form>
</body>
</html>