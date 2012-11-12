<?php

class Search extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Recipe_model');

    }

    /*  Show searchpage
    *   Get min/max values for sliders
    */
    
    public function index() {

        //TODO: DELETE clear recently viewed
        $this->Recipe_model->clear_tables();
        
        if ( isset($_POST['un']) ) {
	        $this->login(); // This function does all the work.
	    }
        
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

    
}  
?>
