<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Files_Model extends CI_Model {


    function create($tag, $tag_id, $user, $path, $title = NULL, $description = NULL) {

        //Process Image Upload
        if($_FILES['file']['name'] != NULL)  {        

                $path = checkDir('./uploads/'.$path.'/'); //the path to upload

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|doc|docx|xls|xlsx|pdf|zip|rar|txt|tiff'; 
                $config['remove_spaces'] = TRUE;         

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "file";
                $this->upload->do_upload($field_name);

                $upload_data = $this->upload->data();

                $filepath = $path . $upload_data['file_name'];

                if ($this->upload->display_errors()) {
                    return FALSE;
                }


                //Set filename as title if title is null
                if(!$title) {
                    $title = $upload_data['file_name'];
                }     

                //Set filetype as description if description is null
                if(!$description) {
                    $description = $upload_data['file_type'];
                }                
                

        }

        $data = array(
            'tag'         => $tag,
            'tag_id'      => $tag_id,  
            'url'         => $filepath,
            'title'       => $title,  
            'description' => $description,  
            'user'        => $user
        );

        $this->db->insert('files', $data);

        return $this->db->insert_id();
    }


    function delete($id) {
        return $this->db->delete('files', array('id'=>$id));
    }



    function view($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('files');

        return $query->row_array();
    }


    function fetch_files($limit, $id, $tag, $tag_id) {

            
            if(!is_null($limit)) {
                $this->db->limit($limit, (($id-1)*$limit));
            }

            $this->db->select('
              users.username as user,
              CONCAT(users.firstname, " ",users.lastname) as name, 
              files.id,
              files.url,
              files.title,
              files.description,
              files.created_at,
              files.updated_at
              ');
            $this->db->join('users', 'users.username = files.user', 'left');

            $this->db->where('tag', $tag);
            $this->db->where('tag_id', $tag_id);
            $this->db->order_by('files.created_at', 'DESC');

            $query = $this->db->get("files");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    
    function count_files($tag, $tag_id) {
        
        $this->db->where('tag', $tag);
        $this->db->where('tag_id', $tag_id);
        return $this->db->count_all_results("files");
    }



   


}