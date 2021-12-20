<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Home Class * * 
 @purpose Dashboard Page Loading * 
 @author Kalyan Ashis Panja * 
 @email kalyan2k@gmail.com 
 */
class Preview extends Admin_Controller
{

	public $user_id;

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$ss = $this->session->userdata();
		//pr($ss);
		$this->user_id = @$ss['user_id'];
		$this->load->model('Resume_Model', 'MODEL');
	}

	/** 
	 * Load dashboard page* 
	 * @access public 
	 * @return BOOL
	 */
	public function index()
	{
		$data = array();

		// pr($this->session_admin_type);
		$data['dashboard_icon_path'] = RESOURCEPATH . "assets/img/dashboard/";
		$data = $this->get_current_resume_data();

		$user = $this->ion_auth->user()->row();
		$id = $user->id;

		$data['data'] = $data;

		echo $string = $this->load->view('admin/preview/index.php', $data, TRUE);
		exit;
	}



	private function get_current_resume_data()
	{

		if (!$this->user_id) return false;


		$user_detail = $this->MODEL->select('*', $this->user_id);

		$record['personal_detail'] = @$user_detail['record'];

		$where['user_id'] = $this->user_id;

		$user_detail = $this->MODEL->select('*', $this->user_id);

		$record['personal_detail'] = @$user_detail['record'];

		$where['user_id'] = $this->user_id;

		// main section 

		$fetch = $this->MODEL->select_relational('tbl_main_section', '*');
		$record['main_section'] = @$fetch['record'];

		// main section choice
		$fetch = $this->MODEL->select_relational('tbl_section_choice', '*', 0, $where);
		$record['section_choice'] = @$fetch['record'];


		// work experience 
		$fetch = $this->MODEL->select_relational('tbl_work_experience', '*', 0, $where);
		$record['work_experience'] = @$fetch['record'];


		// education 
		$fetch = $this->MODEL->select_relational('tbl_education', '*', 0, $where);
		$record['education'] = @$fetch['record'];

		// core competencies 
		$fetch = $this->MODEL->select_relational('tbl_core_competencies', '*', 0, $where);
		$record['competencies'] = @$fetch['record'];

		// executive summary
		$fetch = $this->MODEL->select_relational('tbl_executive_summary', '*', 0, $where);
		$record['executive_summary'] = @$fetch['record'];

		

		// industry
		$fetch = $this->MODEL->select_relational('tbl_industries', '*', 0, $where);
		$record['industries'] = @$fetch['record'];


		// geographies
		$fetch = $this->MODEL->select_relational('tbl_geographies', '*', 0, $where);
		$record['geographies'] = @$fetch['record'];

		// publication
		$fetch = $this->MODEL->select_relational('tbl_publication', '*', 0, $where);
		$record['publication'] = @$fetch['record'];


		// achievement
		$fetch = $this->MODEL->select_relational('tbl_achievement', '*', 0, $where);
		$record['achievement'] = @$fetch['record'];

		// patent section
		$fetch = $this->MODEL->select_relational('tbl_patent', '*', 0, $where);
		$record['patent'] = @$fetch['record'];


		// custom section
		$fetch = $this->MODEL->select_relational('tbl_custom_section', '*', 0, $where);
		$record['custom_section'] = @$fetch['record'];


		
		

		return $record;
	}
}
