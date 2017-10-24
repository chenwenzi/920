<link href="/style/index/css/common.css" rel="stylesheet" />
<script src="/style/index/js/jquery-1.7.2.min.js" type="text/javascript"></script>
</head>
<body>
<div id="top">
</div>
<div id="header">
    <div class='logo'>
        <a href="/"><img src="/style/index/images/logo.jpg" alt=""></a>
    </div>
    <div class='navigation'>
        <a href="/">首页</a>
        <?php foreach($category as $v){
            $link = is_numeric($v['cid']) ? '/c/'.$v['cid'] : $v['cid'];
            echo '<a href="'.$link.'.html">'. $v['cname'] .'</a>';
        } ?>
    </div>
</div>