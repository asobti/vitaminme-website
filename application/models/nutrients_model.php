<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nutrients_model extends CI_Model {

	public function getAll() {
		return $this->db->get('nutdesc')->result();
	}

	public function getById($id) {
		$where = array(
			'NutrientCode' => $id
		);

		return $this->db->get_where('nutdesc', $where)->row();
	}

}

/* End of file nutrients_model.php */
/* Location: ./application/models/nutrients_model.php */