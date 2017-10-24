<div class='sidebar'>
    <div class='item'>
        <h2>最新学校</h2>
        <ul class='flink'>
            <?php foreach ($title as $v): ?>
                <li><a href="/s/<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>

</div>