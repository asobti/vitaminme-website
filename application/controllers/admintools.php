<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admintools extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('metadata_model');
	}

	public function index()	{
		echo 'Welcome to VitaminME admin tools';
		echo PHP_EOL;
	}

	public function update($val) {
		$val = strtoupper($val);

		switch($val) {
			case 'INGREDIENTS' :
			case 'INGREDIENT'  :
				$this->updateIngredients();
				break;
			default :
				echo 'Unrecognized argument' . PHP_EOL;
		}
	}

	private function updateIngredients() {
		try {
			$ingredients = $this->metadata_model->fetchIngredients();
			$count = count($ingredients);

			$this->metadata_model->truncate('ingredients');
			$this->metadata_model->insert($ingredients, 'ingredients');

			echo "Ingredients updated. Found {$count} entries." . PHP_EOL;
		} catch (Exception $e) {
			echo 'Failed updating ingredients';
			echo $e;
		}
	}
}

/* End of file admintools.php */
/* Location: ./application/controllers/admintools.php */