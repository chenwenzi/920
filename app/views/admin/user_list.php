<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css?85">
    <link rel="stylesheet" type="text/css" href="/style/admin/uikit/css/uikit.almost-flat.min.css" >
    <style>h3,h3 a{font-size:1.1em}</style>
</head>
<body>
<table class="form-table" border="1" class="under">
    <h3 style="font-size:1.3em">
    <?php
        echo $tb=='profile' ? '教师列表 / <a href="/admin/article/userlist/school" target="_self">学校列表</a>' : '<a href="/admin/article/userlist/profile" target="_self">教师列表</a> / 学校列表';
    ?>
    </h3>

    <tr>
        <?php
        $order_id = '?orderby=id&direct=' . $redirection;
        $order_title = '?orderby=t&direct=' . $redirection;
        $order_vote = '?orderby=vr&direct=' . $redirection;
        $order_time = '?orderby=r&direct=' . $redirection;
        $arrow = $redirection=='asc' ? ' &uarr;' : ' &darr;';

        echo '<th class="td2"><a href="'.$order_id .'" target="_self">ID'.$arrow.'</a></th>';
        echo '<th class="td1"><a href="'.$order_title .'" target="_self">名字'.$arrow.'</a></th>';
        echo '<th class="td2">头像</th>';
        echo '<th class="td3" '. $hide .'>学校</th>';
        echo '<th class="td6" '.$hide.'><a href="'.$order_vote .'" target="_self">个人票'.$arrow.'</a></th>';
        echo '<th class="td4"><a href="'.$order_time .'" target="_self">更新时间'.$arrow.'</a></th>';
        ?>
    </tr>

    <?php foreach($userList as $v): ?>
        <tr>
            <td class="td2"><?php echo $v['id'] ?></td>
            <td>
                <?php
                $link = $tb=='profile' ? '/u/'.$v['id'].'.html' : '/s/'.$v['id'].'.html';
                echo '<a href="'.$link.'" target="_blank">'.$v['title'].'</a>';
                ?>
            </td>
            <td class="td2"><img src="<?php echo val($v['avatar'],'/images/default-avatar.jpg') ?>" style="height:30px" border="0"> </td>
            <td class="td3" <?php echo $hide ?>>
                <?php
                  echo  $tb=='profile' ? '<a href="/s/'. $v['sid'] .'.html" target="_blank">'. $v['stitle'] .'</a>' : '&nbsp;';
                ?>
            </td>
            <td class="td6" <?php echo $hide ?>><?php echo $tb=='profile' ? val($v['vote'],'0') : '';  ?></td>
            <td class="td3"><?php echo $v['regtime']  ?></td>
        </tr>
    <?php endforeach ?>
</table>
<div class="page">
    <?php echo $links ?>
</div>











</body>
</html>