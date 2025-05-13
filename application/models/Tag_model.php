<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create_tag($data) {
        return $this->db->insert('tags', $data);
    }
}
