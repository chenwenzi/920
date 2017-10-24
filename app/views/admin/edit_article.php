<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <script src="/style/index/js/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/upload.min.js?67"></script>
    <script type="text/javascript" src="/org/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/org/ueditor/ueditor.all.min.js"></script>
    <link rel="stylesheet" href="/css/upload.css" type="text/css">
    <title>编辑</title>
    <style type="text/css">
        span{
            color: #f00;
        }
        body{margin: 0; padding: 0}
        #queue, #queueimg {
            /*border: 1px solid #E5E5E5;*/
            height: auto;
            overflow: auto;
            margin-bottom: 10px;
            padding: 0 3px 3px;
            width: 100%;
        }

        .upload-tips {
            position:relative;
            margin:20px;
            font-size:.9rem;
            color:#ccc !important;
        }
        @media only screen and (max-width:768px) {
            .upload-tips {
                clear:left;
                padding-top:9px;
            }
        }
        #uploadifive-file_upload{
            margin: 0 auto;
            padding-bottom: 40px;
        }
        .form-table tr,.form-table td{border: none !important;}
    </style>
</head>
<body>
<form action="/admin/article/do_edit/<?php echo $ar['id']?>.html" method="POST" enctype="multipart/form-data">
    <table class="form-table" width="100%" border="0" style="border: 0;width: 100%">
        <tr >
            <td class="th" colspan="10">编辑</td>
        </tr>
        <tr>
            <td><input name="title" type="text" value="<?php echo set_value('title',$ar['title']) ?>" />
                <?php echo form_error('title', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr <?php if((int)$ar['cid']!=1) echo ' style="display:none"'; ?>>
            <td>
                <input type="radio" name="isvote" id="t-1" value="1" <?php if((int)$ar['isvote']==1) echo ' checked="checked"'; echo set_radio('isvote', '1', $ar['isvote']) ?>/> <label for="t-1">参加创新作品大赛</label>
                &nbsp;
                <input type="radio" name="isvote" id="t-0" value="0" <?php if((int)$ar['isvote']==0) echo ' checked="checked"';  echo set_radio('isvote', '0', $ar['isvote']) ?>/> <label for="t-0" >不参赛</label>
            </td>
        </tr>
        <tr>
            <td>
                <input name="title" type="text" value="<?php echo $ar['cname'] ?>" disabled />
            </td>
        </tr>
        <tr <?php if((int)$ar['cid']==3 || (int)$ar['cid']==4) echo ' style="display:none"'; ?>>
            <td><input type="hidden" id="video" name="video" value="<?php echo set_value('video',$ar['video']) ?>"" />
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file">
                <a style="display:none;position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">选择视频</a>
                <div class="upload-tips">支持视频格式:mov,flv,mp4,不更新请留空,小于50M</div>
                <?php echo form_error('video', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr style="display: none">
            <td>
                <textarea style="width:550px;height:50px;"></textarea>
            </td>
        </tr>
        <tr <?php if((int)$ar['cid']==2) echo ' style="display:none"'; ?> id="mydesc">
            <td>
                <div style="width:98%;padding:5px 0">
                    <script type="text/plain" name="content" id="content" style="width:auto;height:300px;">
                        <?php echo set_value('content',$ar['content'], false) ?>
                    </script>
                    <script></script>
                </div>
                <?php echo form_error('content', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td><input type="submit" class="input_button" value=" 更新 &rsaquo; "/></td>
        </tr>
    </table>
</form>
<script>
    var editor = UE.getEditor('content', {
        autoHeight: true,
        toolbars: [['fullscreen', 'undo', 'redo', 'insertimage', 'bold']]
    });
    UE.Editor.prototype.placeholder = function (justPlainText) {
        var _editor = this;
        _editor.addListener("focus", function () {
            var localHtml = _editor.getPlainTxt();
            if ($.trim(localHtml) === $.trim(justPlainText)) {
                _editor.setContent(" ");
            }
        });
        _editor.addListener("blur", function () {
            var localHtml = _editor.getContent();
            if (!localHtml) {
                _editor.setContent(justPlainText);
            }
        });
        _editor.ready(function () {
            _editor.fireEvent("blur");
        });
    };
    editor.placeholder("支持上传图片哦，单个图片小于2.5M！");
</script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#file_upload').uploadifive({
            'auto'             : true,
            'checkScript'      : false,
            'formData'         : {
                'timestamp' : '<?php echo $timestamp;?>',
                'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
            },
            'queueID'          : 'queue',
            'uploadScript'     : '/admin/article/upload_video',
            'buttonText'       : '选择视频或录制',
			'fileSizeLimit'	   : '50MB',
			'uploadLimit'      : 1,
			'queueSizeLimit'   : 1,
			'fileType'         : 'video/*',	
			//'multi'			   : true, 
            'onUploadComplete' : function(file, data) { console.log(data);$('#video').val(data.substr(8)); }
        });
    });
</script>
</body>
</html>
