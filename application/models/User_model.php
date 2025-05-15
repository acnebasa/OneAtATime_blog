<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($username) {
        $query = $this->db->get_where('Users', ['user_name' => $username]);
        return $query->row();
    }

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