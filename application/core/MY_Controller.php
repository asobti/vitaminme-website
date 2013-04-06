<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// require APPPATH.'/libraries/REST_Controller.php';

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->result = array(
			'code' => '200',
			'content-type' => 'application/json',
			'content' => array()
		);
	}

	public function is_get() {
		return $this->request_method() === 'GET';
	}

	public function request_method() {
		return $_SERVER['REQUEST_METHOD'];
	}

	public function invalidMethod() {
		$this->result['code'] = 405;
		$this->result['content']['error'] = $this->request_method() . ' not allowed';
	}

	public function dispatchOutput() {
		if (empty($this->result['content'])) {			
			$this->result['code'] = 404;			
		}

		$this->output->set_status_header($this->result['code']);
		$this->output->set_content_type($this->result['content-type']);
		$this->output->set_output(json_encode($this->result['content']));
	}
}

/* End of file mY_Controller.php */
/* Location: ./application/controllers/mY_Controller.php */