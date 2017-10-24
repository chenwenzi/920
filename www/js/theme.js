/**
 * Created by lishaoxing on 2017/8/19.
 */
$(document).ready(function(){

    $('#show_video .slider').slick({
        dots:false,
        arrows:true,
        slidesToShow: 3,
        autoplay: false,
        autoplaySpeed: 2000,
    });
    $('#show_video2 .slider').slick({
        dots:false,
        arrows:true,
        slidesToShow: 4,
        autoplay: false,
        autoplaySpeed: 2000,
    });
    // $('.course_tab ul li').click(function(){
    //     setTimeout(function(){
    //         $('#pdf_down_list .slider')[0].slick.refresh()
    //     },100);
    //     setTimeout(function(){
    //         $('#pdf_down_list .slider').css('visibility','visible')
    //     },200);
    // },100);

    $('#pdf_down_list .slider').slick({ //PDF下载
        dots:false,
        arrows:true,
        slidesToShow: 4,
        autoplay: false,

    });

    $('.teacher_home_bg .slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.teacher_home_bg .slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        focusOnSelect: true
    });

    //首页视频播放
    $(".btn-video").click(function() {
        $("#video-modal .modal-title").html($(this).attr("title"));
        $("#video-modal .modal-body").html("<video src='"+ ($(this).attr("data-target") ? $(this).attr("data-target") : $(this).attr("href")) +"' width='100%' controls autoplay></video>");
        $("#video-modal").modal("show");
        return false;
    });
    $("#video-modal").on("hide.bs.modal", function() {
        $("#video-modal .modal-body").html("");
    });

    //手机版
	//设置视频高宽
	if(screen.width < 765){
		var w = $(".video_box").width();
		$(".video-js").width(w);
		$(".video-js").height(Math.round(w * 0.56));
		$(".video_s").width(w - 56);
		$(".video_s").height(Math.round(w * 0.56)-30);
	}


	if(screen.width < 765){
		$('#show_pic .slider').slick({
			dots:false,
			arrows:true,
			slidesToShow: 2,
			autoplay: false,
			autoplaySpeed: 2000,
		});
	}
	else {
		$('#show_pic .slider').slick({
			dots:false,
			arrows:true,
			slidesToShow: 5,
			autoplay: false,
			autoplaySpeed: 2000,
		});
	}

	if(screen.width < 765){
		$('#course_show .slider').slick({
			dots:false,
			arrows:true,
			slidesToShow: 2,
			autoplay: false,
			autoplaySpeed: 2000,
		});
	}
	else {
		$('#course_show .slider').slick({
			dots:false,
			arrows:true,
			slidesToShow: 4,
			autoplay: false,
			autoplaySpeed: 2000,
		});
	}

});

