<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //Base controller extended by all protected controllers to check user login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
}
