<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nutrients extends MY_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->load->model('nutrients_model');
	}

	public function index($id = NULL)	{

		if ($this->is_get()) {
			if ($id === NULL) {
				$this->getAll();
			} else {
				$this->byId($id);
			}
		} else {
			$this->invalidMethod();
		}

		$this->dispatchOutput();
	}

	public function getAll() {
		$this->result['content'] = $this->nutrients_model->getAll();		
	}

	public function byId($id) {
		$this->result['content'] = $this->nutrients_model->getById($id);
	}

}

/* End of file nutrients.php */
/* Location: ./application/controllers/nutrients.php */