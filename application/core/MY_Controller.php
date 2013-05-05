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
			unset($_GET['start']);
		}

		if ($this->input->get('count')) {
			$this->params['count'] = (int)$this->input->get('count');
			unset($_GET['count']);
		}		
	}

	public function parse_query_filters() {
		$this->params['filter'] = array(
			'where' => array(),
			'like' => array()
		);
		
		if ($this->input->get('filter')) {			
			$this->buildFilters(urldecode($this->input->get('filter')));
		}
	}

	private function buildFilters($queryString) {
		$filters = json_decode($queryString);

		$this->params['filter']['where'] = array();
		$this->params['filter']['like'] = array();

		if (is_array($filters)) {
			foreach($filters as $f) {
				if ($f->op === 'eq') {
					$this->params['filter']['where'][$f->name] = $f->val;
				} else if ($f->op === 'like') {
					$this->params['filter']['like'][$f->name] = $f->val;
				} // else just ignore
			}
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

		// cors
		$this->output->set_header('Access-Control-Allow-Origin: *');

		if (!$this->result['json_encoded']) {
			$this->output->set_output(json_encode($this->result['content']));
		} else {
			$this->output->set_output($this->result['content']);
		}
	}
}

/* End of file mY_Controller.php */
/* Location: ./application/controllers/mY_Controller.php */