<?php

  session_start();

  $nom="Makefile_tmp";
  
  $flagC=isset($_POST["cpp"]);
  $flagH=isset($_POST["h"]);

  $nom_valide = (isset($_POST["nom"]) && $_POST["nom"]!="");

  if($nom_valide){
      $tmparray=array("nom" => $_POST["nom"]);
      $tmparray += array("cpp" => ($flagC ? $_POST["nom"].".cpp" : ""));
      $tmparray += array("h" => ($flagH ? $_POST["nom"].".h" : "")); 
      echo "Le fichier s'appelle ".$_POST["nom"]."<br>";
      if($flagC)
          echo ".cpp -->".$_POST["nom"].".cpp<br>";
      if($flagH)
          echo ".h -->".$_POST["nom"].".h<br>";
      $_SESSION["array"]["obj"][] = $tmparray;
      
  }

  if(isset($_POST["ajout"]))
      echo "Ajout<br>";
  if(isset($_POST["main"]) && isset($_POST["main_name"]))
      $_SESSION["array"]["main"]=$_POST["main_name"];
  if(isset($_POST["void"]))
      unset($_SESSION["array"]);
  if(!isset($_SESSION["array"])){
      echo "Tableau non créé<br>";
       $_SESSION["array"] = array("main" => "", "obj" => array());
  }
  else
      foreach($_SESSION["array"]["obj"] as $array){
          foreach($array as $x=>$value){
              echo $x." : ".$value."<br>";
          }
          echo "<br>";
      }

function write($fptr,$str){
    fwrite($fptr,$str);
}
  
function makefile($array,$nom){
    $f=fopen($nom,"w");
    write($f,"CC=g++\nCFLAGS=-Wall -g\n\nEXE=");
    write($f,$array["main"]."\n\n");
    write($f,"$(EXE) : $(EXE).cpp");
    foreach($array["obj"] as $obj){
        write($f," ".$obj["nom"].".o");
    }
    write($f,"\n\t$(CC) $(CFLAGS) $(EXE).cpp");
    foreach($array["obj"] as $obj){
        write($f," ".$obj["nom"].".o");
    }
    write($f," -o $(EXE)\n");
    foreach($array["obj"] as $obj){
        write($f,"\n".$obj["nom"].".o : ".$obj["cpp"]." ".$obj["h"]."\n\t$(CC) -c $(CFLAGS) ".$obj["cpp"]." -o ".$obj["nom"].".o\n");
    }
    write($f,"\nclean :\n\trm *.o $(EXE)");
    fclose($f);
    echo "<a href=".$nom.">".$nom."</a>";
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
    <title></title>
  </head>
  <body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']  ?>">
      <fieldset>
        <legend>Ajouter un fichier</legend>
        <label>Ajouter un fichier <input type="text" name="nom" placeholder="Entrer le nom du fichier sans extension"></label>
        <label><input type="checkbox" name="h"> .h</label>
        <label><input type="checkbox" name="cpp"> .cpp</label><br>
        <button type="submit" name="ajout">Envoyer</button>
      </fieldset>
      <fieldset>
        <legend>Ajouter le fichier main</legend>
        <label>Entrer le nom du fichier main <input type="text" name="main_name"></label><br>
        <button type="submit" name="main">Envoyer</button>
      </fieldset>
      <fieldset>
        <legend>Vider la liste des fichiers</legend>
        
        <button type="submit" name="void">Envoyer</button>
      </fieldset>
      <fieldset>
        <legend>Créer le Makefile</legend>
        
        <button type="submit" name="create">Envoyer</button>
      </fieldset>
      <?php if(isset($_POST["create"]))
            makefile($_SESSION["array"],$nom);    ?>
    </form>
  </body>
<html>
