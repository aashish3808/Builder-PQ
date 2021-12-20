<?php
/** *  * * 
    @purpose Defined common methods for all controller* 
    @author Kalyan Ashis Panja * 
    @email kalyan2k@gmail.com */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basic_Model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	/** 
   * fetch record from a single table with specific condition * 
   * @access public
   * @ARRAY @STRING
   * @return ARRAY
    */
	
    public function getDataByWhere( $parrWhere = array() , $table = '' ) {
		if($table == '') return false;
        $this->db->select("*");
        $this->db->from($table);
        if(sizeof($parrWhere)) {
            $this->db->where($parrWhere);
        }
        $sResult = $this->db->get();
        //pr($this->db->last_query(),0);
        if ($sResult->num_rows() > 0) {
            $arrRows = $sResult->result_array();
            return $arrRows;
        }
        return false;
    }
	
	/** 
   * fetch record from a frame position table with specific condition * 
   * @access public
   * @ARRAY 
   * @return ARRAY
    */
	
    public function getDataByWhereFramePosition( $parrWhere = array() ) {
        $this->db->select("tbl_cms_frame_position.*,tbl_cms_position.name");
        $this->db->from('tbl_cms_frame_position');
		$this->db->join('tbl_cms_position', 'tbl_cms_position.id = tbl_cms_frame_position.positionId');
        if(sizeof($parrWhere)) {
            $this->db->where($parrWhere);
        }
		
		 $this->db->where("(SELECT count(tbl_cms_widget.id) FROM tbl_cms_widget WHERE tbl_cms_widget.positionId = tbl_cms_frame_position.positionId) >",0,FALSE);
         $sResult = $this->db->get();
		//echo $this->db->last_query() ;
		//exit;
        if ($sResult->num_rows() > 0) {
            $arrRows = $sResult->result_array();
            return $arrRows;
        }
        return false;
    }
	
	/** 
   * build common dropdown  * 
   * @access public
   * @STRING @STRING @STRING @STRING
   * @return ARRAY
    */
	
	function commonDropdown($table_name = '',$title_field = '',$id_field = '',$condition = '',$order = '',$order_by = 'ASC'){
		if($table_name == '' || $title_field == '' || $id_field == '') return false;
		$sql_select  = " SELECT $title_field as option_name,$id_field as option_value
		                 FROM
						 $table_name
						 WHERE
						 status = 1 ";

		if($condition == 'client_applicable'){

			$client_id = $this->session_client_id;
			if($client_id){
				$sql_select .= " AND client_id = ".$client_id;
			}
		}
		else if($condition != ''){
			$sql_select .= $condition;
		}
		
		if($order == ''){
			$order = $title_field;
		}
						 		 
		$sql_select  .=	" order by $order $order_by ";
		$query_select = $this->db->query($sql_select);
		//print_r($sql_select);
		//exit;
        $res_select   = array();
		if ($query_select->num_rows() > 0){
		   $res_select = $query_select->result_array();
		}
		return $res_select;
	}
	
	/** 
   * insert frame position master * 
   * @access public
   * @ARRAY
   * @return BOOL
    */
	
	function insertFramePosition($db=''){
		if($db == '') return false;
		$sql_insert = " INSERT INTO tbl_cms_frame_position";
		if(is_array($db) && count($db)){
			$sql_insert .= " SET  ";
			$i = 0 ;
			foreach($db as $key=>$value){
				if($i > 0) $sql_insert .= " ,  ";
				$sql_insert .= $key." =  '".trim(addslashes($value))."' ";
				$i++;
			}
		}
		//echo $sql_insert;
		//echo "<br>";
		//exit;
		$this->db->query($sql_insert);
		return $this->db->insert_id() ;
	}
	
   /** 
   * update frame position master * 
   * @access public
   * @ARRAY
   * @return BOOL
    */
	
	function updateFramePosition($db=array(),$where=array()){
		if(!is_array($db) || !is_array($where) ) return false ;
		$this->db->where($where);
		$this->db->update('tbl_cms_frame_position', $db) ;
		return true ;
	}
	// get frame position widget list
	function selectFramePosition($id = 0,$frameId= 0, $positionId = 0, $widgetId = 0){
		$order_by     = ''; 
		$sql_select = " SELECT SQL_CALC_FOUND_ROWS
		                *
						FROM  tbl_cms_frame_position
						WHERE 1 ";
						
		if($id)
			$sql_select.=  " AND id = '".$id."'";
		if($frameId)
			$sql_select.=  " AND frameId = '".$frameId."'";
		if($positionId)
			$sql_select.=  " AND positionId = '".$positionId."'";
		if($widgetId)
			$sql_select.=  " AND widgetId = '".$widgetId."'";
		if($order_by != '')
			$sql_select.=  $order_by;
			
		//echo $sql_select ."<br>";
		//exit;
		$query_select = $this->db->query($sql_select);
		
        $res_select   = array();
		if ($query_select->num_rows() > 0){
		   $res_select = $query_select->result_array();
		   $query = $this->db->query('SELECT FOUND_ROWS() AS `found_rows`;');
		   $row = $query->row();
		   $total_no_of_rows = $row->found_rows;
		   $res_select[0]['total_no_rows'] = $total_no_of_rows;
		}
		return $res_select;
	}
	
	
	// insert widget position master
	
	function insertWidgetPosition($db=''){
		if($db == '') return false;
		$sql_insert = " INSERT INTO tbl_cms_page_position_widget";
		if(is_array($db) && count($db)){
			$sql_insert .= " SET  ";
			$i = 0 ;
			foreach($db as $key=>$value){
				if($i > 0) $sql_insert .= " ,  ";
				$sql_insert .= $key." =  '".trim(addslashes($value))."' ";
				$i++;
			}
		}
		//echo $sql_insert;
		//echo "<br>";
		//exit;
		$this->db->query($sql_insert);
		return $this->db->insert_id() ;
	}
	
	// update widget position master 
	function updateWidgetPosition($db=array(),$where=array()){
		if(!is_array($db) || !is_array($where) ) return false ;
		$this->db->where($where);
		$this->db->update('tbl_cms_page_position_widget', $db) ;
		//echo $this->db->last_query();
		return true ;
	}
	// get frame position widget list
	function selectWidgetPosition($id = 0,$pageId= 0, $positionId = 0, $widgetId = 0){
		$order_by     = ''; 
		$sql_select = " SELECT SQL_CALC_FOUND_ROWS
		                *
						FROM  tbl_cms_page_position_widget
						WHERE 1 ";
						
		if($id)
			$sql_select.=  " AND id = '".$id."'";
		if($pageId)
			$sql_select.=  " AND pageId = '".$pageId."'";
		if($positionId)
			$sql_select.=  " AND positionId = '".$positionId."'";
		if($widgetId)
			$sql_select.=  " AND widgetId = '".$widgetId."'";
		if($order_by != '')
			$sql_select.=  $order_by;
			
		//echo $sql_select ."<br>";
		//exit;
		$query_select = $this->db->query($sql_select);
        $res_select   = array();
		if ($query_select->num_rows() > 0){
		   $res_select = $query_select->result_array();
		   $query = $this->db->query('SELECT FOUND_ROWS() AS `found_rows`;');
		   $row = $query->row();
		   $total_no_of_rows = $row->found_rows;
		   $res_select[0]['total_no_rows'] = $total_no_of_rows;
		}
		return $res_select;
	}
	
	// get number of unread message 
	
	public function get_number_of_unread_message(){
		$query = $this->db->get_where('tbl_website_feedback', array('isRead' => 0));
		return $query->num_rows();
	}
	
	function contact_insert($db=''){
		if($db == '') return false;
		$sql_insert = " INSERT INTO tbl_website_feedback ";
		if(is_array($db) && count($db)){
			$sql_insert .= " SET  ";
			$i = 0 ;
			foreach($db as $key=>$value){
				if($i > 0) $sql_insert .= " ,  ";
				if($value == 'NOW()'){
					$sql_insert .= $key." = ".$value ;
				}
				else{
					$sql_insert .= $key." =  '". addslashes($value)."' ";
				}
				
				$i++;
			}
		}
		return $this->db->query($sql_insert);
		
	}
	/** 
   * fetch next record * 
  * @access protected
  * @ARRAY 
  * @return ARRAY
  */
 function getNextRecord($current_id = '', $table_name = ''){
	 	if(empty($current_id) || empty($current_id) ) return false ;
		$this->db->select("id");
		$this->db->from($table_name);
		$this->db->where('id > ', $current_id);
		
		$sResult = $this->db->get();
        if ($sResult->num_rows() > 0) {
            $arrRow = $sResult->row_array();
            return $arrRow['id'];
        }
        return false;
    }
	
}
?>
