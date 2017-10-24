<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css?885">
    <link rel="stylesheet" type="text/css" href="/style/admin/uikit/css/uikit.almost-flat.min.css" >
    <style>
        @media all and (max-width: 768px) {
            .admin {
                display: block
            }
        }
    </style>
</head>
<body>
<table class="form-table" border="1" class="under">
    <tbody>作品列表</tbody>

    <tr>
        <?php
        $order_id = '?orderby=id&direct=' . $redirection;
        $order_vote = '?orderby=v&direct=' . $redirection;
        $order_time = '?orderby=a&direct=' . $redirection;
        $arrow = $redirection=='asc' ? ' &uarr;' : ' &darr;';

        echo '<th class="td2"><a href="'.$order_id .'" target="_self">ID'.$arrow.'</a></th>';
        echo '<th>标题</a></th>';
        echo '<th class="td4">分类</th>';
        echo '<th class="td6"><a href="'.$order_vote .'" target="_self">作品票'.$arrow.'</a></th>';
        echo '<th class="td4"><a href="'.$order_time .'" target="_self">更新时间'.$arrow.'</a></th>';

        ?>

        <?php
        if($this->session->is_admin){
            echo '<th class="td5">作者</th>';
        }
        ?>
        <th class="td6">操作</th>
    </tr>

    <?php foreach($article as $v): ?>
        <tr>
            <td class="td2"><?php echo $v['id'] ?></td>
            <td>
                <?php
                $cid = intval($v['cid']);
                echo in_array($cid, [3,4]) ? '<a href="/p/'.$v['id'].'.html" target="_blank">'.$v['title'].'</a>' : $v['title'];
                if(intval($v['isvote'])==1){echo '<sup style="color:#f00"> 参赛</sup>';}
                ?>
            </td>
            <td class="td2"><?php echo $v['cname'] ?></td>
            <td class="td6"><?php echo intval($v['cid'])==1 ? $v['vote'] : '&nbsp;';  ?></td>
            <td class="td4"><?php echo $v['add_time'] ?></td>
            <?php
            if($this->session->is_admin){
                echo strlen($v['username']) > 9 ? '<td class="td5">'.$v['username'] .'</td>' : '<td class="td5"><a href="/u?q='.urlencode($v['username']).'" target="_blank">'.$v['username'] .'</a></td>';
            }
            ?>
            <td class="td6">
<!--                <a href="/p/--><?php //echo $v['id'] ?><!--.html" target="_blank" title="查看"><i class="uk-icon uk-icon-eye"></i></a> &nbsp;-->
                <a class="admin" href="/admin/article/edit/<?php echo $v['id'] ?>.html" title="编辑"><span><i class="uk-icon uk-icon-edit"></i> 编辑</span></a>               &nbsp; &nbsp;
                <a class="admin" href="/admin/article/del/<?php echo $v['id'] ?>.html" title="删除" onclick="if (!window.confirm('确认删除：<?php echo $v['title'] ?>?')) {return false}"><span><i class="uk-icon uk-icon-trash"></i> 删除</span></a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<div class="page">
    <?php echo $links ?>
</div>











</body>
</html>