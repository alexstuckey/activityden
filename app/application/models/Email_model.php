<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {


    //Loads the database using the ../config/database.php file
    public function __construct()	{
        $this->load->database();
    }

    //Queries database with SQL query where the argument $CISID = cisID database column.
    //The results are stored in an array which can be accessed with $query[n]['column name']
    //Where n is the position in the array.

    public function getAllEmailTemplates()
    {
        $query = $this->db->get('emailTemplates');

        return $query->result_array();
    }

    public function updateEmailTemplate($emailName, $emailSubject, $emailContent)
    {
        $this->db->where('emailName', $emailName);
        $this->db->set('emailSubject', $emailSubject);
        $this->db->set('emailContent', $emailContent);
        $this->db->update('emailTemplates');
    }

    public function getEmailByName($emailName)
    {
        $this->db->where('emailName', $emailName);
        $query = $this->db->get('emailTemplates');

        return $query->row_array();
    }


}