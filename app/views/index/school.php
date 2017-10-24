<style>
    .tooltip-inner{
        padding: 10px 15px;
    }
</style>


<div class="container-fluid blue_kv">
    <div class="container teacher_home_bg">
        <div class="row">
            <div class="col-md-4 col-xs-12 text-center">
                <div class="slider slider-for">

                    <div><img src="<?php echo val($school['avatar'], '/images/default-school.jpg') ?>" style="border-radius: 5px"></div>
                    <?php
                    $imgs = json_decode($school['imgs'], true);
                    $imgstring = '';
                    if(!empty($imgs[0])){
                        foreach ($imgs as $v){
                            $imgstring .= '<div><img src="'.$v.'" style="border-radius: 5px"></div>';
                        }
                    }
                    echo $imgstring;
                    ?>


                </div>
                <div class="slider slider-nav">

                    <div><img src="<?php echo val($school['avatar'], '/images/default-school.jpg') ?>"></div>
                    <?php echo $imgstring ?>

                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <p><?php echo $school['title'] ?></p><br>
                <p>简介：<?php echo empty($school['intro']) ? '暂无' : strip_tags($school['intro']); ?></p><br>
                <p>校长: <?php echo val($school['contact'], '未填写') ?></p><br>
                <p>联系电话: <?php echo val($school['tel'],'暂无') ?> </p><br>
                <p>校区地址: <?php echo val($school['address'],'未填写') ?> </p><br>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
            <div class="read_line_title">校区老师</div>
            <ul class="voted_list">
                <?php
                foreach ($teachers as $v){
                    echo '<li>
                            <div class="pic_box"><a href="/u/'.$v['id'].'.html"  target="_blank"><img src="'.val($v['avatar'],'/images/default-avatar.jpg').'" class="fullpic" style="border-radius: 5px; "></a>
                            </div>
                            <p>'.$v['title'].'</p>
                            <button style="display: none" type="button" class="btn btn-danger read_bg" data-id="'.$v['id'].'">给TA投票</button>
                        </li>';
                }
                ?>
            </ul>
    </div>
    <div class="clear2"></div>
    <div class="container">
        <div class="read_line_title">联战校区</div>
        <ul class="voted_list school">
            <?php
            if(!empty($relate_school)) {
                foreach ($relate_school as $v) {
                    echo '<li>
                            <a href="/s/'.$v['id'].'.html" target="_blank">
                                <div class="pic_box"><img src="'.val($v['avatar'], '/images/default-school.jpg').'" class="fullpic">
                                    <div class="row">
                                        <div class="col-md-12 text-center"> '.$v['title'].'</div>
                                    </div>
                                </div>
                            </a>
                        </li>';
                }
            }else{
                echo '<li style="width:100%"><div class="row"><div class="read_line_title" style="border:none; color:#999">暂无</div></div></li>';
            }
            ?>
        </ul>
    </div>
    <div class="clear2"></div>
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
            <?php if(empty($cheer[0]['video'])){echo '<div class="read_line_title" style="color: #999; border: none">暂无</div>';} ?>
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



<script>
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
    $('.btn-danger').click(function () {
        var t= $(this);
        $.ajax({
            url: '/z/'+t.attr('data-id'),
            method: 'get',
            dataType: 'json',
            success:function (r) {
                if(r.code == 0){
                    showPopover(t,'投票成功！');
                }else{
                    showPopover(t,'已经投过票啦！');
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
  var wx_title = '920能力风暴教师节活动', wx_desc = '2017能力风暴教师节活动风暴再起，决战920！火热开启！', wx_link = 'http://920.abilix.com/s/<?php echo $school['id'] ?>.html', wx_img = 'http://920.abilix.com/images/share.jpg';
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
