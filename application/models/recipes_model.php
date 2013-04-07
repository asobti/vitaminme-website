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
		$recipes = array();
		$totalCount = 0;

		if (isset($params['filter']['nutrients'])) {			
			$nutrient = $params['filter']['nutrients'][0];
			$ingredients = $this->ingredientsFromNutrient($nutrient['id']);
			foreach($ingredients as $in) {
				$ing_terms = explode(',', $in->desc);
				$query_terms[] = trim($ing_terms[0]);
			}			
		}
		
		$this->payload['requirePictures'] = 'true';
		$this->payload['start'] = $params['start'];
		$this->payload['maxResult'] = floor((int)$params['count'] / count($query_terms));
		
		foreach($query_terms as $q) {
			$this->payload['q'] = $q;
			$url = $this->yummly_api_root . 'recipes' . '?' . http_build_query($this->payload);
		
			$resp = $this->curl->simple_get($url);
		
			if ($this->curl->info['http_code'] === 200) {
				$api_response = json_decode($resp);
				$recipes = array_merge($recipes, $api_response->matches);
				$totalCount += (int)$api_response->totalMatchCount;				
			} 
		}

		shuffle($recipes);

		return array(
			'objects' => $recipes,
			'total_pages' => ceil($totalCount / (int)$params['count']),
			'num_results' => $totalCount,
			'pages_results' => count($recipes)
		);
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