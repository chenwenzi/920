
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>头票管理系统</title>
<link href="<?php echo base_url() . 'style/index/' ?>css/category.css" rel="stylesheet" />
<?php $this->load->view('index/head') ?>
<div id="main">
		<div class='news'>

			<?php foreach($article as $v): ?>
			<div class='newsList'>
				<div class='newsImage'>
					<a href="/p/<?php echo $v['id'] ?>"><img src="<?php echo $v['imgs'] ?>"/></a>
				</div>
				<div class='newsContent'>
					<h3><a href="/p/<?php echo $v['id'] ?>"><?php echo $v['title'] ?></a></h3>
					<p><?php echo $v['intro'] ?></p>
					<a href="/p/<?php echo $v['id'] ?>" class='more'>更多>></a>
				</div>
			</div>
			<?php endforeach ?>

		</div>
		<?php $this->load->view('index/right') ?>
	</div>

		<?php $this->load->view('index/foot') ?>
</body>
</html>