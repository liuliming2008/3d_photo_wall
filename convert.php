<?php
	function convert($s,$t,$array=null,$filename=null){
			if(!isset($s)||!isset($t))
				return false;
		  if(!is_dir($s) && !is_dir($t) && $array==null)
		  {	
		  	 $cmd='';	
		  	 if($filename==null)		  	
			  	 $cmd="java -jar ./tools/yuicompressor247.jar -o ".dirname($t)."/".substr($t,strrpos($t,"/")+1,strlen(strrchr($t,"/"))-4)."_compre.js"." ".$s."";
			 else
			 	 $cmd="java -jar ./tools/yuicompressor247.jar -o ".$t." ".$s."";
			  shell_exec($cmd);		  		
		  }else if(is_dir($s) && is_dir($t) && $array==null)
		  {
			  $dir = opendir($s);
			  while (($file = readdir($dir)) !== false)
			  {
			  	echo "filename: " . $file . "<br />";
			  }
			  closedir($dir);
		  }else if(is_dir($s) &&  is_dir($t) && is_array($array)!=null)
		  {
	  		unlink($s."newcompressor.js");
	  		$newf=fopen($s."newcompressor.js","a+");
	  		if( $newf== null )
	  		  echo "open newf fail";
		  	$pri='';
			  foreach ($array as $file)
			  {
			  		$f=fopen($s."".$file,"r");
			  		$dt=fread($f,filesize($s."".$file));
			  		$pri.=substr($file,0,2)."_";
			  		fwrite($newf,$dt);
			  		fclose($f);
			  		
			  		echo "filename: " . $file . "<br />";
			  }
			 
			  fclose($newf);
			  $cmd='';
			  if($filename==null)			 
			  	$cmd="java -jar ./tools/yuicompressor247.jar -o ".$t."".$pri."compre.js  ".$s."newcompressor.js"." --charset utf8";			
			  else			  
			  	$cmd="java -jar ./tools/yuicompressor247.jar -o ".$t."".$filename."  ".$s."newcompressor.js"." --charset utf8";
			  echo $cmd;
        echo shell_exec($cmd);
        echo "ok.\n";
			 	//unlink($s."newcompressor.js");
		  }else
		  		return false;		
	}
	
	function convert_directory_All($s,$t){
		 	 $dir = opendir($s);
			  while (($file = readdir($dir)) !== false)
			  {
			  		if(filetype($s."/".$file)=='file' && substr($s."/".$file,strlen($s."/".$file)-3,strlen($s."/".$file))=='.js')
			  		{
			  			echo "filename: " . $file . "<br />";
			  			$cmd="java -jar /yuicompressor247.jar -o ".$t."/".$file." ".$s."/".$file."";
			  			shell_exec($cmd);	
			  		}
			  		else if(filetype($s."/".$file)=='dir' && $file!='..' && $file!='.')
			  		{
			  			convert_directory_All($s."/".$file,$t."/".$file);
			  		}
			  		else
			  		{
			  			continue;
			  		}	  		
			  }
			  closedir($dir);
	}
	$sourceRoot="E:/netbank/sharepic/";
	$targetRoot="E:/netbank/sharepic/";

  //convert_directory_All($sourceRoot.'client',$targetRoot.'client');
	convert(
		$sourceRoot."js/share/",
		$targetRoot."js/share/",
		Array("imagegrid6.js"),
		"ig.js"
	);
  
  convert(
		$sourceRoot."js/share/",
		$targetRoot."js/share/",
		Array("Detector.js"),
		"dtr.js"
	);

	
?>