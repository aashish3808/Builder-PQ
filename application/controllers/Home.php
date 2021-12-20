<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Home Class * * 
 @purpose Dashboard Page Loading * 
 @author Kalyan Ashis Panja * 
 @email kalyan2k@gmail.com 
 */
class Home extends Admin_Controller
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

		$data['csrf'] = $this->_get_csrf_nonce();



		$this->load_admin_template('home/index', $data);
		return true;
	}

	public function update_step_1()
	{

		$user = $this->ion_auth->user()->row();
		$id = $user->id;

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');



		if (isset($_POST) && !empty($_POST)) {
			// do we have a valid request?
			if ($id != $this->input->post('id')) {
				show_error($this->lang->line('error_csrf'));
			}

			if ($this->form_validation->run() === TRUE) {
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'contact_email'  => $this->input->post('contact_email'),
					'phone' => $this->input->post('phone'),
					'company'  => $this->input->post('company'),
					'address'  => $this->input->post('address'),
					'zipcode' => $this->input->post('zipcode'),
					'city'  => $this->input->post('city'),
					'dob_day' => $this->input->post('dob_day'),
					'dob_month'  => $this->input->post('dob_month'),
					'dob_year' => $this->input->post('dob_year'),
					'place_of_birth'  => $this->input->post('place_of_birth'),
					'driving_licence'  => $this->input->post('driving_licence'),
					'gender'  => $this->input->post('gender'),
					'nationality'  => $this->input->post('nationality'),
					'marital_status'  => $this->input->post('marital_status'),
					'linkedin'  => $this->input->post('linkedin'),
					'website'  => $this->input->post('website')
				);

				// file upload

				if (isset($_FILES['profile_image']['error']) && !$_FILES['profile_image']['error'] && isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
					$hidden_image = $this->capture_form_data('hidden_image', '');

					$thumb_array[0]['width']    = 400;
					$thumb_array[0]['height']   = 400;
					$data['profileImage'] = $this->manageImage($formField = 'profile_image', $appendPath = 'admin/', $hidden_image, 'edit', '', $thumb_array);
				}

				if (isset($_FILES['globalMap']['error']) && !$_FILES['globalMap']['error'] && isset($_FILES['globalMap']['name']) && $_FILES['globalMap']['name'] != '') {
					$hidden_image1 = $this->capture_form_data('hidden_image1', '');

					$thumb_array[0]['width']    = 384;
					$thumb_array[0]['height']   = 203;
					$data['globalMap'] = $this->manageImage($formField = 'globalMap', $appendPath = 'admin/', $hidden_image1, 'edit', '', $thumb_array);
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data)) {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('success_msg', $this->ion_auth->messages());
					redirect(BACKEND . "home/step2", 'refresh');
				} else {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('error_msg', $this->ion_auth->errors());
					redirect(BACKEND, 'refresh');
				}
			} else {
				// redirect them back to the admin page if admin, or to the base url if non admin
				$this->session->set_flashdata('error_msg', $this->ion_auth->errors());
				redirect(BACKEND, 'refresh');
			}
		}
	}

	public function step2()
	{

		$data = array();

		// pr($this->session_admin_type);
		$data['dashboard_icon_path'] = RESOURCEPATH . "assets/img/dashboard/";
		$data = $this->get_current_resume_data();

		//pr($data);

		$user = $this->ion_auth->user()->row();
		$id = $user->id;

		$data['csrf'] = $this->_get_csrf_nonce();



		$this->load_admin_template('home/step2', $data);
		return true;
	}


	public function add_new_section()
	{

		$post = $this->input->post();
		// now I can get account and passwd by array index
		$section = $post["section"];
		$data['current_record'] = NULL;
		echo $string = $this->load->view('admin/home/step2/' . $section . '/ajax.php', $data, TRUE);
		exit;
	}

	public function update_step_2()
	{

		if (!$this->user_id) return false;


		//pr($_POST);

		$customize_text = $this->capture_form_data('customize_text');
		if (is_array($customize_text) && count($customize_text)) {

			foreach ($customize_text as $key => $val) {

				$data['value'] = $val;
				$this->db->update('tbl_section_choice ', $data, array('section_id' => $key, 'user_id' => $this->user_id));
				$data = [];
			}
		}


		$customize_status = $this->capture_form_data('customize_status');
		if (is_array($customize_status) && count($customize_status)) {

			foreach ($customize_status as $key => $val) {
				$data['status'] = $val;
				$this->db->update('tbl_section_choice ', $data, array('section_id' => $key, 'user_id' => $this->user_id));
				$data = [];
			}
		}


		$insert = $this->prepare_insert_record();

		// manage work experience

		$this->MODEL->delete_work_experience($this->user_id);

		$work_experience = $this->capture_form_data('work_experience');

		if (is_array($work_experience) && count($work_experience)) {

			if (is_array($work_experience['job_title'])) {
				$i = 0;
				foreach ($work_experience['job_title'] as $value) {
					$insert['job_title'] = $work_experience['job_title'][$i];
					$insert['job_city'] = $work_experience['job_city'][$i];
					$insert['employer'] = $work_experience['employer'][$i];
					$insert['start_month'] = $work_experience['start_month'][$i];
					$insert['start_year'] = $work_experience['start_year'][$i];
					$insert['end_month'] = $work_experience['end_month'][$i];
					$insert['end_year'] = $work_experience['end_year'][$i];
					$insert['description'] = $work_experience['description'][$i];

					$i++;
					$this->MODEL->insert_work_experience($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}


		// manage education

		$this->MODEL->delete_education($this->user_id);

		$education = $this->capture_form_data('education');

		if (is_array($education) && count($education)) {

			if (is_array($education['degree'])) {
				$i = 0;
				foreach ($education['degree'] as $value) {
					$insert['degree'] = $education['degree'][$i];
					$insert['from_city'] = $education['from_education'][$i];
					$insert['school'] = $education['school'][$i];
					$insert['start_month'] = $education['start_month'][$i];
					$insert['start_year'] = $education['start_year'][$i];
					$insert['end_month'] = $education['end_month'][$i];
					$insert['end_year'] = $education['end_year'][$i];
					$insert['description'] = $education['description'][$i];
					$i++;
					$this->MODEL->insert_education($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}


		// manage patent

		$this->MODEL->delete_patent($this->user_id);

		$patent = $this->capture_form_data('patent');

		if (is_array($patent) && count($patent)) {

			if (is_array($patent['name'])) {
				$i = 0;
				foreach ($patent['name'] as $value) {
					$insert['name'] = $patent['name'][$i];
					$insert['school'] = $patent['school'][$i];
					$insert['start_month'] = $patent['start_month'][$i];
					$insert['start_month'] = $patent['start_month'][$i];
					$insert['start_year'] = $patent['start_year'][$i];
					$insert['end_month'] = $patent['end_month'][$i];
					$insert['end_year'] = $patent['end_year'][$i];
					$insert['description'] = $patent['description'][$i];
					$i++;
					$this->MODEL->insert_patent($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}


		// manage competencies

		$this->MODEL->delete_core_competencies($this->user_id);

		$competencies = $this->capture_form_data('competencies');

		if (is_array($competencies) && count($competencies)) {

			if (is_array($competencies['name'])) {
				$i = 0;
				foreach ($competencies['name'] as $value) {
					$insert['name'] = $competencies['name'][$i];
					$insert['level'] = $competencies['level'][$i];

					$i++;
					$this->MODEL->insert_core_competencies($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}

		// manage executive summary

		$this->MODEL->delete_executive_summary($this->user_id);

		$executive_summary = $this->capture_form_data('executive_summary');

		if (is_array($executive_summary) && count($executive_summary)) {

			if (is_array($executive_summary['description'])) {
				$i = 0;
				foreach ($executive_summary['description'] as $value) {
					$insert['description'] = $executive_summary['description'][$i];
					$i++;
					$this->MODEL->insert_executive_summary($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}


		// manage industries

		$this->MODEL->delete_industries($this->user_id);

		$industries = $this->capture_form_data('industries');

		if (is_array($industries) && count($industries)) {

			if (is_array($industries['name'])) {
				$i = 0;
				foreach ($industries['name'] as $value) {
					$insert['name'] = $industries['name'][$i];
					$i++;
					$this->MODEL->insert_industries($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}



		// manage geographies 

		$this->MODEL->delete_geographies($this->user_id);

		$geographies = $this->capture_form_data('geography');

		if (is_array($geographies) && count($geographies)) {

			if (is_array($geographies['name'])) {
				$i = 0;
				foreach ($geographies['name'] as $value) {
					$insert['name'] = $geographies['name'][$i];
					$insert['level'] = $geographies['level'][$i];

					$i++;
					$this->MODEL->insert_geographies($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}


		// manage Achievement

		$this->MODEL->delete_achievement($this->user_id);

		$achievement = $this->capture_form_data('achievement');

		if (is_array($achievement) && count($achievement)) {

			if (is_array($achievement['name'])) {
				$i = 0;
				foreach ($achievement['name'] as $value) {
					$insert['name'] = $achievement['name'][$i];
					$insert['description'] = $achievement['description'][$i];

					$i++;
					$this->MODEL->insert_achievement($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}


		// manage Publication

		$this->MODEL->delete_publication($this->user_id);

		$publication = $this->capture_form_data('publication');

		if (is_array($publication) && count($publication)) {

			if (is_array($publication['name'])) {
				$i = 0;
				foreach ($publication['name'] as $value) {
					$insert['name'] = $publication['name'][$i];
					$insert['description'] = $publication['description'][$i];

					$i++;
					$this->MODEL->insert_publication($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}


		// manage custom section

		$this->MODEL->delete_custom_section($this->user_id);

		$custom_section = $this->capture_form_data('custom_section');

		//pr($custom_section);

		if (is_array($custom_section) && count($custom_section)) {

			if (is_array($custom_section['heading'])) {
				$i = 0;
				foreach ($custom_section['heading'] as $value) {
					$insert['heading'] = $custom_section['heading'][$i];
					$insert['description'] = $custom_section['description'][$i];

					$i++;
					$this->MODEL->insert_custom_section($insert);
				}
			}

			unset($insert);
			$insert = $this->prepare_insert_record();
		}



		redirect(BACKEND . "home/step2", 'refresh');
	}

	private function prepare_insert_record()
	{

		$insert['user_id'] = $this->user_id;
		$insert['status'] = 1;
		$insert['recordAddedOn'] = date("Y-m-d H:i:s");
		$insert['recordUpdatedOn'] = date("Y-m-d H:i:s");
		$insert['recordAddedByAdminId'] = $this->user_id;
		$insert['recordUpdatedByAdminId'] = $this->user_id;

		return $insert;
	}


	private function get_current_resume_data()
	{

		if (!$this->user_id) return false;


		$user_detail = $this->MODEL->select('*', $this->user_id);

		$record['personal_detail'] = @$user_detail['record'];

		$where['user_id'] = $this->user_id;

		// main section 

		$fetch = $this->MODEL->select_relational('tbl_main_section', '*');
		$record['main_section'] = @$fetch['record'];

		// main section choice
		$fetch = $this->MODEL->select_relational('tbl_section_choice', '*', 0, $where);


		$choices = [];

		if (is_array($fetch['record']) && count($fetch['record'])) {

			foreach ($fetch['record'] as $val) {

				$choices[$val->section_id]['value'] = $val->value;
				$choices[$val->section_id]['status'] = $val->status;
			}
		}

		//pr($choices);

		$record['section_choice'] = @$fetch['record'];

		//pr($record['section_choice']);

		$record['choices'] = $choices;


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


	public function tinymce_upload()
	{


		// Allowed origins to upload images
		$accepted_origins = array("http://localhost", "http://107.161.82.130", "http://codexworld.com");

		// Images upload path
		$imageFolder = "./uploads/tinymce/";

		reset($_FILES);
		$temp = current($_FILES);
		if (is_uploaded_file($temp['tmp_name'])) {
			if (isset($_SERVER['HTTP_ORIGIN'])) {
				// Same-origin requests won't set an origin. If the origin is set, it must be valid.
				if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
					header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
				} else {
					header("HTTP/1.1 403 Origin Denied");
					return;
				}
			}

			// Sanitize input
			if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
				header("HTTP/1.1 400 Invalid file name.");
				return;
			}

			// Verify extension
			if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
				header("HTTP/1.1 400 Invalid extension.");
				return;
			}

			// Accept upload if there was no origin, or if it is an accepted origin
			$filetowrite = $imageFolder . $temp['name'];
			move_uploaded_file($temp['tmp_name'], $filetowrite);

			// Respond to the successful upload with JSON.
			echo json_encode(array('location' => $filetowrite));
		} else {
			// Notify editor that the upload failed
			header("HTTP/1.1 500 Server Error");
		}

		
	}
}
