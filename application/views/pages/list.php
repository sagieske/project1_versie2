<?php
    if(empty($recipes)){
        echo '<h3>No results were found.</h3>';
    }
    else{
        foreach ($recipes as $recipe):
            echo "<h3> <a href=\"../recipe/show/$recipe->recipeID\">
                $recipe->name </a> </h3>";
            echo "<p> $recipe->description <br>";
            echo "Takes <b>$recipe->time</b> minutes. 
                Serves <b>$recipe->yield</b>. </p>";
            echo "<hr/>"; 
        endforeach;
}


?>
