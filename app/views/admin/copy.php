<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style/admin/css/admin.css" />
</head>
<body>
<table class="form-table" border="1">
    <tr>
        <td colspan='2' class="th"><span class="span_people">&nbsp</span>欢迎光临</td>
    </tr>
    <tr>
        <td>用户名</td>
        <td><?php echo $this->session->is_admin ? '超级牛逼管理员' : $this->session->username; ?></td>
    </tr>
    <tr>
        <td>登录时间</td>
        <td><?php echo date('Y-m-d H:i:s', $this->session->logintime) ?></td>
    </tr>
    <tr>
        <td>客户端IP</td>
        <td><?php echo $this->input->ip_address() ?></td>
    </tr>
    <!--		<tr>-->
    <!--			<td colspan='2' class="th"><span class="span_server" style="float:left">&nbsp</span>服务器信息</td>-->
    <!--		</tr>-->
    <!--		<tr>-->
    <!--			<td>服务器环境</td>-->
    <!--			<td>--><?php //echo $this->input->server('SERVER_SOFTWARE') ?><!--</td>-->
    <!--		</tr>-->
    <!--		<tr>-->
    <!--			<td>PHP版本</td>-->
    <!--			<td>--><?php //echo PHP_VERSION ?><!--</td>-->
    <!--		</tr>-->
    <!--		<tr>-->
    <!--			<td>服务器IP</td>-->
    <!--			<td>--><?php //echo $this->input->server('SERVER_ADDR') ?><!--</td>-->
    <!--		</tr>-->
    <!--		<tr style="display:none">-->
    <!--			<td>数据库信息</td>-->
    <!--			<td>--><?php ///*echo mysql_get_server_info()*/ ?><!--</td>-->
    <!--		</tr>-->

</table>
</body>
</html>