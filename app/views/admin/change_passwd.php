<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css?">
    <title></title>
</head>
<body>
<form action="/admin/admin/change_passwd" method="POST">
    <table class="table" border="0" style="border: none">
        <tr>
            <td class="th" colspan="2">修改密码</td>
        </tr>
        <tr>
            <td><input type="text" value="<?php echo $this->session->username ?>" disabled></td>
        </tr>
        <tr>
            <td><input type="password" name="passwd" placeholder="原始密码"/></td>
        </tr>
        <tr>
            <td><input type="password" name="passwdF" placeholder="新密码"/></td>
        </tr>
        <tr>
            <td><input type="password" name="passwdS" placeholder="确认密码"/></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" class="input_button" value=" 更新 &raquo; " />
            </td>
        </tr>
    </table>
</form>
</body>
</html>