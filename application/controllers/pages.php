<?php

class Pages extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('Recipe_model');

    }
    
    public function index() {

        if (!file_exists('../application/views/pages/home.php')) {
        // Whoops, we don't have a page for that!
            show_404();
        }
        //TODO: DELETE clear recently viewed
        $this->Recipe_model->clear_tables();
        
        //$data['posts'] = $this->Recipe_model->get_latest();
        $data['title'] = 'Home';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/home', $data);
        $this->load->view('templates/footer', $data);
        
    }
    
    /* Show all recipes */
    public function show_all() {
        $data['recipes'] = $this->Recipe_model->get_all(); 
        $data['title'] = 'List';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);
    }
    
    /* Show one recipe */
    public function show_recipe($recipeID) {
        $data['title'] = $this->Recipe_model->set_viewed($recipeID);
        $data['recipes'] = $this->Recipe_model->get_one($recipeID); 
       //$data['title'] = 'Recipe';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/recipe', $data);
        $this->load->view('templates/footer', $data);
    }    

    /*  Show searchpage
    *   Get min/max values for sliders
    */
    public function search() {
        $data['title'] = 'search';
        $data['mintime'] = $this->Recipe_model->get_min('time');
        $data['maxtime'] = $this->Recipe_model->get_max('time');
        $data['minyield'] = $this->Recipe_model->get_min('yield');
        $data['maxyield'] = $this->Recipe_model->get_max('yield');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/search', $data);
        $this->load->view('templates/footer', $data);
    }
    
    /*  Show searched recipes by text
        Get values from form in search.php
    */
    public function show_searched_recipes_text() {
        $query = $_GET["search"];
        
        //get type of search
        $type = $_GET["radio-mini"];
        if ($type == 'recipeName') {
            $field = 'name';
        } elseif ($type == 'recipeDescr' ){
            $field = 'description';
        } elseif ($type == 'recipeIngr' ){
            $field = 'ingredients';
        } else {
            $field = 'procedure';
        }

        $data['recipes'] = $this->Recipe_model->get_searched_words($field, $query);
        $data['title'] = 'Results for "'.$query.'"';
        $data['type'] = $field;
        $data['query'] = $query;
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);
    
    }
    
    public function show_searched_recipes_time() {
        $max = $_GET["slider-time"];
        $field = 'time <=';
        //get type of search
        //$max = $_GET["slider-time"];

        $data['recipes'] = $this->Recipe_model->get_searched_timeyield($field, $max);
        $data['title'] = 'Results for "'.$field.' '.$max.'"';
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);
    
    }
       
    public function show_searched_recipes_yield() {
        $max = $_GET["slider-yield"];
        $field = 'yield <=';

        $data['recipes'] = $this->Recipe_model->get_searched_timeyield($field, $max);
        $data['title'] = 'Results for "'.$field.' '.$max.'"';
        //$data['recipes'] = $this->Recipe_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);
    
    }   
    
    public function recently_viewed() {
        $data['recipes'] = $this->Recipe_model->get_recently_viewed(); 
        $data['title'] = 'Recently Viewed';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);    
    }
}

?>
