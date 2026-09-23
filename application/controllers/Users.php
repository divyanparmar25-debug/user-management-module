<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    // Display user listing with search and filters
    public function index()
    {
        $search = $this->input->get('search');
        $role = $this->input->get('role');
        $status = $this->input->get('status');

        $config['base_url'] = site_url('users');
        $config['per_page'] = 5;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';

        $config['total_rows'] = $this->User_model->countUsers($search, $role, $status);

        $this->pagination->initialize($config);

        $page = $this->input->get('page');
        if (!$page) {
            $page = 0;
        }

        $data['users'] = $this->User_model->getUsers(
            $search,
            $role,
            $status,
            $config['per_page'],
            $page
        );

        $data['links'] = $this->pagination->create_links();

        $data['search'] = $search;
        $data['role'] = $role;
        $data['status'] = $status;

        $this->load->view('users/index', $data);
    }

    //only Admin can add new users
    public function add()
    {
        if ($this->session->userdata('user_role') != 'ADMIN') {
            show_error('Access Denied', 403);
        }

        $this->load->view('users/add');
    }

    //save new user
    public function store()
    {
        if ($this->session->userdata('user_role') != 'ADMIN') {
            show_error('Access Denied', 403);
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/add');
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role', TRUE),
                'status' => $this->input->post('status', TRUE)
            );

            $this->User_model->insertUser($data);

            $this->session->set_flashdata('success', 'User added successfully.');

            redirect('users');
        }
    }

    public function edit($id)
    {
        $data['user'] = $this->User_model->getUserById($id);

        if (!$data['user']) {
            show_404();
        }

        if (
            $this->session->userdata('user_role') == 'OPERATOR' &&
            $data['user']['role'] == 'ADMIN'
        ) {
            show_error('Access Denied', 403);
        }

        $this->load->view('users/edit', $data);
    }

    //update user details
    public function update($id)
    {
        $user = $this->User_model->getUserById($id);

        if (!$user) {
            show_404();
        }

        if (
            $this->session->userdata('user_role') == 'OPERATOR' &&
            $user['role'] == 'ADMIN'
        ) {
            show_error('Access Denied', 403);
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $email = $this->input->post('email');

        if ($email != $user['email']) {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email|is_unique[users.email]'
            );
        } else {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email'
            );
        }

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $user;
            $this->load->view('users/edit', $data);
            return;
        }

        $data = array(
            'name' => $this->input->post('name', TRUE),
            'email' => $this->input->post('email', TRUE)
        );

        if ($this->session->userdata('user_role') == 'ADMIN') {
            $data['role'] = $this->input->post('role', TRUE);
            $data['status'] = $this->input->post('status', TRUE);
        }

        $this->User_model->updateUser($id, $data);

        $this->session->set_flashdata('success', 'User updated successfully.');

        redirect('users');
    }

    //Soft delete user
    public function delete($id)
    {
        if ($this->session->userdata('user_role') != 'ADMIN') {
            show_error('Access Denied', 403);
        }

        $this->User_model->deactivateUser($id);

        $this->session->set_flashdata('success', 'User deactivated successfully.');

        redirect('users');
    }

    //AJAX request to update user status
    public function changeStatus()
    {
        if ($this->session->userdata('user_role') != 'ADMIN') {
            $this->output->set_content_type('application/json');

            echo json_encode(array(
                'status' => false,
                'message' => 'Access Denied'
            ));
            return;
        }

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $update = $this->User_model->changeStatus($id, $status);

        if ($update) {
            echo json_encode(array(
                'status' => true,
                'message' => 'User status updated successfully'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'message' => 'Unable to update user status'
            ));
        }
    }
}
