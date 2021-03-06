<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_model extends CI_Model {

    //Loads the database using the ../config/database.php file
    public function __construct()	{
        $this->load->database();
    }

    public function getWholeAuditTrail()
    {
        $query = $this->db->get('audit');

        return $query->result_array();
    }

    public function insertLog($type, $message)
    {
        $data = array(
            'logType' => $type,
            'logMessage' => $message,
            'userResponsible' => $_SERVER['REMOTE_USER']
        );

        $this->db->insert('audit', $data);
    }

}
