<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nutrients_model extends MY_Model {

	public function getAll($params) {		
		return $this->execQuery('nutrients', $params);
	}

	public function getById($id, $params) {
		$where = array(
			'id' => $id
		);

		return $this->db->get_where('nutrients', $where)->row();
	}
}

/* End of file nutrients_model.php */
/* Location: ./application/models/nutrients_model.php */