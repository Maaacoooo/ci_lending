<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Borrower_Model extends CI_Model {

// CREATE DATA ////////////////////////////////////////////////////////////////////


    /**
     * -------------------------------------------------------------------------------
     * Borrowers
     * ------------------------------------------------------------------------------- 
     */

   /**
     * Generates an Account ID
     */
    function generate_AccountID() {

        $total_rows = $this->db->count_all('borrowers');
        return date('Y').'-'.prettyID(($total_rows + 1), 5);  
    }


    /**
     * Creates a Borrower Record
     * @param  String   $acc_id    a system generated ID 
     * @return Boolean              TRUE on success
     */
    function create($acc_id) {
      
            $data = array(              
                'id'             => $acc_id,  
                'firstname'      => strip_tags($this->input->post('fname')),  
                'lastname'       => strip_tags($this->input->post('lname')),  
                'middlename'     => strip_tags($this->input->post('mname')),  
                'birthdate'      => dateform(strip_tags($this->input->post('bdate'))),
                'sex'            => strip_tags($this->input->post('sex')),
                'civil_status'   => strip_tags($this->input->post('civil_stat'))
             );

            $create_act = $this->db->insert('borrowers', $data);   


            //Process Image Upload
              if($_FILES['img']['name'] != NULL)  {        

                $path = checkDir('./uploads/borrowers/'.$acc_id.'/'); //the path to upload

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "img";
                $this->upload->do_upload($field_name);

                $upload_data = $this->upload->data();

                $filepath = $path . $upload_data['file_name'];

                // Set Watermark ////////////////////////////////////////////////////
                $wm_config['quality'] = '100%';
                $wm_config['wm_text'] = 'Copyright '.APP_NAME.' '.date('Y');
                $wm_config['wm_type'] = 'text';
                $wm_config['wm_font_path'] = './system/fonts/arial.ttf';
                $wm_config['wm_font_size'] = '16';
                $wm_config['wm_font_color'] = 'ffffff';
                $wm_config['wm_vrt_alignment'] = 'bottom';
                $wm_config['wm_hor_alignment'] = 'left';
                $wm_config['source_image'] = $filepath; 
                /////////////////////////////////////////////////////////////////////

                //Update row 
                $this->db->update('borrowers', array('img' => $filepath), array('id'=>$acc_id));
            
            } 

            return $create_act;
       

    }




    /**
     * Returns a range of array of data as per request
     * - Used by Borrower List Pagination
     * @param  Int      $limit        The limit of records to be returned
     * @param  Int      $id           The ID of page
     * @param  String   $search       The search query
     * @param  Int      $is_deleted   if deleted record or not
     * @return Array             [description]
     */
    function fetch_borrowers($limit, $id, $search, $is_deleted) {

            if($search) {
              $this->db->like('borrowers.firstname', $search);
              $this->db->or_like('borrowers.middlename', $search);
              $this->db->or_like('borrowers.lastname', $search);
              $this->db->or_like('borrowers.spouse_name', $search);
              $this->db->or_like('borrowers.id', $search);
            }            

            $this->db->where('borrowers.is_deleted', $is_deleted);
            $this->db->limit($limit, (($id-1)*$limit));

            $query = $this->db->get("borrowers");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    /**
     * Counts the number of rows existing 
     * - Used by Pagination
     * @param  String     $search       The Search query
     * @param  Int        $is_deleted   if deleted record or not
     * @return Int         [description]
     */
    function count_borrowers($search, $is_deleted) {
        if($search) {
            $this->db->like('borrowers.firstname', $search);
            $this->db->or_like('borrowers.middlename', $search);
            $this->db->or_like('borrowers.lastname', $search);
            $this->db->or_like('borrowers.spouse_name', $search);
            $this->db->or_like('borrowers.id', $search);
        }

        $this->db->where('is_deleted', $is_deleted);
        return $this->db->count_all_results("borrowers");
    }


    /**
     * Returns an the row array of an item
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function view($acc_id) {

             $this->db->select('
                CONCAT(borrowers.firstname, " ", borrowers.lastname) as name,
                borrowers.img,
                borrowers.firstname,
                borrowers.middlename,
                borrowers.lastname,
                borrowers.civil_status,
                borrowers.sex,
                borrowers.birthdate,
                borrowers.is_deleted,
                borrowers.created_at,
                borrowers.id,
                CONCAT(borrowers_spouse.fname, " ", borrowers_spouse.mname, " ", borrowers_spouse.lname) as spouse_name,
                borrowers_spouse.id as spouse_id,
                borrowers_spouse.fname as spouse_fname,
                borrowers_spouse.mname as spouse_mname, 
                borrowers_spouse.lname as spouse_lname,
                borrowers_spouse.bplace as spouse_bplace,
                borrowers_spouse.bdate as spouse_bdate,
                borrowers_spouse.contact as spouse_contact,
                borrowers_spouse.occupation as spouse_occupation,
                borrowers_spouse.work_address as spouse_work,
                CONCAT(borrowers_address.building, ", ", borrowers_address.street, ", ", 
                        borrowers_address.barangay, ", ", borrowers_address.city, ", ", 
                        borrowers_address.province, ", ", borrowers_address.zip, ", ", borrowers_address.country) as bplace,
                borrowers_address.id as bplace_id,
                borrowers_address.building, 
                borrowers_address.street, 
                borrowers_address.barangay,
                borrowers_address.city,
                borrowers_address.province, 
                borrowers_address.zip,
                borrowers_address.country,
                borrowers_educ.id as educ_id,
                borrowers_educ.level as educ_level,
                borrowers_educ.course as educ_course,
                borrowers_educ.school as educ_school,
                borrowers_educ.year as educ_year
                ');        
             $this->db->join('borrowers_educ', 'borrowers_educ.borrower_id = borrowers.id', 'LEFT');
             $this->db->join('borrowers_spouse', 'borrowers_spouse.borrower_id = borrowers.id', 'LEFT');
             $this->db->join('borrowers_address', 'borrowers_address.id = borrowers.bplace', 'LEFT');
             $this->db->where('borrowers.id', $acc_id);                

             $query = $this->db->get('borrowers');

             return $query->row_array();
    }


    function update($id, $bplace_id) {


        //Update Borrower's basic info
            $data = array(              
                'firstname'      => strip_tags($this->input->post('fname')),  
                'lastname'       => strip_tags($this->input->post('lname')),  
                'middlename'     => strip_tags($this->input->post('mname')),  
                'birthdate'      => dateform(strip_tags($this->input->post('bdate'))),
                'sex'            => strip_tags($this->input->post('sex')),
                'civil_status'   => strip_tags($this->input->post('civil_stat'))
             );

            $this->db->where('id', $id);
            
            if(!$this->db->update('borrowers', $data)) {
                return FALSE;
            } 


        //Update Birthplace
        
              $bldg = strip_tags($this->input->post('bplace_bldg'));
              $strt = strip_tags($this->input->post('bplace_strt'));
              $brgy = strip_tags($this->input->post('bplace_brgy'));
              $city = strip_tags($this->input->post('bplace_city'));
              $prov = strip_tags($this->input->post('bplace_prov'));
              $zip  = strip_tags($this->input->post('bplace_zip'));
              $ctry = strip_tags($this->input->post('bplace_ctry'));

              $data2 = array(
                'building'   => $bldg,
                'street'     => $strt,
                'barangay'   => $brgy,
                'city'       => $city,
                'province'   => $prov,
                'zip'        => $zip,
                'country'    => $ctry
              );

            $this->db->where('id', $bplace_id);
            
            if(!$this->db->update('borrowers_address', $data2)) {
                return FALSE;
            } 

            return TRUE;
    }


    /**
     * -------------------------------------------------------------------------------
     * Addresses  
     * -------------------------------------------------------------------------------
     */



    /**
     * Inserts a Borrower's Address Record
     * @param  int        $acc_id     
     * @param  String     $tag        
     * @param  String     $bldg       
     * @param  String     $street     
     * @param  String     $brgy       
     * @param  String     $city       
     * @param  String     $prov       
     * @param  String     $zip        
     * @param  String     $ctry       
     * @return Boolean                returns TRUE if success
     */
    function create_address($acc_id, $tag, $bldg, $street, $brgy, $city, $prov, $zip, $ctry) {

        //Unsets current address from an account
        if ($tag == 2) {
            $this->update_currentAddr($acc_id, NULL);
        }

          $data = array(
            'borrower_id'=> $acc_id,
            'type'       => $tag,
            'building'   => $bldg,
            'street'     => $street,
            'barangay'   => $brgy,
            'city'       => $city,
            'province'   => $prov,
            'zip'        => $zip,
            'country'    => $ctry
            );

         $this->db->insert('borrowers_address', $data);

         return $this->db->insert_id(); //returns the inserted id

    }


    /**
     * Updates a Borrower's Address Record
     * @param  int        $acc_id     
     * @param  String     $tag        
     * @param  String     $bldg       
     * @param  String     $street     
     * @param  String     $brgy       
     * @param  String     $city       
     * @param  String     $prov       
     * @param  String     $zip        
     * @param  String     $ctry       
     * @return Boolean                returns TRUE if success
     */
    function update_address($id, $acc_id, $tag, $bldg, $street, $brgy, $city, $prov, $zip, $ctry) {

        //Unsets current address from an account
        if ($tag == 2) {
            $this->update_currentAddr($acc_id, NULL);
        }

          $data = array(
            'type'       => $tag,
            'building'   => $bldg,
            'street'     => $street,
            'barangay'   => $brgy,
            'city'       => $city,
            'province'   => $prov,
            'zip'        => $zip,
            'country'    => $ctry
            );

         $this->db->where('id', $id);
         $this->db->update('borrowers_address', $data);

         return $id; //returns the inserted id

    }

    /**
     * Unsets the existing Current Address and sets a new current address
     * @return [type] [description]
     */
    function update_currentAddr($acc_id, $addr_id) {

        //unset existing current address
        $this->db->update('borrowers_address', array('type' => 3), array('borrower_id'=>$acc_id, 'type' => 2));

        if (!is_null($addr_id)) {
            //sets an address to current address
            $this->db->update('borrowers_address', array('type' => 2), array('id'=>$addr_id));
        } 

        return $addr_id;
        
    }


    function fetch_addresses($acc_id, $type = NULL) {
        $this->db->select('
            borrowers_address.id,
            borrowers_address.building,
            borrowers_address.street,
            borrowers_address.barangay,
            borrowers_address.city,
            borrowers_address.province,
            borrowers_address.zip,
            borrowers_address.country,
            borrowers_address.type,
            CONCAT(borrowers_address.building, ", ", borrowers_address.street, ", ", 
                        borrowers_address.barangay, ", ", borrowers_address.city, ", ", 
                        borrowers_address.province, ", ", borrowers_address.zip, ", ", borrowers_address.country) as address,
        ');


        if (!is_null($type)) {
            $this->db->where('borrowers_address.type', $type);
        } else {
            $this->db->where('borrowers_address.type !=', 0);            
        }
        

        $this->db->where('borrowers_address.borrower_id', $acc_id);
        $query = $this->db->get('borrowers_address');
        return $query->result_array();
    }


    /**
     * Returns the address row details;
     * if $id set to NULL, $acc_id must not be null
     * with NULL $id, and definite $acc_id, returns Current Address Record
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function view_address($id, $acc_id = null) {

        $this->db->select('
        id,
        borrower_id,
        type,
        building,
        street,
        barangay,
        city,
        province
        zip,
        country,
        CONCAT(building, ", ", street, ", ", barangay, ", ", city, ", ", province, ", ", zip, ", ",country) as address
        ');
        if(is_null($id)) {
            //returns Current Address
            $this->db->where('borrower_id', $acc_id);
            $this->db->where('type', 2);
        } else {
            $this->db->where('id', $id);
        }

        return $this->db->get('borrowers_address')->row_array();
    }




    /**
     * -------------------------------------------------------------------------------
     * Spouse
     * -------------------------------------------------------------------------------
     * 
     */


    function create_spouse($acc_id) {

        $data = array(
            'borrower_id'   => $acc_id,  
            'fname'         => strip_tags($this->input->post('spouse_fname')),  
            'lname'         => strip_tags($this->input->post('spouse_lname')),  
            'mname'         => strip_tags($this->input->post('spouse_mname')),  
            'bdate'         => dateform(strip_tags($this->input->post('spouse_bdate'))),
            'bplace'        => strip_tags($this->input->post('spouse_bplace')),
            'contact'       => strip_tags($this->input->post('spouse_contact')),
            'occupation'    => strip_tags($this->input->post('spouse_occupation')),
            'work_address'  => strip_tags($this->input->post('spouse_occuaddr')),
        );

        $this->db->insert('borrowers_spouse', $data);
        $spouse = $this->db->insert_id(); //get Spouse ID

        return $this->db->update('borrowers', array('spouse' => $spouse), array('id'=>$acc_id)); //updates the spouse record of the account row
    }


    function update_spouse($id) {

        $data = array(
            'fname'         => strip_tags($this->input->post('spouse_fname')),  
            'lname'         => strip_tags($this->input->post('spouse_lname')),  
            'mname'         => strip_tags($this->input->post('spouse_mname')),  
            'bdate'         => dateform(strip_tags($this->input->post('spouse_bdate'))),
            'bplace'        => strip_tags($this->input->post('spouse_bplace')),
            'contact'       => strip_tags($this->input->post('spouse_contact')),
            'occupation'    => strip_tags($this->input->post('spouse_occupation')),
            'work_address'  => strip_tags($this->input->post('spouse_occuaddr')),
        );


            $this->db->where('id', $id);
            return $this->db->update('borrowers_spouse', $data);
    }




    /**
     * -------------------------------------------------------------------------------
     * Contact and Emails
     * -------------------------------------------------------------------------------
     * 
     */
    
    function view_contact($id) {
        $this->db->where('id', $id);
        return $this->db->get('borrowers_contacts')->row_array();
    }

    function delete_contact($id) {
        $this->db->where('id', $id);
        return $this->db->delete('borrowers_contacts');
    }

    function update_contact($id) {
        $data = array(
            'value'   => strip_tags($this->input->post('value'))
            );

         $this->db->where('id', $id);
         return $this->db->update('borrowers_contacts', $data);
    }

    function create_contact($acc_id, $type, $value) {
        $data = array(
            'borrower_id' => $acc_id,
            'type'        => $type,
            'value'   => $value
            );

         return $this->db->insert('borrowers_contacts', $data);
    }

    function fetch_contacts($acc_id, $type) {
        $this->db->where('type', $type);
        $this->db->where('borrower_id', $acc_id);
        $query = $this->db->get('borrowers_contacts');

        return $query->result_array();
    }



    /**
     * -------------------------------------------------------------------------------
     * Educational Attainment
     * -------------------------------------------------------------------------------
     * 
     */


    function create_educ($acc_id) {

        $data = array(
            'borrower_id' => $acc_id,  
            'level'       => strip_tags($this->input->post('educ_level')),  
            'school'      => strip_tags($this->input->post('educ_school')),  
            'course'      => strip_tags($this->input->post('educ_course')),  
            'year'        => strip_tags($this->input->post('educ_year'))
        );

        $this->db->insert('borrowers_educ', $data);
        $educ = $this->db->insert_id();

        return $this->db->update('borrowers', array('education' => $educ), array('id'=>$acc_id));
    }


    function update_educ($acc_id) {

        $data = array(
            'level'       => strip_tags($this->input->post('educ_level')),  
            'school'      => strip_tags($this->input->post('educ_school')),  
            'course'      => strip_tags($this->input->post('educ_course')),  
            'year'        => strip_tags($this->input->post('educ_year'))
        );

        $this->db->where('id', $this->view($acc_id)['educ_id']);
        return $this->db->update('borrowers_educ', $data);

    }



    /**
     * -------------------------------------------------------------------------------
     * WORK AND BUSINESS
     * -------------------------------------------------------------------------------
     * 
     */
    
    function fetch_works($acc_id, $type) {

        $this->db->select('
            id,
            type,
            employer_business,
            position_nature,
            address,
            date_started,
            date_ended,
            YEAR(date_started) as year_started,
            YEAR(date_ended) as year_ended,
            tel_no,
            status,
            remarks
        ');
        
        if(is_null($type)) {
            $this->db->where('type', $type);
        } else {
            $this->db->where('type !=', NULL);
        }

        $this->db->where('borrower_id', $acc_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('borrowers_work');

        return $query->result_array();
    }
    
    function view_work($id) {

        $this->db->where('id', $id);
        $query = $this->db->get('borrowers_work');

        return $query->row_array();
    }

    function create_work($acc_id, $type, $employer, $position, $address, $date_start, $contact, $status, $remarks) {

        $data = array(
            'borrower_id'       => $acc_id,
            'type'              => $type,
            'employer_business' => $employer,
            'position_nature'   => $position,
            'address'           => $address,
            'date_started'      => $date_start,
            'tel_no'            => $contact,
            'status'            => $status,
            'remarks'           => $remarks
            );

         $this->db->insert('borrowers_work', $data);

         return $this->db->insert_id(); //returns the inserted id

    }

    function update_work($id, $type, $employer, $position, $address, $date_start, $contact, $status, $remarks, $date_end) {

        $data = array(
            'type'              => $type,
            'employer_business' => $employer,
            'position_nature'   => $position,
            'address'           => $address,
            'date_started'      => $date_start,
            'date_ended'        => $date_end,
            'tel_no'            => $contact,
            'status'            => $status,
            'remarks'           => $remarks
            );

         $this->db->where('borrowers_work.id', $id);
         $this->db->update('borrowers_work', $data);

         return $id; //returns the updated id

    }


    function delete_work($id) {
        return $this->db->delete('borrowers_work', array('id' => $id));
    }



    /**
     * -----------------------------------------------------------------------------------------------------------------------
     */
    

    /**
     * Fetches the Gallery Images of an Item
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    function fetch_gallery($item_id) {
             $this->db->select('*');        
             $this->db->where('item_id', $item_id);              

             $query = $this->db->get('item_gallery');

             return $query->result_array();
    }

    /**
     * Uploads a Gallery Image of an Item
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    function upload_gallery($item_id) {

        //Process Image Upload
        if($_FILES['img']['name'] != NULL)  {       


                $path = checkDir('./uploads/items/'.$item_id.'/gallery/'); //the path to upload

                $upl_config['upload_path'] = $path;
                $upl_config['allowed_types'] = 'gif|jpg|png'; 
                $upl_config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $upl_config);
                $this->upload->initialize($upl_config);         
                
                $field_name = "img";
                $this->upload->do_upload($field_name);

                $upload_data = $this->upload->data();

                $filepath = $path . $upload_data['file_name']; //overwrite variable

                $data = array(              
                'item_id' => $item_id,  
                'img'     => $filepath  
             );

            // Set Watermark ////////////////////////////////////////////////////
            $wm_config['quality'] = '100%';
            $wm_config['wm_text'] = 'Copyright '.APP_NAME.' '.date('Y');
            $wm_config['wm_type'] = 'text';
            $wm_config['wm_font_path'] = './system/fonts/arial.ttf';
            $wm_config['wm_font_size'] = '16';
            $wm_config['wm_font_color'] = 'ffffff';
            $wm_config['wm_vrt_alignment'] = 'bottom';
            $wm_config['wm_hor_alignment'] = 'left';
            $wm_config['source_image'] = $filepath; 
            /////////////////////////////////////////////////////////////////////

            $this->image_lib->initialize($wm_config);            
            $this->image_lib->watermark();

            return $this->db->insert('item_gallery', $data);   
            
        }
        return false; 

    }

    /**
     * Returns the row array of the Gallery item
     * @param  int    $id   Gallery Item ID
     * @return [type]     [description]
     */
    function view_gallery($id) {
             $this->db->select('*');        
             $this->db->where('id', $id);              

             $query = $this->db->get('item_gallery');

             return $query->row_array();
    }

    /**
     * Deletes the file and row data of the Gallery Item
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function delete_gallery($id) {
            
            $file = $this->view_gallery($id);
            //check if picture exist
            if(filexist($file['img'])) {
              unlink($file['img']);
            }

            return $this->db->delete('item_gallery', array('id' => $id));
    }

}