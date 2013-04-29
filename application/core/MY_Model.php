<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function execQuery($tbl, $params) {
		$this->db->limit($params['count'], $params['start'])
				->where($params['filter']['where']);

		foreach($this->params['filter']['like'] as $k=>$v) {
			$this->db->like($k, $v);
		}				

		$query = $this->db->get($tbl);

		$this->db->select('count(*) as count')
				->limit($params['count'], $params['start'])
				->where($params['filter']['where']);

		foreach($this->params['filter']['like'] as $k=>$v) {
			$this->db->like($k, $v);
		}	

		$num_rows = $this->db->get($tbl)
							->row()
							->count;

		return array(
			'objects' => $query->result(),
			'total_pages' => ceil($num_rows / $params['count']),
			'num_results' => $num_rows,
			'page_results' => $query->num_rows()
		);
	}

}

/* End of file mY_Model.php */
/* Location: ./application/models/mY_Model.php */