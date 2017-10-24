<style>
    .tooltip-inner{
        padding: 10px 15px;
    }
</style>


<div><img src="/images/teacher_banner.jpg" class="fullpic"></div>
<div class="container">
    <div class="read_line_title">作品列表</div>
    <div class="clear2"></div>
    <ul class="voted_list">
        <?php foreach($article as $v){
            $img = json_decode($v['imgs'], true);
            echo '<li>
                    <a class="pic_box" href="/u/'.$v['id'].'.html"><img src="'.$img[0].'" class="fullpic" style="height: 150px">
                        <div class="row">
                            <div> '.mb_substr($v['title'], 0, 12).'</div>
                        </div>
                    </a>
                    <button data-container="body" data-placement="top"  data-toggle="popover" data-placement="left" 
			data-content="点赞成功！" type="button" class="btn btn-danger read_bg" data-id="'.$v['id'].'">为TA投票</button>
                </li>';
        } ?>

    </ul>
    <div class="clear"></div>
    <div class="pagination"><ul><li class="active"><a>1</a></li><li><a href="?page=2">2</a></li><li><a href="?page=3">3</a></li><li><a href="?page=4">4</a></li><li><a href="?page=2">&gt;</a></li><li><a href="?page=9">Last</a></li></ul></div>
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
            url: '/v/'+t.attr('data-id'),
            method: 'get',
            dataType: 'json',
            success:function (r) {
                if(r.code == 0){
                    showPopover(t,'点赞成功！');
                }else{
                    showPopover(t,'已经赞过啦！');
                }
            }
        });
    });
</script>
