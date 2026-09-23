<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    //check user by email for login
    public function checkLogin($email)
    {
        return $this->db->where('email', $email)
            ->get('users')
            ->row_array();
    }

    public function getUsers($search = '', $role = '', $status = '', $limit = 5, $start = 0)
    {
        if ($search != '') {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }

        if ($role != '') {
            $this->db->where('role', $role);
        }

        if ($status != '') {
            $this->db->where('status', $status);
        }

        $this->db->order_by('id', 'DESC');

        return $this->db->get('users', $limit, $start)->result_array();
    }

    public function insertUser($data)
    {
        return $this->db->insert('users', $data);
    }

    public function getUserById($id)
    {
        return $this->db->where('id', $id)
            ->get('users')
            ->row_array();
    }

    public function updateUser($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('users', $data);
    }

    public function deactivateUser($id)
    {
        return $this->db
            ->where('id', $id)
            ->update('users', array(
                'status' => 'INACTIVE'
            ));
    }

    public function countUsers($search = '', $role = '', $status = '')
    {
        if ($search != '') {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }

        if ($role != '') {
            $this->db->where('role', $role);
        }

        if ($status != '') {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results('users');
    }

    public function changeStatus($id, $status)
    {
        return $this->db
            ->where('id', $id)
            ->update('users', array(
                'status' => $status
            ));
    }
}
