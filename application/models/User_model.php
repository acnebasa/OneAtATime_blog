<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($username) {
        $query = $this->db->get_where('Users', ['user_name' => $username]);
        
        // Check if user exists, return false if not
        if ($query->num_rows() > 0) {
            return $query->row(); // Return the first result
        }
        
        return false; // No user found
    }

    public function get_user_by_username($username) {
        return $this->db->get_where('Users', array('user_name' => $username))->row_array();
    }

    // Insert new user
    public function insert_user($data) {
        return $this->db->insert('Users', $data);
    }

    public function update_user($user_id, $data) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('Users', $data);
    }

    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('Users', ['user_id' => $user_id]);
        return $query->row();
    }
}