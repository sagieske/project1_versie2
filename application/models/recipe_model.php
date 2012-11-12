<?php

// Class is meant to return different lists of recipes.
class Recipe_model extends CI_Model {


    public function clear_tables(){
        $this->db->empty_table('recently_viewed'); 
    }
    /*  Get_all(0): Get all recipes from table
    */
    public function get_all() {
        return $this->db->order_by('recipeID', 'asc')->get('recipes')->result();
    }
    
    /*  Get_one(1): Get single recipe with specified id from table
    */
    public function get_one($id) {
        return $this->db->get_where('recipes',array('recipeID' => $id))->result();
    }
        
    /*  Get_recently_viewed(0): Retrieves recently viewed from databases
    **  join recently viewed recipeIDs with rest of information from recipestable
    */    
    public function get_recently_viewed(){
        return $this->db->order_by('recently_viewed.time', 'desc')->join('recipes', 'recipes.recipeID = recently_viewed.recipeID')->get('recently_viewed')->result();
    }
    
    /*  Get_recently_viewed(0): Sets recipe to recently viewed, inserted in database
    **  Double instances will get updated timestamp
    **  TODO: Write delete function for database
    */   
    public function set_viewed($recipeID) { 
        $result = $this->db->get_where('recipes',array('recipeID' => $recipeID));
        if (mysql_num_rows($result) == 0) {
            $data = array('recipeID' => $recipeID);
            $this->db->insert('recently_viewed', $data);
            }
        else{
            $data = array('recipeID' => $recipeID, 'time' => 'NOW()');
            $this->db->update('recently_viewed', $data)->where('recipeID', $recipeID);            
        }
    }
    
    
    /*  Get_searched_words(2): name column, text for search query
    *   search $query in column $field. Uses like(2) for values containing $query
    *   Search $query with first letter uppercase or lowercase.
    */
    public function get_searched_words( $field, $query ) { 
        //If first char is letter: convert first letter to upper or lowercase 
        if(ctype_alpha($query[0])){
            if(ctype_lower($query{0}))
            {
                $queryLow = $query;
                $queryUp = ucfirst($query);
            }
            if(ctype_upper($query{0}))
            {
                $queryLow = lcfirst($query);
                $queryUp = $query;
            }
        }
        else{
            $queryUp = $query;
            $queryLow = $query;
        }
        
        $query = $this->db->like($field, $queryUp);
        $query = $this->db->or_like($field, $queryLow);        
        
        $query = $this->db->order_by('recipeID', 'asc')->get('recipes');
        return $query->result();
    }
    
    /*  Get_searched_timeyield(2): Find all recipes with time or yield resp with $max
    **  $max = '=< X'
    */
    public function get_searched_timeyield($field, $max) {
        $query = $this->db->where($field, $max);
        $query = $this->db->order_by('recipeID', 'asc')->get('recipes');
        return $query->result();
    }
    
    
    /*  Get_min(1): columntype
        Get minimum number in specified column
    */
    public function get_min($type){
        $this->db->select_min($type);
        $query = $this->db->get('recipes');
        return $query->result_array();
    }
    
    /*  Get_max(1): columntype
        Get maximum number in specified column
    */
    public function get_max($type){
        $this->db->select_max($type);
        $query = $this->db->get('recipes');
        return $query->result_array();
    }

}

?>