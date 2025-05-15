<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');

        // Check if admin is logged in
        if (!$this->session->userdata('admin_id')) {
            $this->session->set_flashdata('error', 'Please login to access the admin dashboard.');
            redirect('admin/login');
        }
    }

    public function dashboard() {
        $data['title'] = 'Admin Dashboard';
        $this->load->view('admin/dashboard', $data);
    }
}