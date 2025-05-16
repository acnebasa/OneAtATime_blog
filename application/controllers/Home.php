<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index() {
    // Load necessary models
    $this->load->model('Post_model');
    $this->load->model('User_model');
    
    // Get bookworm user data
    $username = 'bookworm';
    $user = $this->User_model->get_user_by_username($username);
    
    // Get posts for this user
    $data['posts'] = $this->Post_model->get_posts_by_user($user['user_id']);
    
    // Common data for header
    $data['page_title'] = 'Bookworm\'s Posts';
    $data['username'] = $username;
    $data['active_tab'] = 'home';
    
    // Load views
    $this->load->view('templates/header', $data);
    $this->load->view('landing/home/create_post', $data);
    $this->load->view('landing/home_page', $data);
    $this->load->view('templates/footer');
}
}