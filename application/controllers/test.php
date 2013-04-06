<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('nutrients_model');
		$this->load->model('recipes_model');
	}

	public function ingredients() {
		$param = json_decode($this->input->get('filter'), TRUE);

		foreach($param['nutrients'] as $nutrient)
			print_r($this->recipes_model->ingredientsFromNutrient($nutrient));
	}

}

/* End of file test.php */
/* Location: ./application/controllers/test.php */