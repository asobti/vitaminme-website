<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// require APPPATH.'/libraries/REST_Controller.php';

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->result = array(
			'code' => '200',
			'content-type' => 'application/json',
			'content' => array(),
			'json_encoded' => false
		);

		$this->params = array(
			'start' => 0,
			'count' => 20,
			'filter' => array()
		);
	}

	public function parse_query_params() {
		if ($this->input->get('start')) {
			$this->params['start'] = (int)$this->input->get('start');
		}

		if ($this->input->get('count')) {
			$this->params['count'] = (int)$this->input->get('count');
		}

		if ($this->input->get('filter')) {
			$this->params['filter'] = json_decode(urldecode($this->input->get('filter')), TRUE);
		}
	}

	public function is_method_allowed() {
		return in_array($this->request_method(), $this->allowed_methods);
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

		if (!$this->result['json_encoded']) {
			$this->output->set_output(json_encode($this->result['content']));
		} else {
			$this->output->set_output($this->result['content']);
		}
	}
}

/* End of file mY_Controller.php */
/* Location: ./application/controllers/mY_Controller.php */