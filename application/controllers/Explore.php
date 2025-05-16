<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends CI_Controller {
    public function index() {
        // Load models
        $this->load->model('Post_model');
        $this->load->model('User_model');
        
        // Get current user (assuming bookworm is logged in)
        $current_username = 'bookworm'; // Replace with session user in real implementation
        $current_user = $this->User_model->get_user_by_username($current_username);
        
        // Get posts from other users
        $data['posts'] = $this->Post_model->get_explore_posts($current_user['user_id'], 30);
        
        // Common data
        $data['page_title'] = 'Explore';
        $data['username'] = $current_username;
        $data['active_tab'] = 'explore';
        
        $this->load->view('templates/header', $data);
        $this->load->view('landing/explore_page', $data);
        $this->load->view('templates/footer');
    }
    public function testindex() {
        $this->load->view('templates/header');
        $this->load->view('templates/footer');
    }
}