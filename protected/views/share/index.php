<?php $this->pageTitle=Yii::app()->name . ' - '.Yii::t('share','indexpage');

?>

<canvas id="canvas"  ></canvas>
<div id="siteMenuBar" class="ui-widget">
<div id="menuContainer" class="ui-widget-header">
<ul>
<li><a href="javascript:reloadCat(0)">全部</a></li>
<li><a href="javascript:reloadCat(1)">新闻</a></li>
<li><a href="javascript:reloadCat(2)">国内</a></li>
<li><a href="javascript:reloadCat(3)">国际</a></li>
<li><a href="javascript:reloadCat(4)">自拍</a></li>
<li><a href="javascript:reloadCat(5)">科技</a></li>
<li><a href="javascript:reloadCat(6)">娱乐</a></li>
<li><a href="javascript:reloadCat(7)">体育</a></li>
<li><a href="javascript:reloadCat(8)">财经</a></li>
<li><a href="javascript:reloadCat(9)">军事</a></li>
<li><a href="javascript:reloadCat(10)">女人</a></li>
<li><a href="javascript:reloadCat(11)">旅游</a></li>
</ul>
<ul>
<li><a href="javascript:setTime('nearday')">最近一天</a></li>
<li><a href="javascript:setTime('today')">今天</a></li>
<li><a href="javascript:setTime('yestoday')">昨天</a></li>
<li><a href="javascript:setTime('nearweek')">最近一周</a></li>
<li><a href="javascript:setTime('lastweek')">上周</a></li>
<li><a href="javascript:setTime('nearmonth')">最近一月</a></li>
<li><a href="javascript:setTime('lastmonth')">上月</a></li>
</ul>
</div>
</div>


<div id="links">

  <div id="text_left">   
    <div id="text_title">   </div>
    <div id="text_content">   </div>
  </div>
  <div id="text_right">   
    <a href="" target="_blank"> </a>
    <a href="" target="_blank"> </a>

    <span class="vote">

      <span class="votenumber">
      <a id="votes" href="javascript:vote(1,944,0,'d3d9446802a44259755d38e6d163e820',10)">21</a>
      </span>
    </span>
    <span class="subtext" >
      <a id="vote" href="javascript:vote(1,944,0,'d3d9446802a44259755d38e6d163e820',10)">顶</a>

      <a id="unvote" href="javascript:vote(1,944,0,'d3d9446802a44259755d38e6d163e820',-10)">踩</a>

    </span>
    <a id="more" href="/pligg/story.php?title=%E6%83%A7%E5%AE%B3%E7%BB%B1-jquery-ajax-1" target="_blank">更多</a>
    
  </div>

</div>


 
<!-- css -->  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/share/grid.css" rel="stylesheet" />  

<!-- js   --> 

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/share/tr.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.8.2.custom/js/jquery-1.6.2.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/share/dtr.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/share/ig.js"></script> 



<audio autoplay loop>
  <source src="<?php echo Yii::app()->request->baseUrl; ?>/sound/healtheworld.mp3"  /> 
  <source src="<?php echo Yii::app()->request->baseUrl; ?>/sound/earthsong.mp3"  />  
   
</audio>

<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://183.129.244.136:81/piwik/" : "http://183.129.244.136:81/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://183.129.244.136:81/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->