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
		$num_nutrients = count($params['filter']['nutrients']);

		if (isset($params['filter']['nutrients'])) {
			if ($num_nutrients > 1) {
				foreach($params['filter']['nutrients'] as $nutrient) {
					$qt = array();

					$ingredients = $this->ingredientsFromNutrient($nutrient['id']);
					foreach($ingredients as $in) {
						$ing_terms = explode(',', $in->desc);
						$qt[] = trim($ing_terms[0]);
					}

					$query_terms[] = $qt;
				}
			} else {
				$nutrient = $params['filter']['nutrients'][0];
				$ingredients = $this->ingredientsFromNutrient($nutrient['id']);

				foreach($ingredients as $i) {
					$ing_terms = explode(',', $i->desc);
					$query_terms[] = $ing_terms[0];
				}
			}			
		}
		
		$this->payload['requirePictures'] = 'true';
		$this->payload['start'] = $params['start'];
		$this->payload['maxResult'] = (count($query_terms) > 0)
										? floor((int)$params['count'] / count($query_terms))
										: 0;


		if ($this->payload['maxResult'] > 0) {

			if ($num_nutrients > 1)
				$query_terms = $this->array_transpose($query_terms);

			foreach($query_terms as $q) {
				$this->payload['q'] = (is_array($q)) ? implode(',',$q) : trim($q);			
				
				
				$url = $this->yummly_api_root . 'recipes' . '?' . http_build_query($this->payload);
			
				$resp = $this->curl->simple_get($url);				
			
				if ($this->curl->info['http_code'] === 200) {
					$api_response = json_decode($resp);
					$recipes = array_merge($recipes, $api_response->matches);
					$totalCount += (int)$api_response->totalMatchCount;				
				} 
			}

			if (count($recipes) === 0 && $num_nutrients > 1) {				
				// use one or the other recipe
				// for now, we'll just use the first recipe
				// unset all after 1
				$newParams['start'] = (int)$params['start'];
				$newParams['count'] = (int)$params['count'];
				
				$newParams['filter']['nutrients'][0] = $params['filter']['nutrients'][0];

				return $this->getByFilter($newParams);				
			}
			shuffle($recipes);

		}

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

	private function array_transpose($array) {
		array_unshift($array, null);
    	return call_user_func_array('array_map', $array);
	}

}

/* End of file recipes_model.php */
/* Location: ./application/models/recipes_model.php */