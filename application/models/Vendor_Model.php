<?php
class Vendor_Model extends MY_Model {
	/** * Get Vendor Detail * *
	@purpose Defined methods for vendor  *
	@author Kalyan Ashis Panja *
	@email kalyan2k@gmail.com */
	private $table_name = 'vendors';
	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}
	// method for data fetching both single and multiple record
	function select($select = '*',$id = 0,$filter = [],$where=[],$limit=0,$offset = NULL ){

		$client_id = $this->session_client_id;
		if($client_id){
			$where['T1.client_id'] = $client_id;
		}


		if($select == '*')
			$select = 'T1.*';

		$join = [];

		if($id>0){
			$select .= ' ,DATE_FORMAT(T1.created_at,"DATEFORMAT") as add_date,DATE_FORMAT(T1.updated_at,"DATEFORMAT") as edit_date ';
			$where['T1.id'] = $id ;
			return $this->select_active_record_single($select,$this->table_name. " T1",$where,$join);
		}


		return $this->select_active_record_multiple($select,$this->table_name." T1 ",$join,$where,$filter,$limit,$offset);
	}
	/**
	 * Insert Record*
	 * @access public
	 * @ARRAY
	 * @return INTEGER
	 */
	function insert($db=''){
		if($db == '') return false;
		return $this->insert_active_record($this->table_name,$db );
	}

	/**
	 * Update Record*
	 * @access public
	 * @ARRAY @INTEGER
	 * @return BOOL
	 */

	function update($record='',$id=0){
		if($record === '' || $id < 1)
			return false;
		$where['id'] = $id ;
		$this->update_active_record($this->table_name,$record,$where);
		return true;
	}

	/**
	 * Check Unique Value*
	 * @access public
	 * @STRING @STRING
	 * @return BOOL/INTEGER
	 */
	function check_unique($field='',$value=''){
		if($field == '' || $value == '') return false;

		$sql = " SELECT count(id) as kount from  $this->table_name
		         WHERE
		         $field = '".$value."'";

		$client_id = $this->session_client_id;
		if($client_id){
			$sql .= " AND client_id = ".$client_id;
		}

		$query = $this->db->query($sql);
		$kount = 0 ;
		$row = $query->row();
		$kount = $row->kount;
		return $kount;
	}

	/**
	 * Delete Record*
	 * @access public
	 * @ARRAY @INTEGER
	 * @return BOOL
	 */

	function delete($id=0){
		if($id < 1)
			return false;
		$where['id'] = $id ;
		//$this->relational($id);
		$this->delete_active_record($this->table_name,$where);
		return true;
	}


	/**
	 * Delete Relational Record*
	 * @access private
	 * @ARRAY @INTEGER
	 * @return BOOL
	 */

	private function relational($id=0){
		if($id < 1) return false ;

		// check for widget
		$query = $this->db->query("SELECT id from tbl_cms_widget WHERE positionId = $id ");
		if ($query->num_rows() > 0){
			$page_no 	= $this->uri->segment(4,0);
			$this->set_flash_data_redirect('error_msg','The position cannot be deleted as there are some widget(s) associated with this position.',"position/index/".$page_no);

		}
		// check for frame
		$query = $this->db->query("SELECT id from tbl_cms_frame_position WHERE positionId = $id ");
		if ($query->num_rows() > 0){
			$page_no 	= $this->uri->segment(4,0);
			$this->set_flash_data_redirect('error_msg','The position cannot be deleted as there are some frame(s) associated with this position.',"position/index/".$page_no);
		}

		// check for position
		$query = $this->db->query("SELECT id from tbl_cms_page_position_widget WHERE positionId = $id ");
		if ($query->num_rows() > 0){
			$page_no 	= $this->uri->segment(4,0);
			$this->set_flash_data_redirect('error_msg','The position cannot be deleted as there are some page(s) associated with this position.',"position/index/".$page_no);
		}
		return true;

	}




}
