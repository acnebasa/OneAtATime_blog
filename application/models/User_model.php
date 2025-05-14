<?php
class User_model extends CI_Model {

    // Get user by username
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
        $insert = $this->db->insert('Users', $data);
        
        if ($insert) {
            return $this->db->insert_id(); // Return the ID of the inserted user
        }
        
        return false; // Return false if insert fails
    }

    // Get user by user_id
    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('Users', ['user_id' => $user_id]);
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return false;
    }
}
