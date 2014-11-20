<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_Model extends CI_Model {

    function Common_Model() {

        parent::__construct();
    }

    // Sending email
    public function sendEmail($from, $fromName, $to, $cc, $bcc, $message, $subject, $attach = array()) {
        $this->load->library('email');
        //$config['protocol'] = 'sendmail';
      //  $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'sunmeet@1121group.com';
        $config['smtp_pass'] = 'sunmeet12';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";

        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);
        $this->email->from($from, $fromName);
        $this->email->to($to);
        if (!empty($cc)) {
            $this->email->cc($cc);
        }
        if (!empty($bcc)) {
            $this->email->bcc($bcc);
        }

        $this->email->subject($subject);
        $this->email->message($message);
        if (!empty($attach)) {
            foreach ($attach as $attachment) {
                $this->email->attach($attachment);
            }
        }
        if (!$this->email->send()) {
            return false;
        } else {
            return true;
        }
    }

    //Uploading Images
    public function uploadImages($imageArr, $uploadPath, $filename, $maxSize = "200", $maxWidth = "", $maxHeight = "") {
        //$imageArr as 
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = $maxSize;
        if (!empty($maxWidth)) {
            $config['max_width'] = $maxWidth;
        }
        if (!empty($maxHeight)) {
            $config['max_height'] = $maxHeight;
        }
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($filename)) {
            $error = array('error' => $this->upload->display_errors());
            //log_message('error', 'Uploading Problem ' . $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    function resizingImage($filename, $uploadPath, $width = "", $height = "", $newPath = "", $createThumb = true, $maintainRatio = true) {
        //foreach ($imageArr as $filename) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $uploadPath . $filename;
        $config['new_image'] = $newPath;
        //$config['create_thumb'] = $createThumb;
        $config['maintain_ratio'] = $maintainRatio;
        if (!empty($width)) {
            $config['width'] = $width;
        }
        if (!empty($height)) {
            $config['height'] = $height;
        }
        $this->image_lib->initialize($config);
        try {
            $this->image_lib->resize();
            $this->image_lib->clear();

            //return $newPath;
        } catch (Exception $e) {
            log_message('error', 'Resizing Problem ' . $this->image_lib->display_errors());
        }
        //}
    }

    //Retrieve Data from Table 
    function getCommonTable($dataArr = array(), $tablename) {
        $result = $this->db->get_where($tablename, $dataArr);
        return $result->result_array();
    }

    //Delete Data from Table 
    function deleteCommonTable($dataArr = array(), $tablename) {
        $this->db->delete($tablename, $dataArr);
        return true;
    }

    // Save Common Table
    function saveCommonTable($dataArr = array(), $sn, $tablename) {
        if ($sn == 0) {            // A record does not exist, insert one.            	
            $dataArr['sn'] = $sn;
            $this->db->set($dataArr, FALSE);
            $query = $this->db->insert($tablename);
        } else {
            // A record does exist, update it.            
            $query = $this->db->update($tablename, $dataArr, array('sn' => $sn));
        }        // Check to see if the query actually performed correctly        
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    // Save Common Table
    function insertCommonTableGetSN($dataArr = array(), $sn, $tablename) {
        if ($sn == 0) {            // A record does not exist, insert one.            	
            $dataArr['sn'] = $sn;
            $this->db->set($dataArr, FALSE);
            $this->db->insert($tablename);
            return $this->db->insert_id();
        }
        return 0;
    }

    
    function enquiryHistory($userSN, $userAgentSN,$listingSN)
    {
       $sql = "SELECT * FROM `mo_userenquiry` where  (userSN = ".$userSN.
                    " and  userAgentSN = ". $this->session->userdata('logged_website_user_id').
                    " and  userListingSN = ". $listingSN.
                                          "  ) or ( userSN = ".$this->session->userdata('logged_website_user_id').
                    " and  userAgentSN = ".$userSN.
                    " and  userListingSN = ". $listingSN.
                    " ) order by dateCreated " ;
            $enquireArr = $this->db->query($sql)->result_array();
             return $enquireArr;

                        //4  end of try to use model not use controller directlly               

            
        
        
    }
}
