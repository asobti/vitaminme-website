<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipes extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->allowed_methods = array('GET');
		$this->load->model('nutrients_model');
		$this->load->model('recipes_model');		
	}

	public function index($id = NULL)	{
		if ($this->is_method_allowed()) {

			$this->parse_query_params();

			if ($id === NULL && !empty($this->params['filter'])) {
				$this->getByFilter();
			} else if ($id !== NULL) {
				$this->getById($id);
			} else {
				// bad request
				$this->result['code'] = 400;
				$this->result['content']['error'] = 'You must specify a filter';
			}

		} else {
			$this->invalidMethod();
		}

		$this->dispatchOutput();
	}

	private function getByFilter() {
		$ingredients_set = isset($this->params['filter']['ingredients']) && count($this->params['filter']['ingredients']) > 0;
		$nutrients_set = isset($this->params['filter']['nutrients']) && count($this->params['filter']['nutrients']) > 0;

		if ($ingredients_set || $nutrients_set) {
			$this->result['content'] = $this->recipes_model->getByFilter($this->params);
		} else {
			$this->result['code'] = 400;
			$this->result['content']['error'] = "Invalid filter set";
		}
	}

	private function getById($id) {
		$this->result['content'] = $this->recipes_model->getById($id, $this->params);
	}

}

/* End of file recipes.php */
/* Location: ./application/controllers/recipes.php */