<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causes extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function listAll()
	{
		echo 'Hello World!';
	}

	public function create()
	{
		if ($this->input->get_request_header("Content-Type", TRUE) == "application/json") {

			// Pass the raw_input_stream through a security filter
			$cleaned_input_stream = $this->security->xss_clean($this->input->raw_input_stream);

			// Parse the sanitised string into an associative array
			$requestPayload = json_decode($cleaned_input_stream, TRUE);
			// Checking for errors in parsing
			if ($requestPayload === null
			    && json_last_error() !== JSON_ERROR_NONE) {
				$response = array('error' => "incorrect JSON input" );
				print(json_encode($response));
			}

			if (array_key_exists("name", $requestPayload)
			 && array_key_exists("contactName", $requestPayload)
			 && array_key_exists("contactEmail", $requestPayload)
			 && array_key_exists("contactPhone", $requestPayload)
			 && array_key_exists("notes", $requestPayload)
			 && array_key_exists("type", $requestPayload)
			) {
				var_dump($requestPayload);
			} else {
				$response = array('error' => "parameters incomplete" );
				print(json_encode($response));
			}

		} else {
			// Return error, incorrect Content-Type
		}

		
	}

	public function get($causeID)
	{
		echo 'Hello cause, ' . $causeID . '!';
	}
}