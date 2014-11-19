<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
// Your own constructor code
        $this->_init();
    }

    private function _init() {
        $this->output->set_template('iluvproperty');
        $this->load->model('Login_Model');
        $this->load->model('Common_Model');
        $this->load->library('form_validation');
    }

    public function index() {
        redirect('/login/mobile');
        $this->load->js($this->config->item('defaultThemeManualURL') . 'assets/js/jquery.validate.js');
        $this->load->js($this->config->item('defaultThemeManualURL') . 'assets/js/login_validation.js');
        $this->load->section('header_section', 'common/header');
        $this->load->section('navigation_section', 'common/navigation');
        $this->load->view('login/index');
        $this->load->section('footer_section', 'common/footer');
    }

    public function mobile() {
        $this->output->set_template('iluvproperty-mobile');
        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/jquery.validate.js');
        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/login_validation.js');
//$this->load->section('header_section', 'common/header');
// $this->load->section('navigation_section', 'common/navigation');
        $this->load->view('login/mobile');
// $this->load->section('footer_section', 'common/footer');
    }

    public function mobile_account() {
        $this->output->set_template('iluvproperty-mobile');
        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/jquery.validate.js');
        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/login_validation.js');
        $data['headingName'] = 'Create Account';
        $data['backLink'] = $this->config->item('base_url') . 'login/mobile';
        $this->load->section('header_section', 'common/mobile_single_header', $data);
// $this->load->section('navigation_section', 'common/navigation');
        $this->load->view('login/mobile_account');
// $this->load->section('footer_section', 'common/footer');
    }

    public function submit($action = 'signin') {

        if ($action == "signin") {
            $this->form_validation->set_rules('login_email', 'Email', 'required|trim|xss_clean');
            $this->form_validation->set_rules('login_password', 'Password', 'required|trim|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                exit;
            } else {

                $result = $this->Login_Model->check_login($this->input->post('login_email'), $this->input->post('login_password'));
                if (!$result) {
                    echo 'Login Incorrect!!!';
                    exit;
                } else {
                    if ($result[0]['emailApproval'] == "N") {
                        echo 'Email not approved!!!';
                        exit;
                    } else {
                        $logindata = array('logged_website' => time(), 'logged_website_user_id' => $result[0]['sn'], 'logged_website_user_email' => $result[0]['email']);
//print_r($result);
                        $this->session->set_userdata($logindata);
                        echo "true";
                        exit;
                    }
                }
            }
        }
        if ($action == "register") {
            $sn = $this->input->post('sn');
            $this->form_validation->set_rules('firstname', 'First name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('lastname', 'First name', 'required|trim|xss_clean');
            if ($sn == 0) {
                $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|is_unique[mo_websiteuseragents.email]|valid_email|callback_isEmailExist');
                $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|trim|xss_clean|matches[password]');
            }
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                exit;
            } else {

                $activationNo = random_string('alnum', 16);
                if ($sn == 0) {
                    $dataArr = array(
                        'firstName' => $this->input->post('firstname'),
                        'lastName' => $this->input->post('lastname'),
                        'email' => $this->input->post('email'),
                        'activationNo' => $activationNo,
                        'dateCreated' => date("Y-m-d H:i:s"),
                        'password' => md5($this->input->post('password')),
                    );
                } else {
                    $dataArr = array(
                        'firstName' => $this->input->post('firstname'),
                        'lastName' => $this->input->post('lastname'),
                        'dateModified' => date("Y-m-d H:i:s")
                    );
                    if (!empty($this->input->post('password'))) {
                        $dataArr['password'] = md5($this->input->post('password'));
                    }
                }
                $filename = "";
                $uploadPath = $this->config->item('profileUploadPath');
                if (!empty($_FILES)) {
                    $count = count($_FILES['image']['size']);
                    foreach ($_FILES as $key => $value) {
                        for ($s = 0; $s <= $count - 1; $s++) {
                            if ($s == 0) {
                                $_FILES['image']['name'] = $value['name'][$s];
                                $_FILES['image']['type'] = $value['type'][$s];
                                $_FILES['image']['tmp_name'] = $value['tmp_name'][$s];
                                $_FILES['image']['error'] = $value['error'][$s];
                                $_FILES['image']['size'] = $value['size'][$s];


                                $return = $this->Common_Model->uploadImages($_FILES, $uploadPath, 'image', "200", "3000", "3000");
                                $filename = $return['upload_data']['file_name'];

                                echo $this->Common_Model->resizingImage($filename, $uploadPath, "300", "300", $uploadPath . "m_" . $filename);
                                echo $this->Common_Model->resizingImage($filename, $uploadPath, "150", "150", $uploadPath . "t_" . $filename);
                            }
                        }
                    }
                }

                if (!empty($filename)) {
                    $dataArr['imageName'] = $filename;
                }

                try {
                    if ($sn == 0) {
                        $this->Common_Model->insertCommonTableGetSN($dataArr, 0, 'mo_websiteuseragents');
                    } else {
                        $this->Common_Model->saveCommonTable($dataArr, $sn, 'mo_websiteuseragents');
                    }
                } catch (Exception $e) {
                    log_message('error', 'Can\'t insert into websiteuseragents ' . var_dump($dataArr));
                }
                if ($sn == 0) {
                    //Sending Email
                    try {

                        $from = $this->config->item('ownerURL');
                        $fromName = $this->config->item('ownerName');
                        $to = $this->input->post('email');
                        $message = 'Click the link below to activate your account' . anchor(base_url() . 'login/account_activation/' . $activationNo, 'Confirmation Register');
                        $subject = 'Registration Confirmation';
                        $this->Common_Model->sendEmail($from, $fromName, $to, '', '', $message, $subject);
                    } catch (Exception $e) {
                        log_message('error', 'Can\'t send activation email to user ' . var_dump($dataArr));
                    }
                }
                echo "true";
                exit;
            }
        }
    }

    public function account_activation($activationNo='', $view = '') {
        if ($activationNo == '') {
            echo 'Error!!! no registration code in URL';
            exit();
        }
        $reg_confirm = $this->Login_Model->confirm_registration($activationNo);
        $this->load->section('header_section', 'common/header');
        $this->load->section('navigation_section', 'common/navigation');
        if ($reg_confirm) {
            $data['response'] = 'You are successfully activated.';
        } else {
            $data['response'] = 'You have failed to register.';
        }
        if ($view == "desktop") {
            $this->load->view('login/activationResponse', $data);
            $this->load->section('footer_section', 'common/footer');
        } else {
            $this->output->set_template('iluvproperty-mobile');
            $data['headingName'] = '&nbsp;';
            $data['backLink'] = $this->config->item('base_url') . 'login/mobile';
            $this->load->section('header_section', 'common/mobile_single_header', $data);
            $this->load->view('login/mobileActivationResponse');
        }
    }

    public function mobile_account_activation($activationNo) {
        if ($activationNo == '') {
            echo 'Error!!! no registration code in URL';
            exit();
        }
        $reg_confirm = $this->Login_Model->confirm_registration($activationNo);
        $this->load->section('header_section', 'common/header');
        $this->load->section('navigation_section', 'common/navigation');
        if ($reg_confirm) {
            $data['response'] = 'You are successfully activated.';
        } else {
            $data['response'] = 'You have failed to register.';
        }
        $this->load->view('login/activationResponse', $data);

        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/jquery.validate.js');
        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/login_validation.js');
    }

}
