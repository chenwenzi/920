<?php
require_once "jssdk.php";
$jssdk = new JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  
</body>
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
  var wx_title = '能力风暴教育机器人官网', wx_desc = '能力风暴是教育机器人的全球开创者和领导者,有面向家庭用户的教育机器人产品、机器人活动中心、学校机器人实验室三大业务线。', wx_link = 'http://m.abilix.com', wx_img = 'http://m.abilix.com/images/share.jpg';
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
</html>
