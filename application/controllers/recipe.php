<?php

class Recipe extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('Recipe_model');

    }
}  
?>