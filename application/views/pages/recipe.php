<?php

    $recipe = $recipes[0];
    

    // Print all relevant information.
    echo "<h1> $recipe->name </h1>";
    echo "Average rating: $recipe->ratings";
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
    
    $li = $this->session->userdata('logged_in');
    if ( $li ) {
    ?>
        <form <? echo 'action="'.$recipe->recipeID.'"' ?> method="post" data-inline="true">
        <fieldset data-role="controlgroup" >
            <label for="rating">Rate this recipe?</label>
            <input type="number" name="rating" id="rating">
            <input type="submit" value="Rate!" data-inline="true" id="rate">
        </fieldset>
        </form>
    <? }

?>
