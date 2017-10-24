<?php

$config = array(
    'article'	=>	array(
        array(
            'field'	=>	'title',
            'label'	=> '标题',
            'rules'	=> 'required|min_length[1]|max_length[50]'
        ),
        array(
            'field'	=>	'isvote',
            'label'	=> '类型',
            'rules'	=> 'required|integer'
        ),
        array(
            'field'	=>	'cid',
            'label'	=> '分类',
            'rules'	=> 'required|integer'
        ),
        array(
            'field'	=>	'content',
            'label'	=> '内容',
            'rules'	=> 'required|max_length[19999]'
        ),
        array(
            'field'	=>	'video',
            'label'	=> '视频',
            'rules'	=> 'required|min_length[20]'
        ),
    ),
    'article_kj'	=>	array(
        array(
            'field'	=>	'title',
            'label'	=> '标题',
            'rules'	=> 'required|min_length[1]|max_length[50]'
        ),
        array(
            'field'	=>	'isvote',
            'label'	=> '类型',
            'rules'	=> 'required|integer'
        ),
        array(
            'field'	=>	'cid',
            'label'	=> '分类',
            'rules'	=> 'required|integer'
        ),
        array(
            'field'	=>	'content',
            'label'	=> '内容',
            'rules'	=> 'required|max_length[19999]'
        )
    ),
    'article_edit'	=>	array(
        array(
            'field'	=>	'title',
            'label'	=> '标题',
            'rules'	=> 'required|min_length[1]|max_length[50]'
        ),
        array(
            'field'	=>	'isvote',
            'label'	=> '类型',
            'rules'	=> 'integer'
        ),
        array(
            'field'	=>	'content',
            'label'	=> '内容',
            'rules'	=> 'required|max_length[19999]'
        )

    ),
    'profile'	=>	array(
        array(
            'field'	=>	'avatar',
            'label'	=> '头像',
            'rules'	=> 'callback_check_upload_pic'
        ),
        array(
            'field'	=>	'sid',
            'label'	=> '分类',
            'rules'	=> 'required|integer'
        ),
        array(
            'field'	=>	'info',
            'label'	=> '口号',
            'rules'	=> 'max_length[155]'
        ),
        array(
            'field'	=>	'intro',
            'label'	=> '个人介绍',
            'rules'	=> 'max_length[19999]'
        )

    ),
    'profile_eidt'	=>	array(
        array(
            'field'	=>	'info',
            'label'	=> '口号',
            'rules'	=> 'max_length[155]'
        ),
        array(
            'field'	=>	'intro',
            'label'	=> '介绍',
            'rules'	=> 'max_length[19999]'
        )

    ),
    'cate'	=> array(
        array(
            'field'	=> 'cname',
            'label'	=> '栏目名称',
            'rules'	=> 'required|max_length[20]'
        ),

    ),

);









