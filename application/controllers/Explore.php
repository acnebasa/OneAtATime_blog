<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends CI_Controller {
    public function index() {
        $data = [
            'page_title' => 'Explore',
            'user_profile' => 'assets/images/profiles/user1.jpg',
            'active_tab' => 'explore' // Highlights "Explore" tab
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('landing/explore_page');
        $this->load->view('templates/footer');
    }
}