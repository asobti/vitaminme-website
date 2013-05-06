<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipes extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->allowed_methods = array('GET');
		$this->load->model('nutrients_model');
		$this->load->model('recipes_model');		
	}

	public function index($id = NULL) {
		if ($this->is_method_allowed()) {
			$this->parse_query_params();

			if ($id === NULL) {
				$this->queryRecipes();
			} else {
				$this->getById($id);
			}
		} else {
			$this->invalidMethod();
		}

		if (isset($this->result['content']['error'])) {
			$this->result['code'] = 500;
		}

		$this->dispatchOutput();
	}

	private function getById($id) {
		$this->result['content'] = $this->recipes_model->getById($id);
	}

	private function queryRecipes() {
		$otherParams = $this->input->get();

		// remove pagination info
		if (isset($otherParams['start'])) unset($otherParams['start']);
		if (isset($otherParams['count'])) unset($otherParams['count']);
		// pass all GET params				
		$this->result['content'] = $this->recipes_model->query($this->params, $otherParams);
	}

}

/* End of file recipes.php */
/* Location: ./application/controllers/recipes.php */