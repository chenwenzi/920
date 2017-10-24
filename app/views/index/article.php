<style>
    img{
        /*width: auto !important;*/
        /*max-width: 100%;*/
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
    #show_pic {width: 100%; margin: 3em auto; text-align: center; color: #333;font-size: 1.2em; }
    #show_pic p img {display: block}
    #show_pic p{text-align: left; text-indent: 2.4em}
    #show_pic img{width: 100%;height: auto }
</style>

<div><img src="/images/teacher_banner.jpg" class="fullpic"></div>
<div class="container-fluid">
    <div class="container">
        <div class="read_line_title" style="border: none; color: #333; font-size: 1.7em"> <?php echo $article['title']?></div>
        <div class="read_line_title" style="border: none; width: 100%; margin-top: -30px; color: #999; font-size: 1em; text-align: right"> <?php echo $article['cname'], '，' ,$author['username'] ?>，<?php echo $article['add_time'] ?></div>
        <div class="read_line_title" style="border: none; width: 100%; margin-top: -30px; color: #f00; font-size: 1em; text-align: left"> <a href="javascript:goBack()"> &laquo; 返回 </a> </div>
        <div id="show_pic">
            <?php
            //$imgs = json_decode($article['imgs'], true);
            if(!empty($article['content'])) {
                echo '<div>' . $article['content'] . '</div>';
            }else{
                echo '<p>暂无</p>';
            }
            ?>
        </div>
        <div class='content' style="display: none">
            <?php
            echo strip_tags($article['content']) ?>
        </div>
        <input type="hidden" id="pid" value="<?php echo $article['id'] ?>">
        <div class="read_line_title withLove like" style="cursor: pointer;<?php if((int)$article['cid']!=1){echo ' display:none';}?>" >
            <?php if($article['isvote']==1): ?>
            <svg class="heart" version="1.1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="92.515px" height="73.161px" viewBox="0 0 92.515 73.161" enable-background="new 0 0 92.515 73.161" xml:space="preserve">
  <g><path d="M82.32,7.888c-8.359-7.671-21.91-7.671-30.271,0l-5.676,5.21l-5.678-5.21c-8.357-7.671-21.91-7.671-30.27,0          c-9.404,8.631-9.404,22.624,0,31.255l35.947,32.991L82.32,39.144C91.724,30.512,91.724,16.52,82.32,7.888z" fill="#010101"></path>
  </g></svg>
            <span style="font-size: 34px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;"> &nbsp; <span id="c"><?php echo $article['vote'] ?></span></span>
            <?php else: echo '<span style="font-size: 20px;color:#f00">该作品未参赛</span>'; endif; ?>
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
    $('.like').click(function () {
        var t = $(this);
        $.ajax({
            url: '/v/'+$('#pid').val(),
            method: 'get',
            dataType: 'json',
            success:function (r) {
                if(r.code == 0){
                    var c = parseInt($('#c').html());
                    $('#c').html(c+1);
                    showPopover(t,r._msg);
                }else{
                    showPopover(t,r._msg);
                }
            }
        });
    });
    /**
     * 返回前一页（或返回个人首页）
     */
    function goBack(){
        if ((navigator.userAgent.indexOf('MSIE') >= 0) && (navigator.userAgent.indexOf('Opera') < 0)){ // IE
            if(history.length > 0){
                window.history.go( -1 );
            }else{
                window.location.href = '/u/';
            }
        }else{ //非IE浏览器
            if (navigator.userAgent.indexOf('Firefox') >= 0 ||
                navigator.userAgent.indexOf('Opera') >= 0 ||
                navigator.userAgent.indexOf('Safari') >= 0 ||
                navigator.userAgent.indexOf('Chrome') >= 0 ||
                navigator.userAgent.indexOf('WebKit') >= 0){

                if(window.history.length > 1){
                    window.history.go( -1 );
                }else{
                    window.location.href = '/u/';
                }
            }else{ //未知的浏览器
                window.history.go( -1 );
            }
        }
    }
</script>
