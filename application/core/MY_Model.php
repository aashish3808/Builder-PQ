<?php
/** * MY_Controller Class * * 
@purpose Defined common database methods for whole projects * 
@author Kalyan Ashis Panja * 
@email kalyan2k@gmail.com */
	 
class MY_Model extends CI_Model{

	protected $session_admin_id;
	protected $session_client_id;
  function __construct(){
  	parent::__construct();

  	$this->session_admin_id 	= $this->session->userdata('user_id');
  	$this->session_client_id = $this->session->userdata('client_id');
  }
  
  /**
     * fetch record from single table or nultiple tables 
     *
	 * @param   STRING   select                    -> table columns 
     * @return  STRING   from                      -> table name  
	 * @return  ARRAY    where                     -> and condition
	 * @param   BOOL     multiple_record_status    -> determine  single row return or multiple row return 
	 * @return  ARRAY    order_by                  -> order by -> sort record
	 * @return  STRING   limit                     -> limit record set
	 * @return  ARRAY    join                      -> perform any type of join on any number of tables on any specified condition 
	 * @return  ARRAY    or_where                  -> or condition 
	 * @return  ARRAY    like                      -> and like condition
	 * @return  ARRAY    or_like                   -> or like condition
	 
	 
	  
     * @author  Kalyan
 */
 
  protected function select_active_record_single($select='*',$from = '',$where = array(),$join=array(),$find_in_set='',$order_by = array(), $limit= '',$or_where = array(),$like = array(),$or_like = array() ){
	 if($from === ''){
	 	return false;
	 }
	 $select = str_replace('DATEFORMAT',DATEFORMAT,$select);
      $select = str_replace('JSFORMAT',JSFORMAT,$select);
	 $select = 'SQL_CALC_FOUND_ROWS '. $select;
	 $this->db->select($select,FALSE);
	 
	  $this->db->from($from);
	  
	  if(is_array($join) && count($join)){
	  	foreach($join as  $join_value){
			$this->db->join($join_value['table_name'],$join_value['on'],$join_value['type']);
		}
	  }
	   
	  if(is_array($where) && count($where)){
	  	$this->db->where($where); 
	  }
	  
	  if($find_in_set){
		  $this->db->where($find_in_set);
	  }
	  
	  if(is_array($or_where) && count($or_where)){
	  	$this->db->or_where($or_where); 
	  }
	 
	  if(is_array($like) && count($like)){
	  	foreach($like as $like_key => $like_value){
			$this->db->like($like_key, $like_value);
		}
	  }
	  
	  if(is_array($or_like) && count($or_like)){
	  	foreach($or_like as $or_like_key => $or_like_value){
			$this->db->or_like($or_like_key, $or_like_value);
		}
	  }
	 
	  if(is_array($order_by) && count($order_by)){
	  	foreach($order_by as $order_by_key => $order_by_value){
			$this->db->order_by($order_by_key, $order_by_value);
		}
	  }
	  if($limit != ''){
	  	$this->db->limit($limit);
	  }
	   $query = $this->db->get();

      //echo $this->db->last_query();
      //echo "<br>";
	    // echo $this->db->last_query();
	    // exit; 
	   $query_rows = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
	   $number_of_results_without_limit = $query_rows->row()->Count;
	   // echo $this->db->last_query();
	  // exit; 
	  $result = $this->prepare_record_set($query,FALSE,$number_of_results_without_limit);
	  return $result;
  }
  
  /**
     * fetch record from single table or nultiple tables 
     *
	 * @param   STRING   select                    -> table columns 
     * @return  STRING   from                      -> table name 
	 * @return  ARRAY    join                      -> perform any type of join on any number of tables on any specified condition  
	 * @return  ARRAY    where                     -> and condition
	 * @return  ARRAY    filter                    -> data filtering
	 
     * @author  Kalyan
 */
 
  protected function select_active_record_multiple($select='*',$from = '',$join=array(),$where = array(),$filter=array(),$offset=NULL,$limit=0,$find_in_set='',$order='',$or_where ='',$where_in = ''){
	 if($from === ''){
	 	return false;
	 }
	 $select = 'SQL_CALC_FOUND_ROWS '. $select;
      $select = str_replace('DATEFORMAT',DATEFORMAT,$select);
      $select = str_replace('JSFORMAT',JSFORMAT,$select);
	 $this->db->select($select,FALSE);
	  $this->db->from($from);
	  if(is_array($join) && count($join)){
	  	foreach($join as  $join_value){
			$this->db->join($join_value['table_name'],$join_value['on'],$join_value['type']);
		}
	  }
	  
	  $like = array();
	  $or_like = array();
	  $order_by = array();
	   if($this->router->class === 'message'){
			if(isset($filter['filter_by']) && $filter['filter_by'] !=''){
				$where['T1.isRead'] = $filter['filter_by'];
			 }
			 $this->db->order_by('T1.id','desc');
		}
		else{
				if(isset($filter['filter_by']) && $filter['filter_by'] !=''){
			    $where['T1.status'] = $filter['filter_by'];
		 }
			
		}
		 if(isset($filter['search_text']) && $filter['search_text'] !=''  && isset($filter['search_by_column']) && $filter['search_by_column'] != '' ){
			 $like[$filter['search_by_column']] = $filter['search_text'];
		 }
		 
		 if(isset($filter['sort_by']) && $filter['sort_by'] != '' && isset($filter['sort_order']) && $filter['sort_order'] != '' ) {
				 $order_by[$filter['sort_by']]   = $filter['sort_order'];
			}
		
	  if(is_array($where) && count($where)){
	  	$this->db->where($where); 
	  }
	  
	  if(is_array($where_in) && count($where_in)){
	  	foreach($where_in as $where_in_key => $where_in_value){
			$this->db->where_in($where_in_key, $where_in_value,TRUE);
		}
	  }
	  
	   if($find_in_set){
		  $this->db->where($find_in_set);
	  }
	  if(is_array($or_where) && count($or_where)){
	  	$this->db->or_where($or_where); 
	  }
	 
	  if(is_array($like) && count($like)){
	  	foreach($like as $like_key => $like_value){
			$this->db->like($like_key, $like_value);
		}
	  }
	  
	  if(is_array($or_like) && count($or_like)){
	  	foreach($or_like as $or_like_key => $or_like_value){
			$this->db->or_like($or_like_key, $or_like_value);
		}
	  }
	  if(is_array($order) && count($order)){
		  foreach($order as $value){
			  $this->db->order_by($value['sort_by'], $value['sort_order']);
		  }
	  }
	 
	  if(is_array($order_by) && count($order_by)){
	  	foreach($order_by as $order_by_key => $order_by_value){
			$this->db->order_by($order_by_key, $order_by_value);
		}
	  }
	  
	 
	  if($limit)
	  	$this->db->limit($limit, $offset);
	   $query = $this->db->get();
	   // echo $this->db->last_query();
	  // echo "<br>";
	   // exit;
	   $query_rows = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
	   $number_of_results_without_limit = $query_rows->row()->Count;
	   //echo $this->db->last_query();
	  // exit;
	  $result = $this->prepare_record_set($query,TRUE,$number_of_results_without_limit);
	  return $result;
  }
  
  /** 
  * INSERT RECORD INTO TABLE* 
  * @access protected
  * @STRING @ARRAY
  * @return INT/BOOL
 */
	 
 protected function insert_active_record($table='',$record=array()){
 	if($table === '' || !is_array($record) || count($record) < 1 ) 
		return false;
 	$this->db->insert($table,$record);
	return $this->db->insert_id() ;
 }
 
  /** 
  * UPDATE RECORD IN TABLE
  * @access protected
  * @STRING @ARRAY @ARRAY
  * @return INT/BOOL
 */
	 
 protected function update_active_record($table='',$record=array(), $where=array()){
 	if($table === '' || !is_array($record) || count($record) < 1 || !is_array($where) || count($where) < 1) return false;
	$this->db->update($table, $record,$where);
	return $this->db->affected_rows() ;
 
 }
 
 
  /** 
  * DELETE RECORD IN TABLE
  * @access protected
  * @STRING @ARRAY 
  * @return BOOL
 */
	 
 protected function delete_active_record($table='',$where=array()){
 	if($table === '' || !is_array($where) || count($where) < 1 ) return false;
	$this->db->delete($table,$where); 
	return TRUE ;
 }
 
 
  /** 
  * TRUNCATE TABLE
  * @access protected
  * @STRING  
  * @return BOOL
 */
	 
 protected function truncate_active_record($table=''){
 	if($table === ''  ) return false;
	$this->db->truncate($table);
	return TRUE ;
 }
 
 
 /**
     * fetch record from single table or nultiple tables 
     *
     * @param   BOOL     multiple_record_status    -> determine  single row return or multiple row return 
	 * @param   STRING   select                    -> table columns 
	 * @param   STRING   compound_select           -> sub query , mysql functions etc
     * @return  STRING   from                      -> table name  
	 * @return  ARRAY    where                     -> and condition 
	 * @return  ARRAY    order_by                  -> order by -> sort record
	 * @return  STRING   limit                     -> limit record set
	 * @return  ARRAY    join                      -> perform any type of join on any number of tables on any specified condition 
	 * @return  ARRAY    or_where                  -> or condition 
	 * @return  ARRAY    like                      -> and like condition
	 * @return  ARRAY    or_like                   -> or like condition
	 * @return  ARRAY    where_in                  -> and where in 
	 * @return  ARRAY    where_not_in              -> and where not it 
	 * @return  ARRAY    or_where_in               -> or where in 
	 * @return  ARRAY    or_where_not_in           -> or where not in 
	 * @return  ARRAY    not_like                  -> and not like
	 * @return  ARRAY    or_not_like               -> or not like
	 * @return  ARRAY    group_by                  -> group by 
	 * @return  STRING   distinct                  -> distinct column name 
	 * @return  ARRAY    having                    -> and having condition
	 * @return  ARRAY    or_having                 -> or having condition 
	 
	  
     * @author  Kalyan
 */
  
  protected function select_active_record_larger($select='*',$from = '',$where = array(),$order_by = array(), $limit= '',$join=array(),$or_where = array(),$like = array(),$or_like = array(),$where_in = array(), $where_not_in = array(),$or_where_in = array(),$or_where_not_in = array(),$not_like = array() , $or_not_like = array() , $group_by = array(), $distinct='',$having = array(),$or_having = array()){
	 if($from === ''){
	 	return false;
	 }
	  $select = 'SQL_CALC_FOUND_ROWS '. $select;
	  $this->db->select($select,FALSE);
	 
	  $this->db->from($from);
	  
	  if(is_array($join) && count($join)){
	  	foreach($join as $join_key => $join_value){
			$this->db->join($join_key, $join_value);
		}
	  }
	  
	  if(is_array($where) && count($where)){
	  	$this->db->where($where); 
	  }
	  if(is_array($or_where) && count($or_where)){
	  	$this->db->or_where($or_where); 
	  }
	  
	  if(is_array($where_in) && count($where_in)){
	  	foreach($where_in as $where_in_key => $where_in_value){
			$this->db->where_in($where_in_key, $where_in_value);
		}
	  }
	  
	  if(is_array($or_where_in) && count($or_where_in)){
	  	foreach($or_where_in as $or_where_in_key => $or_where_in_value){
			$this->db->or_where_in($or_where_in_key, $or_where_in_value);
		}
	  }
	  
	  if(is_array($or_where_in) && count($or_where_in)){
	  	foreach($or_where_in as $or_where_in_key => $or_where_in_value){
			$this->db->or_where_in($or_where_in_key, $or_where_in_value);
		}
	  }
	  
	  if(is_array($where_not_in) && count($where_not_in)){
	  	foreach($where_not_in as $where_not_in_key => $where_not_in_value){
			$this->db->where_not_in($where_not_in_key, $where_not_in_value);
		}
	  }
	  
	  if(is_array($or_where_not_in) && count($or_where_not_in)){
	  	foreach($or_where_not_in as $or_where_not_in_key => $or_where_not_in_value){
			$this->db->or_where_not_in($or_where_not_in_key, $or_where_not_in_value);
		}
	  }
	  
	  if(is_array($like) && count($like)){
	  	foreach($like as $like_key => $like_value){
			$this->db->like($like_key, $like_value);
		}
	  }
	  
	  if(is_array($or_like) && count($or_like)){
	  	foreach($or_like as $or_like_key => $or_like_value){
			$this->db->or_like($or_like_key, $or_like_value);
		}
	  }
	  
	  if(is_array($not_like) && count($not_like)){
	  	foreach($not_like as $not_like_key => $not_like_value){
			$this->db->not_like($not_like_key, $not_like_value);
		}
	  }
	  
	  if(is_array($or_not_like) && count($or_not_like)){
	  	foreach($or_not_like as $or_not_like_key => $or_not_like_value){
			$this->db->or_not_like($or_not_like_key, $or_not_like_value);
		}
	  }
	  
	  if(is_array($group_by) && count($group_by)){
	  	$this->db->group_by($group_by);
	  }
	  
	  if($distinct != ''){
	  	$this->db->distinct($distinct);
	  }
	  
	  if(is_array($having) && count($having)){
	  	$this->db->having($having);
	  }
	  
	  if(is_array($or_having) && count($or_having)){
	  	$this->db->or_having($or_having);
	  }
	  
	  if(is_array($order_by) && count($order_by)){
	  	foreach($order_by as $order_by_key => $order_by_value){
			$this->db->order_by($order_by_key, $order_by_value);
		}
	  }
	  
	  
	  if(is_array($order_by) && count($order_by)){
	  	foreach($order_by as $order_by_key => $order_by_value){
			$this->db->order_by($order_by_key, $order_by_value);
		}
	  }
	  if($limit != ''){
	  	$this->db->limit($limit);
	  }
	   $query = $this->db->get();
	   $query_rows = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
	   $number_of_results_without_limit = $query_rows->row()->Count;
	   // echo $this->db->last_query();
	  // exit; 
	  $result = $this->prepare_record_set($query,TRUE,$number_of_results_without_limit);
	  return $result;
  }
  
  
   /** 
	  * Prepare Record Set* 
	  * @access private
	  * @MYSQL Resource @INTEGER @INTEGER
	  * @return ANY VARIABLE
     */
  
  
  protected function prepare_record_set($query=NULL,$multiple_record_status=1,$number_of_results_without_limit=0){
  	if(is_null($query) || $number_of_results_without_limit < 1) return false;
	$return_array['total_rows_with_out_limit'] = $number_of_results_without_limit ;
	if($multiple_record_status){
		if($query->num_rows() > 0) {
			$return_array['total_rows_with_out_limit'] = $number_of_results_without_limit ;
			$return_array['record']                    = $query->result();
		}
	
	}
	else{
		if($query->num_rows() > 0) {
			$return_array['record'] = $query->row();
		}
	}
	return $return_array;
  }
  
    /** 
  * Set Flashdata with redirect   * 
  * @access protected 
  * @STRING @STRING @STRING
  * @return BOOL
  */
  
  protected function set_flash_data_redirect($type='',$message='',$redirect=''){
	  if($type === '' || $message === '')
	  	return false;
	  if($redirect === '')
	  	$url = $_SERVER['HTTP_REFERER'];
	  else{
		  $url = BACKEND.$redirect ;
	  }
	 $this->session->set_flashdata($type,$message);
	 redirect($url);
  }
  
  /** 
	  * Update all category urls* 
	  * @access protected 
	  * @ARRAY @INTEGER  
	  * @return BOOL
     */
	 
	 protected  function updateAllCategoriesUrls(){
		$all = $this->select_active_record_multiple('*','tbl_cms_category');
		$allCategories =  $all['record']; 
		if(!is_array($allCategories) || count($allCategories) < 1) return false ;
		foreach($allCategories as $val){
			$url_string = $this->getParentCategoryChain($val);
			$db['url'] = $url_string ;
			$this->db->where('id', $val->id);
			$this->db->update('tbl_cms_category', $db); 
			$update_page_query = "UPDATE tbl_cms_pages SET url =  CONCAT('".$url_string."',slug,'.html')   WHERE categoryId = ".$val->id;
			$this->db->query($update_page_query);
		}
		return true;
	}
	
	 /** 
	  * Update all category urls* 
	  * @access private 
	  * @ARRAY   
	  * @return BOOl/STRING
     */
	
	protected function getParentCategoryChain($category){
		if(!is_object($category) || sizeof($category) < 1) return false ;
		 $categoryId = $category->id;
		 $i = 0 ;
		 $url[$i] = $category->name;
		 $parentId = $category->parentId;
		 while($parentId > 0) {
			 $query = $this->db->query("SELECT * FROM tbl_cms_category WHERE id = $parentId");
			 $row = $query->row();
			 $url[++$i] = stripcslashes($row->name);
			 $parentId = $row->parentId;
		 }
		$url = array_reverse($url);
		$url_string = implode('/',$url);
		$url_string .= '/';
		return $url_string ;
	}
}
