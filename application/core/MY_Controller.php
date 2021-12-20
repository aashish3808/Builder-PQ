<?php

/**
 * MY_Controller Class * * 
 @purpose Defined common methods for whole projects * 
 @author Kalyan Ashis Panja * 
 @email kalyan2k@gmail.com 
 */

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!defined('FILE_UPLOAD_ABS_PATH')) {
			define("FILE_UPLOAD_ABS_PATH", './uploads/');
		}
		if (!defined('COMMONJSCS')) {
			define("COMMONJSCS", base_url() . "public/common/");
		}

		if (!defined('RESOURCEPATH')) {
			define("RESOURCEPATH", base_url() . 'public/admin/assets/');
		}

		if (!defined('ADMINDIR')) {
			define("ADMINDIR", 'backoffice');
		}

		if (!defined('BACKEND')) {
			//define("BACKEND",base_url().ADMINDIR."/");
			define("BACKEND", base_url());
		}

		if (!defined('DATEFORMAT')) {
			define("DATEFORMAT", "%d %b, %Y %h:%i %p");
		}

		if (!defined('JSFORMAT')) {
			define("JSFORMAT", "%d %b, %Y");
		}

		$this->load->model('Basic_Model');
	}

	/** 
	 * Capture, filter and Secure Form Data* 
	 * @access protected
	 * @STRING
	 * @return ANY VARIABLE
	 */

	protected function capture_form_data($input = '')
	{
		if ($input === '') {
			return false;
		}
		$output = NULL;
		// capture input
		$capture = $this->input->get_post($input);

		if (is_array($capture) && count($capture)) {
			foreach ($capture as $key => $value) {
				$output[$key] = $this->apply_filter($value);
				$output[$key] = $this->apply_security($value);
			}
		} else {
			$output  = $this->apply_filter($capture);
			$output  = $this->apply_security($capture);
		}
		return $output;
	}

	/** 
	 * filter variable* 
	 * @access private
	 * @ANY DATA TYPE
	 * @return ANY VARIABLE
	 */

	private function apply_filter($value = '')
	{
		if (is_array($value)) return $value;
		return trim($value);
	}

	/** 
	 * secure variable* 
	 * @access private
	 * @ANY DATA TYPE
	 * @return ANY VARIABLE
	 */

	private function apply_security($value = '')
	{

		if ($this->router->directory == ADMINDIR . '/') {
			return $value;
		}

		return $this->security->xss_clean($value);
	}

	/** 
	 * send mail using codeigniter library* 
	 * @access public
	 * @ARRAY
	 * @return BOOL
	 */
	public function send_mail($parrMail)
	{
		if (!is_array($parrMail) || count($parrMail) < 1)
			return false;
		$this->load->library('email');
		$arrTo     =   $parrMail['to'];
		$sFrom     =   $parrMail['from'];
		$sFromName =   $parrMail['fromName'];
		$sSubject  =   $parrMail['subject'];
		$sContent  =   $parrMail['content'];
		$arrConfig['mailtype'] = 'html';
		$arrConfig['charset'] = 'iso-8859-1';
		$arrConfig['wordwrap'] = 'TRUE';
		$arrConfig['newline'] = "\r\n"; //use double quotes

		// pr($arrTo);
		// $this->email->clear();
		$this->email->initialize($arrConfig);
		$this->email->from($sFrom, $sFromName);
		$this->email->to($arrTo);
		$this->email->subject($sSubject);
		$this->email->message($sContent);
		// $this->email->send(false);
		// $return = $this->email->print_debugger();
		//pr($return);

		$is_email_send = $this->email->send();
		if ($is_email_send) return true;
		else {
			$this->email->print_debugger();
		}
	}


	/** 
	 * File Upload using codeigniter library  
	 * @access protected
	 * @ARRAY STRING ARRAY
	 * @return ARRAY
	 */

	protected function do_upload($config, $formField = '', $thumbInputArray = array())
	{
		if ($formField === '')
			return false;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($formField)) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			$source_path 		= $data['upload_data']['full_path'];

			if (is_array($thumbInputArray) && count($thumbInputArray)) {
				$data['upload_data']['thumbnail'] = 0;
				foreach ($thumbInputArray as $thumb) {
					//pr($thumb);
					$destination_path 	= $config['upload_path'] . $thumb['subPath'] . "/thumb_" . $data['upload_data']['file_name'];
					if (isset($thumb['height']) && $thumb['width']) {
						if ($this->createThumb($source_path, $destination_path, $thumb['width'], $thumb['height'])) {
							$data['upload_data']['thumbnail'] += 1;
						}
					} else {
						if ($this->createThumb($source_path, $destination_path, @$thumb['width'])) {
							$data['upload_data']['thumbnail'] += 1;
						}
					}
				}
			}

			//pr($data);

			return $data;
		}
	}


	/** 
	 * File Create thumbnail using codeigniter library
	 * @access protected
	 * @STRING STRING INT INT
	 * @return BOOL
	 */

	protected function createThumb($sourcePath = '', $destinationPath = '', $width = 0, $height = 0)
	{
		if ($sourcePath == '' || $destinationPath == '' || $width < 1) return false;
		$this->load->library('image_lib');
		$config['image_library'] 		= 'gd2';
		$config['source_image'] 		= $sourcePath;
		$config['new_image']            = $destinationPath;
		$config['width']  				= $width;
		if ($height)
			$config['height'] 				= $height;
		$config['master_dim']           = 'width';
		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) {
			// an error occured
			echo $this->image_lib->display_errors();
			exit;
			return false;
		}
		return true;
	}


	/** 
	 * 
	 * @access protected
	 * @STRING STRING STRING STRING STRING ARRAY
	 * @return BOOL
	 */

	protected function manageImage($formField = '', $appendPath = '', $hidden_image = '', $mode = '', $deleteImage = '', $thumb_array = array())
	{
		$config['upload_path']      = FILE_UPLOAD_ABS_PATH . $appendPath;
		$config['allowed_types']    = 'bmp|gif|jpeg|jpg|png|tiff|tif';
		$thumb_array[0]['subPath']  = 'thumbs';
		$thumb_array[1]['subPath']  = 'thumbs_large';

		if ($mode == 'add' || $mode == 'edit') {
			if ($formField === '') {
				$this->session->set_flashdata('error_msg', 'Please Upload a file');
				redirect($_SERVER['HTTP_REFERER']);
				return true;
			}

			// pr($thumb_array);
			$return_array = $this->do_upload($config, $formField, $thumb_array);
			// pr($return_array);
			if (isset($return_array['error'])) {
				$this->session->set_flashdata('error_msg', $return_array['error']);
				redirect($_SERVER['HTTP_REFERER']);
				return true;
			}
			if (isset($return_array['upload_data']['file_name'])) {
				if ($hidden_image != '' && ($mode == 'edit')) {
					@unlink(FILE_UPLOAD_ABS_PATH . $appendPath . $hidden_image);
					if (is_array($thumb_array)) {
						foreach ($thumb_array as $thumb) {
							@unlink(FILE_UPLOAD_ABS_PATH . $appendPath . $thumb['subPath'] . "/thumb_" . $hidden_image);
						}
					}
				}
				return $return_array['upload_data']['file_name'];
			}
		}
		if ($mode == 'delete' && $deleteImage != '') {
			@unlink(FILE_UPLOAD_ABS_PATH . $appendPath . $deleteImage);
			if (is_array($thumb_array)) {
				foreach ($thumb_array as $thumb) {
					@unlink(FILE_UPLOAD_ABS_PATH . $appendPath . $thumb['subPath'] . "/thumb_" . $deleteImage);
				}
			}
			return true;
		}
		return NULL;
	}

	/**
	 * fetch email template detail
	 *
	 * @param   string   uniqueIndent
	 * @return  array    mailContent   
	 * @author  Kalyan
	 */
	public function getEmailTemplate($uniqueIndent = '')
	{
		if ($uniqueIndent == '') return false;
		$mailContent = $this->basic_model->getDataByWhere('slug = "' . $uniqueIndent . '" ', 'tbl_cms_email_template');
		return  $mailContent;
	}


	/** 
	 * 
	 * @access protected
	 * @STRING
	 * @return STRING
	 */
	protected function generateSlug($title = '')
	{
		if ($title == '') return false;
		return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
	}





	public function getConfigValue($config_title = '')
	{
		if ($config_title == '')
			return false;
		$query = $this->db->query("SELECT value FROM tbl_website_settings WHERE slug = '" . $config_title . "'  LIMIT 1");
		$row = $query->row();
		return @$row->value;
	}

	public function getConfigStatus($config_title = '')
	{
		if ($config_title == '')
			return false;
		$query = $this->db->query("SELECT status FROM tbl_website_settings WHERE slug = '" . $config_title . "'  LIMIT 1");
		$row = $query->row();
		return @$row->status;
	}

	public function getText($content = '', $start = '', $end = '')
	{
		if ($content == '' || $start == '' || $end == '') return false;
		$r = explode($start, $content);
		if (isset($r[1])) {
			$r = explode($end, $r[1]);
			return $r[0];
		}
		return '';
	}
}
