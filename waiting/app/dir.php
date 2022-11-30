<?php

$dir="../image";
$liste=scandir($dir);

function print_array($list){
    $count=0;
    echo "new Array(";
    foreach($list as $el){
        if($el != "." && $el!=".."){
            if($count>0)
                echo ",";
            echo $el;
            $count++;
        }
    }
    echo ")";
}


?>
<script>
    var images = <?php print_array($liste); ?>;
</script>