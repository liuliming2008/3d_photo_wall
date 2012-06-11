<?php

class ShareController extends Controller
{
	public $layout='share/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','indextest','view','links','vote','unvote'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}



	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
    $data="";//{"page":1,"rows":[{"title":null,"ext_url":null,"id":"944","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/49a8d3d84ceebdc9a365be4b4fc7837a350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/49a8d3d84ceebdc9a365be4b4fc7837a350x250.jpg"},{"title":"\u5f17\u83b1\u513f\u5f17\u83b1\u513f:\u4e43\u4e43\u4e2a\u718a\u7684","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=21","id":"942","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/b355c3f69a0226a47418c4545ef3b634350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/b355c3f69a0226a47418c4545ef3b634350x250.jpg"},{"title":"\u7231\u60c5\u8bed\u5f55\u7231\u60c5\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=22","id":"943","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/76df885a16d78dbd3226b03269dbc728350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/76df885a16d78dbd3226b03269dbc728350x250.jpg"},{"title":"\u838e\u838e\u838e\u838e:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=20","id":"941","md":"b4b147bc522828731f1a016bfa72c073","votes":"23","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/d6247f26b0c6fcec98aaf53db639f481350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/d6247f26b0c6fcec98aaf53db639f481350x250.jpg"},{"title":"\u5929\u5929\u8bed\u5f55\u5929\u5929\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=19","id":"940","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/de02f3ff3e0ceaf897959b6609e245f5350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/de02f3ff3e0ceaf897959b6609e245f5350x250.jpg"},{"title":null,"ext_url":null,"id":"939","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/4c16e2baf7fe6b0d7f8840155a635797350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/4c16e2baf7fe6b0d7f8840155a635797350x250.jpg"},{"title":"\u95ed\u95ed:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=16","id":"937","md":"b4b147bc522828731f1a016bfa72c073","votes":"22","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/9ab695543fdfb815064d3dc150301864350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/9ab695543fdfb815064d3dc150301864350x250.jpg"},{"title":null,"ext_url":null,"id":"938","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/d36306d239b55a51c49556a23d529101350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/d36306d239b55a51c49556a23d529101350x250.jpg"},{"title":null,"ext_url":null,"id":"936","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/559e00ed0b5ad757d8c1fbde33df1d6d350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/559e00ed0b5ad757d8c1fbde33df1d6d350x250.jpg"},{"title":null,"ext_url":null,"id":"935","md":"b4b147bc522828731f1a016bfa72c073","votes":"23","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/499efcc3eb38fdb82ca9a733fd4f53fd350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/499efcc3eb38fdb82ca9a733fd4f53fd350x250.jpg"},{"title":"\u770b\u6211\u840c\u4e0d\u840c\uff1f","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=13","id":"934","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/0f105e592f2c5a425e734818ce2ae2ca350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/0f105e592f2c5a425e734818ce2ae2ca350x250.jpg"},{"title":"\u674e_\u9577\u65b0\u674e_\u9577\u65b0:\u4e66\u7b7e\uff0c\u4e66\u7b7e\u7684\u80cc\u540e\uff0c","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=12","id":"933","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/461503b393a46b0645bfac3a83ba5a9c350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/461503b393a46b0645bfac3a83ba5a9c350x250.jpg"},{"title":"_Princess_\u88d9_Princess_\u88d9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=11","id":"932","md":"b4b147bc522828731f1a016bfa72c073","votes":"25","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/42a32c1ab24ab081b2b12c850e6c4796350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/42a32c1ab24ab081b2b12c850e6c4796350x250.jpg"},{"title":"_Princess_\u88d9_Princess_\u88d9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=10","id":"931","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/5cb2607ab9e89143c110d9c3df142c2e350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/5cb2607ab9e89143c110d9c3df142c2e350x250.jpg"},{"title":"\u82a5\u672b\u82b1\u5f00\u672b\u672b\u82a5\u672b\u82b1\u5f00\u672b\u672b:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=9","id":"930","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/55239f88507ee2373106b581f80b8af4350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/55239f88507ee2373106b581f80b8af4350x250.jpg"},{"title":"\u7231\u60c5\u8bed\u5f55\u7231\u60c5\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=8","id":"929","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/2e264a6465d407042bf51856d21fcfe4350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/2e264a6465d407042bf51856d21fcfe4350x250.jpg"},{"title":null,"ext_url":null,"id":"928","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/4ea1953452fbf3ed46fe212dcd88e2f0350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/4ea1953452fbf3ed46fe212dcd88e2f0350x250.jpg"},{"title":"\u590f\u51b0\u4e1d\u51c9\u590f\u51b0\u4e1d\u51c9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=6","id":"927","md":"b4b147bc522828731f1a016bfa72c073","votes":"25","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/dcdc2aa4172510e6c32fcb14083c0e79350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/dcdc2aa4172510e6c32fcb14083c0e79350x250.jpg"},{"title":"\u8bda\u4fe1\u4e92\u542c\u8bda\u4fe1\u4e92\u542c:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=5","id":"926","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/bee2cfda016b6d450f1046e082369f16350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/bee2cfda016b6d450f1046e082369f16350x250.jpg"},{"title":"\u5e9a\u968f\u5fc3\u4e0a\u7684\u53e5\u5b50\u5e9a\u968f\u5fc3\u4e0a\u7684\u53e5\u5b50:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=3","id":"924","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/97b4c56956fa9f7c36efebf6812332cc350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/97b4c56956fa9f7c36efebf6812332cc350x250.jpg"}],"groupshare":"","weburl":"http:\/\/localhost\/pligg","user":0,"total":20,"records":20}";
    
		$this->render('index',array(
			'data'=>$data,
		));
	}
  
  public function actionIndextest()
	{
		
    $data="";//{"page":1,"rows":[{"title":null,"ext_url":null,"id":"944","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/49a8d3d84ceebdc9a365be4b4fc7837a350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/49a8d3d84ceebdc9a365be4b4fc7837a350x250.jpg"},{"title":"\u5f17\u83b1\u513f\u5f17\u83b1\u513f:\u4e43\u4e43\u4e2a\u718a\u7684","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=21","id":"942","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/b355c3f69a0226a47418c4545ef3b634350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/b355c3f69a0226a47418c4545ef3b634350x250.jpg"},{"title":"\u7231\u60c5\u8bed\u5f55\u7231\u60c5\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=22","id":"943","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/76df885a16d78dbd3226b03269dbc728350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/76df885a16d78dbd3226b03269dbc728350x250.jpg"},{"title":"\u838e\u838e\u838e\u838e:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=20","id":"941","md":"b4b147bc522828731f1a016bfa72c073","votes":"23","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/d6247f26b0c6fcec98aaf53db639f481350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/d6247f26b0c6fcec98aaf53db639f481350x250.jpg"},{"title":"\u5929\u5929\u8bed\u5f55\u5929\u5929\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=19","id":"940","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/de02f3ff3e0ceaf897959b6609e245f5350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/de02f3ff3e0ceaf897959b6609e245f5350x250.jpg"},{"title":null,"ext_url":null,"id":"939","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/4c16e2baf7fe6b0d7f8840155a635797350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/4c16e2baf7fe6b0d7f8840155a635797350x250.jpg"},{"title":"\u95ed\u95ed:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=16","id":"937","md":"b4b147bc522828731f1a016bfa72c073","votes":"22","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/9ab695543fdfb815064d3dc150301864350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/9ab695543fdfb815064d3dc150301864350x250.jpg"},{"title":null,"ext_url":null,"id":"938","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/d36306d239b55a51c49556a23d529101350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/d36306d239b55a51c49556a23d529101350x250.jpg"},{"title":null,"ext_url":null,"id":"936","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/559e00ed0b5ad757d8c1fbde33df1d6d350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/559e00ed0b5ad757d8c1fbde33df1d6d350x250.jpg"},{"title":null,"ext_url":null,"id":"935","md":"b4b147bc522828731f1a016bfa72c073","votes":"23","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/499efcc3eb38fdb82ca9a733fd4f53fd350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/499efcc3eb38fdb82ca9a733fd4f53fd350x250.jpg"},{"title":"\u770b\u6211\u840c\u4e0d\u840c\uff1f","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=13","id":"934","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/0f105e592f2c5a425e734818ce2ae2ca350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/0f105e592f2c5a425e734818ce2ae2ca350x250.jpg"},{"title":"\u674e_\u9577\u65b0\u674e_\u9577\u65b0:\u4e66\u7b7e\uff0c\u4e66\u7b7e\u7684\u80cc\u540e\uff0c","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=12","id":"933","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/461503b393a46b0645bfac3a83ba5a9c350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/461503b393a46b0645bfac3a83ba5a9c350x250.jpg"},{"title":"_Princess_\u88d9_Princess_\u88d9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=11","id":"932","md":"b4b147bc522828731f1a016bfa72c073","votes":"25","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/42a32c1ab24ab081b2b12c850e6c4796350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/42a32c1ab24ab081b2b12c850e6c4796350x250.jpg"},{"title":"_Princess_\u88d9_Princess_\u88d9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=10","id":"931","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/5cb2607ab9e89143c110d9c3df142c2e350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/5cb2607ab9e89143c110d9c3df142c2e350x250.jpg"},{"title":"\u82a5\u672b\u82b1\u5f00\u672b\u672b\u82a5\u672b\u82b1\u5f00\u672b\u672b:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=9","id":"930","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/55239f88507ee2373106b581f80b8af4350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/55239f88507ee2373106b581f80b8af4350x250.jpg"},{"title":"\u7231\u60c5\u8bed\u5f55\u7231\u60c5\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=8","id":"929","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/2e264a6465d407042bf51856d21fcfe4350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/2e264a6465d407042bf51856d21fcfe4350x250.jpg"},{"title":null,"ext_url":null,"id":"928","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/4ea1953452fbf3ed46fe212dcd88e2f0350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/4ea1953452fbf3ed46fe212dcd88e2f0350x250.jpg"},{"title":"\u590f\u51b0\u4e1d\u51c9\u590f\u51b0\u4e1d\u51c9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=6","id":"927","md":"b4b147bc522828731f1a016bfa72c073","votes":"25","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/dcdc2aa4172510e6c32fcb14083c0e79350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/dcdc2aa4172510e6c32fcb14083c0e79350x250.jpg"},{"title":"\u8bda\u4fe1\u4e92\u542c\u8bda\u4fe1\u4e92\u542c:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=5","id":"926","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/bee2cfda016b6d450f1046e082369f16350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/bee2cfda016b6d450f1046e082369f16350x250.jpg"},{"title":"\u5e9a\u968f\u5fc3\u4e0a\u7684\u53e5\u5b50\u5e9a\u968f\u5fc3\u4e0a\u7684\u53e5\u5b50:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=3","id":"924","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/97b4c56956fa9f7c36efebf6812332cc350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/97b4c56956fa9f7c36efebf6812332cc350x250.jpg"}],"groupshare":"","weburl":"http:\/\/localhost\/pligg","user":0,"total":20,"records":20}";
    
		$this->render('indextest',array(
			'data'=>$data,
		));
	}
  
  public function actionLinks()
	{
    
    $limit=30;
    $cat = 0;
    $time="nearweek";
    $time_condition=null;
    try
    {
    
    if(isset($_POST['limit']))
      $limit=$_POST['limit'];
    if(isset($_POST['cat']))
      $cat=$_POST['cat']; 
    if(isset($_POST['time']))
      $time=$_POST['time'];

    if( $limit < 0 || $limit >99 ) $limit=99;
    
    if( $time === "today" )
      $time_condition=" TO_DAYS(NOW()) - TO_DAYS(link_published_date) =0";
    elseif ( $time === "nearday" )
       $time_condition=" ABS(TIMESTAMPDIFF(DAY,NOW(),link_published_date)) <= 1";
    elseif ( $time === "yestoday" )
       $time_condition=" ABS(TO_DAYS(NOW()) - TO_DAYS(link_published_date)) = 1";
    elseif ( $time === "nearweek" )
       $time_condition=" ABS(TIMESTAMPDIFF(DAY,NOW(),link_published_date)) <= 7";
    elseif ( $time === "nearmonth" )
       $time_condition=" ABS(TIMESTAMPDIFF(DAY,NOW(),link_published_date)) <= 30";
    elseif ( $time === "lastweek" )
       $time_condition=" ABS(WEEK(NOW())-WEEK(link_published_date))=1 ";
    elseif ( $time === "lastmonth" )
       $time_condition=" ABS(MONTH(NOW())-MONTH(link_published_date)) =1";
    else
       $time_condition="";
    
    $criteria=null;
    if( $cat==0 || $cat=="all")
      $criteria=new CDbCriteria(array(
  			//'condition'=>'link_status=published',
        //'group'=>'link_id',
        'condition'=>$time_condition,
  			'order'=>'link_votes DESC, link_published_date DESC, link_date DESC',
  			'limit'=>$limit,
		  ));
    else 
      $criteria=new CDbCriteria(array(
  			//'condition'=>'link_status=published',
        //'group'=>'link_id',
        'condition'=>'link_category='.$cat." and ".$time_condition,
  			'order'=>'link_votes DESC,link_published_date DESC, link_date DESC',
  			'limit'=>$limit,
  		));
     
    $links = Link::model()->findAllByAttributes(
    array('link_status'=>"published"),
    $criteria
    );
    $link_summary_output ="";
    
    if ($links && count($links)>=1 ) {
      $responce->page = 1; 
      
      $i=0;
  		foreach($links as $item) {
        
        if( $i >= $limit)  break;
        $file_size=Yii::app()->params['upload_thumb_sizes'][0];//"350x200";
        $criteria_files=new CDbCriteria(array(
    			//'condition'=>'link_status=published',
          //'group'=>'link_id',
    			'order'=>'file_number',
    			'limit'=>1,
    		));
        $images = File::model()->findAllByAttributes(
          array('file_link_id'=>$item->link_id,'file_size'=>$file_size),
          $criteria_files
        );
        //$images = $db->get_results($sql,ARRAY_A);// (a.file_size='$upload_defsize' OR a.file_size='350x250')
      	if($images)
      	{
      		$image = $images[0];
          //Yii::log('liming.oriurl.','trace',"link 2:".$i );
          $responce->rows[$i]['title']=$item->link_title_url; 
          $responce->rows[$i]['ext_url']=$item->link_url;
          $responce->rows[$i]['id']=$item->link_id;
          $responce->rows[$i]['md']=md5($item->link_randkey);  //$current_user->user_id
          $responce->rows[$i]['votes']=$item->link_votes;
          $responce->rows[$i]['summary']=$item->link_summary;
          //if( strlen($item->link_summary)>96 ) $responce->rows[$i]['summary']=substr($item->link_summary,0,96);
          //  else     $responce->rows[$i]['summary']=$item->link_summary;
          
          $responce->rows[$i]['image_ori_url'] =  Yii::app()->baseUrl.'/'.Yii::app()->params['upload_dir'].'/'.$image->file_name;
          $responce->rows[$i]['image_thumb_url'] = Yii::app()->baseUrl.'/'.Yii::app()->params['upload_thumb_dir'].'/'.$image->file_name;
          
          $i++;
      	}  
        
        
  		}
       if( $i>=1)
       {
         $current_userid = 0;//$current_user->user_id;
      		//if (!isset($this->group_membered) && $current_userid)
          //		    $this->group_membered = $db->get_results("SELECT group_id,group_name FROM " . table_groups . " WHERE group_creator = $current_userid and group_status = 'Enable'");
          
      		/*$group_membered = $db->get_results("SELECT DISTINCT group_id,group_name FROM " . table_groups . " LEFT JOIN ".table_group_member." ON member_group_id=group_id AND member_user_id = $current_userid WHERE group_status = 'Enable' AND member_status='active'",ARRAY_A);
      
      		$output = '';
      		if ($group_membered)
      			foreach($group_membered as $results)
      				$output .= "<a class='group_member_share' href='".my_base_url.my_pligg_base."/group_share.php?link_id="."link_id"."&group_id=".$results->group_id."&user_id=".$current_user->user_id."' >".$results->group_name."</a><br />";  
          
          $responce->groupshare= $output;   */
          $responce->weburl= Yii::app()->baseUrl;  
          $responce->user=$current_userid;
      		$responce->total = $limit;//$i;//count($links); 
          $responce->records = $i;//count($links); 
          $responce->time=$time_condition;
          
          $links = json_encode($responce);
          //Yii::log('liming.oriurl.','trace',"links 3:".$limit );
          header("content-type: application/json;charset=utf-8");
          
          //header("Expires: -1");
          echo $links;
       }
       else
        echo "";
      
    }
    else
      echo "";
    }  
    catch(Exception $e)
     {
      Yii::log('liming.oriurl.','trace',"getMessage:".$e->getMessage());
      echo "";//'Message: ' .$e->getMessage();
     }
  }
  
  public function actionVote()
	{
    $id=-1;

    if(isset($_POST['id']))
      $id=$_POST['id'];
    if($id!=-1)
    {
       $link = Link::model()->findByPk($id);
       $link->link_votes =$link->link_votes +1;
       $link->save();
    }
  }
  
  public function actionUnvote()
	{
     $id=-1;

      if(isset($_POST['id']))
        $id=$_POST['id'];
      if($id!=-1)
      {
         $link = Link::model()->findByPk($id);
         $link->link_votes =$link->link_votes -1;
         $link->save();
      }
  }
  

}
