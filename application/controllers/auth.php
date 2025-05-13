<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/** 
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property User_model $User_model
 */
class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function login() {
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = $this->session->flashdata('error');
            $this->load->view('auth/login', $data);
        } else {
            $username = $this->input->post('user_name');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user($username);

            if ($user && password_verify($password, $user->password)) {// In production, use password hashing
                $this->session->set_userdata('user_id', $user->user_id);
                redirect('welcome'); // Create a dashboard or homepage
            } else {
                $data['error'] = $this->session->flashdata('error');
                redirect('auth/login');
            }
        }
    }

    public function register() {
        $this->form_validation->set_rules('user_name', 'Username', 'required|is_unique[Users.user_name]');
        $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
        $data['error'] = validation_errors(); // Pass validation errors to the view
        $this->load->view('auth/register', $data);
    } else {
        $data = [
            'user_name' => $this->input->post('user_name'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];

        $this->User_model->insert_user($data);

        // Flash message will show after redirect
        $this->session->set_flashdata('success', 'Registered successfully. Please login.');
        redirect('auth/login');
    }
}

    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}
