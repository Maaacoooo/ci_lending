<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Notes_Model extends CI_Model {


    function create($tag, $tag_id, $user) {

        $data = array(
            'tag'         => $tag,
            'tag_id'      => $tag_id,  
            'title'       => strip_tags($this->input->post('title')),  
            'description' => strip_tags($this->input->post('description')),  
            'user'        => $user
        );

        $this->db->insert('notes', $data);

        return $this->db->insert_id();
    }


    function update($id) {

        $data = array(
            'title'       => strip_tags($this->input->post('title')),  
            'description' => strip_tags($this->input->post('description'))
        );

        $this->db->where('id', $id);
        $this->db->update('notes', $data);

        return $id;
    }


    function delete($id) {
        return $this->db->delete('notes', array('id'=>$id));
    }



    function view($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('notes');

        return $query->row_array();
    }


    function fetch_notes($limit, $id, $tag, $tag_id) {

            
            if(!is_null($limit)) {
                $this->db->limit($limit, (($id-1)*$limit));
            }

            $this->db->select('
              users.username as user,
              users.name,
              notes.id,
              notes.title,
              notes.description,
              notes.created_at,
              notes.updated_at
              ');
            $this->db->join('users', 'users.username = notes.user', 'left');

            $this->db->where('tag', $tag);
            $this->db->where('tag_id', $tag_id);
            $this->db->order_by('notes.created_at', 'DESC');

            $query = $this->db->get("notes");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    
    function count_notes($tag, $tag_id) {
        
        $this->db->where('tag', $tag);
        $this->db->where('tag_id', $tag_id);
        return $this->db->count_all_results("notes");
    }



   


}