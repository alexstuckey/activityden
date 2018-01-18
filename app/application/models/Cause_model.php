<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cause_model extends CI_Model {

    //Loads the database using the ../config/database.php file
    public function __construct()	{
        $this->load->database();
    }

    //Returns an array of a single Cause Row
    // Where the $causeID argument matches the causeID row in the causes table
    public function getCauseByID($causeID)
    {
        $this->db->where('causeID', $causeID);

        $query = $this->db->get('causes');

        return $query->result_array();
    }

    //  Takes an array of the form
    //  $data = array(
    // 'organisation' => 'organisation,
    // 'typeID' => 'typeID',
    // 'contactName' => 'contactName',
    // 'contactEmail' => 'contactEmail',
    // 'contactPhone' => 'contactPhone',
    // 'notes' => 'notes',
    // );
    // Inserts into 'causes' table in the database.
    public function createCause($data)
    {

        $valid_flag = True;

        $typeIDExistsFlag = False;

//        $this->load->helper(array('form', 'url'));
//
//        $this->load->library('form_validation');
//
//        $this->form_validation->set_rules('cisID', 'Username', 'trim|required');
//        $this->form_validation->set_rules('start', 'StartTime', 'trim|required');
//        $this->form_validation->set_rules('finish', 'FinishTime', 'trim|required');
//        $this->form_validation->set_rules('causeID', 'CauseID', 'trim|required');
//
//        if ($this->form_validation->run() == TRUE)
//        {
//            $valid_flag=True;
//        }


        $this->db->where('typeID', $data['typeID']);

        $query = $this->db->get('causeType');

        $result = $query->result_array();


        if (sizeof($result) >= 1) {
            $typeIDExistsFlag = True;
        }

        if ($valid_flag and $typeIDExistsFlag) {
            $this->db->insert('causes', $data);
            return True;
        }
        return False;

    }

    //Returns an array of cause rows which match the typeID given in the argument
    public function getCausesByType($type)
    {
        $this->db->where('name', $type);

        $this->db->join('causes','causes.typeID=causeType.typeID');

        $query = $this->db->get('causeType');

        $result=$query->result_array();

        }

    }

    //Returns an array of cause rows for every cause in the database, this is joined with the type ID
    public function getAllCauses()
    {

        $this->db->join('causes','causes.typeID=causeType.typeID');

        $query = $this->db->get('causeType');

        $result=$query->result_array();


    }

}
