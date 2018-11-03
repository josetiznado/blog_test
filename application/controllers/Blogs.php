<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->model('Blog');
        $comments = $this->Blog->getComments();
        $this->load->view('index', array('comments' => $comments));
    }

    public function saveComment() {
//        if (!$this->input->is_ajax_request()) {
//            exit('No direct script access allowed');
//        }
        $this->load->model('Blog');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $post_arr = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 


        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('comment', 'Comment', 'required');

        if ($this->form_validation->run() == FALSE) {
            die(json_encode(
                            array('success' => false, 'message' => 'Required fields',)
            ));
        }

        try {
            $returned_data = $this->Blog->saveComment($post_arr);
            $json['date'] = $returned_data['date'];
            $json['id'] = $returned_data['id'];
            $json['success'] = true;
        } catch (Exception $ex) {

            log_message('error', $ex->getMessage());
        }

        echo json_encode($json);
    }

}
