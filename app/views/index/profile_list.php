<style>
    .tooltip-inner{
        padding: 10px 15px;
    }
</style>

<div><img src="/images/teacher_banner.jpg" class="fullpic pc"></div>
<div><img src="/images/teacher_banner_m.jpg" class="fullpic mobile"></div>
<div class="container">
    <div class="clear2"></div>
    <ul class="voted_list">
        <?php foreach($profile as $v){
            echo '<li>
                    <a class="pic_box" href="/u/'.$v['id'].'.html"><img src="'.val($v['avatar'], '/images/default-avatar.jpg').'" class="fullpic" style="border-radius: 3px">
                        <div class="row">
                            <div class="col-md-7 col-xs-7 text-left"> '.$v['title'].'</div>
                            <div class="col-md-5 col-xs-5 text-right" id="vote_'.$v['id'].'">'.$v['vote'].'票</div>
                        </div>
                    </a>
                    <button style="display: none" data-container="body" data-placement="top"  data-toggle="popover" data-placement="left" data-content="点赞成功！" type="button" class="btn btn-danger read_bg" data-id="'.$v['id'].'">为TA投票</button>
                </li>';
        }
        if(empty($profile)){
            echo '<br><br><h1>没有找到符合条件的教师</h1>';
        }
        ?>

    </ul>
    <div class="clear"></div>
    <div class="pagination">
        <?php echo $links ?>
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
        var t = $(this), id = t.attr('data-id'), hid = $('#vote_'+id), ic = parseInt(hid.html().replace('票',''))+1+'票';
        $.ajax({
            url: '/z/'+id,
            method: 'get',
            dataType: 'json',
            success:function (r) {
                if(r.code == 0){
                    $(hid).html(ic);
                    showPopover(t,'点赞成功！');
                }else{
                    showPopover(t,'已经赞过啦！');
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
  var wx_title = '920能力风暴教师节活动', wx_desc = '2017能力风暴教师节活动风暴再起，决战920！火热开启！', wx_link = 'http://920.abilix.com/u/', wx_img = 'http://920.abilix.com/images/share.jpg';
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
