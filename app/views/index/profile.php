<style>
    img{
        width: auto !important;
        max-width: 100%;
    }
    .tooltip-inner{
        padding: 10px 15px;
    }
</style>
<style type="text/css">

    .withLove {
        overflow: hidden;
        text-align: center;
        padding-bottom: 0;
        cursor: default;
        color: #616c84;
    }
    .withLove * {
        display: inline-block;
    }
    .withLove .alpha, .withLove .omega {
        width: 40%;
    }
    .withLove .alpha {
        text-align: right;
    }
    .withLove .omega {
        text-align: left;
    }
    .withLove .heart {
        margin: 0 -2px;
        position: relative;
        z-index: 3;
        -webkit-animation: throb 1.33s ease-in-out infinite;
        animation: throb 1.33s ease-in-out infinite;
    }
    .withLove .heart path {
        fill: #ff005d;
    }
    @media screen and (min-width: 300px) {
        .withLove .heart {
            width: 30px;
            height: 30px;
            top: .4em;
        }
    }
    @media screen and (min-width: 460px) {
        .withLove .heart {
            top: .5em;
            width: 50px;
            height: 50px;
        }
    }
    @-webkit-keyframes throb {
        0% {
            -webkit-transform: scale(1);
        }
        50% {
            -webkit-transform: scale(0.8);
        }
        100% {
            -webkit-transform: scale(1);
        }
    }
    @keyframes throb {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(0.8);
        }
        100% {
            transform: scale(1);
        }
    }
</style>

<div id="include_header"></div>
<div class="container-fluid blue_kv">
    <div class="container school_home_bg">
        <div class="row">
            <div class="col-md-4 col-xs-12 text-center">
                <img src="<?php echo val($profile['avatar'], '/images/default-avatar.jpg'); ?>" style="height: 270px; border-radius: 5px">
                <div class="clear2"></div>
                <button id="likeu" type="button" class="btn btn-danger read_bg">给TA投票 (<?php echo $profile['vote'] ?>)</button>
            </div>
            <div class="col-md-8 col-xs-12">
                <p><?php echo $profile['title'] ?></p><br>
                <p>参赛口号：<a href="#"><?php echo val($profile['info'],'暂无') ?></a> </p><br>
                <p>简介：<?php echo val($profile['intro'], '暂无') ?></p><br>
                <p>校区：<?php echo '<a href="/s/'.$profile['sid'].'.html">'.$profile['stitle'].'</a>' ?></p><br>
                <input type="hidden" id="pid" value="<?php echo $profile['id'] ?>">
                <input type="hidden" id="aid" value="<?php echo !empty($article[0]['id']) ? $article[0]['id'] : '' ?>">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="read_line_title">作品展示(照片)</div>
        <div id="show_pic">
            <div class="slider">
                <?php
                if(!empty($article)) {
                    foreach ($article as $v) {
                        $imgs = json_decode($v['imgs'], true);
                        foreach ($imgs as $img) {
                            echo '<div>';
                            echo intval($v['isvote'])==1 ? '<span class="hot"><img src="/images/hot.png"></span>' : '';
                            echo '<a class="example-image-link" href="' . $img . '" data-lightbox="example-set"><img src="' . $img . '" alt="' . sub($v['title']) . '" style="max-height: 140px"></a></div>';
                        }

                    }
                } ?>
            </div>
            <?php
            if(empty($imgs)){
                echo '<div class="read_line_title" style="border:none; color:#999">暂无</div>';
            }
            echo '<div class="read_line_title withLove like" id="like" style="cursor: pointer;border: 1px dashed #f00; margin: 10px auto 0 auto"><svg class="heart" version="1.1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="92.515px" height="73.161px" viewBox="0 0 92.515 73.161" enable-background="new 0 0 92.515 73.161" xml:space="preserve">
  <g><path d="M82.32,7.888c-8.359-7.671-21.91-7.671-30.271,0l-5.676,5.21l-5.678-5.21c-8.357-7.671-21.91-7.671-30.27,0          c-9.404,8.631-9.404,22.624,0,31.255l35.947,32.991L82.32,39.144C91.724,30.512,91.724,16.52,82.32,7.888z" fill="#010101"></path></g></svg> <br> <span style="font-size: 22px"> &nbsp;<span id="c">'. val($article[0]['vote'],'0') .'</span></div><div class="read_line_title" style="border:none;margin: 5px auto;"><span style="font-size: 12px;color: #999">给TA的参赛作品点赞</span></div>';
            ?>
        </div>
    </div>
    <div class="clear2"></div>
    <div class="container video_robot">
        <div class="read_line_title">作品展示(视频)</div>
        <div class="video_box">
            <!--<?php if(!empty($article[0]['video'])){
                $video_type = substr($article[0]['video'],strripos($article[0]['video'], '.')+1);
                $video_type = 'video/'.strtolower($video_type);
                echo '<video id="example_video" class="video-js vjs-default-skin home_video2 " controls poster="" data-setup="{}"><source src="'. $article[0]['video'] .'" /></video>';
            }else{
                echo '<img src="/images/no_video.jpg" class="no_video">';
            } ?>-->
            <?php if(!empty($article[0]['video'])){
				//$video_type = substr($article[0]['video'],strripos($article[0]['video'], '.')+1);
				//$video_type = 'video/'.strtolower($video_type);
				echo '<video src="'. $article[0]['video'] .'" width="560" id="example_video" controls="" autoplay="autoplay"></video>';
			}else{
				echo '<img src="/images/no_video.jpg" class="no_video">';
			} ?>


        </div>
        <div class="clear"></div>
        <div id="show_video">
            <div class="slider">
                <?php
                if(!empty($article[0]['video'])) {
                    foreach ($article as $v) {
                        $video_type = substr($v['video'],strripos($v['video'], '.')+1);
                        $video_type = 'video/'.strtolower($video_type);
                        echo '<div><a href="' . $v['video'] . '" class="btn-video" title="' . sub($v['title']) . '"><img src="/images/default-play2.png" alt="' . $v['title'] . '"></a></div>';
                    }
                }?>
            </div>
        </div>
    </div>

    <div class="container course_tab">
        <div class="read_line_title">课程展示</div>

        <div id="course_show">
            <div class="slider">
                <?php
                if(!empty($kc)) {
                    foreach ($kc as $v) {
                        $kcimgs = json_decode($v['imgs'], true);
                        echo '<div><a href="/p/'.$v['id'].'.html" ><img src="' . val($kcimgs[0],'/images/default-school.jpg') . '" alt="' . $v['title'] . '" style="max-height: 140px"><p>'.sub($v['title']).'</p></a></div>';
                    }
                } ?>
            </div>
            <?php
            if(empty($kc[0]['id'])){
                echo '<div class="read_line_title" style="border:none; color:#999">暂无</div>';
            }
            ?>
        </div>

    </div>

    <div class="container course_tab">

        <div class="read_line_title">教案展示</div>

        <div id="pdf_down_list">
            <div class="slider">
                <?php
                if(!empty($ja)) {
                    foreach($ja as $v) {
                        $jaimgs = json_decode($v['imgs'], true);
                        echo '<div><a href="/p/'.$v['id'].'.html" ><img src="'.val($jaimgs[0],'/images/default-school.jpg').'" alt="'.$v['title'].'" style="max-height: 140px"><p>'.sub($v['title']).'</p></a></div>';
                    }
                } ?>
            </div>
            <?php
            if(empty($ja[0]['id'])){
                echo '<div class="read_line_title" style="border:none; color:#999">暂无</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="read_line_title">助威团</div>
    <div id="show_video2">
        <div class="slider">
            <?php
            if(!empty($cheer[0]['video'])) {
                foreach ($cheer as $v) {
                    echo '<div><a href="' . $v['video'] . '" class="btn-video" title="' . $v['title'] . '"><img src="/images/cheer.jpg" alt="' . $v['title'] . '"></a></div>';
                }
            } ?>
        </div>
        <?php
        if(empty($cheer[0])) {echo '<div class="read_line_title" style="color: #999; border: none">暂无</div>';}
        ?>
    </div>
    <div class="clear2"></div>
    <div class="panel panel-primary comment_box" style="display: none">
        <div class="panel-heading">评论留言</div>
        <div class="panel-body">
            <div class="container-fluid">
                <div class="navbar-header"><img class="media-object" src="/images/robot_icon.png" alt=" "></div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <form class="navbar-form navbar-left  ">
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder=" " style="width: 850px;">
                        </div>
                        <button type="submit" class="btn btn-default">发表评论</button>
                    </form>
                </div>
            </div>
            <div class="media_box">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="/images/header_icon.jpg" alt=" ">
                        </a>
                    </div>
                    <div class="media-body">
                        <a class="author" href="#">讯月 </a>
                        <div class="date">&nbsp;&nbsp; 2 天前</div>
                        <div class="clear"></div>
                        <p>能力风暴机器人真实让人思维开阔的极好方式！</p>
                        <div class="actions">
                            <a><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>(0)</a>
                            <a class="reply"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 回复</a>
                        </div>
                        <textarea class="form-control hidden" id="message-text"></textarea>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="/images/header_icon.jpg" alt=" ">
                        </a>
                    </div>
                    <div class="media-body">
                        <a class="author" href="#">讯月 </a>
                        <div class="date">&nbsp;&nbsp; 2 天前</div>
                        <div class="clear"></div>
                        <p>能力风暴机器人真实让人思维开阔的极好方式！</p>
                        <div class="actions">
                            <a><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> (0)</a>
                            <a class="reply"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 回复</a>
                        </div>
                        <textarea class="form-control hidden" id=" "></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="/js/jquery.cookie.min.js"></script>
<script>
    var token = '<?php echo $token ?>',itoken = '<?php echo $itoken ?>';
    $(function () {
        $.cookie('pid', $('#pid').val(), { expires: 1, path: '/' });
        $.cookie('aid', $('#aid').val(), { expires: 1, path: '/' });
    });
    function showPopover(t, msg) {
        t.attr("data-original-title", msg);
        $('[data-toggle="tooltip"]').tooltip();
        t.tooltip('show');
        t.focus();
        var id = setTimeout(
            function () {
                t.attr("data-original-title", "");
                t.tooltip('hide');
            }, 2000
        );
    }
    $('#likeu').click(function () {
        var t = $(this);
        if($.cookie('likeu') == 'vote'){
            showPopover(t, '你已经投过票啦！！');
            return;
        }
        if($.cookie('pid') == null){
            showPopover(t, '刷新页面重试！！');
            return;
        }
        $.ajax({
            url: '/z/'+$('#pid').val()+'?itoken='+itoken,
            method: 'get',
            dataType: 'json',
            success:function (r) {
                if(r.code == 0){
                    var pc = $('#likeu').html(),pci=parseInt(pc.replace('给TA投票 (','').replace(')',''))+1;
                    $('#likeu').html('给TA投票 ('+pci+')');
                    showPopover(t, r._msg);
                    $.cookie('likeu', 'vote', { expires: 1, path: '/' });
                }else{
                    showPopover(t, r._msg);
                }
            }
        });
    });
    $('#like').click(function () {
        var t = $(this);
        if($.cookie('like') == 'vote'){
            showPopover(t, '你已经赞过啦！！');
            return;
        }
        if($.cookie('aid') == null){
            showPopover(t, '刷新页面重试！！');
            return;
        }
        $.ajax({
            url: '/v/'+$('#aid').val()+'?token='+token,
            method: 'get',
            dataType: 'json',
            success:function (r) {
                if(r.code == 0){
                    var ac = parseInt($('#c').html())+1;
                    $('#c').html(ac);
                    showPopover(t, r._msg);
                    $.cookie('like', 'vote', { expires: 1, path: '/' });
                }else{
                    showPopover(t, r._msg);
                }
            }
        });
    });
</script>



<?php
require_once FCPATH . "wx/jssdk.php";
$jssdk = new JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  wx.config({
    //debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareQZone'
    ]
  });
  var wx_title = '920能力风暴教师节活动', wx_desc = '2017能力风暴教师节活动风暴再起，决战920！火热开启！', wx_link = 'http://920.abilix.com/u/<?php echo $profile['id'] ?>.html', wx_img = 'http://920.abilix.com/images/share.jpg';
  wx.ready(function () {
	wx.onMenuShareAppMessage({
		title: wx_title,
		desc: wx_desc,
		link: wx_link, 
		imgUrl: wx_img,
		type: 'link', 
		dataUrl: '', 
		success: function () { 
		},
		cancel: function () { 
		}
	});
	wx.onMenuShareTimeline({
		title: wx_title,
		link: wx_link, 
		imgUrl: wx_img,
		success: function () { 
		},
		cancel: function () { 
		}
	});
	wx.onMenuShareQQ({
		title: wx_title,
		desc: wx_desc,
		link: wx_link, 
		imgUrl: wx_img,
		success: function () { 
		},
		cancel: function () { 
		}
	});
	wx.onMenuShareQZone({
		title: wx_title,
		desc: wx_desc,
		link: wx_link, 
		imgUrl: wx_img,
		success: function () { 
		},
		cancel: function () { 
		}
	});
  });
</script>
