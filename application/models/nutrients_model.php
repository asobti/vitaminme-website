<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nutrients_model extends CI_Model {

	public function getAll($params) {		
		$resultset = $this->db->limit($params['count'], $params['start'])->where($params['filter'])->get('nutdesc');
		$num_rows = $this->db->select('count(*) as count')->where($params['filter'])->get('nutdesc')->row()->count;

		return array(
			'objects' => $resultset->result(),
			'total_pages' => ceil($num_rows / $params['count']),
			'num_results' => $num_rows
		);
	}

	public function getById($id, $params) {
		$where = array(
			'id' => $id
		);

		return $this->db->get_where('nutdesc', $where)->row();
	}
}

/* End of file nutrients_model.php */
/* Location: ./application/models/nutrients_model.php */