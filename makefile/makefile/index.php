<?php

$dir="makefile/";
$mktmp="Makefile_tmp";
  
function list_dir($dir,$mktmp){
      $files=scandir($dir);
      foreach($files as $file){
          if($file==$mktmp)
              unlink($dir.$mktmp);
          if($file!="." && $file!=".."){
              $name=explode(" ",$file)[0];
              echo "<span><a href=\"".$dir.$file."\">".$name."</a></span>";
          }
      }
  }
  
?>
<!DOCTYPE html>
<!--

 CREATION : 

 SUBJECT : 

-->
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Makefile</title>
    <style>
      span {
      width : 100px;
      height : calc(100px/1.618);
      color : #fff;
      background-color : #0077b3;
      margin : 10px;
      display : flex;
      align-items : center;
      justify-content : center;
      }
    </style>
  </head>
  <body>
<?php
list_dir($dir,$mktmp);
  ?>
  </body>
<html>