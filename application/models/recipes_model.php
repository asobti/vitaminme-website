<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipes_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->config('yummly');
		$this->yummly_api_root = $this->config->item('yummly_api_root');
		$this->yummly_api_id = $this->config->item('yummly_app_id');
		$this->yummly_api_key = $this->config->item('yummly_app_key');

		$this->load->library('curl');

		$this->payload = array(
			'_app_id' => $this->yummly_api_id,
			'_app_key' => $this->yummly_api_key
		);
	}

	public function getByFilter($params) {
		$query_terms = array();

		if (isset($params['filter']['ingredients'])) {
			foreach($params['filter']['ingredients'] as $ingredient) {
				$query_terms[] = $ingredient;
			}
		}
		
		if (isset($params['filter']['nutrients'])) {
			foreach($params['filter']['nutrients'] as $nutrient) {
				$query_terms[] = $this->ingredientsFromNutrient($nutrient);
			}
		}

		$this->payload['q'] = implode(' ', $query_terms);
		$this->payload['requirePictures'] = 'true';
		
		$url = $this->yummly_api_root . 'recipes' . '?' . http_build_query($this->payload);

		$resp = $this->curl->simple_get($url);
		
		if ($this->curl->info['http_code'] === 200) {
			return json_decode($resp, TRUE);
		} else {
			return array();
		}
	}

	public function getById($id, $params) {		

		$url = $this->yummly_api_root . 'recipe/' . $id . '?' . http_build_query($this->payload);		
		
		$resp = $this->curl->simple_get($url);
		
		if ($this->curl->info['http_code'] === 200) {
			return json_decode($resp, TRUE);
		} else {
			return array();
		}
	}

	private function ingredientsFromNutrient($nutrient) {
		// implement
		return;
	}

}

/* End of file recipes_model.php */
/* Location: ./application/models/recipes_model.php */