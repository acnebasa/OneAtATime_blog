<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_posts() {
        $this->db->select('posts.*, users.user_name, tags.category');
        $this->db->from('posts');
        $this->db->join('users', 'users.user_id = posts.user_id');
        $this->db->join('tags', 'tags.post_id = posts.post_id', 'left');
        $this->db->order_by('created_At', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_post_by_id($post_id) {
        $this->db->select('posts.*, users.user_name, tags.category');
        $this->db->from('posts');
        $this->db->join('users', 'users.user_id = posts.user_id');
        $this->db->join('tags', 'tags.post_id = posts.post_id', 'left');
        $this->db->where('posts.post_id', $post_id);
        return $this->db->get()->row_array();
    }

    public function get_posts_by_user($user_id) {
        $this->db->select('p.*, t.category as tag_name');
        $this->db->from('Posts p');
        $this->db->join('Tags t', 'p.tag_id = t.tag_id', 'left');
        $this->db->where('p.user_id', $user_id);
        $this->db->order_by('p.created_At', 'DESC');
        return $this->db->get()->result_array();
    }

    public function create_post($data) {
        $this->db->insert('posts', $data);
        return $this->db->insert_id();
    }

    public function update_post($post_id, $data) {
        $this->db->where('post_id', $post_id);
        return $this->db->update('posts', $data);
    }

    public function delete_post($post_id) {
        $this->db->delete('posts', ['post_id' => $post_id]);
        $this->db->delete('tags', ['post_id' => $post_id]);
        $this->db->delete('reactions', ['post_id' => $post_id]);
    }

    public function increment_reaction_count($post_id) {
        $this->db->set('reaction_count', 'reaction_count+1', FALSE);
        $this->db->where('post_id', $post_id);
        return $this->db->update('posts');
    }
}
