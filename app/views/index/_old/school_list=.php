
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>头票管理系统</title>
<link href="/style/index/css/category.css" rel="stylesheet" />
<?php $this->load->view('index/head') ?>
<div id="main">
    <h1>学校列表</h1>
		<div class='news'>

			<?php foreach($school as $v): ?>
			<div class='newsList'>
				<div class='newsImage'>
					<a href="/s/<?php echo $v['id'] ?>.html"><img src="<?php echo $v['avatar'] ?>"/></a>
				</div>
				<div class='newsContent'>
					<h3><a href="/s/<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a></h3>
					<p><?php echo mb_substr(strip_tags($v['intro']), 0, 32). '...'; ?></p>
					<a href="/s/<?php echo $v['id'] ?>.html" class='more'>详情 &raquo;</a>
				</div>
			</div>
			<?php endforeach ?>

		</div>
		<?php $this->load->view('index/right') ?>
	</div>

		<?php $this->load->view('index/foot') ?>
</body>
</html>