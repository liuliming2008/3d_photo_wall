<?php
include_once(dirname(__FILE__).'/simple_html_dom.php');    
class ImportController extends Controller
{
	

	public function actionAll()
	{
		$this->render('all');   
	}
  
  public function action163()
	{     
    $news_page= file_get_html("http://news.163.com/photorank/");
        
      //echo "\nttt1:".$news_page->plaintext; 
    $contents = $news_page->find('div[class="tabBox"]');
    //echo count($contents)."\nttt:".$contents[0]->plaintext;
    
    //24小时排行
    $this->doit163($contents[0]->children(2),Yii::app()->params['cats_name']["新闻"],9,49,"新闻",5);  
    $this->doit163($contents[1]->children(2),Yii::app()->params['cats_name']["娱乐"],6,39,"娱乐",3);
    
    $this->doit163($contents[2]->children(2),Yii::app()->params['cats_name']["体育"],4,29,"体育",3);
    
    $this->doit163($contents[3]->children(2),Yii::app()->params['cats_name']["财经"],7,19,"财经",5);
    $this->doit163($contents[4]->children(2),Yii::app()->params['cats_name']["科技"],4,19,"汽车",2);
    $this->doit163($contents[5]->children(2),Yii::app()->params['cats_name']["女人"],2,49,"女人",5);
    $this->doit163($contents[8]->children(2),Yii::app()->params['cats_name']["科技"],6,39,"读书",3);
    $this->doit163($contents[9]->children(2),Yii::app()->params['cats_name']["娱乐"],3,19,"游戏",2);
    $this->doit163($contents[10]->children(2),Yii::app()->params['cats_name']["旅游"],5,39,"旅游",2);
    $this->doit163($contents[11]->children(2),Yii::app()->params['cats_name']["科技"],5,29,"教育",1);
    $this->doit163($contents[14]->children(2),Yii::app()->params['cats_name']["科技"],3,19,"数码",1);                                                                
    $this->doit163($contents[15]->children(2),Yii::app()->params['cats_name']["娱乐"],4,29,"手机",1);
    
		$this->render('163');
	}
  
  private function doit163($data,$categary,$vote_start,$vote_end,$tags,$max_count){
    $upload_dir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.Yii::app()->params['upload_dir'];//mnmpath.get_misc_data('upload_directory');
    $settings = "";	
    $trs = $data->find('tr');
    $count=0;

    foreach($trs as $k=>$news) {
      if($count==0) {$count++;continue;}
      $count++;
      if( $count>= $max_count+1)  break;
      $oriurl = $news->children(0)->children(1)->href;
      $oriurltile = iconv("GBK", "UTF-8",$news->children(0)->children(1)->plaintext);
      $news_page= file_get_html($oriurl);
      echo   $oriurl;
      $text = $news_page->find('#setInfo',0);
      if($text==null || $text->children(1)==null)
        continue;
      $text=iconv("GBK", "UTF-8",$text->children(1)->plaintext );
      //echo   "\ntext:".$news_page->find('#photoList',0)->plaintext; 
      $photo = $news_page->find('#photoList',0)->children(0)->children(3);     
      
      $photourl=   $photo->plaintext; 
      if( strpos($text,"163.com")>0)
      {
        $photodesc = $news_page->find('#photoList',0)->children(0)->children(2); 
        $text =  iconv("GBK", "UTF-8",$photodesc->plaintext);  
        echo "yes";  
      }
      echo  "\ntext:".$text;
    
      $link = Link::model()->findByAttributes(array('link_url'=>$oriurl));
      if( $link!=null)
      {
        
         continue;
      }
        
      $link=new Link;
      
      $link->link_author = 1;
      $link->link_status = "published";
      $link->link_votes = $vote_end-$count*($vote_end-$vote_start)/$max_count;//mt_rand($vote_start,$vote_end);
      $link->link_reports = 0;
      $link->link_comments = 0;
      $link->link_karma = 1;
      $link->link_date = date('Y-m-d H:i:s',time() );
      $link->link_published_date = date('Y-m-d H:i:s',time() );
      $link->link_category = $categary;
      $link->link_lang = 1;
      $link->link_url = $oriurl;
      $link->link_url_title = $oriurltile;//引用文章标题
      
      $link->link_title =$oriurltile; //站内标题
      $link->link_title_url = $oriurltile; //站内标题
      $link->link_content = $text; //应用文章内容
      $link->link_summary =$text; //应用文章内容
      $link->link_tags = $tags;
      
        
      $link->save();
      //echo $link;
        
      $url = trim($photourl);
      echo $url;
      if (strlen($url)>10 && strpos($url,'http')===0) 
      {
        if (preg_match('/([^\/]+)\.([^\/]+)$/',$url,$m) || preg_match('/([^\/]+)$/',$url,$m))
      	    $name = $m[1].'.'.$m[2];
      	else
      	    $name = $url;
      	//echo     $m[0].":".$m[1].":".$m[2].":".$m[3];
        global $db;
        
        //$upload_dir = mnmpath.get_misc_data('upload_directory');
      	$filepath = $upload_dir.'/'.$name;
      	echo 'filepath'.$filepath;
      	$file = fopen($filepath,"wb");
      	$str = @file_get_contents($url);
      	fwrite($file,$str);
      	fclose($file);
      
        $fields="";
        
        $file= new File;
        $file->file_size= 'orig';
        $file->file_user_id= 1;     
        $file->file_real_size= filesize("$filepath");   
        $file->file_ispicture= 1;
        $file->file_link_id= $link->link_id;
        $file->file_fields= '';
        $file->file_name= $name;
        $file->save();
            
      	//$count++;
      	$last_id = $file->file_id;
      	//$settings ="";
        
      	$error = $this->generate_thumbs($url,$link->link_id,$settings,$last_id,'',1);
      }
      echo $error;
    }
  }

	public function actionBaidu()
	{
		$str=@file_get_contents("http://news.baidu.com");
    $tag1 = 'cpOptions_1\.data\.push\(';
    $tag2 = '\})\);';
    $pattern = "/".$tag1."([\s\S]*?".$tag2."/";
    preg_match_all($pattern,$str,$result);
    
    //echo "\n000:".$result[0][0];
    //echo "\t000:".$result[1][0];
    //echo "\t000:".$result[1][1];
    //echo "\t000:".$result[1][2];
     
    $news1str=str_replace("'", '"', $result[1][0]);
    $vote_start =55;
    $vote_end=65;
    //focus news
    foreach($result[1] as $k=>$news) { 
      echo $k."\n".$news;
      $news1str=str_replace("'", '"', $news);
      $news1 = json_decode( iconv("GBK", "UTF-8", $news1str));//tb_json_convert_encoding($news1str, "GBK", "UTF-8"));
      
      $link = Link::model()->findByAttributes(array('link_url'=>$news1->url));
      if( $link!=null)
        continue;
      $link=new Link;
      
      $link->link_author = 1;
      $link->link_status = "published";
      $link->link_votes = mt_rand($vote_start,$vote_end);
      $link->link_reports = 0;
      $link->link_comments = 0;
      $link->link_karma = 1;
      $link->link_date = date('Y-m-d H:i:s',time() );
      $link->link_published_date = date('Y-m-d H:i:s',time() );
      $link->link_category = Yii::app()->params['cats_name']["新闻"];
      $link->link_lang = 1;
      $link->link_url = $news1->url;
      $link->link_url_title = $news1->title;//引用文章标题
      
      $link->link_title =$news1->title; //站内标题
      $link->link_title_url = $news1->title; //站内标题
      $link->link_content = $news1->title; //应用文章内容
      $link->link_summary =$news1->title; //应用文章内容
      $link->link_tags = "新闻";
      
    
        
      $link->save();
      //echo $link;
        
      $url = trim($news1->imgUrl);
      echo $url;
      if (strlen($url)>10 && strpos($url,'http')===0) 
      {
        if (preg_match('/([^\/]+)\.([^\/]+)$/',$url,$m) || preg_match('/([^\/]+)$/',$url,$m))
      	    $name = $m[1].'.'.$m[2];
      	else
      	    $name = $url;
        echo "\n".$url;
      	//echo     $m[0].":".$m[1].":".$m[2].":".$m[3];
      	$upload_dir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.Yii::app()->params['upload_dir'];//mnmpath.get_misc_data('upload_directory');
    	  $filepath = $upload_dir.'/'.$name;
      	echo $filepath;
      	$file = fopen($filepath,"wb");
      	$str = @file_get_contents($url);
      	fwrite($file,$str);
      	fclose($file);

      	$file= new File;
        $file->file_size= 'orig';
        $file->file_user_id= 1;     
        $file->file_real_size= filesize("$filepath");   
        $file->file_ispicture= 1;
        $file->file_link_id= $link->link_id;
        $file->file_fields= '';
        $file->file_name= $name;
        $file->save();
            
      	//$count++;
      	$last_id = $file->file_id;
      	$settings ="";
      	//$error = generate_thumbs($url,$link->id,$settings,$last_id);
        $error = $this->generate_thumbs($url,$link->link_id,$settings,$last_id,'',1);
        echo  "\nerror:".$error;
      }
     
    }                
    
    $this->render('baidu');
	}

  public function actionSina()
	{
    //今日
    $top_time = date("Ymd");  
    //                     http://top.news.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat=www_all&top_time=20120527&top_show_num=100&top_order=ASC&js_var=all_1_data
    $top_cat='www_all';
    $this->dosinacategary('http://top.news.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["新闻"],12,48,"新闻",5);
    $top_cat='china';
    $this->dosinacategary('http://top.news.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["国内"],6,56,"国内新闻",8);
    $top_cat='world';
    $this->dosinacategary('http://top.news.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["国际"],7,46,"国际新闻",5);
     
    $top_cat='society';
    $this->dosinacategary('http://top.news.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["国内"],5,38,"社会新闻",5);
    
    $top_cat='all';
    $this->dosinacategary('http://top.sports.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["体育"],3,18,"体育新闻",5);
    
    
    $top_cat='all';
    $this->dosinacategary('http://top.tech.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["科技"],7,38,"科技新闻",6);
    
    $top_cat='all';
    $this->dosinacategary('http://top.finance.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["财经"],3,28,"财经新闻",6);
    
    $top_cat='all';
    $this->dosinacategary('http://top.ent.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["娱乐"],6,18,"娱乐新闻",5);
               
    $top_cat='all';
    $this->dosinacategary('http://top.mil.news.sina.com.cn/ws/GetTopDataList.php?top_type=day&top_cat='.$top_cat.'&top_time='.$top_time.'&top_show_num=20&top_order=ASC&js_var=all_1_data',
    Yii::app()->params['cats_name']["军事"],11,38,"军事新闻",6);
    $this->render('sina');
	}
  
  private function dosinacategary($dataurl,$categary,$vote_start,$vote_end,$tags,$max_count)
  {
    echo "now cat:".$categary;
    $json= file_get_contents($dataurl);
    
    $jsongbk=str_replace("var all_1_data = ", '', $json);
    
    $jsongbk1=substr($jsongbk,0,strripos($jsongbk,';'));
     
    $list = json_decode( iconv("GBK", "UTF-8", $jsongbk1));//tb_json_convert_encoding($news1str, "GBK", "UTF-8"));
    
    $settings = "";//get_upload_settings();
    $upload_dir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.Yii::app()->params['upload_dir'];//mnmpath.get_misc_data('upload_directory');
    	  
    $count=0;  
    foreach($list->data as $k=>$news) {
      
      if( $count>=$max_count) break;
      
      //echo $news->title;
      echo "news->url:".$news->url;
      $news_page= file_get_html($news->url);
      
     
      $content = $news_page->find('div[class="blkContainerSblk"]',0);
      if( $content==null )
      {
        echo "error $content:\n";

        continue;
      }
        
      $oriurl =  $content->find('#media_name',0);
      if( $oriurl->find('#a')!=null )
      {
          
          $oriurl =  $oriurl->first_child ()->href;
          $oriurltile =  iconv("GBK", "UTF-8", $oriurl->first_child ()->plaintext);
      }
      else
      {
          $oriurltile =  iconv("GBK", "UTF-8",$oriurl->plaintext);
          //if( $oriurl->next_sibling() )
          //  $oriurl = $oriurl->next_sibling()->href;
          //else
            $oriurl = $news->url;
      }
      echo "oriurltile:".$oriurltile." oriurl:".$oriurl;      
      
      $contenttext = $news_page->find('#artibody',0);
      if( $contenttext==null )
      {
        echo "error $contenttext:\n";
        continue;
      }
      $contentps =  $contenttext->find("p");
      if( $contentps==null )
      {
        echo "error contentps:\n";
       
        continue;
      }
      $link_content = '';
      echo "count:".count($contentps);
      $link_summary='';
      foreach($contentps as $k=>$contentp) {
        $parent = $contentp->parent();
        //echo  $parent->getAttribute("id");
        //echo  $contentp->plaintext;
        if( strcmp($parent->getAttribute("id"),'artibody')==0 )
        {
            $link_content =$link_content.iconv("GBK", "UTF-8",$contentp->plaintext)."<br />";  
            if( $link_summary == '')
               $link_summary  = mb_convert_encoding(substr($contentp->plaintext,0,300),"UTF-8","GBK");//iconv("GBK", substr($contentp->plaintext,0,300));//substr(iconv("GBK", "UTF-8",$contentp->plaintext),0,299);
            //$link_summary = $link_content.iconv("GBK", "UTF-8",substr($contentp->plaintext,0,96))."<br />"; 
            //echo "\noo".$link_content;
        }
          
      }
      //$link_content =  iconv("GBK", "UTF-8",$link_content);
      //echo  "\nlink_content:".$link_content;     
      $content = $news_page->find('div[class="img_wrapper"]',0);
      
      if( $content == null ||$content->children(0)==null)
      {
        //text  
        continue;        
      }
      else
      {
        //resolve exception
        if( $content->children(0)->children(0)!=null)
           $content = $content->children(0);
        //image
        $imagesrc =    $content->children(0)->src;
        echo   $imagesrc;
        
        //echo $link;
        $link = Link::model()->findByAttributes(array('link_url'=>$oriurl));
        if( $link!=null)
        {
          
          continue;
        }
          
        
        
          
        $url = trim($imagesrc);
        echo $url;
        if (strlen($url)>10 && strpos($url,'http')===0) 
        {
          $link=new Link;
        
          $link->link_author = 1;
          $link->link_status = "published";
          $link->link_votes = $vote_end-$count*($vote_end-$vote_start)/$max_count;;//mt_rand($vote_start,$vote_end);
          $link->link_reports = 0;
          $link->link_comments = 0;
          $link->link_karma = 1;
          $link->link_date = date('Y-m-d H:i:s',time() );
          $link->link_published_date = date('Y-m-d H:i:s',time() );
          $link->link_category = $categary;
          $link->link_lang = 1;
          $link->link_url = $oriurl;
          $link->link_url_title = $oriurltile;//引用文章标题
          
          $link->link_title =$news->title; //站内标题   
          $link->link_title_url = $news->title; //站内标题       
          $link->link_content = $link_content; //应用文章内容
          $link->link_summary = $link_summary;//substr($link_content,0,96);   //编辑内容
          $link->link_tags = $tags;          
          $link->save();
          
          echo "title:".$link->link_title."cat:".$link->link_category."votes:".$link->link_votes."\n";
          if (preg_match('/([^\/]+)\.([^\/]+)$/',$url,$m) || preg_match('/([^\/]+)$/',$url,$m))
        	    $name = $m[1].'.'.$m[2];
        	else
        	    $name = $url;
        	//echo     $m[0].":".$m[1].":".$m[2].":".$m[3];
          global $db;
          
          
        	$filepath = $upload_dir.'/'.$name;
        	echo 'filepath'.$filepath;
        	$file = fopen($filepath,"wb");
        	$str = @file_get_contents($url);
        	fwrite($file,$str);
        	fclose($file);
        
          $fields="";
          $file= new File;
          $file->file_size= 'orig';
          $file->file_user_id= 1;     
          $file->file_real_size= filesize("$filepath");   
          $file->file_ispicture= 1;
          $file->file_link_id= $link->link_id;
          $file->file_fields= $fields;
          $file->file_name= $name;
          $file->save();
              
        	//$count++;
        	$last_id = $file->file_id;
          
        	$settings ="";
        	//$error = generate_thumbs($url,$link->id,$settings,$last_id);
          $error = $this->generate_thumbs($url,$link->link_id,$settings,$last_id,'',1); 
          $count++;         
        }
        echo $error;
        
      }
      //break;
    }   
  
  }
  
	public function actionPp()
	{
    
    $urlbase="http://weibo.pp.cc/weitu/";
    $news_page= file_get_html("http://weibo.pp.cc/weitu/?mod=index&action=hot");
        
 
    $contents = $news_page->find('div[class="wt_home_poto cl"]',0)->find("a");

    $max=20;
    $count=0;
    foreach($contents as $k=>$news)
    {
      if( $count>= $max )
      break;
      $this->doitpp($news,Yii::app()->params['cats_name']["自拍"],20,35,"自拍");
      $count++;
      
    }
    echo "doitpp:count:".$count;
    $news_page=null;
    $contents=null;
    $news_page= file_get_html("http://weibo.pp.cc/weitu/?mod=index");
    //echo "doitpp 2".$news_page;
    $contents = $news_page->find('div[class="wt_home_poto"]',0);
    //echo "doitpp 22".$contents;
    $contents=$contents->find("a");
     echo "doitpp 3";
    $max=20;
    $count=0;
    foreach($contents as $k=>$news)
    {
      if( $count>= $max )
      break;
      $this->doitpp($news,Yii::app()->params['cats_name']["自拍"],20,35,"自拍");
      $count++;
      
    }
    echo "doitpp:count:".$count;
  	$this->render('pp');
	}
  
  public function doitpp($data,$categary,$vote_start,$vote_end,$tags)
  {
    echo "doitpp:";
    $db = Yii::app()->db; //获取数据库连接对象 $conn
    //$transaction = $conn->beginTransaction(); //开启实务
    
    $urlbase="http://weibo.pp.cc/weitu/";
    echo "data:".$data->plaintext;
    $oriurl = $urlbase.$data->href;
    $page = file_get_html($oriurl);
    echo   "oriurl".$oriurl;
    Yii::log('liming.oriurl.','trace',$oriurl);
    $oriurltile = $page->find('dd[class="wt_bt_dd1"]',0)->plaintext;
    Yii::log('liming.oriurltile0.','trace',$oriurltile);
    $oriurltile = str_replace("的微图", '',$oriurltile);
    Yii::log('liming.oriurltile.','trace',$oriurltile);
    $photourl = $page->find('#gallery',0)->children(0)->href;
    
    $text = $oriurltile.":".$page->find('#gallery',0)->find('p[class="wt_pcwt_pcjs"]',0)->children(0)->plaintext;
    //if( strlen($text) >0)
    {
       $oriurltext=$oriurltile.$text;
       Yii::log('liming.new title0:','trace',$oriurltext);
       //$oriurltile=substr($oriurltile,0,48);
       echo "new title:".$oriurltile;
       Yii::log('liming.new title:','trace',$oriurltext);
    }
    if(strlen($oriurltile)<=1)
      $oriurltile = "看我萌不萌？";
   
    $settings = "";//get_upload_settings();
    
    $link = Link::model()->findByAttributes(array('link_url'=>$oriurl,'link_category'=>$categary));
    if( $link!=null)
    {
      echo "dupledate id:".$link->link_id;
       return;
    }
      
    $link=new Link;
    
    $link->link_author = 1;
    $link->link_status = "published";
    $link->link_votes = mt_rand($vote_start,$vote_end);
    $link->link_reports = 0;
    $link->link_comments = 0;
    $link->link_karma = 1;
    $link->link_date = date('Y-m-d H:i:s',time() );
    $link->link_published_date = date('Y-m-d H:i:s',time() );
    $link->link_category = $categary;
    $link->link_lang = 1;
    $link->link_url = $oriurl;
    $link->link_url_title = $oriurltile;//引用文章标题
    
    $link->link_title =$oriurltile; //站内标题   
    $link->link_title_url = $oriurltile; //站内标题       
    $link->link_content = $text; //应用文章内容
    $link->link_summary = $text;//substr($text,0,96);   //编辑内容
    $link->link_tags = $tags;
    echo "\nlink->url_title:".$oriurltile;
    echo "\nlink->link_content:".$text;
      
    $link->save();
    echo "linkid:".$link->link_id;
      
    $url = trim($photourl);
    echo $url;
    if (strlen($url)>10 && strpos($url,'http')===0) 
    {
      if (preg_match('/([^\/]+)\.([^\/]+)$/',$url,$m) || preg_match('/([^\/]+)$/',$url,$m))
    	    $name = $m[1].'.'.$m[2];
    	else
    	    $name = $url;

      $upload_dir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.Yii::app()->params['upload_dir'];//mnmpath.get_misc_data('upload_directory');
    	$filepath = $upload_dir.'/'.$name;
    	echo 'filepath'.$filepath;
      Yii::trace('filepath '.$filepath);
    	$file = fopen($filepath,"wb");
    	$str = @file_get_contents($url);
    	fwrite($file,$str);
    	fclose($file);
    
      $fields="";

      $file= new File;
      $file->file_size= 'orig';
      $file->file_user_id= 1;     
      $file->file_real_size= filesize("$filepath");   
      $file->file_ispicture= 1;
      $file->file_link_id= $link->link_id;
      $file->file_fields= '';
      $file->file_name= $name;
      $file->save();
          
    	//$count++;
    	$last_id = $file->file_id;
      echo "last_id:".$last_id;
    	$error = $this->generate_thumbs($url,$link->link_id,$settings,$last_id,'',1);
      echo "generate ok";
    }  
    echo $error;
  }
  
  
  private function generate_thumbs($fname,$link_id,$settings,$orig_id,$only_size='',$user_id=1)
  {
     if (!($str = @file_get_contents($fname)))   return "Can't read file $fname"; 
      if (!($img = @imagecreatefromstring($str))) 
      	return; 
     $thumb_dir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.Yii::app()->params['upload_thumb_dir'];//mnmpath . $settings['thdirectory'];
      echo "begin:2";
      // load image and get image size
      $width  = imagesx( $img );
      $height = imagesy( $img );
      $error  = '';

      $filenumber = 1;
      foreach (Yii::app()->params['upload_thumb_sizes'] as $size)
      {
        echo "\nupload sizes:".$size;
        Yii::trace('sizes'.$size);
      	if (!strstr($size,'x') || ($only_size && $only_size!=$size)) continue;
      	list($maxw,$maxh) = preg_split('[x]',$size);
      	if ($maxw <= 0 || $maxh <= 0) continue;
      
      	// Thumbnail file name
      	if (preg_match('/([^\/]+)\.[^\/]+$/',$fname,$m) || preg_match('/([^\/]+)$/',$fname,$m))
      	    $name = $m[1];
      	else
      	    $name = $fname;
      	$name = "$name$size";
      
      	// calculate thumbnail size
      	$c = max($width/$maxw,$height/$maxh);
      	if ($c > 1)
      	{
      	      	$new_width  = floor($width/$c);
      	      	$new_height = floor($height/$c);
      	}
      	else
      	{
      	      	$new_width  = $width;
      	      	$new_height = $height;
      	}
      	
      	//calculate tmp image size
      	$ratio_thumb = $maxw/$maxh;
      	$ratio_ori_img = $width/$height;
      	if( $ratio_thumb > $ratio_ori_img)
      	{
      	  $tmp_width =$width;
          $tmp_height =  $width/$ratio_thumb;
          
        }
      	else
      	{
          $tmp_width = $height*$ratio_thumb;
          $tmp_height = $height;
        }
    
    	  // create a new temporary image
        //$tmp_img = imagecreatetruecolor( $new_width, $new_height );
        $tmp_img = imagecreatetruecolor( $maxw, $maxh );
  	
        	// copy and resize old image into new image
        $i=0; 
        while (file_exists("$thumb_dir/$name$i.jpg")) $i++;
        if( $i>0)
  	     $name = "$name$i.jpg";
        else
         $name = "$name.jpg"; 
        //error_log( $maxw.":".$maxh.":".$tmp_width.":".$tmp_heigh);
        imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $maxw, $maxh, $tmp_width, $tmp_height);
        //imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $maxw, $maxh, $tmp_width, $tmp_height );
  	
        if (!imagejpeg( $tmp_img, "$thumb_dir/$name", 80))//Yii::app()->params['upload_thumb_quality'] ))
  	       $error .= "Can't create thumbnail $thumb_dir/$name";
      	else
        {
          
          $file= new File;
          $file->file_size= $size;
          $file->file_user_id= 1;     
          $file->file_real_size=filesize("$thumb_dir/$name");   
          $file->file_ispicture= 1;
          $file->file_link_id= $link_id;
          $file->file_number= $filenumber;
          $file->file_fields= '';
          $file->file_name= $name;
          if( $orig_id != null )
            $file->file_orig_id= $orig_id;
          $file->save();
          echo "thumb file id:".$file->file_id;
          $filenumber++;  
        
        } 
  	     
      }
      return $error;
  }
  
	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}