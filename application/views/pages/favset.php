<?php

    if($set == 1){
        echo "This recipe is now set as Favorite:";
    }else{
        echo "This recipe is deleted as Favorite:";
    }
    $recipe = $recipes[0];
    echo "<h3> <a href=\"../../recipe/show/$recipe->recipeID\">
                $recipe->name </a> </h3>";


?>
