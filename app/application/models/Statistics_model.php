<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_model extends CI_Model {


    //Loads the database using the ../config/database.php file
    public function __construct()	{
        $this->load->database();
    }

    public function sumTimeByCause()
    {

        $query = $this->db->query("SELECT organisation, SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(finish,start) ) ) ) AS timeSum  FROM times JOIN causes WHERE times.causeID=causes.causeID AND status='confirmed' GROUP BY causes.organisation ORDER BY timeSum DESC ");

        return $query->result_array();

    }

    public function volunteeringTimebyDepartment()
    {

        $query = $this->db->query("SELECT departmentsName, SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(finish,start) ) ) ) AS timeSum FROM times join users ON times.cisID=users.cisID join departments ON users.departmentID=departments.ID WHERE status='confirmed' group by departmentsName ORDER BY timeSum DESC");

        return $query->result_array();

    }

    public function volunteeringTimePersonal($CISID)

    {
        $query = $this->db->query("SELECT cisID, SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(finish,start) ) ) ) AS timeSum FROM times WHERE cisID=" . $CISID ." AND status='confirmed' ");

        $data= $query->result_array();

        return (string) $data[0]['timeSum'];

    }

    public function totalHoursVolunteered()
    {
        $query = $this->db->query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(finish,start) ) ) ) AS timeSum FROM times WHERE status='confirmed' ");
        $data= $query->row_array();

        return (string) $data['timeSum'];
    }

    public function totalVolunteers()
    {
        $query = $this->db->query("SELECT count(*) FROM users");
        $data= $query->row_array();

        return (string) $data['count(*)'];

    }

    public function getFavouriteCause($cisID)
    {
        $query = $this->db->query("SELECT cisID, organisation, SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(finish,start) ) ) ) AS timeSum  FROM times JOIN causes WHERE times.causeID=causes.causeID AND status='confirmed' AND ". $cisID . "=times.cisID  GROUP BY causes.organisation order by timeSum desc limit 1");

        $data= $query->row_array();

        return (string) $data['organisation'];
    }

    public function positionWithinDepartment($cisID)
    {

        $this->load->model('User_model');

        $department=$this->User_model->getDepartment($cisID);

        $query = $this->db->query("SELECT users.cisID,departmentsName, SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(finish,start) ) ) ) AS timeSum FROM times join users ON times.cisID=users.cisID join departments ON users.departmentID=departments.ID WHERE times.status='confirmed' AND departmentsName=\"" .$department."\" group by cisID,departmentsName ORDER BY timeSum DESC");

        $data= $query->result_array();

        $total = sizeof($data)+1;


        $i = 1;

        foreach ($data as $arr)
        {
            if ($arr['cisID']==$cisID){
                print("You are ". $i . " out of " . $total);
            }

            $i+=1;

        }

        $return = array($i,$total);

        return $return;
    }
}
