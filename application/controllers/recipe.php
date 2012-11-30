<?php

/*Controller for single recipe */
class Recipe extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Recipe_model');
        $this->load->model('User_model');
    }

    public function index() {

        if (!file_exists('../application/views/pages/home.php')) {
        // Whoops, we don't have a page for that!
            show_404();
        }

        $data['recipes'] = $this->Recipe_model->get_one(1); 
        $data['title'] = 'Recipe';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);
        
    }  
    
    
    public function rate($recipe) {
        $rating = $this->input->post("rating");
        $un = $this->session->userdata("username");
        $uid = $this->session->userdata("userid");
        $correct = $this->User_model->rate($un, $uid, $rating, $recipe);
        return $correct;
    }
    
    public function set_favorite($recipeID) {
        $uid = $this->session->userdata("userID");
        $this->User_model->set_favorites($recipeID, $un, $uid);
    }
    
    public function delete_favorite($recipeID) {
        $uid = $this->session->userdata("userID");
        $this->User_model->delete_favorite($recipeID, $un, $uid);
    }
    
    public function favorite_setted($recipeID) {
        $data['title'] = ' ';
        $data['recipes'] = $this->Recipe_model->get_one($recipeID); 
        $un = $this->session->userdata("username");
        $uid = $this->User_model->find_uid($un);
        $isfav = $this->User_model->is_favorite($recipeID,$un);
        if($isfav < 1 ){
            $this->User_model->set_favorites($recipeID, $un, $uid);
            $data['set'] = 1;
        } else{
            $this->User_model->delete_favorite($recipeID, $un,$uid);
            $data['set'] = 0;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/favset', $data);
        $this->load->view('templates/footer', $data);
    }
    
    /* Show one recipe */
    public function show($recipeID) {
    
        if ( isset($_POST['rating']) ) {
	        $this->rate($recipeID); // This function does all the rating.
	    }
	    $rating = $this->Recipe_model->get_ratings( $recipeID );
        
       
        $li = $this->session->userdata('logged_in');
        if ($li) {
            $data['recent'] = $this->User_model->set_viewed($recipeID, $this->session->userdata('username'));
            $data['isfav'] = $this->User_model->is_favorite($recipeID, $this->session->userdata('username'));
        } 
        
        $data['title'] = 'Recipe';
        $data['recipes'] = $this->Recipe_model->get_one($recipeID); 
        $data['rating'] = $rating;
        $data['recipeID'] = $recipeID;

        $this->load->view('templates/header', $data);
        $this->load->view('pages/recipe', $data);
        $this->load->view('templates/footer', $data);
    }    
     
}  
?>
