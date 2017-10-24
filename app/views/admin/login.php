<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url() . 'style/admin/' ?>css/login.css" />
	<script type="text/javascript" src="<?php echo base_url() . 'style/admin/' ?>js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'style/admin/' ?>js/login.js"></script>
	<title></title>
    <script>
        if (top.location != self.location){top.location=self.location}
    </script>
</head>
<body>
	<div id="divBox">
		<form action="<?php echo site_url('admin/login/login_in') ?>" method="POST" id="login">
			<input type="text" id="userName" name="username"/>
			<input type="password" id="psd" name="passwd"/>
			<input type="" value="" id="verify" name="captcha"/>
			<input type="submit" id="sub" value=""/>
			<!-- 验证码 -->
			<div class="captcha">
				<img src="<?php echo site_url('admin/login/code') ?>" alt="" />
			</div>
		</form>
		<div class="four_bj">
			
			<p class="f_lt"></p>
			<p class="f_rt"></p>
			<p class="f_lb"></p>
			<p class="f_rb"></p>
		</div>
	</div>
<!--[if IE 6]>
    <script type="text/javascript" src="<?php echo base_url() . 'style/admin/' ?>js/iepng.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('form','background');
    </script>
<![endif]-->
</body>
</html>