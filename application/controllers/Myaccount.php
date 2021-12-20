<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Myaccount Class * * 
 @purpose Manage Admin Account* 
 @author Kalyan Ashis Panja * 
 @email kalyan2k@gmail.com 
 */
class Myaccount extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

    }
    /** 
     * Load myaccount page* 
     * @access public 
     * @return BOOL
     */
    public function index($id = 0)
    {

        if ($id > 0) {
            $user = $this->ion_auth->user($id)->row();
        } else {

            $user = $this->ion_auth->user()->row();
            $id = $user->id;
        }

        // pr($user);
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();


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
                    'last_name'  => $this->input->post('last_name')
                );


                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }

                // file upload

                if (isset($_FILES['profile_image']['error']) && !$_FILES['profile_image']['error'] && isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
                    $hidden_image = $this->capture_form_data('hidden_image', '');

                    $thumb_array[0]['width']    = 400;
                    $thumb_array[0]['height']   = 400;
                    $data['profileImage'] = $this->manageImage($formField = 'profile_image', $appendPath = 'admin/', $hidden_image, 'edit', '', $thumb_array);
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('success_msg', $this->ion_auth->messages());
                    redirect(BACKEND, 'refresh');
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('error_msg', $this->ion_auth->errors());
                    redirect(BACKEND . 'myaccount/' . $id, 'refresh');
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name'  => 'first_name',
            'id'    => 'first_name',
            'type'  => 'text',
            'class' => 'data-hj-whitelist',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name'  => 'last_name',
            'id'    => 'last_name',
            'type'  => 'text',
            'class' => 'data-hj-whitelist',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );

        $data = $this->data;

        $this->load_admin_template('myaccount/record', $data);
        return true;
    }

    public function add($mode = '')
    {


        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }

        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');


            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),

            );

            // file upload

            if (isset($_FILES['profile_image']['error']) && !$_FILES['profile_image']['error'] && isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
                $hidden_image = '';

                $thumb_array[0]['width']    = 400;
                $thumb_array[0]['height']   = 400;
                $additional_data['profileImage'] = $this->manageImage($formField = 'profile_image', $appendPath = 'admin/', $hidden_image, 'edit', '', $thumb_array);
            }
        }

        $group_id[] = 1;
        $group_id[] = 2;

        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data, $group_id, 'admin/')) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('success_msg', $this->ion_auth->messages());
            redirect(BACKEND . "myaccount", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );

            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $data = $this->data;
            $this->load_admin_template('myaccount/add', $data);
        }

        return true;
    }


    /**
     * current admin user listing
     * @access public
     * NULL
     *@return string
     */

    public function listing()
    {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['users'] = $this->ion_auth->users(2)->result();
        foreach ($this->data['users'] as $k => $user) {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        $data = $this->data;

        // pr($this->data);

        $this->load_admin_template('myaccount/listing', $data);
    }


    /** 
     * delete admin profile image* 
     * @access public
     * @STRING 
     * @return BOOL
     */

    public function delete_image($id = 0)
    {
        if ($id < 1) return false;
        $user = $this->ion_auth->user($id)->row();
        $profile_image = $user->profileImage;
        $this->manageImage('', 'admin/', '', 'delete', $profile_image);

        $data['profileImage'] = '';
        // check to see if we are updating the user
        if ($this->ion_auth->update($user->id, $data)) {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('success_msg', 'Image deleted successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_image1($id = 0)
    {
        if ($id < 1) return false;
        $user = $this->ion_auth->user($id)->row();
        $profile_image = $user->globalMap;
        $this->manageImage('', 'admin/', '', 'delete', $profile_image);

        $data['globalMap'] = '';
        // check to see if we are updating the user
        if ($this->ion_auth->update($user->id, $data)) {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('success_msg', 'Image deleted successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // activate the user
    public function activate($id, $code = false)
    {
        $activation = $this->ion_auth->activate($id);
        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('success_msg', $this->ion_auth->messages());
            redirect(BACKEND . "myaccount/listing", 'refresh');
        }
    }

    // deactivate the user
    public function deactivate($id = NULL)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            //pr($this->data);
            $this->data['user'] = $this->ion_auth->user($id)->row();
            $data = $this->data;

            $this->load_admin_template('myaccount/deactivate_user', $data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }
            $this->session->set_flashdata('success_msg', $this->ion_auth->messages());
            // redirect them back to the auth page
            redirect(BACKEND . 'myaccount/listing', 'refresh');
        }
    }



    public function changepassword()
    {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect(BACKEND . 'authentication', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id'   => 'old',
                'type' => 'password',
                'class' => 'data-hj-whitelist'
            );
            $this->data['new_password'] = array(
                'name'    => 'new',
                'id'      => 'new',
                'type'    => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                'class' => 'data-hj-whitelist'
            );
            $this->data['new_password_confirm'] = array(
                'name'    => 'new_confirm',
                'id'      => 'new_confirm',
                'type'    => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                'class' => 'data-hj-whitelist'
            );
            $this->data['user_id'] = array(
                'name'  => 'user_id',
                'id'    => 'user_id',
                'type'  => 'hidden',
                'value' => $user->id,
            );
            // render

            $data = $this->data;
            $this->load_admin_template('myaccount/change_password', $data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('success_msg', $this->ion_auth->messages());
                redirect(BACKEND, 'refresh');
            } else {
                $this->session->set_flashdata('error_msg', $this->ion_auth->errors());
                redirect(BACKEND . 'myaccount/changepassword', 'refresh');
            }
        }
    }

    public function delete_user($id = 0)
    {
        if ($id < 1) return false;
        $user = $this->ion_auth->user($id)->row();
        $profile_image = $user->profileImage;
        $deletion = $this->ion_auth->delete_user($id);
        if ($deletion) {
            $this->manageImage('', 'admin/', '', 'delete', $profile_image);
            $this->session->set_flashdata('success_msg', $this->ion_auth->messages());
            redirect(BACKEND . "myaccount/listing", 'refresh');
        }
    }

    // create a new group
    public function create_group()
    {
        $this->data['title'] = $this->lang->line('create_group_title');


        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('success_msg', $this->ion_auth->messages());
                redirect(BACKEND . "myaccount/listing", 'refresh');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name'  => 'group_name',
                'id'    => 'group_name',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('description'),
            );

            $data = $this->data;
            $this->load_admin_template('myaccount/create_group', $data);
        }
    }

    // edit a group
    public function edit_group($id)
    {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect(BACKEND . 'myaccount/listing', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('success_msg', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('error_msg', $this->ion_auth->errors());
                }
                redirect(BACKEND . "myaccount/listing", 'refresh');
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name'    => 'group_name',
            'id'      => 'group_name',
            'type'    => 'text',
            'class' => 'form-control',
            'value'   => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['group_description'] = array(
            'name'  => 'group_description',
            'id'    => 'group_description',
            'type'  => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $data = $this->data;

        $this->load_admin_template('myaccount/edit_group', $data);
    }
}
