<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/style/admin/css/public.css">
    <script src="/style/index/js/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/upload.min.js?69"></script>
    <link rel="stylesheet" href="/css/upload.css" type="text/css">
    <title>发布</title>
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
<form action="/admin/article/send" method="POST" enctype="multipart/form-data">
    <table class="form-table" width="100%" border="0" style="border: 0;width: 100%">
        <tr>
            <td><input type="text" name="title" placeholder="标题，必填" value="<?php echo set_value('title') ?>"/>
                <?php echo form_error('title', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td>
                <select name="cid" id="is_vote" style="width: 100%">
                    <option value="2" <?php echo set_select('cid', 2) ?>>助威</option>
                </select>
                <?php echo form_error('cid', '<span>', '</span>') ?>
                <input type="hidden" name="isvote" value="0">
                <input type="hidden" name="content" value="0">
            </td>
        </tr>
        <tr id="uvideo">
            <td><input type="hidden" id="video" name="video" readonly value="<?php echo set_value('video','') ?>" />
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file" multiple>
                <a style="display:none;position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">选择视频</a>
                <div class="upload-tips"> 支持的视频格式：mov,flv,mp4, 推荐直接使用手机上传，小于50M</div>
                <?php echo form_error('video', '<span>', '</span>') ?>
            </td>
        </tr>
        <tr>
            <td><input type="submit" class="input_button" value=" 发布 &rsaquo; "/></td>
        </tr>
    </table>
</form>
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
			'fileSizeLimit'	   : '25MB',
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
