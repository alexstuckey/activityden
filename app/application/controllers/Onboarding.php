<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onboarding extends CI_Controller {

    public function welcome()
    {
        $this->load->model('User_model');
        if (!$this->User_model->doesUserExist($_SERVER['REMOTE_USER'])) {
            // First access by user, normally redirect, but already there.
            // redirect
        }

        $this->Audit_model->insertLog('ACCESS', 'Accessing Welcome Page');

        $data['user'] = $this->User_model->getUserByCIS($_SERVER['REMOTE_USER']);

        $this->load->view('onboarding_1_welcome', $data);

        $this->User_model->setOnboardingStatus($_SERVER['REMOTE_USER'], 1);
    }

    public function step_details()
    {
        $this->load->model('User_model');
        if (!$this->User_model->doesUserExist($_SERVER['REMOTE_USER'])) {
            // First access by user, normally redirect, but already there.
            $this->Audit_model->insertLog('ACCESS DENIED', 'Onboarding: Accessing Page Denied');
            $this->Audit_model->insertLog('REDIRECT', 'Onboarding: Redirect to Welcome Page');

            $this->load->helper('url');
            redirect('/onboard/welcome');
        }

        $data['user'] = $this->User_model->getUserByCIS($_SERVER['REMOTE_USER']);

        $data['active'] = 'enter_details';
        
        $this->load->view('onboarding_steps', $data);


        $this->User_model->setOnboardingStatus($_SERVER['REMOTE_USER'], 2);

        $this->Audit_model->insertLog('ALTER', 'Onboarding: status updated');
    }

    public function enter_details_form()
    {
        $this->load->model('User_model');
        if (!$this->User_model->doesUserExist($_SERVER['REMOTE_USER'])) {
            // First access by user, normally redirect, but already there.
            $this->load->helper('url');
            redirect('/onboard/welcome');
        }

        $data['user'] = $this->User_model->getUserByCIS($_SERVER['REMOTE_USER']);

        $this->load->model('Departments_model');
        $data['departments'] = $this->Departments_model->getDepartmentsListWithCount();

        $this->load->helper('form');

        $this->load->view('onboarding_3_enter_details_form', $data);


        $this->User_model->setOnboardingStatus($_SERVER['REMOTE_USER'], 3);

        $this->Audit_model->insertLog('ALTER', 'Onboarding: status updated');
    }

    public function send_details()
    {
        $this->load->model('User_model');
        if (!$this->User_model->doesUserExist($_SERVER['REMOTE_USER'])) {
            // First access by user, normally redirect, but already there.
            $this->load->helper('url');
            redirect('/onboard/welcome');
        }

        $data['user'] = $this->User_model->getUserByCIS($_SERVER['REMOTE_USER']);

        // Form logic
        // Validate
        $this->load->library('form_validation');

        $this->form_validation->set_rules('inputFirstName', 'First Name', 'required');
        $this->form_validation->set_rules('inputLastName', 'Last Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('onboarding_3_enter_details_form', $data);
        } else {

            $this->Audit_model->insertLog('ALTER', 'Details updated');

            $data['active'] = 'nominate_manager';
            $this->load->view('onboarding_steps', $data);

            $userChanges = array(
                'firstName' => $this->input->post('inputFirstName'),
                'secondName' => $this->input->post('inputLastName')
            );

            $this->User_model->updateUser($_SERVER['REMOTE_USER'], $userChanges);

            $this->User_model->setOnboardingStatus($_SERVER['REMOTE_USER'], 4);
        }
        
    }

    public function enter_nominate_manager_form()
    {
        $this->load->model('User_model');
        if (!$this->User_model->doesUserExist($_SERVER['REMOTE_USER'])) {
            // First access by user, normally redirect, but already there.
            $this->load->helper('url');
            redirect('/onboard/welcome');
        }

        $data['user'] = $this->User_model->getUserByCIS($_SERVER['REMOTE_USER']);

        $this->load->helper('form');

        $this->load->view('onboarding_5_nominate_manager_form', $data);

        $this->User_model->setOnboardingStatus($_SERVER['REMOTE_USER'], 5);
        $this->Audit_model->insertLog('ALTER', 'Onboarding: Status Updated');

    }

    public function email_check($str)
    {
        $this->load->model('User_model');
        $account = $this->User_model->getUserByEmail($str);
        if (empty($account)) {
            $this->form_validation->set_message('email_check', 'The {field} must be a valid Durham address.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function send_nominate_manager()
    {
        $this->load->model('User_model');
        if (!$this->User_model->doesUserExist($_SERVER['REMOTE_USER'])) {
            // First access by user, normally redirect, but already there.
            $this->load->helper('url');
            redirect('/onboard/welcome');
        }

        $data['user'] = $this->User_model->getUserByCIS($_SERVER['REMOTE_USER']);

        // Form logic
        // Validate
        $this->load->library('form_validation');

        $this->form_validation->set_rules('inputEmailAddress', 'Email address', 'required|strtolower|valid_email|regex_match[/^[a-zA-Z0-9.!#$%&\'*+=?^_`{|}~-]+@dur(ham)?.ac.uk$/]|callback_email_check');
        $this->form_validation->set_rules('inputComment', 'Comment');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('onboarding_5_nominate_manager_form', $data);
        } else {

            $data['active'] = 'get_started';
            $this->load->view('onboarding_steps', $data);



            $this->User_model->setManager($_SERVER['REMOTE_USER'], $data);

            $this->User_model->setOnboardingStatus($_SERVER['REMOTE_USER'], 6);
            $this->Audit_model->insertLog('ALTER', 'Onboarding: Manager Nominated');

        }

    }


}