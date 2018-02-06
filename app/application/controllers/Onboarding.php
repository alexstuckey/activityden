<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onboarding extends CI_Controller {

	public function welcome()
	{
		$this->load->model('user_model');

		$data['user'] = $this->user_model->getUserByCIS($_SERVER['REMOTE_USER']);

		$this->load->view('onboarding_1_welcome', $data);
	}

	public function flow()
	{
		$data['cis_username'] = 'xxxx99';
		$data['active'] = 'enter_details';
		$this->load->view('onboarding_steps', $data);
	}

	public function enter_details_form()
	{
		$data['cis_username'] = 'xxxx99';
		$this->load->view('onboarding_3_enter_details_form', $data);
	}

	public function send_details()
	{
		$data['cis_username'] = 'xxxx99';
		$data['active'] = 'nominate_manager';
		$this->load->view('onboarding_steps', $data);
	}

	public function enter_nominate_manager_form()
	{
		$data['cis_username'] = 'xxxx99';
		$this->load->view('onboarding_5_nominate_manager_form', $data);
	}

	public function send_nominate_manager()
	{
		$data['cis_username'] = 'xxxx99';
		$data['active'] = 'get_started';
		$this->load->view('onboarding_steps', $data);
	}
}
