<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function authenticate()
    {
        $email = trim($this->input->post('email'));
        $password = $this->input->post('password');

        //verify user credentials
        $user = $this->User_model->checkLogin($email);

        if ($user && $user['status'] == 'ACTIVE' && password_verify($password, $user['password'])) {

            //create user session after successful login
            $this->session->set_userdata(array(
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_role' => $user['role'],
                'logged_in' => TRUE
            ));

            redirect('dashboard');
        } else {

            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
