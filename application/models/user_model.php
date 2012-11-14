<?php

// Class is meant to return different lists of recipes.
class User_model extends CI_Model {

    public function login($un,$pw){
        
        $users = $this->db->get_where('users',array('username' => $un))->result();
        foreach ( $users as $user ) {
        
            if ( MD5($pw) == $user->password ) { return TRUE; }
        
        }
        return FALSE;
        //(BTW, database gazes also into you, BE CAREFUL)
    }
    public function signup($un,$pw){
        
        $users = $this->db->get_where('users',array('username' => $un))->result();
        foreach ( $users as $user ) {
            return FALSE; // Checks for existing users with the same name
        }
        $data = array(
            'username' => $un,
            'password' => MD5($pw)
            // identifier => auto-increment
        );
        $this->db->insert('users', $data); 
        return TRUE;
        
    }
    
    
    public function rate($un, $rating, $recipe) {
        $existing = $this->db->get_where('ratings',array('username' => $un,
                                                       'recipeID' => $recipe))->result();
        foreach ( $existing as $e ) {
            return FALSE; // Breaks on existing rating.
        }
        $data = array(
            'username' => $un,
            'recipeID' => $recipe,
            'rating' => $rating
            // identifier => auto-increment
        );
        $this->db->insert('ratings', $data); 
        return TRUE;
        
    }
    
    /*  Set_viewed(1): Sets recipe to recently viewed with username, inserted in database
    **  Double instances will get updated timestamp
    **  TODO: Write delete function for database
    */
    public function set_viewed($recipeID, $un) { 
        $result = $this->db->get_where('recently_viewed',array('recipeID' => $recipeID, 'username' => $un));
        if (mysql_num_rows($result) == 0) {
            $data = array('recipeID' => $recipeID, 'username' => $un);
            $this->db->insert('recently_viewed', $data);
            }
        else{
            $data = array('recipeID' => $recipeID, 'time' => 'NOW()', 'username' => $un);
            $this->db->update('recently_viewed', $data)->where('recipeID', $recipeID);
        }
    }
    
    /*  Get_recently_viewed(0): Retrieves recently viewed from databases given with user
    **  join recently viewed recipeIDs with rest of information from recipestable
    */    
    public function get_recently_viewed($un){
        $data = array('username' => $un);
        return $this->db->order_by('recently_viewed.time', 'desc')
            ->join('recipes', 'recipes.recipeID = recently_viewed.recipeID')
            ->get_where('recently_viewed',array('username' => $un))->result();
    }

    /*  Set_favorite(1): Sets recipe to recently viewed with username, inserted in database
    **  Double instances will get updated timestamp
    **  TODO: Write delete function for database
    */
    public function set_favorite($recipeID) { 
        $result = $this->db->get_where('favorites',array('recipeID' => $recipeID));
        if (mysql_num_rows($result) == 0) {
            $data = array('recipeID' => $recipeID);
            $this->db->insert('favorites', $data);
            }
        else{
            $data = array('recipeID' => $recipeID);
            $this->db->update('favorites', $data)->where('recipeID', $recipeID);            
        }
    }    
    
    
    /*  Get_Favorites(0): Retrieves favorites from databases
    **  
    */    
    public function get_favorites(){
        return $this->db->order_by('recipes.recipeID', 'asc')->join('recipes', 'recipes.recipeID = favorites.recipeID')->get('favorites')->result();
    }
}

?>
