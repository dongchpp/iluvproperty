<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
// Your own constructor code
        $this->_init();
    }

    private function _init() {
        $this->output->set_template('iluvproperty');
        $this->load->model('Admin_Model');
        $this->load->model('Common_Model');
        $this->load->library('form_validation');
        if (empty($this->session->userdata('logged_website_user_id'))) {
            redirect('login/mobile');
        }
    }

    public function index() {
        
    }

    public function getParent($regionSN) {
        $this->output->unset_template();
        $dataArr = array('regionListSN' => $regionSN);
        $result = $this->Common_Model->getCommonTable($dataArr, 'mo_regionlist');
        echo json_encode($result, true);
    }

    public function listing_mobile($action = 'view', $listingSN = 0, $status = '', $deleteImagesSN = 0, $listingMasterSN = 0) {
        $this->output->set_template('iluvproperty-mobile');
        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/jquery.validate.js');
        if ($action == "detail") {
            $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/idangerous.swiper.js');
            $this->load->css($this->config->item('mobileThemeManualURL') . 'assets/css/idangerous.swiper.css');
        }
        $footerArr = array();
        $data['status'] = trim(urldecode($status));
        if ($action == "add" || $action == "edit" || $action == "detail") {
            $data['headingName'] = ($action == "add" ? 'Add' : ($action == "detail" ? "View" : 'Edit')) . ' Listing';
            $data['backLink'] = $this->config->item('base_url') . 'admin/listing_mobile';
            $this->load->section('header_section', 'common/mobile_single_header', $data);
            $data['listingSN'] = $listingSN;
            $data['apartmentTypeArr'] = $this->Admin_Model->getListingsTypes('AT', 'Y');
            $data['listingTypeArr'] = $this->Admin_Model->getListingsTypes('LT', 'Y');
            $data['listingStatusArr'] = $this->Admin_Model->getListingsTypes('LS', 'Y');
            $data['userListingArr'] = array();
            $data['userListingImagesArr'] = array();
            $data['listingSN'] = $listingSN;
            if ($action == "edit" || $action == "detail") {
                if ($action == "edit") {
                    $dataArr = array('sn' => $listingSN, 'userAgentSN' => $this->session->userdata('logged_website_user_id'));
                } else {
                    $dataArr = array('sn' => $listingSN);
                }
                $userListingArr = $this->Common_Model->getCommonTable($dataArr, 'mo_userlistings');
                if (!empty($userListingArr)) {
                    $data['userListingArr'] = $userListingArr[0];
                    $dataArr = array('userListingSN' => $listingSN);
                    $data['userListingImagesArr'] = $this->Common_Model->getCommonTable($dataArr, 'mo_userlistingimages');
                    $dataArr = array('sn' => $userListingArr[0]['userAgentSN']);
                    $userProfileArr = $this->Common_Model->getCommonTable($dataArr, 'mo_websiteuseragents');
                    $data['userProfileArr'] = $userProfileArr[0];
                } else {
                    redirect($this->config->item('base_url') . 'admin/listing_mobile/view/0/The listing you are trying to edit not belong to you. Please do not play wth us.');
                    exit;
                }
            }
            if ($action == "detail") {
                $this->load->view('listing/mobile_listing_detail', $data);
            } else {
                $this->load->view('listing/mobile_listing_add', $data);
            }
            //footer Part

            $footerArr[] = array('name' => 'Search Listings', 'href' => 'admin/listing_mobile', 'class' => ($action == "view" ? 'redBgColor' : ""), 'icon' => 'search');
            $footerArr[] = array('name' => 'My Listings', 'href' => 'admin/listing_mobile/mylisting', 'class' => ($action == "mylisting" ? 'redBgColor' : ""), 'icon' => 'search');
            $footerArr[] = array(
                'name' => ($action == "add" ? 'Add' : ($action == "detail" ? "View" : 'Edit')) . ' Property',
                'href' => 'admin/listing_mobile/' . ($action == "add" ? 'add' : 'edit' . $listingSN),
                'class' => ($action == "add" || $action == "edit" || $action == "detail" ? 'redBgColor' : ""),
                'icon' => ($action == "add" ? 'plus' : ($action == "detail" ? "check" : 'edit'))
            );
            $footerArr[] = array('name' => 'My Profile', 'href' => 'admin/mobile_myprofile', 'class' => '', 'icon' => 'info');
        } else if ($action == "deleteImages") {
            $dataArr = array('sn' => $deleteImagesSN, 'userListingSN' => $listingSN);
            $result = $this->Common_Model->deleteCommonTable($dataArr, 'mo_userlistingimages');
            redirect($this->config->item('base_url') . 'admin/listing_mobile/edit/' . $listingSN . '/Deleted');
        } else if ($action == "deleteListing") {
            $dataArr = array('sn' => $listingSN);
            $result = $this->Common_Model->deleteCommonTable($dataArr, 'mo_userlistings');
            //get Images By Listing SN
            $dataArr = array('userListingSN' => $listingSN);
            $userListingImagesArr = $this->Common_Model->getCommonTable($dataArr, 'mo_userlistingimages');
            $uploadPath1 = $this->config->item('listingUploadPath');
            $uploadPath = $uploadPath1 . $this->session->userdata('logged_website_user_id');
            $uploadPath .= "/";
            foreach ($userListingImagesArr as $userListingImage) {
                if (!empty($userListingImage['imageName'])) {
                    unlink($uploadPath . $userListingImage['imageName']);
                }
            }
            $dataArr = array('userListingSN' => $listingSN);
            $result = $this->Common_Model->deleteCommonTable($dataArr, 'mo_userlistingimages');

            redirect($this->config->item('base_url') . 'admin/listing_mobile/view/0/Deleted');
        } else {
            $postDataArr = array();
            if ($this->input->post('countrySN')) {
                $postDataArr['countrySN'] = $this->input->post('countrySN');
            }
            if ($this->input->post('regionSN')) {
                $postDataArr['regionSN'] = $this->input->post('regionSN');
            }
            if ($this->input->post('districtSN')) {
                $postDataArr['districtSN'] = $this->input->post('districtSN');
            }
            if ($this->input->post('suburbSN')) {
                $postDataArr['suburbSN'] = $this->input->post('suburbSN');
            }
            $queryString = '';
            if ($this->input->post()) {
                if (!empty($_POST['beds']['MIN']) && $_POST['beds']['MIN'] > 0) {
                    $queryString .= " and beds >= " . $_POST['beds']['MIN'];
                }
                if (!empty(trim($_POST['beds']['MAX']))) {
                    $queryString .= " and beds <= " . $this->input->post('beds')['MAX'];
                }
                if (!empty($_POST['bath']['MIN']) && $_POST['bath']['MIN'] > 0) {
                    $queryString .= " and bath >= " . $_POST['bath']['MIN'];
                }
                if (!empty($_POST['bath']['MAX']) && $_POST['bath']['MAX'] > 0) {
                    $queryString .= " and bath <= " . $_POST['bath']['MAX'];
                }
                if (!empty($_POST['carpark']['MIN']) && $_POST['carpark']['MIN'] > 0) {
                    $queryString .= " and carpark >= " . $_POST['carpark']['MIN'];
                }
                if (!empty($_POST['carpark']['MAX']) && $_POST['carpark']['MAX'] > 0) {
                    $queryString .= " and carpark <= " . $_POST['carpark']['MAX'];
                }
                $postDataArr['queryString'] = $queryString;
            }

            if ($action == "mylisting") {
                //echo "User Id".$this->session->userdata('logged_website_user_id');
                if ($listingMasterSN > 0) {
                    $data['listingArr'] = $this->Admin_Model->getListingsByUserID($postDataArr, $this->session->userdata('logged_website_user_id'), $listingMasterSN);
                } else {
                    $data['listingArr'] = $this->Admin_Model->getListingsByUserID($postDataArr, $this->session->userdata('logged_website_user_id'));
                }
            } else if ($action != "mylisting" && $listingMasterSN > 0) {
                $data['listingArr'] = $this->Admin_Model->getListingsByUserID($postDataArr, 0, $listingMasterSN);
            } else {
                $data['listingArr'] = $this->Admin_Model->getListingsByUserID($postDataArr);
            }

            // echo $listingMasterSN;
            //$data['listingArr'] = $this->Admin_Model->getListingsByUserID($this->session->userdata('logged_website_user_id'));
            $data['headingName'] = count($data['listingArr']) . ' Listings';
            $data['backLink'] = $this->config->item('base_url') . 'admin/listing_mobile';
            $this->load->section('header_section', 'common/mobile_single_header', $data);

            $activeClass = '';
            if ($listingMasterSN == 6) {
                $activeClass = 'redBgColor';
            }
            $filterArr[] = array('name' => 'For Sale', 'href' => 'admin/listing_mobile/' . $action . '/0/ /0/6', 'class' => $activeClass, 'icon' => 'home');
            $activeClass = '';
            if ($listingMasterSN == 7) {
                $activeClass = 'redBgColor';
            }
            $filterArr[] = array('name' => 'For Rent', 'href' => 'admin/listing_mobile/' . $action . '/0/ /0/7', 'class' => $activeClass, 'icon' => 'home');
            $data['footerArr'] = $filterArr;
            $this->load->section('common_section', 'common/mobile_footer', $data);

            $this->load->view('listing/mobile_view', $data);

            //footer Part
            $footerArr[] = array('name' => 'Search Listings', 'href' => 'admin/listing_mobile', 'class' => ($action == "view" ? 'redBgColor' : ""), 'icon' => 'search');
            $footerArr[] = array('name' => 'My Listings', 'href' => 'admin/listing_mobile/mylisting', 'class' => ($action == "mylisting" ? 'redBgColor' : ""), 'icon' => 'search');
            $footerArr[] = array('name' => 'List Property', 'href' => 'admin/listing_mobile/add', 'class' => ($action == "add" ? 'redBgColor' : ""), 'icon' => 'plus');
            $footerArr[] = array('name' => 'My Profile', 'href' => 'admin/mobile_myprofile', 'class' => '', 'icon' => 'user');
            //$footerArr[] = array('name' => 'About us', 'href' => 'admin/listing_mobile', 'class' => '', 'icon' => 'info');
        }
        $data['footerArr'] = $footerArr;
        $this->load->section('footer_section', 'common/mobile_footer', $data);
    }

    public function listing_submit() {
        $this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean');
        $this->form_validation->set_rules('countrySN', 'Country', 'required|trim|xss_clean');
        $this->form_validation->set_rules('regionSN', 'Region', 'required|trim|xss_clean');
        $this->form_validation->set_rules('districtSN', 'District', 'required|trim|xss_clean');
        $this->form_validation->set_rules('suburbSN', 'Suburb', 'required|trim|xss_clean');
        $this->form_validation->set_rules('apartmentTypeSN', 'Property Type', 'required|trim|xss_clean');
        $this->form_validation->set_rules('listingTypeSN', 'Listing Type', 'required|trim|xss_clean');
        $this->form_validation->set_rules('beds', 'Bedrooms', 'required|trim|xss_clean');
        $this->form_validation->set_rules('bath', 'Bathrooms', 'required|trim|xss_clean');
        $this->form_validation->set_rules('carpark', 'Car parks', 'required|trim|xss_clean');
        $this->form_validation->set_rules('sqFt', 'Sqm/Ft', 'required|trim|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            exit;
        } else {
            $dataArr = array(
                'title' => $this->input->post('title'),
                'address' => $this->input->post('address'),
                'suburbSN' => $this->input->post('suburbSN'),
                'districtSN' => $this->input->post('districtSN'),
                'regionSN' => $this->input->post('regionSN'),
                'countrySN' => $this->input->post('countrySN'),
                'apartmentTypeSN' => (!empty($this->input->post('apartmentTypeSN')) ? $this->input->post('apartmentTypeSN') : "0"),
                'listingTypeSN' => (!empty($this->input->post('listingTypeSN')) ? $this->input->post('listingTypeSN') : "0"),
                'listingStatusSN' => (!empty($this->input->post('listingStatusSN')) ? $this->input->post('listingStatusSN') : "0"),
                'availableFrom' => (!empty($this->input->post('availableFrom')) ? $this->input->post('availableFrom') : "0000-00-00"),
                'availableTo' => (!empty($this->input->post('availableTo')) ? $this->input->post('availableTo') : "0000-00-00"),
                'auctionDescription' => (!empty($this->input->post('auctionDescription')) ? $this->input->post('auctionDescription') : ""),
                'price' => (!empty($this->input->post('price')) ? $this->input->post('price') : "0"),
                'beds' => (!empty($this->input->post('beds')) ? $this->input->post('beds') : "0"),
                'bath' => (!empty($this->input->post('bath')) ? $this->input->post('bath') : "0"),
                'carpark' => (!empty($this->input->post('carpark')) ? $this->input->post('carpark') : "0"),
                'sqFt' => (!empty($this->input->post('sqFt')) ? $this->input->post('sqFt') : "0"),
                'description' => $this->input->post('description'),
                'userAgentSN' => $this->session->userdata('logged_website_user_id')
            );
            $sn = $this->input->post('listingSN');

            if ($sn == 0) {
                $sn = $this->Common_Model->insertCommonTableGetSN($dataArr, 0, 'mo_userlistings');
                $dataArr = array(
                    'dateCreated' => date("Y-m-d H:i:s"),
                    'customId' => date("Y-m-d") . $sn
                );
                $this->Common_Model->saveCommonTable($dataArr, $sn, 'mo_userlistings');
            } else {
                $dataArr['dateModified'] = date("Y-m-d H:i:s");
                $this->Common_Model->saveCommonTable($dataArr, $sn, 'mo_userlistings');
            }


            $uploadPath1 = $this->config->item('listingUploadPath');
            $uploadPath = $uploadPath1 . $this->session->userdata('logged_website_user_id');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, TRUE);
            }
            $uploadPath .= "/";
            if (!empty($_FILES)) {
                $count = count($_FILES['image']['size']);
                foreach ($_FILES as $key => $value) {
                    for ($s = 0; $s <= $count - 1; $s++) {

                        $_FILES['image']['name'] = $value['name'][$s];
                        $_FILES['image']['type'] = $value['type'][$s];
                        $_FILES['image']['tmp_name'] = $value['tmp_name'][$s];
                        $_FILES['image']['error'] = $value['error'][$s];
                        $_FILES['image']['size'] = $value['size'][$s];


                        $return = $this->Common_Model->uploadImages($_FILES, $uploadPath, 'image', "200", "3000", "3000");
                        $filename = $return['upload_data']['file_name'];
                        $this->Common_Model->resizingImage($filename, $uploadPath, "600", "600", $uploadPath . "m_" . $filename);

                        $this->Common_Model->resizingImage($filename, $uploadPath, "150", "150", $uploadPath . "t_" . $filename);
                        $dataArr = array(
                            'userListingSN' => $sn,
                            'imageName' => $filename,
                            'status' => "Y",
                            'dateCreated' => date("Y-m-d H:i:s")
                        );
                        $this->Common_Model->saveCommonTable($dataArr, 0, 'mo_userlistingimages');
                    }
                }
            }
        }

        echo "true";
        exit;
    }

    public function mobile_myprofile() {
        $this->output->set_template('iluvproperty-mobile');
        $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/jquery.validate.js');
        //$this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/login_validation.js');
        $data['headingName'] = 'My Profile';
        $data['backLink'] = $this->config->item('base_url') . 'admin/listing_mobile';
        $this->load->section('header_section', 'common/mobile_single_header', $data);

        $dataArr = array('sn' => $this->session->userdata('logged_website_user_id'));
        $userProfileArr = $this->Common_Model->getCommonTable($dataArr, 'mo_websiteuseragents');
        $data['userProfileArr'] = $userProfileArr[0];
        $this->load->view('admin/myprofile', $data);

        //footer Part
        $footerArr[] = array('name' => 'Search Listings', 'href' => 'admin/listing_mobile', 'class' => '', 'icon' => 'search');
        $footerArr[] = array('name' => 'My Listings', 'href' => 'admin/listing_mobile/mylisting', 'class' => '', 'icon' => 'search');
        $footerArr[] = array('name' => 'My Profile', 'href' => 'admin/mobile_myprofile', 'class' => 'redBgColor', 'icon' => 'user');
        $footerArr[] = array('name' => 'About us', 'href' => 'admin/info/aboutus/About us', 'class' => '', 'icon' => 'info');
        $data['footerArr'] = $footerArr;
        $this->load->section('footer_section', 'common/mobile_footer', $data);
    }

    public function info($action = 'aboutus', $pageName = 'About us') {
        $this->output->set_template('iluvproperty-mobile');
        $data['headingName'] = urldecode($pageName);
        $data['backLink'] = $this->config->item('base_url') . 'admin/mobile_myprofile';
        $this->load->section('header_section', 'common/mobile_single_header', $data);

        $this->load->view('info/' . $action);

        //footer Part
        $footerArr[] = array('name' => 'My Listings', 'href' => 'admin/listing_mobile/mylisting', 'class' => '', 'icon' => 'search');
        $footerArr[] = array('name' => 'My Profile', 'href' => 'admin/mobile_myprofile', 'class' => '', 'icon' => 'user');
        $footerArr[] = array('name' => urldecode($pageName), 'href' => 'admin/info/' . $action . '/' . urldecode($pageName), 'class' => 'redBgColor', 'icon' => 'info');
        $data['footerArr'] = $footerArr;
        $this->load->section('footer_section', 'common/mobile_footer', $data);
    }

    public function mobile_enquire($listingSN = '', $userSN = '') {

        if ($userSN == '') {
            $this->output->set_template('iluvproperty-mobile');
            $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/jquery.validate.js');
            //$this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/login_validation.js');
            $data['headingName'] = 'Enquire More Information';
            $data['backLink'] = $this->config->item('base_url') . 'admin/listing_mobile';
            $this->load->section('header_section', 'common/mobile_single_header', $data);


            $dataArr = array('sn' => $this->session->userdata('logged_website_user_id'));
            $userProfileArr = $this->Common_Model->getCommonTable($dataArr, 'mo_websiteuseragents');
            $data['userProfileArr'] = $userProfileArr[0];

            $listingArr = array('sn' => $listingSN);
            $userProfileArr = $this->Common_Model->getCommonTable($listingArr, 'mo_userlistings');

            $tempuseragentsn = $userProfileArr[0]['userAgentSN'];
            $listingArr2 = array('sn' => $tempuseragentsn);
            $userProfileArr2 = $this->Common_Model->getCommonTable($listingArr2, 'mo_websiteuseragents');
            $data['toUserArr'] = $userProfileArr2[0];

//        $listingArr3 = array('sn' => $listingSN);
            $userProfileArr3 = $this->Common_Model->getCommonTable($listingArr, 'mo_userlistings');
            $data['listingArr'] = $userProfileArr3[0];

            $this->load->view('listing/mobile_enquire', $data);
        } else {
            $this->output->set_template('iluvproperty-mobile');
            $this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/jquery.validate.js');
            //$this->load->js($this->config->item('mobileThemeManualURL') . 'assets/js/login_validation.js');
            $data['headingName'] = 'Enquire History';
            $data['backLink'] = $this->config->item('base_url') . 'admin/listing_mobile';
            $this->load->section('header_section', 'common/mobile_single_header', $data);


            
            $sql = "SELECT * FROM `mo_userenquiry` where  (userSN = ".$userSN.
                    " and  userAgentSN = ". $this->session->userdata('logged_website_user_id').
                    " and  userListingSN = ". $listingSN.
                                          "  ) or ( userSN = ".$this->session->userdata('logged_website_user_id').
                    " and  userAgentSN = ".$userSN.
                    " and  userListingSN = ". $listingSN.
                    " ) order by dateCreated " ;
            $data['enquireArr'] = $this->db->query($sql)->result();
                        
            
            $dataArr = array('sn' => $this->session->userdata('logged_website_user_id'));
            $userProfileArr = $this->Common_Model->getCommonTable($dataArr, 'mo_websiteuseragents');
            $data['userProfileArr'] = $userProfileArr[0];

            $listingArr = array('sn' => $listingSN);
            $userProfileArr = $this->Common_Model->getCommonTable($listingArr, 'mo_userlistings');

            $tempuseragentsn = $userProfileArr[0]['userAgentSN'];
            $listingArr2 = array('sn' => $tempuseragentsn);
            $userProfileArr2 = $this->Common_Model->getCommonTable($listingArr2, 'mo_websiteuseragents');
            $data['toUserArr'] = $userProfileArr2[0];

//        $listingArr3 = array('sn' => $listingSN);
            $userProfileArr3 = $this->Common_Model->getCommonTable($listingArr, 'mo_userlistings');
            $data['listingArr'] = $userProfileArr3[0];

            $this->load->view('listing/mobile_enquire', $data);
            
        }

        //footer Part
        $footerArr[] = array('name' => 'Search Listings', 'href' => 'admin/listing_mobile', 'class' => 'ui-btn-active', 'icon' => 'search');
        $footerArr[] = array('name' => 'My Listings', 'href' => 'admin/listing_mobile/mylisting', 'class' => '', 'icon' => 'search');
        $footerArr[] = array('name' => 'My Profile', 'href' => 'admin/mobile_myprofile', 'class' => '', 'icon' => 'user');
        $footerArr[] = array('name' => 'About us', 'href' => 'admin/info/aboutus/About us', 'class' => '', 'icon' => 'info');
        $data['footerArr'] = $footerArr;
        $this->load->section('footer_section', 'common/mobile_footer', $data);
    }

    public function enquire_submit() {


        $sn = $this->input->post('sn');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            exit;
        } else {

            $dataArr = array(
                'userSN' => $this->input->post('userSN'),
                'userAgentSN' => $this->input->post('userAgentSN'),
                'userListingSN' => $this->input->post('userListingSN'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'),
                'dateCreated' => date("Y-m-d H:i:s"),
            );

            try {
                $this->Common_Model->insertCommonTableGetSN($dataArr, 0, 'mo_userenquiry');
            } catch (Exception $e) {
                log_message('error', 'Can\'t insert into websiteuseragents ' . var_dump($dataArr));
            }
//Sending Email
            try {

                $from = $this->config->item('ownerURL');
                $fromName = $this->config->item('ownerName');
                $to = $this->input->post('email');
                $message = "From user:  " . $this->input->post('useremail') . "  " . $this->input->post('message');
                $subject = $this->input->post('subject');

                $this->Common_Model->sendEmail($from, $fromName, $to, '', '', $message, $subject);
            } catch (Exception $e) {
                log_message('error', 'Can\'t send activation email to user ' . var_dump($dataArr));
            }
            echo "true";
            exit;
        }
    }

//end of     public function enquire_submit() {
////    public function getEnquiry($box = "inbox") {
////
////        $this->output->set_template('iluvproperty-mobile');
////        $data['headingName'] = 'Dashboard'; //urldecode($pageName);
////        $data['backLink'] = $this->config->item('base_url') . 'admin/listing_mobile';
////        $this->load->section('header_section', 'common/mobile_single_header', $data);
////
////
////
////        if ($box == "inbox") {
////            $dataArr = array('userAgentSN' => $this->session->userdata('logged_website_user_id'));
////            $userProfileArr = $this->Common_Model->getCommonTable($dataArr, 'mo_userenquiry');
////
////            $data['userProfileArr'] = $userProfileArr;
////            $this->load->view('enquiry/enquiryList', $data);
////        } else {
////            
////        }
//
//
//
//
//        //footer Part
//        $footerArr[] = array('name' => 'Search Listings', 'href' => 'admin/listing_mobile', 'class' => 'ui-btn-active', 'icon' => 'search');
//        $footerArr[] = array('name' => 'My Listings', 'href' => 'admin/listing_mobile/mylisting', 'class' => '', 'icon' => 'search');
//        $footerArr[] = array('name' => 'My Profile', 'href' => 'admin/mobile_myprofile', 'class' => '', 'icon' => 'user');
//        $footerArr[] = array('name' => 'About us', 'href' => 'admin/info/aboutus/About us', 'class' => '', 'icon' => 'info');
//        $data['footerArr'] = $footerArr;
//        $this->load->section('footer_section', 'common/mobile_footer', $data);
//    }
// end of public function getEnquiry($box="inbox")

    public function enquiry_dashboard($box = "inbox") {
        $this->output->set_template('iluvproperty-mobile');
        $data['headingName'] = 'Enquiry Dashboard'; //urldecode($pageName);
        $data['backLink'] = $this->config->item('base_url') . 'admin/listing_mobile';
        $this->load->section('header_section', 'common/mobile_single_header', $data);

        //2 start of message box title
        $sql = "SELECT count(*) as countTemp FROM `mo_userenquiry` WHERE `userAgentSN`= " . $this->session->userdata('logged_website_user_id') . " AND `dateFirstRead`='0000-00-00 00:00:00'";
        $data['userProfileArr'] = $this->db->query($sql)->result();

        $countText = "";
        if ($data['userProfileArr'][0]->countTemp > 0) {
            $countText = "(" . $data['userProfileArr'][0]->countTemp . ")";
            $changeColor = "redColor";
        } else {
            $changeColor = "";
        }

        $filterArr[] = array('name' => 'Enquiry Box' . $countText, 'href' => '#', 'class' => "redColor", 'icon' => 'mail');
        $data['footerArr'] = $filterArr;
        $this->load->section('common_section', 'common/mobile_footer', $data);
        //2 end  of message box title
        //3 start of content of enquiry
        $sql = "select q2.* ,user2.`firstName` ,user2.`lastName`, listing.`title` from (select `userSN`, `userListingSN`,`subject`,`message`, `dateFirstRead`,`dateCreated`\n"
                . "FROM (select * from `mo_userenquiry` where `userAgentSN`=" . $this->session->userdata('logged_website_user_id') . " order by `dateFirstRead` asc , `dateCreated` desc) q1 group by `userSN`, `userListingSN`  order by `dateFirstRead` ) q2 left join `mo_websiteuseragents` user2\n"
                . "on q2.userSN = user2.`sn` \n"
                . "left join `mo_userlistings` listing\n"
                . "on q2.userListingSN = listing.`sn`";

        $data['enquiryArr'] = $this->db->query($sql)->result();
        $this->load->view('enquiry/enquiryList', $data);
//
//
//        $data['footerArr'] = $filterArr;
//        $this->load->section('common_section', 'enquiry/enquiryList', $data);
//
        //footer Part
        $footerArr[] = array('name' => 'Search Listings', 'href' => 'admin/listing_mobile', 'class' => 'ui-btn-active', 'icon' => 'search');
        $footerArr[] = array('name' => 'My Listings', 'href' => 'admin/listing_mobile/mylisting', 'class' => '', 'icon' => 'search');
        $footerArr[] = array('name' => 'My Profile', 'href' => 'admin/mobile_myprofile', 'class' => '', 'icon' => 'user');
        $footerArr[] = array('name' => 'About us', 'href' => 'admin/info/aboutus/About us', 'class' => '', 'icon' => 'info');
        $data['footerArr'] = $footerArr;
        $this->load->section('footer_section', 'common/mobile_footer', $data);
    }// end of     public function enquiry_dashboard($box = "inbox") {
}
