<?php

class Lists extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Recipe_model');
        $this->load->model('User_model');
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
        $li = $this->session->userdata('logged_in');
        if ($li) {
            $un = $this->session->userdata('username');
            
            // At this point, delete non-recent data?
            // $this->db->delete('mytable', array('username' => $un, 'time' => 'nonrecent?')); 
            
            $data['recipes'] = $this->User_model->get_recently_viewed($un);
        }
        $data['title'] = 'Recently Viewed';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);    
    }
    
    public function show_favorites() {
        $li = $this->session->userdata('logged_in');
        if ($li) {
            $un = $this->session->userdata('username');
            
            $data['recipes'] = $this->User_model->get_favorites($un);
        }
        $data['title'] = 'Recently Viewed';;
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/list', $data);
        $this->load->view('templates/footer', $data);    
    }
    
                  

}  
?>
