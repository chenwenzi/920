<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Vote</title>
    <link href="/style/index/css/index.css" rel="stylesheet" />
    <?php $this->load->view('index/head') ?>
    <div id="main">
        <div class='content'>
            <div  class='list'>
                <div class='title'>
                    <h2>最新作品</h2>
                </div>
                <ul>
                    <?php foreach($zuopin as $v): ?>
                        <li>
                            <div class='post-image'>
                            <span>
                                <a href="/p/<?php echo $v['id'] ?>.html"><img width="" src="<?php echo $v['imgs']?>" /></a>
                            </span>
                            </div>
                            <div class='post-content'>
                                <a href="/p/<?php echo $v['id'] ?>.html"><h3><?php echo $v['title'] ?></h3></a>
                                <p><?php echo $v['intro'] . '...' ?></p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div  class='list'>
                <div class='title'>
                    <h2>热门教师</h2>
                </div>
                <ul>
                    <?php foreach($profile as $v): ?>
                        <li>
                            <div class='post-image'>
                            <span>
                                <a href="/u/<?php echo $v['id'] ?>.html"><img width="" src="<?php echo $v['avatar']?>" /></a>
                            </span>
                            </div>
                            <div class='post-content'>
                                <a href="/p/<?php echo $v['id'] ?>.html"><h3><?php echo $v['title'] ?></h3></a>
                                <p><?php echo $v['info'] . '...' ?></p>
                            </div>
                        </li>
                    <?php endforeach ?>

                </ul>
            </div>
        </div>
        <?php $this->load->view('index/right') ?>
    </div>
    <?php $this->load->view('index/foot') ?>


