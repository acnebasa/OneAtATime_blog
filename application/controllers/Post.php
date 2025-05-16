<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Post_model');
        $this->load->model('Tag_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    private function check_login()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function create()
    {
        $this->check_login();
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        // Get all available tags for the dropdown
        $data['tags'] = $this->Tag_model->get_all_tags();
        $data['username'] = $user['user_name'];
        $data['active_tab'] = 'home';

        // Set validation rules
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[180]');
        $this->form_validation->set_rules('tags', 'Tags', 'callback_validate_tags');

        if ($this->form_validation->run() === FALSE) {
            // Reload with errors
            $this->load->view('templates/header', $data);
            $this->load->view('landing/home/create_post', $data);
            $this->load->view('templates/footer');
        } else {
            // Prepare post data
            $post_data = array(
                'user_id' => $user_id,
                'content' => $this->input->post('content'),
                'created_At' => date('Y-m-d H:i:s')
            );

            // Create the post
            $post_id = $this->Post_model->create_post($post_data);

            // Handle tags if provided
            $tags = $this->input->post('tags');
            if (!empty($tags)) {
                $tag_ids = explode(',', $tags);
                $this->Post_model->add_post_tags($post_id, $tag_ids);
            }

            // Redirect to home page to refresh stuffs
            redirect('home');
        }
    }

    // Custom validation callback for tags
    // THis is to ensure that before we send the data to the database,
    // the tags are only 3, and exists in the database.
    public function validate_tags($tags)
    {
        if (empty($tags)) {
            return true; // Tags are optional
        }

        $tag_ids = explode(',', $tags);

        // Validate maximum 3 tags
        if (count($tag_ids) > 3) {
            $this->form_validation->set_message('validate_tags', 'You can select maximum 3 tags');
            return false;
        }

        // Validate all tag IDs exist
        foreach ($tag_ids as $tag_id) {
            if (!$this->Tag_model->tag_exists($tag_id)) {
                $this->form_validation->set_message('validate_tags', 'One or more selected tags are invalid');
                return false;
            }
        }

        return true;
    }


    public function like()
    {
        $this->check_login();

        $post_id = $this->input->post('post_id');
        $user_id = $this->session->userdata('user_id');

        // Check if user already liked this post
        $existing_like = $this->db->get_where('reactions', [
            'post_id' => $post_id,
            'user_id' => $user_id
        ])->row_array();

        if (!$existing_like) {
            // Add new like
            $this->db->insert('reactions', [
                'post_id' => $post_id,
                'user_id' => $user_id,
                'reaction' => 1
            ]);

            // Update reaction count
            $this->Post_model->update_reaction_count($post_id);

            echo json_encode([
                'success' => true,
                'new_count' => $this->Post_model->get_reaction_count($post_id)
            ]);
        } else {
            // Unlike if already liked
            $this->db->where([
                'post_id' => $post_id,
                'user_id' => $user_id
            ])->delete('reactions');

            $this->Post_model->update_reaction_count($post_id);

            echo json_encode([
                'success' => true,
                'new_count' => $this->Post_model->get_reaction_count($post_id),
                'unliked' => true
            ]);
        }
    }

    public function delete()
    {
        $this->check_login();

        $post_id = $this->input->post('post_id');
        $user_id = $this->session->userdata('user_id');

        // Verify post exists and belongs to user
        $post = $this->Post_model->get_post_by_id($post_id);

        if (!$post || $post['user_id'] != $user_id) {
            echo json_encode(['success' => false, 'message' => 'Post not found or not owned by user']);
            return;
        }

        // Delete the post
        if ($this->Post_model->delete_post($post_id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error']);
        }
    }

}