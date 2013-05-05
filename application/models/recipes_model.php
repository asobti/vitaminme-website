<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipes_model extends MY_Model {

	public function __construct() {
		parent::__construct();

		$this->load->config('yummly');
		$this->yummly_api_root = $this->config->item('yummly_api_root');

		$keys = $this->config->item('yummly_keys');

		$idx = array_rand($keys);

		$this->yummly_api_id = $keys[$idx]['app_id'];
		$this->yummly_api_key = $keys[$idx]['app_key'];

		$this->load->library('curl');

		$this->payload = array(
			'_app_id' => $this->yummly_api_id,
			'_app_key' => $this->yummly_api_key
		);	
	}

	public function query($pagParams, $params) {
		$this->buildQueryPayload($pagParams, $params);
		$url = $this->yummly_api_root . 'recipes' . '?' . $this->buildQueryPayload($pagParams, $params); //http_build_query($this->payload);
		
		$resp = $this->curl->simple_get($url);

		if ($this->curl->info['http_code'] === 200) {
			$resp = json_decode($resp);
			$page_results = count($resp->matches);

			if ($page_results > 0) {
				// convert to our response format
				$formattedResponse = array(
					'objects' => $resp->matches,
					'total_pages' => ceil((int)$resp->totalMatchCount / $page_results),
					'num_results' => (int)$resp->totalMatchCount,
					'page_results' => $page_results
				);

				return $formattedResponse;
			} else {
				return array();
			}
		} else {			
			return array();
		}
	}

	public function getById($id) {		

		$url = $this->yummly_api_root . 'recipe/' . $id . '?' . http_build_query($this->payload);		
		
		$resp = $this->curl->simple_get($url);
		
		if ($this->curl->info['http_code'] === 200) {
			return json_decode($resp, TRUE);
		} else {
			return array();
		}
	}

	private function buildQueryPayload($pagParams, $params) {
		$queryString = '';
		// require pictures
		$this->payload['requirePictures'] = 'true';

		// pagination info
		$this->payload['maxResult'] = $pagParams['count'];
		$this->payload['start'] = $pagParams['start'];

		$queryString = http_build_query($this->payload);

		foreach($params as $k=>$v) {
			if (is_array($params[$k])) {
				foreach($params[$k] as $p) {
					$queryString = $queryString . "&" . $k . "[]=" . $p;
				}
			} else {
				$queryString = $queryString . "&" . $k . "=" . $v;
			}
		}

		return $queryString;
	}	
}

/* End of file recipes_model.php */
/* Location: ./application/models/recipes_model.php */