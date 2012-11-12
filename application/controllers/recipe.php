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
        $correct = $this->User_model->rate($un, $rating, $recipe);
        return $correct;
    }
    
    /* Show one recipe */
    public function show($recipeID) {
    
        if ( isset($_POST['rating']) ) {
	        $this->rate($recipeID); // This function does all the rating.
	    }
	    $rating = $this->Recipe_model->get_ratings( $recipeID );

        $data['title'] = $this->Recipe_model->set_viewed($recipeID);
        $data['recipes'] = $this->User_model->get_one($recipeID); 
        $data['rating'] = $rating;
        $data['recipeID'] = $recipeID;

        $this->load->view('templates/header', $data);
        $this->load->view('pages/recipe', $data);
        $this->load->view('templates/footer', $data);
    }    
     
}  
?>
