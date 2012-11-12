<?php

/*Controller for single recipe */
class Recipe extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Recipe_model');
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
    
    /* Show one recipe */
    public function show($recipeID) {
        $this->Recipe_model->set_viewed($recipeID);
        $data['recipes'] = $this->Recipe_model->get_one($recipeID); 
        $data['title'] = 'Recipe';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/recipe', $data);
        $this->load->view('templates/footer', $data);
    }   
     
}  
?>
