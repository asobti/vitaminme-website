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
			case 'ALLERGIES' :
			case 'ALLERGY' :
				$this->updateAllergies();
				break;
			case 'DIETS' :
			case 'DIET' :
				$this->updateDiets();
				break;
			case 'COURSES' :
			case 'COURSE' :
				$this->updateCourses();
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

	private function updateAllergies() {
		try {
			$allergies = $this->metadata_model->fetchAllergies();
			$count = count($allergies);

			$this->metadata_model->truncate('allergies');
			$this->metadata_model->insert($allergies, 'allergies');

			echo "Allergies updated. Found {$count} entries." . PHP_EOL;
		} catch (Exception $e) {
			echo 'Failed updating allergies' . PHP_EOL;
			echo $e;
		}
	}

	private function updateDiets() {
		try {
			$diets = $this->metadata_model->fetchDiets();
			$count = count($diets);

			$this->metadata_model->truncate('diets');
			$this->metadata_model->insert($diets, 'diets');

			echo "Diets updated. Found {$count} entries." . PHP_EOL;
		} catch (Exception $e) {
			echo 'Failed updating diets' . PHP_EOL;
			echo $e;
		}
	}

	private function updateCourses() {
		try {
			$courses = $this->metadata_model->fetchCourses();
			$count = count($courses);

			$this->metadata_model->truncate('courses');
			$this->metadata_model->insert($courses, 'courses');

			echo "Courses updated. Found {$count} entries." . PHP_EOL;
		} catch (Exception $e) {
			echo 'Failed updating courses' . PHP_EOL;
			echo $e;
		}
	}
}

/* End of file admintools.php */
/* Location: ./application/controllers/admintools.php */