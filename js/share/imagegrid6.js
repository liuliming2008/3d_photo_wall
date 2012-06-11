var isGecko = /gecko/i.test(navigator.userAgent) && !/like gecko/i.test(navigator.userAgent);
if(!Array.indexOf)
{
    Array.prototype.indexOf = function(obj)
    {               
        for(var i=0; i<this.length; i++)
        {
            if(this[i]==obj)
            {
                return i;
            }
        }
        return -1;
    }
} 
  
    	var winWidth = 0;var winHeight = 0;
      var theImageSrc="xxx";
      var theImageWidth=-1;
      var theF=-1;
      function findDimensions() 
      //函数：获取尺寸
      {
        //获取窗口宽度
        if (window.innerWidth)
          winWidth = window.innerWidth;
        else if ((document.body) && (document.body.clientWidth))
          winWidth = document.body.clientWidth;
        //获取窗口高度
        if (window.innerHeight)
          winHeight = window.innerHeight;
        else if ((document.body) && (document.body.clientHeight))
          winHeight = document.body.clientHeight;
        //通过深入Document内部对body进行检测，获取窗口大小
        if (document.documentElement  && document.documentElement.clientHeight && document.documentElement.clientWidth)
        {
          winHeight = document.documentElement.clientHeight;
          winWidth = document.documentElement.clientWidth;
        }
      
      }
      findDimensions();                  //调用函数，获取数值
      var itemTop=$("#siteMenuBar");
        
      itemTop.css({position: "absolute",'left':(winWidth-itemTop.width())/2});   
      itemTop.show(); 
      window.onresize=reload;
      function reload(){
        if( response == null )
          return;
        findDimensions();
        var itemTop=$("#siteMenuBar");
        
        itemTop.css({position: "absolute",'left':(winWidth-itemTop.width())/2});   
        itemTop.show(); 
            
        cancelAnimationFrame(timerID);
        //init();
        scene.remove( camera );
        camera = null;
        camera = new THREE.PerspectiveCamera( 75, winWidth / winHeight, 1, 100000  );
        camera.position = cameraTarget; 
        scene.add( camera );

        /*sceneBack.remove( cameraBack );
        cameraBack = null;
        cameraBack = new THREE.PerspectiveCamera( 75, winWidth / winHeight, 1, 100000  );
        cameraBack.position.z = cameraBackTarget.z; 
        sceneBack.add( cameraBack );     */
        
        //renderer = null;  
        if( renderer == null)
        {
          if (  Detector.webgl ) 
              renderer = new THREE.WebGLRenderer({canvas:$("canvas")[0]});
          else 
              renderer = new THREE.CanvasRenderer({canvas:$("canvas")[0]});
          //renderer = new THREE.CanvasRenderer(renderer.domElement);
        }
        
					
        renderer.setSize( winWidth, winHeight );
        renderer.setClearColor("#FFFFFF");
        //var container = document.createElement( 'div' );
        //container.appendChild( renderer.domElement );
        //onloadimgs = needLoadReflect;
        //refreshTextrue();
        
        animate();
        
      }
      //var winWidth = winWidth;
			//var winHeight = winHeight;
			var FLOOR = - 250;
      var mouseX = 0;
			var mouseY = 0;
      
      var container, stats;
      var timerID=0;
			//var windowHalfX = winWidth / 2;
			//var windowHalfY = winHeight / 2;
      var isDown=false;
      var isMove=false;
      var clickx=0;
      var clicky=0;
      var clickPicZ=180;
      var clickCameraZ=360;
      var initCameraZ=860;//500;  
      var cameraTargettmp={x:0,y:0,z:0};
      var cameraTarget={x:0,y:0,z:initCameraZ};
      var cameraTargetInit={x:0,y:0,z:initCameraZ};
      var cameraBackTarget={x:0,y:0,z:initCameraZ};
      
      var cameraStep={x:0,y:0,z:0};
      var cameraStepRatio={x:0.03,y:0.03,z:0.15};
      var cameraStepRatioInit={x:0.05,y:0.05,z:0.15};
      var cameraStepRatioInitFast={x:0.2,y:0.2,z:0.45};
      
      var cameraRatioDelayInit=30;
      var cameraRatioDelayTmp = 0;
      var lookTarget={x:0,y:0,z:0};
     var lookTargettmp={x:0,y:0,z:0};
     var lookpos={x:0,y:0,z:0};
     var gridCenter={x:0,y:0,z:0};
     var gridRect={left:0,right:0,top:0,bottom:0}
     var clickScale={x:1,y:1,z:1}
       
      var reflectImage, image, imageContext,
			imageReflection, imageReflectionContext, imageReflectionGradient,
			texture, textureReflection;
			var textureReflections=new Array();//null;;
			var reflectImage;
      var reflectionOpacity = 0.3;
       var reflectionHeightPer = 0.4;
       var imgtmp;
       var gridPicWidth=350;
       var gridPicHeight=200;
       var image ;
       var needLoadReflect=0;
       var onloadimgs=0;
      var bottom=0,textheight=60,linksHeight=75;
      var titlechars = 12;
      //gridPicWidth=250;
      var amountx=22,amounty=3;
      var uniforms1;
      
      var gridInterval =30;  
      var gridIntervalWidth =60;
      var gridIntervalHeight =30;
      var smoothMove=false; 
      var indexClick = 0;
      var rightLinkWidth=60;
       
      //document.addEventListener('mousemove', onDocumentMouseMove, false);
      var cameraBack,sceneBack; 
		  var camera, scene, renderer=null,
      geometry, material, mesh;
      
  
      var response=null;
      
      var itemLinks=null;
      var itemTopbar =null;
      
      var meshClickPic=null;
      var meshClickText=null;
      var catName=0;
      var timeName="nearday";
      var limitNo=120;
      var clickIndexInResponse=-1;
      var destUrl = "http://localhost/sharepic";
      
      
      
      function getRespoonse(cat,time,limit){  
          //jQuery.Support.Cors = true;
          var param = 
        		 { 
                "limit":limit,
                "cat":cat,
                "time":time
             }
        		
        	;		
          //response = {"page":1,"rows":[{"title":null,"ext_url":null,"id":"944","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/49a8d3d84ceebdc9a365be4b4fc7837a350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/49a8d3d84ceebdc9a365be4b4fc7837a350x250.jpg"},{"title":"\u5f17\u83b1\u513f\u5f17\u83b1\u513f:\u4e43\u4e43\u4e2a\u718a\u7684","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=21","id":"942","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/b355c3f69a0226a47418c4545ef3b634350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/b355c3f69a0226a47418c4545ef3b634350x250.jpg"},{"title":"\u7231\u60c5\u8bed\u5f55\u7231\u60c5\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=22","id":"943","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/76df885a16d78dbd3226b03269dbc728350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/76df885a16d78dbd3226b03269dbc728350x250.jpg"},{"title":"\u838e\u838e\u838e\u838e:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=20","id":"941","md":"b4b147bc522828731f1a016bfa72c073","votes":"23","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/d6247f26b0c6fcec98aaf53db639f481350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/d6247f26b0c6fcec98aaf53db639f481350x250.jpg"},{"title":"\u5929\u5929\u8bed\u5f55\u5929\u5929\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=19","id":"940","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/de02f3ff3e0ceaf897959b6609e245f5350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/de02f3ff3e0ceaf897959b6609e245f5350x250.jpg"},{"title":null,"ext_url":null,"id":"939","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/4c16e2baf7fe6b0d7f8840155a635797350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/4c16e2baf7fe6b0d7f8840155a635797350x250.jpg"},{"title":"\u95ed\u95ed:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=16","id":"937","md":"b4b147bc522828731f1a016bfa72c073","votes":"22","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/9ab695543fdfb815064d3dc150301864350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/9ab695543fdfb815064d3dc150301864350x250.jpg"},{"title":null,"ext_url":null,"id":"938","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/d36306d239b55a51c49556a23d529101350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/d36306d239b55a51c49556a23d529101350x250.jpg"},{"title":null,"ext_url":null,"id":"936","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/559e00ed0b5ad757d8c1fbde33df1d6d350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/559e00ed0b5ad757d8c1fbde33df1d6d350x250.jpg"},{"title":null,"ext_url":null,"id":"935","md":"b4b147bc522828731f1a016bfa72c073","votes":"23","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/499efcc3eb38fdb82ca9a733fd4f53fd350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/499efcc3eb38fdb82ca9a733fd4f53fd350x250.jpg"},{"title":"\u770b\u6211\u840c\u4e0d\u840c\uff1f","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=13","id":"934","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/0f105e592f2c5a425e734818ce2ae2ca350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/0f105e592f2c5a425e734818ce2ae2ca350x250.jpg"},{"title":"\u674e_\u9577\u65b0\u674e_\u9577\u65b0:\u4e66\u7b7e\uff0c\u4e66\u7b7e\u7684\u80cc\u540e\uff0c","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=12","id":"933","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/461503b393a46b0645bfac3a83ba5a9c350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/461503b393a46b0645bfac3a83ba5a9c350x250.jpg"},{"title":"_Princess_\u88d9_Princess_\u88d9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=11","id":"932","md":"b4b147bc522828731f1a016bfa72c073","votes":"25","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/42a32c1ab24ab081b2b12c850e6c4796350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/42a32c1ab24ab081b2b12c850e6c4796350x250.jpg"},{"title":"_Princess_\u88d9_Princess_\u88d9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=10","id":"931","md":"b4b147bc522828731f1a016bfa72c073","votes":"20","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/5cb2607ab9e89143c110d9c3df142c2e350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/5cb2607ab9e89143c110d9c3df142c2e350x250.jpg"},{"title":"\u82a5\u672b\u82b1\u5f00\u672b\u672b\u82a5\u672b\u82b1\u5f00\u672b\u672b:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=9","id":"930","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/55239f88507ee2373106b581f80b8af4350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/55239f88507ee2373106b581f80b8af4350x250.jpg"},{"title":"\u7231\u60c5\u8bed\u5f55\u7231\u60c5\u8bed\u5f55:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=8","id":"929","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/2e264a6465d407042bf51856d21fcfe4350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/2e264a6465d407042bf51856d21fcfe4350x250.jpg"},{"title":null,"ext_url":null,"id":"928","md":"b4b147bc522828731f1a016bfa72c073","votes":"24","summary":null,"image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/4ea1953452fbf3ed46fe212dcd88e2f0350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/4ea1953452fbf3ed46fe212dcd88e2f0350x250.jpg"},{"title":"\u590f\u51b0\u4e1d\u51c9\u590f\u51b0\u4e1d\u51c9:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=6","id":"927","md":"b4b147bc522828731f1a016bfa72c073","votes":"25","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/dcdc2aa4172510e6c32fcb14083c0e79350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/dcdc2aa4172510e6c32fcb14083c0e79350x250.jpg"},{"title":"\u8bda\u4fe1\u4e92\u542c\u8bda\u4fe1\u4e92\u542c:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=5","id":"926","md":"b4b147bc522828731f1a016bfa72c073","votes":"1","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/bee2cfda016b6d450f1046e082369f16350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/bee2cfda016b6d450f1046e082369f16350x250.jpg"},{"title":"\u5e9a\u968f\u5fc3\u4e0a\u7684\u53e5\u5b50\u5e9a\u968f\u5fc3\u4e0a\u7684\u53e5\u5b50:","ext_url":"http:\/\/weibo.pp.cc\/weitu\/?mod=index&aciton=hot&action=view&is=hot&ok=1&k=3","id":"924","md":"b4b147bc522828731f1a016bfa72c073","votes":"21","summary":"","image_ori_url":"\/pligg\/\/modules\/upload\/attachments\/97b4c56956fa9f7c36efebf6812332cc350x250.jpg","image_thumb_url":"\/pligg\/\/modules\/upload\/attachments\/thumbs\/97b4c56956fa9f7c36efebf6812332cc350x250.jpg"}],"groupshare":"","weburl":"http:\/\/localhost\/pligg","user":0,"total":20,"records":20};
          //init();
          //animate();
           $.ajax({
             
        	   //async: false,
             type: 'POST',
        	   url: destUrl+"/index.php/share/links",
        	   data: param,
        	   dataType: "json",
             //contentType: "text/html; charset=utf-8",
             //contentType: " charset=utf-8",         //application/json;

        	   success: function(data){ 
        	     //alert("ok");
               response = data;//$.parseJSON(data);  
               if (response===null ||response.rows==null|| response.rows.length   <=0)
                 alert("该条件下没有内容"); 
               else
               {
                  init();
               
                  animate();
               }
               
             },
        	   error: function(data,status) { try {
              alert(status+"获取数据失败"+data); 
              
             } catch (e) {} }
          });//.responseText;     
          //response = $.parseJSON(response.responseText);//JSON.parse(response);
      }
      //init();
      //animate();
      
      itemLinks = $("#links");
      itemLinks.hide();
      itemTopbar = $("#topbar");
      itemTopbar.show();
      
      scene=null;
      sceneBack=null;
      scene = new THREE.Scene();
      /*sceneBack = new THREE.Scene();
      //var shader = THREE.ShaderUtils.lib[ "normal" ];
      uniforms1 = {
			time: { type: "f", value: 1.0 },
			resolution: { type: "v2", value: new THREE.Vector2() }
		  };
      var shadematerial = new THREE.ShaderMaterial( { 
				uniforms: uniforms1,
        vertexShader: "varying vec2 vUv;void main({vUv = uv;vec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );gl_Position = projectionMatrix * mvPosition;}",            
        fragmentShader: "uniform float time;uniform vec2 resolution;varying vec2 vUv;void main( void ) {vec2 position = -1.0 + 2.0 * vUv;float red = abs( sin( position.x * position.y + time / 5.0 ) );float green = abs( sin( position.x * position.y + time / 4.0 ) );	float blue = abs( sin( position.x * position.y + time / 3.0 ) );gl_FragColor = vec4( red, green, blue, 1.0 );}"
        //uniforms: { time: { type: "f", value: 0.0 } },
				//vertexShader: "varying vec2 vUv;void main() {vUv = uv;gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );}",
				//fragmentShader: "varying vec2 vUv; uniform float time;	void main() { float r = vUv.x;if( vUv.y < 0.5 ) r = 0.0;	float g = vUv.y;if( vUv.x < 0.5 ) g = 0.0;	gl_FragColor = vec4( r, g, 0, 1.0 );}" 
			} );
      var plane = new THREE.PlaneGeometry( window.innerWidth, window.innerHeight );

			var quad = new THREE.Mesh( plane, shadematerial );
			quad.position.x = 0;
      quad.position.y = 0;
      quad.position.z = 0;
			sceneBack.add( quad );
      */
      if( renderer == null)
      {
          if (  Detector.webgl ) 
            renderer = new THREE.WebGLRenderer({canvas:$("canvas")[0]});
          else if( Detector.canvas) 
            renderer = new THREE.CanvasRenderer({canvas:$("canvas")[0]});
          else
            {
                alert("浏览该网站需要IE9，Firefox或Chrome最近的版本。");
            }
          //renderer = new THREE.CanvasRenderer(renderer.domElement);
      }
      //renderer.setSize( winWidth, winHeight   );
      //renderer = new THREE.CanvasRenderer();
			
      renderer.setSize( winWidth, winHeight );
      renderer.setClearColor("#FFFFFF");
      
      getRespoonse(catName,timeName,limitNo);
      
      
      function init() {
        try{
         
          if (response===null || response.rows.length   <=0)
            return;
          camera = new THREE.PerspectiveCamera( 75, winWidth / winHeight, 1, 10000  );
          camera.position= cameraTarget; 
          scene.add( camera );
    
          
          /*cameraBack = new THREE.PerspectiveCamera( 75, winWidth / winHeight, 1, 10000  );
          cameraBack.position.z = cameraBackTarget.z; 
          sceneBack.add( cameraBack ); */
          
          amountx= response.rows.length/amounty;
          needLoadReflect=parseInt(amountx);//response.rows.length % amounty==0?amountx:parseInt(amountx);//response.rows.length-(amounty-1)*amountx;
          
          //gridCenter =  {x:(gridIntervalWidth+gridPicWidth)*(amountx-1)/2,y:-(gridIntervalWidth+textheight+gridPicHeight)*(amounty)/2-gridPicHeight/3,z:0} ;
          gridCenter =  {x:(gridIntervalWidth+gridPicWidth)*2,y:-(gridIntervalHeight+textheight+gridPicHeight)*(amounty)/2-gridPicHeight/3,z:0} ;
          
          gridRect={left:0,right:(gridIntervalWidth+textheight+gridPicWidth)*(amountx),top:0,bottom:-(j+1)*(gridPicHeight+ gridIntervalHeight+textheight)};
          mouseX=camera.position.x = gridCenter.x; 
          mouseY=camera.position.y = gridCenter.y; 
          lookTarget =  {x:gridCenter.x,y:gridCenter.y,z:0} ;
          lookpos= {x:gridCenter.x,y:gridCenter.y,z:0};
          cameraTarget={x:gridCenter.x,y:gridCenter.y,z:cameraTarget.z};
          
          //textureReflections=new Array();
          var noTmp=0;
          var ratation=0;
          for (var i=0; i<amountx; i++) 
          {
			       for (var j=0; j<amounty; j++) {
                if( noTmp >= response.records)
                  break;
              	var texture = THREE.ImageUtils.loadTexture( response.rows[noTmp].image_thumb_url );//new THREE.Texture( generateTexture() );
                texture.needsUpdate = true;
                var material = new THREE.MeshBasicMaterial( 
                { map: texture, transparent: true,opacity:1 } );
                //
                //var material = new THREE.MeshBasicMaterial( mat);
                var mesh = new THREE.Mesh( new THREE.PlaneGeometry( gridPicWidth,gridPicHeight ), material );
                mesh.position.x = (i+1) * ( gridPicWidth + gridIntervalWidth ) - (( gridPicWidth  ) / 2 );
      					mesh.position.y = -(j+1)*(gridPicHeight+ gridIntervalHeight+textheight)+textheight+( gridPicHeight  ) / 2 ;
      					mesh.position.z = 0;
      					mesh.scale.x = 1;
                mesh.scale.y = 1;
                mesh.scale.z = 1;
                
      					mesh.rotation.x = Math.PI / 2;
                mesh.doubleSided = true;
                //mesh = new THREE.Mesh( geometry, material );
                scene.add( mesh );
                response.rows[noTmp].mesh=mesh;
                //texture.image.onclick=function(){alert("test");};
                
                var x = document.createElement( "canvas" );
                var xc = x.getContext("2d");
                x.width = gridPicWidth;
                x.height = textheight;
                //xc.shadowColor = "#000";
                //xc.shadowBlur = 7;
                xc.fillStyle = '#000000';
          			xc.fillRect( 0, 0, gridPicWidth, textheight );
                xc.fillStyle = "white";
                xc.font = "18pt SimSun";//arial bold";//SimSun
                var text1="";
                var text2="";
                
                if( response.rows[noTmp].title != null )
                {
                   if( response.rows[noTmp].title.length >titlechars )
                   {
                      text1 =response.rows[noTmp].title.substr(0,titlechars); 
                      text2 =response.rows[noTmp].title.substr(titlechars);  
                      xc.fillText(text1   , 0, textheight-textheight/2-5 );
                      xc.fillText(text2   , 0, textheight-10 );
                   }
                   else
                   {
                      text1 =response.rows[noTmp].title; 
                      xc.fillText(text1   , 0, textheight-textheight/2-5 );
                   }
                }
                var xx=response.rows[noTmp].votes;
                var numlen =  xx.toString().length;
                xc.fillText(xx.toString()   , gridPicWidth-13*numlen, textheight-textheight/2-5 );  
                
                var xm = new THREE.MeshBasicMaterial( { map: new THREE.Texture( x ), transparent: true, opacity:1  } );
                xm.map.needsUpdate = true;
                
                var mesht = new THREE.Mesh( new THREE.PlaneGeometry( gridPicWidth, textheight ), xm );
                mesht.position.x = (i+1) * ( gridPicWidth + gridIntervalWidth ) - (( gridPicWidth  ) / 2 );
                mesht.position.y = -(j+1)*(gridPicHeight+ gridIntervalHeight+textheight)+( textheight  ) / 2;
                mesht.position.z = 0;
                mesht.scale.x = mesh.scale.y = mesh.scale.z = 1;
                mesh.rotation.x = Math.PI / 2;
                mesh.doubleSided = true;
                scene.add( mesht ); 
                response.rows[noTmp].mesht=mesht;
                
                if( j==amounty-1)
                {
          				textureReflections[i]=new Image();
                  
                  textureReflections[i].onload=function(){
                    refreshTextrue();
        					};//
        					textureReflections[i].src=response.rows[noTmp].image_thumb_url;
                  
          				
                } 
                noTmp++;
                
             }
          }
          
          
          
          
          //var container = document.createElement( 'div' );
          //document.body.appendChild( container );
          //container.appendChild( renderer.domElement );
          //renderer.domElement.style.position = "relative";
          
          //renderer.domElement.id="canvas";
          //document.body.appendChild( renderer.domElement );
          
          //$("canvas").addEventListener('onmousedown', function(e)
          /*stats = new Stats();
          stats.domElement.style.position = 'absolute';
          stats.domElement.style.top = '0px';
          
          document.body.appendChild( stats.domElement );*/
        }
        catch (e)
          {
              var i;
              i++;
              alert('错误' + e.message + '发生在' + e.lineNumber + '行'+"name:"+e.name+"src:"+theImageSrc+"theImageWidth:"+theImageWidth+"thef:"+theF);
          }
  
      }
  
      function animate() {
  
          // note: three.js includes requestAnimationFrame shim
          timerID=requestAnimationFrame( animate );
          render();
          //stats.update();
      }
  
      function refreshTextrue(){
        try{
          onloadimgs++;
          if( onloadimgs == needLoadReflect )
          {
            for(var index=0;index<textureReflections.length;index++)
            {
                      imageReflection = document.createElement( 'canvas' );
              				imageReflection.width = gridPicWidth;
              				imageReflection.height = gridPicHeight*0.7;
              
              				imageReflectionContext = imageReflection.getContext( '2d' );
              				imageReflectionContext.save();
              				imageReflectionContext.fillStyle = '#000000';
              				imageReflectionContext.fillRect( 0, 0, gridPicWidth, gridPicHeight*0.7 );
                      //imageReflectionContext.globalAlpha=reflectionOpacity;
                      imageReflectionContext.drawImage(textureReflections[index], 0, 0, gridPicWidth, gridPicHeight*0.7/*,0,0,scope.w, scope.reflectionHeightPer*scope.h*/);
                      imageReflectionContext.restore();
                      imageReflectionContext.globalCompositeOperation = "destination-out";
              				imageReflectionGradient = imageReflectionContext.createLinearGradient( 0, 0, 0, 204 );
              				imageReflectionGradient.addColorStop( 0.2, 'rgba(240, 240, 240, 1)' );
              				imageReflectionGradient.addColorStop( 1, 'rgba(240, 240, 240, 0.6)' );
                      imageReflectionContext.fillStyle = imageReflectionGradient;
                      imageReflectionContext.fillRect(0, 0, gridPicWidth, gridPicHeight*0.7);
    
              				textureReflection = new THREE.Texture( imageReflection );
              				textureReflection.minFilter = THREE.LinearFilter;
              				textureReflection.magFilter = THREE.LinearFilter;
              				textureReflection.needsUpdate = true;
                      
                      
              				var materialReflection = new THREE.MeshBasicMaterial( { map: textureReflection, overdraw: true,opacity:1  } );
              
              			  var plane = new THREE.PlaneGeometry( gridPicWidth, gridPicHeight );
              				//scene.add(mesh);
        
              				mesh = new THREE.Mesh( plane, materialReflection );
              				mesh.position.x = (index+1) * ( gridPicWidth + gridIntervalWidth ) - (( gridPicWidth  ) / 2 );
                      mesh.position.y = -(amounty-1+2)*(gridPicHeight+ gridIntervalHeight+textheight)+( gridPicHeight  ) / 2+textheight;
                      mesh.position.z = 0;
              				mesh.scale.x = mesh.scale.y = mesh.scale.z = 1;
              				mesh.rotation.x = Math.PI / 2;
                      mesh.doubleSided = true;
              				mesh.overdraw = true;
              				scene.add( mesh ); 
                      textureReflections[index].meshReflect = mesh;
                             
            }
            onloadimgs=0;  
          }
        }
        catch (e)
          {
              var i;
              i++;
              alert('错误' + e.message + '发生在' + e.lineNumber + '行'+"name:"+e.name+"src:"+theImageSrc+"theImageWidth:"+theImageWidth+"thef:"+theF);
          }
      }
     

      function render() {
  
          //mesh.rotation.x += 0.01;
          //mesh.rotation.y += 0.02;
          try{
          /*if( !isDown && cameraStepRatio.x>0.02 &&cameraTarget.x !=camera.position.x)
          {   
              if( cameraRatioDelayTmp >1)
                cameraRatioDelay--;     
              else
              {
                  //cameraStepRatio.x -= 0.001;
                  //cameraStepRatio.y -= 0.001;
                  //cameraStepRatio.z -= 0.001;
              }     
              
              
          }
          else
          {
              if( !isDown && cameraStepRatio.x<=0.01 &&cameraTarget.x ==camera.position.x)
              {
                  cameraStepRatio=cameraStepRatioInit;
                  cameraRatioDelayTmp=cameraRatioDelayInit;
                  
              }
          }*/
          
          cameraStep.x=( cameraTarget.x - camera.position.x )* cameraStepRatio.x;
          cameraStep.y=( cameraTarget.y - camera.position.y )* cameraStepRatio.y;
          cameraStep.z=( cameraTarget.z - camera.position.z )* cameraStepRatio.z;
          /*cameraStep.x=Math.abs(cameraStep.x)>5?cameraStep.x:((cameraTarget.x - camera.position.x)>5?5:(cameraTarget.x - camera.position.x));
          cameraStep.y=Math.abs(cameraStep.y)>5?cameraStep.y:((cameraTarget.y - camera.position.y)>5?5:(cameraTarget.y - camera.position.y));
          cameraStep.z=Math.abs(cameraStep.z)>5?cameraStep.z:((cameraTarget.z - camera.position.z)>5?5:(cameraTarget.z - camera.position.z));
          */
          
          
          var lookposStep={x:0,y:0,z:0};
          
          if( smoothMove )
          {
              lookposStep.x=( lookTarget.x - lookpos.x )* cameraStepRatio.x;
              lookposStep.y=( lookTarget.y - lookpos.y )* cameraStepRatio.y
              /*lookposStep.x=Math.abs(lookposStep.x)>5?cameraStep.x:((lookTarget.x - lookpos.x)>5?5:(lookTarget.x - lookpos.x));
              lookposStep.y=Math.abs(lookposStep.y)>5?cameraStep.y:((lookTarget.y - lookpos.y)>5?5:(lookTarget.y - lookpos.y));
        */
          }
          else
          {   
              lookposStep.x=( lookTarget.x - lookpos.x )* 0.1;
              lookposStep.y=( lookTarget.y - lookpos.y )* cameraStepRatio.y
              /*lookposStep.x=Math.abs(lookposStep.x)>5?cameraStep.x:((lookTarget.x - lookpos.x)>5?5:(lookTarget.x - lookpos.x));
              lookposStep.y=Math.abs(lookposStep.y)>5?cameraStep.y:((lookTarget.y - lookpos.y)>5?5:(lookTarget.y - lookpos.y));
        */
        
          }
          lookpos.x += lookposStep.x;
  				lookpos.y += lookposStep.y;
          lookpos.z += lookposStep.z;
          
          
              
          camera.position.x += cameraStep.x;
  				camera.position.y += cameraStep.y;
          camera.position.z += cameraStep.z;
          
          
            if(meshClickPic!=null &   Math.abs( camera.position.z - clickCameraZ) <0.1  &
             Math.abs(lookposStep.x)<0.1 &Math.abs(lookposStep.y)<0.1&Math.abs(lookposStep.z)<0.1
            & Math.abs(cameraStep.x)<0.1&Math.abs(cameraStep.y)<0.1&Math.abs(cameraStep.z)<0.1
            )
            {
  
              //if( meshClickText.position.z<cameraTarget.z)
              {
              //var    projector = new THREE.Projector(),    
              p3D = new THREE.Vector3(meshClickText.position.x-clickScale.x*gridPicWidth/2 , meshClickText.position.y+clickScale.y*textheight/2, meshClickText.position.z);
              var p2D = projector.projectVector(p3D, camera);
              //p3D = projector.unprojectVector(p2D, camera);
              //need extra steps to convert p2D to window's coordinates
              p2D.x = (p2D.x + 1)/2 * window.innerWidth;
              p2D.y = - (p2D.y - 1)/2 * window.innerHeight;
              
              p3DRightTop = new THREE.Vector3(meshClickText.position.x+clickScale.x*gridPicWidth/2 , meshClickText.position.y+clickScale.y*textheight/2, meshClickText.position.z);
              var p2DRightTop = projector.projectVector(p3DRightTop, camera);
              //p3D = projector.unprojectVector(p2D, camera);
              //need extra steps to convert p2D to window's coordinates
              p2DRightTop.x = (p2DRightTop.x + 1)/2 * window.innerWidth;
              p2DRightTop.y = - (p2DRightTop.y - 1)/2 * window.innerHeight;
              
              itemLinks.css({position: "absolute",'top':p2D.y,'left':p2D.x,'width':p2DRightTop.x-p2D.x,'height':linksHeight,display:'block'});   
              itemLinks.show(); 
              var rightWidth = (p2DRightTop.x-p2D.x)*03>rightLinkWidth?rightLinkWidth:(p2DRightTop.x-p2D.x)*0.3;
              $("#text_right").css({ 'width':rightWidth}); 
              $("#text_left").css({ 'width':p2DRightTop.x-p2D.x-rightWidth}); 
              
              //hide the  meshClickText
              //meshClickText.position.z=cameraTarget.z+1000;//clickPicZ;  
              meshClickText.visible  = false;
              }
              
            }
            else
            {
               itemLinks.hide();            
               //meshClickText.position.z=      
               if(meshClickText!=null )         
                  meshClickText.visible  = true;
            }
          

          
  				camera.lookAt( lookpos );//{x:camera.position.x,y:camera.position.y,z:0} );
  				
           
  				{
    				//refreshTextrue();
  
  				}
          itemTopbar.show();
  				renderer.setSize( winWidth, winHeight );
          renderer.setClearColor("#FFFFFF");
          
          renderer.render( scene, camera );  
          
          //uniforms1.time.value += 0.05;   
          //renderer.render( sceneBack, cameraBackTarget ); 
          }
          catch (e)
          {
              var i;
              i++;
              //alert('错误' + e.message + '发生在' + e.lineNumber + '行'+"name:"+e.name+"src:"+theImageSrc+"theImageWidth:"+theImageWidth+"thef:"+theF);
          }
      }
      
      
      function onDocumentMouseDown(event)
          {
            isDown = true;
            
            isMove=false;
            clickx = event.clientX;
            clicky = event.clientY;
            //radiustmp = radius;
            cameraTargettmp.x=cameraTarget.x;
            cameraTargettmp.y=cameraTarget.y;
            cameraTargettmp.z=cameraTarget.z;
            
            lookTargettmp.x=lookTarget.x;
            lookTargettmp.y=lookTarget.y;
            lookTargettmp.z=lookTarget.z;
            
          };
          
          //$("canvas").addEventListener('onmouseup', function(e)
        function onDocumentMouseUp(event)
          {
            if( isMove )
            {
              isDown=false;
              isMove=false;
              //cameraStepRatio=cameraStepRatioInit;
              
            }
            else
            {
              //click
              isDown=false;
              isMove=false;
              smoothMove=true; 
              
              var mouse={x:0,y:0};
              
              //click text and links
              itemLinks = $("#links");
              if( event.clientX>itemLinks[0].offsetLeft && event.clientX<  itemLinks[0].offsetLeft+itemLinks[0].offsetWidth
                  &&event.clientY>itemLinks[0].offsetTop && event.clientY<itemLinks[0].offsetTop+itemLinks[0].offsetHeight )
                return;
          		event.preventDefault();
        			mouse.x = ( event.clientX / winWidth ) * 2 - 1;
        			mouse.y = - ( event.clientY / winHeight ) * 2 + 1;
              var vector = new THREE.Vector3( mouse.x, mouse.y, 1 );
          		projector.unprojectVector( vector, camera );
          
          		var ray = new THREE.Ray( camera.position, vector.subSelf( camera.position ).normalize() );
          		var intersects = ray.intersectScene( scene );
          
          		if ( intersects.length > 0 ) {
          
  			        
        				INTERSECTED = intersects[ 0 ].object;
        				var imagesrc = INTERSECTED.material.map.image.src;
        				if( imagesrc!= null )
        				{
                  indexClick = 0;
                  
                  while( indexClick<response.rows.length&&imagesrc.indexOf(response.rows[indexClick].image_thumb_url)==-1) 
                  {
                    indexClick++;
                    //imagesrc = INTERSECTED.material.map.image.src;
                  }
                  //INTERSECTED.material.response_index;
          				//INTERSECTED.material.color.setHex( 0xff0000 );
                  
          				if( indexClick<response.rows.length)
          				{
          				  cameraStepRatio=cameraStepRatioInitFast;
          				  
          				  if( INTERSECTED.position.z==0)
          				  {
          				    if( meshClickPic!=null)
                      	restorePicText(false);
                      //forbidden show another pic before click the current shown pic
                      //if( meshClickPic!=null)
                      //  return;
          				    cameraTargettmp.x=cameraTarget.x;
                      cameraTargettmp.y=cameraTarget.y;
                      cameraTargettmp.z=cameraTarget.z;
                      
                      lookTargettmp.x=lookTarget.x;
                      lookTargettmp.y=lookTarget.y;
                      lookTargettmp.z=lookTarget.z;
          				    INTERSECTED.position.z=clickPicZ;  
                      INTERSECTED.scale.x = clickScale.x;
                      INTERSECTED.scale.y = clickScale.y;
                      INTERSECTED.scale.z = clickScale.z; 
                      //INTERSECTED.material.wireframe=true;
                      //INTERSECTED.material.wireframeLinewidth=6;   
                      //INTERSECTED.material.map.needsUpdate = true; 
                      cameraTarget.x = lookTarget.x = INTERSECTED.position.x;
                      cameraTarget.y = lookTarget.y = INTERSECTED.position.y-textheight/2;
                      cameraTarget.z=clickCameraZ;//cameraTargetInit.z; 
                      
                      meshClickPic=INTERSECTED;
                      
                      var index = 0;
                  
                      while( index<INTERSECTED.parent.children.length&&INTERSECTED.parent.children[index].id!=INTERSECTED.id) 
                      {
                        index++;
                        //imagesrc = INTERSECTED.material.map.image.src;
                      }
                      
                      var textMesh=INTERSECTED.parent.children[index+1];
                      meshClickText=textMesh;
                      meshClickText.position.z=clickPicZ;  
                      meshClickText.position.y=meshClickPic.position.y-clickScale.y*gridPicHeight/2-clickScale.y*textheight/2;
                      meshClickText.scale.x = clickScale.x;
                      meshClickText.scale.y = clickScale.y;
                      meshClickText.scale.z = clickScale.z;
                      
                      $("#text_title").text(response.rows[indexClick].title);
                      if( response.rows[indexClick].summary != null )
                        $("#text_content").text(response.rows[indexClick].summary);
                      else 
                        $("#text_content").text("");
                      $("#votes").text(response.rows[indexClick].votes);
                      $("#vote").attr("href","javascript:run_vote("+response.user+","+response.rows[indexClick].id+",0,'"+response.rows[indexClick].md+"',10)");
                      $("#unvote").attr("href","javascript:run_unvote("+response.user+","+response.rows[indexClick].id+",0,'"+response.rows[indexClick].md+"',-10)");
                      //$("#more").attr("href",response.weburl+"/story.php?title="+response.rows[indexClick].title) ; 
                      $("#more").attr("href",response.rows[indexClick].ext_url) ; 
                      $("#vote").text("顶");
                      $("#unvote").text("踩");
                      $("#unvote").show();
                      $("#vote").show(); 
                      //存
                      //删
                      //评
                      //原文
                      clickIndexInResponse =  indexClick; 
                    }
          				  else
          				  {
          				    restorePicText(true);  
                          
                    }
          				  
                    //alert(response.rows[index].title);
                  }
                  
                }
              				
              
          		} else {
          
          		  //cameraTarget.z=cameraTargetInit.z;	
                restorePicText(true);   
          		}
          }
      };
      function run_vote(user, id, htmlid, md5, value)
      {
          $("#votes").text( String(Number($("#votes").text())+1));
          $("#vote").attr("href","#");
          $("#unvote").hide();
          $("#vote").text("已顶");
          response.rows[clickIndexInResponse].votes  =Number(response.rows[clickIndexInResponse].votes)+1;
          var param = 
        	{ 
              "id":response.rows[clickIndexInResponse].id
          };		

         $.ajax({            
      	   //async: false,
           type: 'POST',
      	   url: destUrl+"/index.php/share/vote",
      	   data: param,
      	   dataType: "json",
           //contentType: "text/html; charset=utf-8",
           //contentType: " charset=utf-8",         //application/json;
      	   success: function(data){         	     
           },
      	   error: function(data,status) { try {
           
           } catch (e) {
           
           } }
        });
      }
      
      function run_unvote(user, id, htmlid, md5, value)
      {
          $("#votes").text(  String(Number($("#votes").text())-1));
          $("#unvote").attr("href","#");
          $("#unvote").hide();
          $("#vote").text("已踩");
          response.rows[clickIndexInResponse].votes  =response.rows[clickIndexInResponse].votes-1;
          var param = 
        	{ 
              "id":response.rows[clickIndexInResponse].id
          };	
          $.ajax({            
      	   //async: false,
           type: 'POST',
      	   url: destUrl+"/index.php/share/unvote",
      	   //data: param,
      	   dataType: "json",
           //contentType: "text/html; charset=utf-8",
           //contentType: " charset=utf-8",         //application/json;
      	   success: function(data){         	     
           },
      	   error: function(data,status) { try {
           
           } catch (e) {} }
          });
      }
      function restorePicText(restoreTarget)
      {
        clickIndexInResponse=-1;
        if(meshClickPic!=null)
        {
         
          
          itemLinks.hide(); 
          meshClickText.visible  = true;
          
          meshClickPic.position.z=0;
          meshClickPic.scale.x = 1;
          meshClickPic.scale.y = 1;
          meshClickPic.scale.z = 1;  
          meshClickText.position.z=0;  
          meshClickText.position.y=meshClickPic.position.y-gridPicHeight/2-textheight/2;
          //textMesh.position.y+(clickScale.y-1)*gridPicHeight/2;
          meshClickText.scale.x = 1;
          meshClickText.scale.y = 1;
          meshClickText.scale.z = 1;  
          meshClickPic=null;
          meshClickText=null; 
          
          //restore camera
          
          
        }
        if( restoreTarget )
          {
            cameraTarget.x=cameraTargettmp.x;
            cameraTarget.y=gridCenter.y;
            cameraTarget.z=cameraTargetInit.z;//cameraTargettmp.z;
            
            lookTarget.x=lookTargettmp.x;
            lookTarget.y=gridCenter.y;
            lookTarget.z=lookTargettmp.z;
          }
      }
      function onDocumentMouseMove( event ) {

				if( isDown )
            {
              isMove=true;
              smoothMove=false;    
              //restorePicText(false);      
              //cameraStepRatio={x:1,y:1,z:1};
              cameraStepRatio=cameraStepRatioInit;
              //cameraTarget.z=cameraTargettmp.z-(e.clientX-clickx)*10;
              cameraTarget.x = cameraTargettmp.x- (event.clientX-clickx)*3*Math.abs(cameraTarget.z/initCameraZ);
              //cameraTarget.y = cameraTargettmp.y+ (event.clientY-clicky)*6;
              
              lookTarget.x = lookTargettmp.x- (event.clientX-clickx)*3*Math.abs(cameraTarget.z/initCameraZ);
              //lookTarget.y = lookTargettmp.y+ (event.clientY-clicky)*6; 
              
              //lookpos.x = lookTargettmp.x- (event.clientX-clickx)*16;
              //camera.position.z = camera.position.y/2;
              
              if( cameraTarget.x<(gridRect.left)   )
              {
                  cameraTarget.x= gridRect.left;           
             
              }
              else if( cameraTarget.x >(gridRect.right) )
                   cameraTarget.x= gridRect.right; 
              
              
              if( lookTarget.x < (gridRect.left) )
                  lookTarget.x = gridRect.left;
              else if(lookTarget.x >(gridRect.right))
                  lookTarget.x = gridRect.right;

            } 

			}
    //document.addEventListener('mousemove', onDocumentMouseMove, false);
    //document.addEventListener('mousedown', onDocumentMouseDown, false);
    //document.addEventListener('mouseup', onDocumentMouseUp, false);
    $(document).mousemove(onDocumentMouseMove);
    $(document).mousedown(onDocumentMouseDown);
    $(document).mouseup(onDocumentMouseUp); 
    var isGecko = /gecko/i.test(navigator.userAgent) && !/like gecko/i.test(navigator.userAgent);
    if(!isGecko){
     //绑mousewheel
     //document.addEventListener('mousewheel', function(e)
     //$(document).scroll(onDocumentMouseWheel);
     $(document).bind("mousewheel", onDocumentMouseWheel);
    
    }else{
      //ff去绑DOMMouseScroll
      //document.addEventListener('DOMMouseScroll', function(e)
      //$(document).scroll(onDocumentMouseScroll);
       $(document).bind("DOMMouseScroll", onDocumentMouseScroll);
    }
    function onDocumentMouseWheel(e)
    {
      var radiusstepup = cameraTarget.z /10;
      var radiusstepdown = -radiusstepup;
      //if( radiusstep <5 ) radiusstep=5;
      if( cameraTarget.z<100 ) radiusstepdown = 0;
      if( cameraTarget.z>9000 ) radiusstepup = 0;
      //向下  ,120倍数
      if( e.wheelDelta <0)
      {
          cameraTarget.z +=radiusstepup;
      }
      else
      {
          cameraTarget.z +=radiusstepdown;
      }
      
      //only restore the clicked pic and text
      //restorePicText(false);  
      
    }//, false);
    function onDocumentMouseScroll(e)
    {
      var radiusstepup = cameraTarget.z /8;
      var radiusstepdown = -radiusstepup;
      //if( radiusstep <5 ) radiusstep=5;
      if( cameraTarget.z<100 ) radiusstepdown = 0;
      if( cameraTarget.z>9000 ) radiusstepup = 0;
      //向下，3倍数
      if( e.detail >0)
      {
          cameraTarget.z +=radiusstepup;
      }
      else
      {
          cameraTarget.z +=radiusstepdown;
      }
      //only restore the clicked pic and text
      //restorePicText(false);       
      
    }//, false);
    projector = new THREE.Projector();
    //document.addEventListener('click', onDocumentClick, false);
    
    //function onDocumentClick( event ) {
      
  	//}
    // Very dramatic easing
function setTime(time)
{
  if( timeName!= time )
  { 
    timeName=time;
    releaseResponse();
    getRespoonse(catName,timeName,limitNo);
  }
  timeName=time;
}
function reloadCat(cat)
{
  catName = cat;
  releaseResponse();
  getRespoonse(cat,timeName,limitNo);
  //reload();
   
}

function releaseResponse()
{
  var index=0;
  if( response!=null && response.rows!=null )
    while( index<response.rows.length ) 
    {
      scene.remove( response.rows[index].mesh );
      scene.remove( response.rows[index].mesht );
      index++;
      //imagesrc = INTERSECTED.material.map.image.src;
    }
  response=null;
  
  for(var index=0;index<textureReflections.length;index++)
  {
    scene.remove( textureReflections[index].meshReflect);
  }
  textureReflections=null;
  textureReflections=new Array();
  
            
}

var timeout = null;
var initialMargin = parseInt($("#siteMenuBar").css("margin-top"));
 
$("#siteMenuBar").hover(
function() {
if (timeout) {
clearTimeout(timeout);
timeout = null;
}
$(this).animate({ marginTop: 0 }, 'fast');
},
function() {
var menuBar = $(this);
timeout = setTimeout(function() {
timeout = null;
menuBar.animate({ marginTop: initialMargin }, 'slow');
}, 1000);
}
);

 
