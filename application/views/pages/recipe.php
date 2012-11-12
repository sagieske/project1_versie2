<?php

    $recipe = $recipes[0];

    // Print all relevant information.
    echo "<h1> $recipe->name </h1>";
    //TODO: INSERT PICTURE ON THIS SPOT
    echo "<p> <i>$recipe->description </i></p>";
    echo "<p> <b>TIME:</b> $recipe->time minutes.<br> <b>YIELD:</b> $recipe->yield. </p>";
    
    // Print ingredients
    echo "<p> <b>INGREDIENTS:</b>";
    $strings = explode("\n",$recipe->ingredients);
    foreach ($strings as $ingr):
        echo "<br>".lcfirst($ingr);
    endforeach;
    
    echo "<p> <b>PROCEDURE</b> <br> $recipe->procedure </p>";

?>
