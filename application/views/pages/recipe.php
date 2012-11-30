<?php


    $recipe = $recipes[0];

    // Print all relevant information.
    echo "<h1> $recipe->name </h1>";
    if ($rating != -1) {
        echo "Average rating: $rating";
    }

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
        //Check if recipe is not a favorite

        if ($isfav < 1 ){?>
            <a <? echo 'href="../../../recipe/favorite_setted/'.$recipe->recipeID.'"' ?> data-role="button" data-icon="star" >Set as Favorite</a>
        
        
        <? } 
        //Recipe is a favorite:
        else{ ?>
            <a <? echo 'href="../../../recipe/favorite_setted/'.$recipe->recipeID.'"' ?> data-role="button" data-icon="star" >Delete as Favorite</a>
         <?}
        

        
        // Look for existing ratings by this user:
        $un = $this->session->userdata("username");
        $existing = $this->db->get_where('ratings',array('username' => $un,
                                                       'recipeID' => $recipe->recipeID))->result();
        $stop = FALSE; // If stop is set true, stop printing the rate box.
        foreach ( $existing as $e ) { // The only way I know how.
            $stop = TRUE;
        }
        if (!$stop) {
        ?>
        <form <? echo 'action="'.$recipe->recipeID.'"' ?> method="post" data-inline="true">
        <fieldset data-role="controlgroup" >
            <label for="rating">Rate this recipe?</label>
            <input type="number" min="1" max="10" name="rating" id="rating">
            <input type="submit" value="Rate!" data-inline="true" id="rate">
        </fieldset>
        </form>
        
        
    <? }
    }

?>
