<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metadata_model extends MY_Model {

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

	public function getAll($tbl, $params) {
		return $this->execQuery($tbl, $params);
	}

	public function getById($tbl, $id) {
		$where = array(
			'id' => $id
		);

		return $this->db->get_where($tbl, $where)->row();
	}

	public function truncate($tbl) {
		$this->db->empty_table($tbl);
	}

	public function insert($data, $tbl) {
		$this->db->insert_batch($tbl, $data);
	}

	public function fetchIngredients() {
		$url = $this->yummly_api_root . 'metadata/ingredient'
				. '?'
				. http_build_query($this->payload);

		return $this->fetch($url);
	}

	public function fetchAllergies() {
		$url = $this->yummly_api_root . 'metadata/allergy'
				. '?'
				. http_build_query($this->payload);

		return $this->fetch($url);	
	}

	public function fetchDiets() {
		$url = $this->yummly_api_root . 'metadata/diet'
				. '?'
				. http_build_query($this->payload);

		return $this->fetch($url);	
	}

	public function fetchCourses() {
		$url = $this->yummly_api_root . 'metadata/course'
				. '?'
				. http_build_query($this->payload);

		return $this->fetch($url);
	}

	private function fetch($url) {
		$resp = $this->curl->simple_get($url);

		if ($this->curl->info['http_code'] === 200) {
			// parse out the json data from the response
			$matches = array();
			$pattern = '/\[[^\]]+\]/';

			preg_match($pattern, $resp, $matches);
			$json = $matches[0];
			return json_decode($json, true);
		} else {
			$message = 'Fetching failed with HTTP status code: ' . $this->curl->info['http_code'];
			throw new Exception($message);
		}
	}

}

/* End of file metadata_model.php */
/* Location: ./application/models/metadata_model.php */