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

		$this->ing_per_nut = (int)$this->config->item('ingredients_per_nutrient');
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
				$ingredients = $this->ingredientsFromNutrient($nutrient['id']);
				$query_terms[] = $ingredients[0]->desc;
			}
		}

		$this->payload['q'] = implode(' ', $query_terms);
		$this->payload['requirePictures'] = 'true';
		$this->payload['start'] = $params['start'];
		$this->payload['maxResult'] = $params['count'];
		
		$url = $this->yummly_api_root . 'recipes' . '?' . http_build_query($this->payload);
		
		$resp = $this->curl->simple_get($url);
		
		if ($this->curl->info['http_code'] === 200) {
			$api_response = json_decode($resp);
			return array(
				'objects' => $api_response->matches,
				'total_pages' => ceil($api_response->totalMatchCount / $params['count']),
				'num_results' => $api_response->totalMatchCount,
				'page_results' => count($api_response->matches)
			);
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

	public function ingredientsFromNutrient($nutrient) {

		$query = $this->db
					  ->select('f.foodcode, f.desc, fnv.nutval')
					  ->from('mainfooddesc as f')
					  ->join('fnddsnutval as fnv', 'f.foodcode = fnv.foodcode')
					  ->join('nutdesc as n', 'fnv.nutrientcode = n.id')
					  ->where('n.id', $nutrient)
					  ->order_by('fnv.nutval', 'DESC')
					  ->limit($this->ing_per_nut, 0)
					  ->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

}

/* End of file recipes_model.php */
/* Location: ./application/models/recipes_model.php */