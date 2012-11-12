<?php

class Lists extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('Recipe_model');

    }
    
        
    /* Show all recipes */
    public function show_all() {
        $data['recipes'] = $this->Recipe_model->get_all(); 
        $data['title'] = 'List';

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
