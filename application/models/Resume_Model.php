<?php
class Resume_Model extends MY_Model
{
	/** * Get Vendor Detail * *
	@purpose Defined methods for vendor  *
	@author Kalyan Ashis Panja *
	@email kalyan2k@gmail.com */
	private $table_name = 'users';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	// method for data fetching both single and multiple record
	function select($select = '*', $id = 0, $filter = [], $where = [], $limit = 0, $offset = NULL)
	{

		$client_id = $this->session_client_id;
		if ($client_id) {
			$where['T1.client_id'] = $client_id;
		}


		if ($select == '*')
			$select = 'T1.*';

		$join = [];

		if ($id > 0) {
			$select .= '  ';
			$where['T1.id'] = $id;
			return $this->select_active_record_single($select, $this->table_name . " T1", $where, $join);
		}


		return $this->select_active_record_multiple($select, $this->table_name . " T1 ", $join, $where, $filter, $limit, $offset);
	}
	/**
	 * Insert Record*
	 * @access public
	 * @ARRAY
	 * @return INTEGER
	 */
	function insert($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record($this->table_name, $db);
	}

	/** 
	 * Insert Record Work Experience* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_work_experience($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_work_experience', $db);
	}


	/** 
	 * Insert Record Education* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_education($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_education', $db);
	}


	/** 
	 * Insert Record Core Competencies* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_core_competencies($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_core_competencies', $db);
	}



	/** 
	 * Insert Record Executive Summary* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_executive_summary($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_executive_summary', $db);
	}


	/** 
	 * Insert Record Industries* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_industries($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_industries', $db);
	}


	/** 
	 * Insert Record Geographies* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_geographies($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_geographies', $db);
	}


	/** 
	 * Insert Record Publication* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_publication($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_publication', $db);
	}


	/** 
	 * Insert Record Achievement* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_achievement($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_achievement', $db);
	}


	/** 
	 * Insert Record Patent* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_patent($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_patent', $db);
	}


	/** 
	 * Insert Record Custom Section* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_custom_section($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_custom_section', $db);
	}


		/** 
	 * Insert Record Custom Section* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function insert_section_choice($db = '')
	{
		if ($db == '') return false;
		return $this->insert_active_record('tbl_section_choice', $db);
	}



	/**
	 * Update Record*
	 * @access public
	 * @ARRAY @INTEGER
	 * @return BOOL
	 */

	function update($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record($this->table_name, $record, $where);
		return true;
	}


	/** 
	 * Update Record Work Experience* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_work_experience($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_work_experience', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Education* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_education($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_education', $record, $where);
		return $id;
	}


	/** 
	 * Update Core Competencies* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_core_competencies($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_core_competencies', $record, $where);
		return $id;
	}



	/** 
	 * Update Record Executive Summary* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_executive_summary($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_executive_summary', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Industry* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_industries($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_industries', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Geographies* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_geographies($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_geographies', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Publication* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_publication($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_publication', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Achievement* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_achievement($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_achievement', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Patent* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_patent($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_patent', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Custom Section* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_custom_section($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_custom_section', $record, $where);
		return $id;
	}


	/** 
	 * Update Record Section Choice* 
	 * @access public 
	 * @ARRAY  
	 * @return INTEGER
	 */
	function update_section_choice($record = '', $id = 0)
	{
		if ($record === '' || $id < 1)
			return false;
		$where['id'] = $id;
		$this->update_active_record('tbl_section_choice', $record, $where);
		return $id;
	}

	/**
	 * Check Unique Value*
	 * @access public
	 * @STRING @STRING
	 * @return BOOL/INTEGER
	 */
	function check_unique($field = '', $value = '')
	{
		if ($field == '' || $value == '') return false;

		$sql = " SELECT count(id) as kount from  $this->table_name
		         WHERE
		         $field = '" . $value . "'";

		$client_id = $this->session_client_id;
		if ($client_id) {
			$sql .= " AND client_id = " . $client_id;
		}

		$query = $this->db->query($sql);
		$kount = 0;
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

	function delete($id = 0)
	{
		if ($id < 1)
			return false;
		$where['id'] = $id;
		//$this->relational($id);
		$this->delete_active_record($this->table_name, $where);
		return true;
	}


	 /**
     * Delete Record Work Experience*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

    function delete_work_experience($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_work_experience',$where);
        return true;
    }


	/**
     * Delete Record Education*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_education($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_education',$where);
        return true;
    }


	 /**
     * Delete Core  Competencies*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_core_competencies($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_core_competencies',$where);
        return true;
    }


	 /**
     * Delete Record Executive Summary*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_executive_summary($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_executive_summary',$where);
        return true;
    }

	 /**
     * Delete Record Industries*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_industries($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_industries',$where);
        return true;
    }


	 /**
     * Delete Record Geographies*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_geographies($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_geographies',$where);
        return true;
    }


	 /**
     * Delete Record Publication*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_publication($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_publication',$where);
        return true;
    }

	  /**
     * Delete Record Achievement*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_achievement($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_achievement',$where);
        return true;
    }

	  /**
     * Delete Record Patent*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_patent($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_patent',$where);
        return true;
    }

	  /**
     * Delete Record Custom Section*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_custom_section($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_custom_section',$where);
        return true;
    }

	  /**
     * Delete Record Section Choice*
     * @access public
     * @ARRAY @INTEGER
     * @return BOOL
     */

	function delete_section_choice($user_id = 0){
        if($user_id < 1)
            return false;
        $where['user_id'] = $user_id ;
        $this->delete_active_record('tbl_section_choice',$where);
        return true;
    }



	 // method for data fetching both single and multiple record 
	 function select_relational($table_name = '', $select = '*',$id = 0,$where = [],$filter =[],$limit=0,$offset = NULL, $order_by =[] ){

		if($table_name == '')
			return false;

        $join=[];

        if($select == '*')
            $select = 'T1.*';
		if($id>0){
			$select .= ' ,DATE_FORMAT(T1.recordAddedOn,"DATEFORMAT") as add_date,DATE_FORMAT(T1.recordUpdatedOn,"DATEFORMAT") as edit_date ';
			$where['T1.id'] = $id ;
			return $this->select_active_record_single($select,$table_name." T1 ",$where,$join);
		}

	   return $this->select_active_record_multiple($select,$table_name." T1 ",$join,$where,$filter,$limit,$offset,$order_by);

	}
	
}
