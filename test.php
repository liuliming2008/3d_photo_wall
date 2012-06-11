<?php

$link->tt="adsf";
$links = json_encode($link);
try{

 
$test=fopen("/mnt/data/www/html/sharepic/data/test4.txt","wb");
fwrite($test,"test");
fclose($test);

echo  $links;

}
catch(Exception $e)
     {
      echo 'Message: ' .$e->getMessage();
     }

?>