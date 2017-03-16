<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->view('test/available-tests.php');
	}

	public function instructions($category_slug = null)
	{
		if(!$category_slug || $category_slug ==""){
			redirect('test');
		}

		$no_of_ques = $this->input->get('no_of_ques');
		$time = $this->input->get('time');
		
		// TODO: Validate the input beofre processing;
		
		$this->load->model('Model_test');

		// To create a test, ranodomly select the desired no of quetions and give the alloted time!
		// After that return all the questions only to the user.
		$data = array(
			'time' => $time, 
			'no_of_ques' => $no_of_ques, 
			'category_slug' => $category_slug 
			);
		// Test interface will be single page and without reloads! page will only reload if the user has completed the test!
		$this->load->view('test/instructions', $data);
	}

	public function start($category_slug = "")
	{
		// TODO prevent starting if not logged in
		
		if(!$category_slug || $category_slug ==""){
			redirect('test');
		}

		$no_of_ques = $this->input->get('no_of_ques');
		$time = $this->input->get('time');
		
		$this->load->model('Model_test');

		$data = $this->Model_test->createTest($category_slug, $time, $no_of_ques);
		
		$this->load->view('test/start-test.php', $data);
	}


}
