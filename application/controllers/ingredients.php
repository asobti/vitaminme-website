<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingredients extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->allowed_methods = array('GET');
		$this->load->model('metadata_model');

		$this->tbl = 'ingredients';
	}

	public function index($id = null) {
		if ($this->is_method_allowed()) {
			$this->parse_query_params();

			if ($id === NULL) {
				$this->result['content'] = $this->metadata_model->getAll($this->tbl, $this->params);
			} else {
				$this->result['content'] = $this->metadata_model->getById($this->tbl, $id);
			}

		} else {
			$this->invalidMethod();
		}

		if (   is_array($this->result['content'])
			&& isset($this->result['content']['error'])) {
			$this->result['code'] = 500;
		}

		$this->dispatchOutput();
	}

}

/* End of file ingredients.php */
/* Location: ./application/controllers/ingredients.php */