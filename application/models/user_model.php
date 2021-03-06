<?php

// Class is meant to return different lists of recipes.
class User_model extends CI_Model {

    public function login($un,$pw){
        
        $users = $this->db->get_where('users',array('username' => $un))->result();
        foreach ( $users as $user ) {
        
            if ( crypt($pw) == $user->password ) { return TRUE; }
        
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
            'password' => crypt($pw)
            // identifier => auto-increment
        );
        $this->db->insert('users', $data); 
        return TRUE;
        
    }
    public function find_uid($un){
        $users = $this->db->get_where('users',array('username' => $un))->result();
        foreach ($users as $user)
        {
            return $user->identifier;
        }
    }
    
    public function rate($un, $uid, $rating, $recipe) {
        $existing = $this->db->get_where('ratings',array('userID' => $uid,
                                                       'recipeID' => $recipe))->result();
        foreach ( $existing as $e ) {
            return FALSE; // Breaks on existing rating.
        }
        $data = array(
            'username' => $un,
            'userID' => $uid,
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
    public function set_viewed($recipeID, $un, $uid) {
        $data = array('recipeID' => $recipeID, 'username' => $un, 'userID' => $uid);
        $existing_entries = $this->db->get_where( 'recently_viewed', $data )->num_rows();
        if ($existing_entries < 1 ) {
            $this->db->insert('recently_viewed', $data);
        }else{
            $this->db->delete('recently_viewed', $data);
            $this->db->insert('recently_viewed', $data);
           
        }
    }
    
    /*  Get_recently_viewed(1): Retrieves recently viewed from databases given with user
    **  join recently viewed recipeIDs with rest of information from recipes table
    */    
    public function get_recently_viewed($un, $uid){
        $data = array('username' => $un, 'userID' => $uid);
        return $this->db->order_by('recently_viewed.time', 'desc')
            ->join('recipes', 'recipes.recipeID = recently_viewed.recipeID')
            ->get_where('recently_viewed', $data)->result();
    }

    /*  Set_favorite(2): Sets recipe to favorite with username, inserted in database
    */
    public function set_favorites($recipeID, $un, $uid) { 
        $data = array('recipeID' => $recipeID, 'username' => $un, 'userID' => $uid);
        $existing_entries = $this->db->get_where( 'favorites', $data )->num_rows();
        if ($existing_entries < 1 ) {
            $this->db->insert('favorites', $data);
        }
    }    
    
    
    /*  Get_favorites(1): Retrieves favorites from databases given with user
    **  join favorites recipeIDs with rest of information from recipes table
    */   
    
    public function get_favorites($un, $uid){
        $data = array('username' => $un, 'userID' => $uid);
        return $this->db->order_by('name', 'asc')
            ->join('recipes', 'recipes.recipeID = favorites.recipeID')
            ->get_where('favorites', $data)->result();
    }
    
     public function is_favorite($recipeID, $un, $uid){
        $data = array('username' => $un, 'recipeID' => $recipeID, 'userID' => $uid);
        $existing_entries = $this->db->get_where( 'favorites', $data )->num_rows();
        return $existing_entries;
    }
    
    public function delete_favorite($recipeID, $un, $uid){
        $data = array('username' => $un, 'recipeID' => $recipeID, 'userID' => $uid);
        $this->db->delete('favorites', $data); 
    }
}

?>
