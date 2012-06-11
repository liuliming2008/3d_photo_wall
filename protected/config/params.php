<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'晚霞居--更酷的新闻和图片浏览',
	// this is used in error pages
	'adminEmail'=>'liuliming2008@126.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
  
  'upload_dir'=>'data/upload',
  'upload_thumb_dir'=>'data/upload/thumbs',
  'upload_thumb_sizes'=>array('350x200'),
  'upload_thumb_quality'=>80,
  'cats_no'=>array(1=>"新闻", 2=>"国内", 3=>"国际",4=>"自拍",5=>"科技",6=>"娱乐",7=>"体育",8=>"财经",9=>"军事",10=>"女人",11=>"旅游"),
  'cats_name'=>array("新闻"=>1, "国内"=>2, "国际"=>3,"自拍"=>4,"科技"=>5,"娱乐"=>6,"体育"=>7,"财经"=>8,"军事"=>9,"女人"=>10,"旅游"=>11),

);
