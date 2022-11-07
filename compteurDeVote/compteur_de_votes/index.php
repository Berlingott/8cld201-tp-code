<?php

session_start();

if(!(isset($_SESSION["flag"]))){
      $_SESSION["flag"]=true;
      $_SESSION["candidates"]=array();
      $_SESSION["name"]="";
      $_SESSION["color"]=array();
}
  
function display($candid,$color){
    echo "<table>";
    foreach($candid as $c){
        echo "<tr><td>".$c."</td><td style=\"background-color : ".$color[$c]."\"width=\"75px\"></td></tr>";
    }
    echo "</table>";
}

function array_assoc_push($array, $key, $value){
    $array[$key]=$value;
    return $array;
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
    <title>Candidats</title>
  </head>
  <body>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <fieldset>
        <legend>Ajouter un candidat</legend>
        <input type="text" placeholder="Entrer le nom du candidat, de la candidate" name="candidat" required>
        <input type="color" name="color" value="#fff">
        <button type="submit" name="submit">Ajouter</button>
      </fieldset>
    </form>
    <form action="php/candidat.php" method="POST">
      <button type="submit">Envoyer puis passer au dépouillement</button>
    </form>
      <?php
          if(isset($_POST["candidat"]) && $_SESSION["flag"] && $_SESSION["name"]!=$_POST["candidat"]){
            $_SESSION["candidates"][]=$_POST["candidat"];
            $_SESSION["name"]=$_POST["candidat"];
            $_SESSION["color"]=array_assoc_push($_SESSION["color"],$_SESSION["name"],$_POST["color"]);
          }
display($_SESSION["candidates"],$_SESSION["color"]);
        
      ?>
    </ul>
  </body>
<html>
