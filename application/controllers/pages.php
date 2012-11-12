<?php

class Pages extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Recipe_model');

    }
    
    public function logout() {
        $this->session->set_userdata('logged_in', FALSE );
        $this->session->set_userdata('username', '' );
    }
    
    public function login() {
        $un = $this->input->post("un");
        $pw = $this->input->post("pw");
        $correct = $this->Recipe_model->login($un, $pw);
        if ( $correct ) {
            $newdata = array(
                   'username'  => $un,
                   'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
        }
        return $correct;
    }
    public function signup() {
        $un = $this->input->post("un");
        $pw = $this->input->post("pw");
        $correct = $this->Recipe_model->signup($un, $pw);
        if ( $correct ) {
            $newdata = array(
                   'username'  => $un,
                   'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
        }
        return $correct;
    }
    
    public function rate($recipe) {
        $rating = $this->input->post("rating");
        $un = $this->session->userdata("username");
        $correct = $this->Recipe_model->rate($un, $rating, $recipe);
        return $correct;
    }

    
    public function index() {

        if (!file_exists('../application/views/pages/home.php')) {
        // Whoops, we don't have a page for that!
            show_404();
        }
        //TODO: DELETE clear recently viewed
        $this->Recipe_model->clear_tables();
        
        if ( isset($_POST['un']) ) {
	        $this->login(); // This function does all the work.
	    }
        
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
    
        if ( isset($_POST['rating']) ) {
	        $this->rate($recipeID); // This function does all the rating.
	    }
	    $rating = $this->Recipe_model->get_ratings( $recipeID );

        $data['title'] = $this->Recipe_model->set_viewed($recipeID);
        $data['recipes'] = $this->Recipe_model->get_one($recipeID); 
        $data['rating'] = $rating;
        $data['recipeID'] = $recipeID;

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
    
    //If user has just signed up...
    public function view_welcome() {
        if ( isset($_POST['un']) ) {
	    	$itworked = $this->signup(); // This function does all the work.
	    }
	    $data['title'] = 'welcome';

        $this->load->view('templates/header', $data);
        if ($itworked) {$this->load->view('pages/welcome',$data);}
	    else {$this->load->view('pages/signup_error',$data);}
        $this->load->view('templates/footer', $data);    
    }
    public function view_logout() {
        $this->session->unset_userdata('username');
	    $this->session->unset_userdata('logged_in');
        $data['title'] = 'logout';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/logout', $data);
        $this->load->view('templates/footer', $data);    
    }
    public function view_signup() {
        $data['title'] = 'signup';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/signup', $data);
        $this->load->view('templates/footer', $data);    
    }
	
}

?>
