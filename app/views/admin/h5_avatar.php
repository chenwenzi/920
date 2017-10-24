<!DOCTYPE html>
<html>
<head>
    <title>上传头像</title>
    <meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
    <meta http-equiv="description" content="this is my page">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="/avatar/css/bootstrap.min.css">
    <link rel="stylesheet" href="/avatar/css/cropper.css">
    <link rel="stylesheet" href="/avatar/css/myCrop.css">
    <style>
        body{margin:0 auto;text-align: center;}

        .nav-back{position:relative;margin:10px auto;height:20px; clear: both;text-align: left;padding: 0 10px}
        .files{position:relative;margin:0 auto 20px auto;width: 100%; max-width: 300px; text-align: center}
        .files .files2{position: absolute;top:0;left:0;display: block;width: 100%; max-width: 300px;}
        .files .files3{position: absolute;top:0;left:0;width: 100%}
        .myfile{width: 100%; height:40px; filter:alpha(opacity=0);-moz-opacity:0;-khtml-opacity:0;opacity: 0}

        .save{width:100%; max-width:300px; display:block;margin:5px auto;text-align:center}
        .sub-btn{width:100%;height:2em;display: none}

        @media screen and (min-width: 768px) {
            .nav-back{max-width:600px;width: 100%; margin: 30px auto}
        }
        <?php if($is_school=='yes') {echo '.files,.files .files2,.save{max-width:380px}';} ?>
    </style>
</head>

<body>
<div class="nav-back"><a href="javascript:history.go(-1)">&laquo; 返回</a></div>

<div class="files">
    <div class="files2"><input id="photoBtn" type="button" value="选择头像" style="width:100%;height:2em;"></div>
    <div class="files3"><input  id="inputImage"  type="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff" class="myfile"/></div>
    <div style="display: block;height: 50px; clear: both"></div>
    <img  id="showImg" border="0" style="border-radius: 5px" />
</div>

<div class="container" style="padding: 0;margin: 0;position:fixed;display: none;top: 0;left: 0;z-index: 200;" id="containerDiv">
    <div class="row" style="display: none;" id="imgEdit">
        <div class="col-md-9">
            <div class="img-container">
                <img src="" alt="Picture">
            </div>
        </div>
    </div>
    <div class="row" id="actions" style="padding: 0;margin: 0;width: 100%;position: fixed;bottom: 5px;">
        <div class="col-md-9 docs-buttons">
            <div class="btn-group" >
                <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy" style="height: auto;">
	            <span class="docs-tooltip" data-toggle="tooltip" >
	              <span class="fa fa-power-off" >取消</span>
	            </span>
                </button>
            </div>

            <div class="btn-group" >
                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate Left">
				<span class="docs-tooltip" data-toggle="tooltip">
				  旋转
				</span>
                </button>
            </div>


            <div class="btn-group btn-group-crop " style="float: right;">
                <?php if($is_school == 'yes') {
                    echo '<button type="button" class="btn btn-primary" id="imgCutConfirm" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 380, &quot;height&quot;: 320 }" style="height: auto;margin-right: 17px;">';
                }else{
                    echo '<button type="button" class="btn btn-primary" id="imgCutConfirm" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 300, &quot;height&quot;: 400 }" style="height: auto;margin-right: 17px;">';
                }

                ?>

                    <span class="docs-tooltip" data-toggle="tooltip" title="">确认</span> <!--cropper.getCroppedCanvas({ width: 320, height: 180 }) -->
                </button>
            </div>

        </div><!-- /.docs-buttons -->
    </div>
</div>

<!-- 预览 -->
<div class="modal fade docs-cropped" id="getCroppedCanvasModal" style="display: none"
     role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="getCroppedCanvasTitle" >预览</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="height: auto;">取消</button>
                <a class="btn btn-primary" id="imgCutConfirm" href="javascript:void(0);" style="height: auto;">确认</a>
            </div>
        </div>
    </div>
</div><!-- /.预览 -->

<style>
    #res{font-size: 1em;font-weight: bold}
    .ok{color:#659f13;}
    .red{color:#990000}
</style>

<div class="save"><input type="button" id="save-img" onclick="submitForm()" value="更新" class="sub-btn">
    <div id="res"></div>
</div>

</body>
<script>
    var is_school = '<?php echo $is_school ?>';
    var the_aspectRatio = is_school == 'yes' ? 1.1875 : 0.75;//裁剪框宽：高， 头像： 3 / 4， 校区：1.18
    var uri = is_school == 'yes' ? '/admin/school/h5_upload_avatar' : '/admin/profile/h5_upload_avatar';
</script>
<script type="text/javascript" src="/avatar/js/jquery.min.js" ></script>
<script type="text/javascript" src="/avatar/js/exif.js"></script>
<script type="text/javascript" src="/avatar/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/avatar/js/cropper.js?5555"></script>
<script type="text/javascript" src="/avatar/js/canvas-to-blob.min.js"></script>
<script type="text/javascript" src="/avatar/js/myCrop.js?v=1.0.5"></script>
<script type="text/javascript">
    var fileImg = "";

    $(function(){

        $("#imgCutConfirm").bind("click",function(){
            $("#containerDiv").hide();
            $("#imgEdit").hide();
            $("#getCroppedCanvasModal").modal("hide");
            $("#res").html('');
            $("#save-img").show();
        })
    })

    //提交表达
    function submitForm(){


        var formData = new FormData($("#registerForm")[0]);
        $("#registerForm").attr("enctype","multipart/form-data");
        //formData.append("imgBase64",encodeURIComponent(fileImg));//
        //formData.append("fileFileName","photo.jpg");
        formData.append('files',fileImg,'upload.jpg')




        $.ajax({
            url: uri,
            type: 'POST',
            data: formData,
            timeout : 10000, //超时时间设置，单位毫秒
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                console.log(result);
                if(result=='success'){
                    $("#res").html('<span class="ok">更新成功 &checkmark;</span>');
                    $("#save-img").hide();
                }else{
                    $("#res").html('<span class="red">更新失败，请重试！</span>');
                    $("#save-img").hide();
                }
            },
            error: function (returndata) {
                console.log(returndata);
                $("#res").html('<span class="red">网络错误请重试！</span>');
            }
        });

    }

</script>

</html>
