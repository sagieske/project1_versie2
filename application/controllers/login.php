<?php

class Login extends CI_Controller {


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
        
        // OLD: Upon loading the login page, recently viewed recipes were cleared entirely.
        //$this->Recipe_model->clear_tables();
        // This should be done to select data and only when looking at the list itself.
        
        $loginworked = TRUE;
        if ( isset($_POST['un']) ) {
	        $loginworked = $this->login(); // This function does all the work.
	    }
        
        $data['title'] = 'Home';

        $this->load->view('templates/header', $data);
        if ( $loginworked ) {
            $this->load->view('pages/home', $data);
        } else {
            $this->load->view('pages/login_error', $data);
        }
        $this->load->view('templates/footer', $data);
        
    }
    
    
   public function logout() {
        $this->session->set_userdata('logged_in', FALSE );
        $this->session->set_userdata('username', '' );
    }
    
    public function login() {
        $un = $this->input->post("un");
        $pw = $this->input->post("pw");
        $correct = $this->User_model->login($un, $pw);
        $uid = $this->User_model->find_uid($un);
        if ( $correct ) {
            $newdata = array(
                   'username'  => $un,
                   'userid' => $uid,
                   'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
        }
        return $correct;
    }
    public function signup() {
        $un = $this->input->post("un");
        $pw = $this->input->post("pw");
        $correct = $this->User_model->signup($un, $pw);
        $uid = $this->User_model->find_uid($un);
        if ( $correct ) {
            $newdata = array(
                   'username'  => $un,
                   'userid' => $uid,
                   'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
        }
        return $correct;
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
