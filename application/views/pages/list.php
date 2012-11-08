<?php
    if(empty($recipes)){
        echo 'No results were found.';
    }
    else{
        foreach ($recipes as $recipe):
            echo "<h3> <a href=\"show_recipe/$recipe->recipeID\">
                $recipe->name </a> </h3>";
            echo "<p> $recipe->description <br>";
            echo "Takes <b>$recipe->time</b> minutes. 
                Serves <b>$recipe->yield</b>. </p>";
            echo "<hr/>"; 
        endforeach;
}


?>
