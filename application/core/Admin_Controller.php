<?php

/** * Admin_Controller Class * * 
@purpose Defined common methods for back end * 
@author Kalyan Ashis Panja * 
@email kalyan2k@gmail.com */

class Admin_Controller extends My_Controller
{
	public $session_admin_id;
	public $session_admin_type;
	public $group_id;
	public $session_client_id;
	function __construct()
	{

		parent::__construct();
		$this->load_initial();
		$this->check_valid_session();
		$this->check_valid_user();
	}

	/** 
	 * Load common resources for the backend  * 
	 * @access private 
	 * @NULL
	 * @return BOOL
	 */
	private function load_initial()
	{

		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		$this->load->library('layout');
		$this->session_admin_id 	= $this->session->userdata('user_id');
		$this->session_client_id = $this->session->userdata('client_id');
		//pr($this->session->userdata);
		$currentGroups = $this->ion_auth->get_users_groups($this->session_admin_id)->result();
		$this->session_admin_type 	= @$currentGroups[0]->name;
		$this->group_id = @$currentGroups[0]->id;
		return TRUE;
	}

	/** 
	 * Check Valid Session * 
	 * @access private 
	 * @NULL
	 * @return BOOL
	 */

	private function check_valid_session()
	{

		if (($this->router->class === 'authentication' && $this->router->method == 'forgot_password')) {
			return TRUE;
		}

		if (($this->router->class === 'authentication' && $this->router->method == 'reset_password')) {
			return TRUE;
		}

		if ($this->router->class === 'authentication' && $this->router->method != 'logout') {
			if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('members') || $this->ion_auth->in_group('admin')) {

				redirect(BACKEND . "home");
				return true;
			}
		} else {
			if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('members') && !$this->ion_auth->in_group('admin')) {
				$this->ion_auth->logout();
				redirect(BACKEND . "authentication");
				return true;
			}
		}
		return TRUE;
	}

	/** 
	 * Control user access completely  * 
	 * @access private 
	 * @NULL
	 * @return BOOL
	 */

	private function check_valid_user()
	{
		return TRUE;
	}

	/** 
	 * Call Layout and arrange template  * 
	 * @access protected 
	 * @STRING @ARRAY
	 * @return BOOL
	 */

	protected function load_admin_template($view_file = '', $data = array(), $popup = 0)
	{
		if ($view_file === '')
			return false;
		$view_file = "admin/" . $view_file;
		if ($this->router->class === 'authentication') {
			$layout = 'admin/layout';
		} else {
			$layout = 'admin/layout';
		}

		if ($popup == 1) {
			$layout = 'admin/layout_popup';
		}

		$userId = $this->ion_auth->get_user_id();
		$data['user_groups'] = $this->ion_auth->get_users_groups($userId)->row();
		$data['user_group_id'] = @$data['user_groups']->id;
		// pr($data);

		// $data['existing_tags'] = $this->getAllDistinctTags();

		$data['error_msg'] = $this->session->flashdata('error_msg');
		$data['success_msg'] = $this->session->flashdata('success_msg');
		$data['status_options'] = array('1'  => 'Active', '0'  => 'Inactive');
		$data['status_options_complete'] = array('1'  => 'Complete', '0'  => 'Incomplete');
		$data['yes_no_flag_options'] = array('1'  => 'Yes', '0'  => 'No');
		$data['no_yes_flag_options'] = array('0'  => 'No', '1'  => 'Yes');
		$data['admin_user'] = $this->ion_auth->user($this->session_admin_id)->row();
		$data['user_options']   = array('superadmin'  => 'Super Admin', 'developer' => 'Developer', 'admin'    => 'Admin', 'client' => 'Client');


		/*
     $data['office_admin'] = $this->ion_auth->users(5)->result();
     $data['total_no_unread_message'] = $this->Basic_Model->get_number_of_unread_message();*/
		// pr($data);

		//pr($data['user_groups']->name,0);

		$data['admin_type'] = @$data['user_groups']->name;

		$this->layout->setLayout($layout);
		$this->layout->view($view_file, $data);
		return TRUE;
	}

	/** 
	 * Set Admin Session  * 
	 * @access protected 
	 * @OBJECT
	 * @return BOOL
	 */

	protected function set_admin_session($admin_detail)
	{
		if ($admin_detail === '') return false;
		$this->session->set_userdata('admin_id', $admin_detail->id);
		$this->session->set_userdata('admintype', $admin_detail->type);
		$this->session->set_userdata('adminname', $admin_detail->fullName);
		$this->session->set_userdata('adminemail', $admin_detail->email);
		$this->session->set_userdata('adminurl', $admin_detail->webPageLink);
		$this->session->set_userdata('admingoogleplus', $admin_detail->googlePlusLink);
		if ($admin_detail->profileImage != '') {
			$this->session->set_userdata('adminimage', base_url() . "uploads/admin/thumbs/thumb_" . $admin_detail->profileImage);
		}
		return true;
	}

	/** 
	 * Unset Admin Session  * 
	 * @access protected 
	 * @return BOOL
	 */

	protected function unset_admin_session()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admintype');
		$this->session->unset_userdata('adminname');
		$this->session->unset_userdata('adminemail');
		$this->session->unset_userdata('adminimage');
		$this->session->unset_userdata('adminurl');
		$this->session->unset_userdata('admingoogleplus');
		return true;
	}

	/** 
	 * Set Flashdata with redirect   * 
	 * @access protected 
	 * @STRING @STRING @STRING
	 * @return BOOL
	 */

	protected function set_flash_data_redirect($type = '', $message = '', $redirect = '')
	{
		if ($type === '' || $message === '')
			return false;
		if ($redirect === '')
			$url = $_SERVER['HTTP_REFERER'];
		else {
			$url = BACKEND . $redirect;
		}
		$this->session->set_flashdata($type, $message);
		redirect($url);
	}


	/** 
	 * Get Search Filter Data * 
	 * @access protected
	 * @INTEGER @STRING
	 * @return ARRAY
	 */

	protected function prepare_listing_data($page_no = 0, $re_use_string = '', $where = [], $find_in_set = '')
	{

		if ($re_use_string === '') return false;
		$this->load->library('pagination');
		// if the listing page is loading for the first time or user press the refresh button
		// then search and filter data should be reset
		if ($page_no == 0) {
			$this->session->unset_userdata('session_filter');
			$page_no = 1;
		}
		$data['search_mode']   = 0;
		// define default per page record
		$per_page_no = 25;
		if ($this->router->class == 'client') {
			$per_page_no = 99999999;
		}

		if ($this->router->class == 'clientbooking') {
			$per_page_no = 100;
		}

		$filter_mode = $this->capture_form_data('submit');

		$filter['where'] = $where;
		$filter['find_in_set'] = $find_in_set;

		// search block start 
		$search_mode = $this->capture_form_data('search_mode', 0);
		if ($filter_mode == 'submit_button' || $search_mode == 1) {
			$filter      = $this->capture_form_data('filter', '');
			$filter      = array_map('trim', $filter);
			$this->session->set_userdata('session_filter', $filter);
			$per_page_no = $filter['per_page_no'];
		}
		$filter = $this->session->userdata('session_filter');
		if (is_array($filter) && count($filter)) {
			$per_page_no = $filter['per_page_no'];
			$data['search_mode']   = 1;
		} else {
			$filter['per_page_no'] 		= $per_page_no;
			$filter['sort_by']     		= '';
			$filter['sort_order']  		= 'ASC';
			$filter['filter_by']  		= '';
			$filter['search_by_column'] = '';
		}

		$filter['where'] = $where;
		$filter['find_in_set'] = $find_in_set;

		$data['perpage_options'] = array('10'  => '10', '25'  => '25', '50'  => '50', '100' => '100');
		$data['sort_by_options']  = array('' => 'Select', 'ASC'  => 'Ascending', 'DESC'  => 'Descending');

		if ($this->router->class === 'message') {
			$data['active_inactive_options'] = array('' => 'Select', '1'  => 'Read', '0'  => 'Unread');
		} else
			$data['active_inactive_options'] = array('' => 'Select', '1'  => 'Active', '0'  => 'Inactive');



		// search block end 

		// necessary urls record,delete, detail , change status url , serach url 
		$data['add_url'] = BACKEND . $re_use_string . "/form/add/" . $page_no . "/";
		$data['edit_url'] = BACKEND . $re_use_string . "/form/edit/" . $page_no . "/";
		$data['delete_url'] = BACKEND . $re_use_string . "/delete_record/" . $page_no . "/";
		$data['clone_url'] = BACKEND . $re_use_string . "/cloning/" . $page_no . "/";
		$data['detail_url'] = BACKEND . $re_use_string . "/detail/view/" . $page_no . "/";
		$data['change_status_url'] = BACKEND . $re_use_string . "/change_status/" . $page_no . "/";
		$data['change_isFeatured_url'] = BACKEND . $re_use_string . "/change_isFeatured/" . $page_no . "/";
		$data['search_action_url'] = BACKEND . $re_use_string . "/";
		$data['list_url'] 	= BACKEND . $re_use_string . "/";
		// necessary url end 
		$limit             = ($page_no - 1) * $per_page_no;

		$data['per_page_no'] = $per_page_no;
		$data['filter_mode'] = $filter_mode;
		$data['filter']      = $filter;
		$data['limit']       = $limit;
		$data['page_no']     = $page_no;

		// record
		$records     		= $this->MODEL->select('*', 0, $data['filter'], $where, $data['limit'], $data['per_page_no']);
		// pr($records );
		$data['total_no_of_rows'] = @$records['total_rows_with_out_limit'];
		$data['record']     = @$records['record'];

		if (is_array($data['record']) && count($data['record'])) {
			$pagination_base_url     =  BACKEND . $re_use_string . "/" . "index/";
			$this->load_pagination($pagination_base_url, $data['total_no_of_rows'], $data['per_page_no']);
		}
		$data['re_use_string']  = ucfirst($re_use_string);

		return $data;
	}


	/** 
	 * Get Search Filter Data * 
	 * @access protected
	 * @INTEGER @STRING
	 * @return ARRAY
	 */

	protected function listing_sitemap_data($page_no = 0, $re_use_string = '', $type = '')
	{
		if ($re_use_string === '') return false;
		$this->load->library('pagination');
		// if the listing page is loading for the first time or user press the refresh button
		// then search and filter data should be reset
		if ($page_no == 0) {
			$this->session->unset_userdata('session_filter');
			$page_no = 1;
		}
		$data['search_mode']   = 0;
		$per_page_no = 25000;
		$data['perpage_options'] = array('10'  => '10', '25'  => '25', '50'  => '50', '100' => '100');
		$data['sort_by_options']  = array('' => 'Select', 'ASC'  => 'Ascending', 'DESC'  => 'Descending');

		if ($this->router->class === 'message') {
			$data['active_inactive_options'] = array('' => 'Select', '1'  => 'Read', '0'  => 'Unread');
		} else
			$data['active_inactive_options'] = array('' => 'Select', '1'  => 'Active', '0'  => 'Inactive');


		// search block end 

		$data['action_url'] = BACKEND . $re_use_string . "/do_add_edit/";
		$data['list_url'] 	= BACKEND . $re_use_string . "/";
		// necessary url end 
		$limit             = ($page_no - 1) * $per_page_no;

		$data['per_page_no'] = $per_page_no;
		//$data['filter_mode'] = $filter_mode ;
		//$data['filter']      = $filter ;
		$data['limit']       = $limit;
		$data['page_no']     = $page_no;

		// record
		$records     		= $this->MODEL->select('*', 0, '', $data['limit'], $data['per_page_no'], $type);


		$data['total_no_of_rows'] = $records['total_rows_with_out_limit'];
		$data['record']     = $records['record'];

		if (is_array($data['record']) && count($data['record'])) {
			$pagination_base_url     =  BACKEND . $re_use_string . "/" . "assign_page/" . $type . "/";
			$this->load_pagination($pagination_base_url, $data['total_no_of_rows'], $data['per_page_no'], 5);
		}
		$data['re_use_string']  = ucfirst($re_use_string);


		// pr($data);

		return $data;
	}

	/** 
	 * Load Pagination * 
	 * @access protected
	 * @STRING @INTEGER @INTEGER
	 * @return ARRAY
	 */

	protected function load_pagination($base_url = '', $total_no_rows = 0, $per_page = 0, $uri_segment = 4)
	{
		if ($base_url === '' || $per_page < 1)
			return false;
		$config['base_url'] 	= $base_url;
		$config['total_rows'] = $total_no_rows;
		$config['per_page'] 	= $per_page;
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment'] = $uri_segment;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return true;
	}


	/** 
	 * Load detail page* 
	 * @access public 
	 * @STRING @INT @INT @STRING
	 * @return BOOL
	 */

	protected function load_detail($mode = '', $page_no = 0, $detail_id = 0, $re_use_string = '', $where = '', $find_in_set = '')
	{


		if ($mode === '' || $mode != 'view' || $page_no < 1 || $detail_id < 1 || $re_use_string === '')
			$this->set_flash_data_redirect('error_msg', 'Invalid Page', $re_use_string . "/index/" . $page_no);

		$filter['where'] = $where;
		$filter['find_in_set'] = $find_in_set;

		$data['mode']  		= $mode;
		$data['page_no']	= $page_no;
		$data['detail_id']  = $detail_id;

		// pr($filter);
		$records            = $this->MODEL->select('*', $detail_id, $filter);
		$data['total_no_of_rows'] = $records['total_rows_with_out_limit'];
		$data['record']     = $records['record'];

		// echo $detail_id;
		// exit;
		if (!(is_array($records) && count($records))) {
			$this->set_flash_data_redirect('error_msg', 'No Data Available', $re_use_string . "/index/" . $page_no);
		}
		$data['add_url'] = BACKEND . $re_use_string . "/form/add/" . $page_no . "/";
		$data['edit_url'] = BACKEND . $re_use_string . "/form/edit/" . $page_no . "/";
		$data['delete_url'] = BACKEND . $re_use_string . "/delete_record/" . $page_no . "/";
		$data['detail_url'] = BACKEND . $re_use_string . "/detail/view/" . $page_no . "/";
		$data['change_status_url'] = BACKEND . $re_use_string . "/change_status/" . $page_no . "/";
		$data['search_action_url'] = BACKEND . $re_use_string . "/";
		$data['list_url'] 	= BACKEND . $re_use_string . "/index/" . $page_no . "/";

		$data['re_use_string']  = ucfirst($re_use_string);
		return $data;
	}


	/** 
	 * Prepare form data * 
	 * @access protected
	 * @STRING @INTEGER @STRING @INTEGER
	 * @return ARRAY
	 */

	protected function prepare_form_data($mode = '', $page_no = 0, $re_use_string = '', $edit_id = 0)
	{
		if ($mode === '' || $page_no < 1 || $re_use_string === '') {
			$this->set_flash_data_redirect('error_msg', 'Invalid Page', $re_use_string . "/index/" . $page_no);
		}
		if ($mode == 'add') {
			$data['record']     = NULL;
		}
		$data['mode']  		= $mode;
		$data['page_no']	= $page_no;
		if ($mode == 'edit') {
			if ($edit_id < 1) {
				$this->set_flash_data_redirect('error_msg', 'Invalid Page', $re_use_string . "/index/" . $page_no);
			}
			$records            = $this->MODEL->select('*', $edit_id);
			$data['total_no_of_rows'] = $records['total_rows_with_out_limit'];
			$data['record']     = $records['record'];
			if (!(is_array($records) && count($records))) {
				$this->set_flash_data_redirect('error_msg', 'No Data Available', $re_use_string . "/index/" . $page_no);
			}
		}
		$data['action_url'] = BACKEND . $re_use_string . "/do_add_edit/";
		$data['add_url'] =  BACKEND . $re_use_string . "/form/add/" . $page_no . "/";
		$data['edit_url'] = BACKEND . $re_use_string . "/form/edit/" . $page_no . "/";
		$data['delete_url'] = BACKEND . $re_use_string . "/delete_record/" . $page_no . "/";
		$data['detail_url'] = BACKEND . $re_use_string . "/detail/view/" . $page_no . "/";
		$data['clone_url'] = BACKEND . $re_use_string . "/cloning/" . $page_no . "/";
		$data['list_url'] 	= BACKEND . $re_use_string . "/index/" . $page_no . "/";
		$data['check_unique_url'] 	= BACKEND . $re_use_string . "/check_unique/";
		$data['edit_id'] = $edit_id;
		$data['re_use_string']  = ucfirst($re_use_string);
		return $data;
	}


	/** 
	 * do add edit * 
	 * @access protected
	 * @STRING @ARRAY @INTEGER @STRING
	 * @return BULL
	 */

	protected function add_edit_action($mode = '', $db = '', $recordId = 0, $re_use_string = '')
	{
		if ($mode === '' || !is_array($db) || $re_use_string === '') return false;

		if ($mode == 'add') {
			$db['created_at'] 	    = date("Y-m-d H:i:s");
			$db['created_by'] = $this->session_admin_id;
			return $this->addParent($db, $re_use_string);
		} elseif ($mode == 'edit') {
			if ($recordId < 1) {
				$this->set_flash_data_redirect('error_msg', 'Operation Error');
			}
			$db['updated_by'] = $this->session_admin_id;
			$db['updated_at']  = date("Y-m-d H:i:s");

			return $this->edit($db, $recordId, $re_use_string);
		}

		return true;
	}

	/** 
	 * do add * 
	 * @access private
	 * @ARRAY @STRING
	 * @return BULL
	 */

	private function addParent($db = array(), $re_use_string = '')
	{
		if (!is_array($db) || count($db) < 1 || $re_use_string === '')
			$this->set_flash_data_redirect('error_msg', 'Operation Error');
		$page_no = 1;
		return $last_insert_id = $this->MODEL->insert($db);
	}

	/** 
	 * do edit * 
	 * @access private
	 * @ARRAY  @INTEGER @STRING
	 * @return BULL
	 */

	private function edit($db = array(), $edit_id = 0, $re_use_string = '')
	{
		if (!is_array($db) || count($db) < 1 ||  $re_use_string === '' || $edit_id < 1)
			$this->set_flash_data_redirect('error_msg', 'Operation Error');
		return  $this->MODEL->update($db, $edit_id);
	}

	/** 
	 * generate record add edit message * 
	 * @access protected
	 * @STRING  @INTEGER 
	 * @return BULL
	 */
	protected function generate_message_add_edit($mode = '', $return, $re_use_string)
	{
		if ($mode == 'add' && $return) {
			$this->set_flash_data_redirect('success_msg', 'Record added successfully', $re_use_string . "/index/");
			return true;
		} elseif ($mode == 'edit' && $return) {
			$this->set_flash_data_redirect('success_msg', 'Record edited successfully');
			return true;
		} else
			$this->set_flash_data_redirect('error_msg', "Operation $mode $return Error");
	}

	/** 
	 * check unique column value * 
	 * @access private
	 * @return BULL
	 */
	protected function load_check_unique()
	{

		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash()
		);

		$field 		= 	$this->capture_form_data('field');
		$value 		= 	$this->capture_form_data('value');
		if ($field == '' || $value == '') {
			return false;
		}
		$field = " BINARY " . $field;
		$status = $this->MODEL->check_unique($field, $value);
		$response['status'] = $status;
		echo json_encode($response);
		return true;
	}

	/** 
	 * delete record * 
	 * @access protected
	 * @INTEGER @INTEGER @STRING
	 * @return BULL
	 */

	protected function load_delete($page_no = 0, $delete_id = 0, $re_use_string = '')
	{
		if ($delete_id < 1 || $page_no < 1  || $re_use_string === '') {
			$this->set_flash_data_redirect('error_msg', 'Invalid Page', $re_use_string . "/index/" . $page_no);
		}
		$delete_status = $this->MODEL->delete($delete_id);
		if ($delete_status) {
			$this->set_flash_data_redirect('success_msg', 'Record Deleted Successfully', $re_use_string . "/index/" . $page_no);
		} else {
			$this->set_flash_data_redirect('error_msg', 'Operation Error', $re_use_string . "/index/" . $page_no);
		}
		return true;
	}

	/** 
	 * change status * 
	 * @access protected
	 * @INTEGER @INTEGER @INTEGER @STRING
	 * @return BULL
	 */

	protected function load_change_status($page_id = 0, $record_id = 0, $status_value = 1, $re_use_string = '')
	{
		if ($page_id < 1 || $record_id < 1 || !($status_value == 0 || $status_value == 1) || $re_use_string === '') {
			$this->set_flash_data_redirect('error_msg', 'Invalid Page', $re_use_string . "/index/" . $page_no);
		}
		$db['status'] = $status_value;
		if ($this->MODEL->update($db, $record_id)) {
			$this->set_flash_data_redirect('success_msg', 'Status Changed Successfully', $re_use_string . "/index/" . $page_no);
		} else {
			$this->set_flash_data_redirect('error_msg', 'Operation Error', $re_use_string . "/index/" . $page_no);
		}
		return true;
	}

	/** 
	 * change isFeatured * 
	 * @access protected
	 * @INTEGER @INTEGER @INTEGER @STRING
	 * @return BULL
	 */

	protected function load_change_isFeatured($page_id = 0, $record_id = 0, $isFeatured_value = 1, $re_use_string = '')
	{
		if ($page_id < 1 || $record_id < 1 || !($isFeatured_value == 0 || $isFeatured_value == 1) || $re_use_string === '') {
			$this->set_flash_data_redirect('error_msg', 'Invalid Page', $re_use_string . "/index/" . $page_no);
		}
		$db['isFeatured'] = $isFeatured_value;
		if ($this->MODEL->update($db, $record_id)) {
			$this->set_flash_data_redirect('success_msg', 'isFeatured Changed Successfully', $re_use_string . "/index/" . $page_no);
		} else {
			$this->set_flash_data_redirect('error_msg', 'Operation Error', $re_use_string . "/index/" . $page_no);
		}
		return true;
	}
	/** 
	 * fetch frame position widget combination * 
	 * @access protected
	 * @ARRAY 
	 * @return ARRAY
	 */
	protected function getFramePosition($filter = array())
	{
		$record = $this->Basic_Model->getDataByWhere($filter, 'tbl_cms_frame_position');
		return  $record;
	}

	/** 
	 * fetch frame position widget combination with filter * 
	 * @access protected
	 * @ARRAY 
	 * @return ARRAY
	 */

	protected function getFramePositionFilter($filter = array())
	{
		$record = $this->Basic_Model->getDataByWhereFramePosition($filter);
		return  $record;
	}

	/** 
	 * fetch page position widget combination * 
	 * @access protected
	 * @ARRAY 
	 * @return ARRAY
	 */
	protected function getWidgetPosition($filter = array())
	{
		$record = $this->Basic_Model->getDataByWhere($filter, 'tbl_cms_page_position_widget');
		return  $record;
	}

	/** 
	 * fetch page position widget combination * 
	 * @access protected
	 * @ARRAY @INTEGER
	 * @return BOOL
	 */
	protected function processFramePosition($position = array(), $frame_id = 0)
	{
		if (!count($position) || $frame_id < 1) return false;
		$db = array();
		$where['frameId'] = $frame_id;
		$db['positionStatus'] = 0;
		$this->Basic_Model->updateFramePosition($db, $where);
		$db = array();
		$where = array();
		foreach ($position as $key => $value) {
			$record = $this->Basic_Model->selectFramePosition(0, $frame_id, $key);
			$db['positionStatus'] = $value;
			$where['frameId'] = $frame_id;
			$where['positionId'] = $key;
			if (count($record)) {
				$this->Basic_Model->updateFramePosition($db, $where);
			} else {
				$db['frameId'] = $frame_id;
				$db['positionId'] = $key;
				$this->Basic_Model->insertFramePosition($db);
			}
			$db = array();
			$where = array();
		}
		return true;
	}

	/** 
	 * fetch page position widget combination * 
	 * @access protected
	 * @ARRAY @INTEGER
	 * @return BOOL
	 */

	protected function processWidgetPosition($position = array(), $page_id = 0)
	{

		if (!count($position) || $page_id < 1) return false;

		$db = array();
		$where['pageId'] = $page_id;
		$db['status'] = 0;
		$this->Basic_Model->updateWidgetPosition($db, $where);
		$db = array();
		$where = array();
		foreach ($position as $key => $value) {
			$record = $this->Basic_Model->selectWidgetPosition(0, $page_id, $key);
			$db['status'] 			= 1;
			$where['pageId'] 		= $page_id;
			$where['positionId'] 	= $key;
			$db['widgetId']   = $value;
			if (count($record)) {
				$this->Basic_Model->updateWidgetPosition($db, $where);
			} else {
				$db['pageId'] 	  = $page_id;
				$db['positionId'] = $key;
				$db['widgetId']   = $value;
				$this->Basic_Model->insertWidgetPosition($db);
			}
			$db = array();
			$where = array();
		}
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
