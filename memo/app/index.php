<?php
  
  $n=12;

  $size=150;
  
  function display_array($array){
      echo "<ul>";
      foreach($array as $file)
          echo "<li>".$file["filename"]."</li>";
      echo "</ul>";
  }
  
  function image_array($n){
      $dir="image/";
      
      $liste=scandir($dir);

      $i=0;
      foreach($liste as $image){
          if($i>=$n)
              break;
          if($image == "." || $image == "..")
              continue;
          
          $info = pathinfo($image);
          
          $filename = $info["basename"];
          $name = $info["filename"];
          
          $arrCard  = array();
          $arrCard["name"] = $name;
          $arrCard["filename"] = $filename;
          $arrCard["url"] = "image/{$filename}";
          
          $arrCars[] = $arrCard;
          $arrCars[] = $arrCard;

          $i++;
      }
      shuffle($arrCars);
      
      return $arrCars;
  }

  function create_memo($array){
      $i=1;
      foreach($array as $file){
          echo "<div class=\"card\" element=\"".$file["name"]."\" number=\"".$i."\"><img src=\"".$file["url"]."\"></div>";
          $i++;
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
    <title>Memo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icon/icon_b.png" type="image/x-icon">
    <style>

    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="heading">Memory scout</h1>
      <div class="cards">
    <?php
              create_memo(image_array($n));
    ?>
      </div>
    </div>
    <script src="js/script.js">
    </script>
  </body>
<html>
