<?php

session_start();

function draw($candidates,$color){
    echo "<table><tr><th>Ajouter 1 vote</th><th>Prénom</th><th>Nom</th><th colspan=\"10\">Nombre de vote</th><th>Total</th></tr>";
    foreach ($candidates as $c){
        $name=explode(" ",$c);
        echo "<tr style=\"background-color :".$color[$c]."55\"><td class=\"button\" rowspan=\"2\"><button type=\"button\" onclick=\"addVote('".$c."')\" rowspan=\"2\">Ajouter</button></td><td class=\"nom\" rowspan=\"2\">".ucfirst($name[0])."</td><td class=\"nom\" rowspan=\"2\">".strtoupper($name[1])."</td>";
        for($i=0 ; $i<10 ; $i++){
            echo "<td class=\"case\" id=\"".$c."_".(2*$i+1)."\">";
            for($j=0 ; $j<10 ; $j++)
                echo ".";
            echo "</td>";
        }
        echo "<td rowspan=\"2\" id=\"".$c."\" class=\"total\">0</td>";
        echo "</tr><tr style=\"background-color :".$color[$c]."55\">";
        for($i=0 ; $i<10 ; $i++){
            echo "<td class=\"case\" id=\"".$c."_".(2*($i+1))."\">";
            for($j=0 ; $j<10 ; $j++)
                echo ".";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<form method=\"POST\" action=\"total.php\">";
    echo "<button type=\"submit\">Envoyer</button>";
    foreach ($candidates as $c){
        echo "<input class=\"resultat\" type=\"number\" id=\"".$c."77\" name=\"".$c."\" value=\"0\"><br>";
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
    <title></title>
        <link rel="stylesheet" href="../css/candidat.css">
  </head>
  <body>
<?php draw($_SESSION["candidates"],$_SESSION["color"]); ?>
  </body>
  <script src="../js/script.js"></script>
<html>
