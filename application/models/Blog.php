<?php

class Blog extends CI_Model {

    public function __construct() {
        
    }

    public function getComments() {
        $return_data = array();
        $this->db->order_by('id', 'DESC');
        $this->db->where('parent_comment = 0 OR parent_comment IS NULL');
        $this->db->select("id, name, comment,DATE_FORMAT(date,'%b %e, %Y at %h%:%i%:%s %p') as date, parent_comment");
        $result = $this->db->get('comments');
        $return_data['comments'] = $result->result_array();

        $this->db->order_by('id', 'DESC');
        $this->db->where('parent_comment > 0');
        $this->db->select("id, name, comment,DATE_FORMAT(date,'%b %e, %Y at %h%:%i%:%s %p') as date, parent_comment");
        $result_replies = $this->db->get('comments');
        $return_data['replies'] = $result_replies->result_array();
        return $return_data;
    }

    public function saveComment($data) {
        $date = date('Y-m-d H:i:s');
        $date_formatted = date('M d, Y g:i:s A', strtotime($date));
        $insert_data = array(
            'name' => $data['name'],
            'comment' => $data['comment'],
            'date' => $date,
            'parent_comment' => $data['parent_comment']
        );
        $this->db->insert('comments', $insert_data);
        $id = $this->db->insert_id();
        return array('id' => $id, 'date' => $date_formatted);
    }

}
