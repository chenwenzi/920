

<div><img src="/images/school_banner.jpg" class="fullpic"></div>
<div class="container">
    <div class="clear2"></div>
    <ul class="voted_list school">
        <?php foreach($school as $v): ?>

            <li>
                <a class="pic_box" href="/s/<?php echo $v['id'] ?>.html"><img src="<?php echo val($v['avatar'],'/images/default-school.jpg') ?>" class="fullpic" style="border-radius:5px">
                    <div class="row">
                        <div class="col-md-12 text-center"> <?php echo $v['title'] ?></div>
                    </div>

                </a>
            </li>

        <?php endforeach ?>

    </ul>
    <div class="clear"></div>
    <div class="pagination">
        <?php echo $links ?>
    </div>
</div>




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
  var wx_title = '920能力风暴教师节活动', wx_desc = '2017能力风暴教师节活动风暴再起，决战920！火热开启！', wx_link = 'http://920.abilix.com/s/', wx_img = 'http://920.abilix.com/images/share.jpg';
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
