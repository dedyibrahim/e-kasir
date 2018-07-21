<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->helper('url');
$this->load->library('session');

if(!$this->session->userdata('email') && !$this->session->userdata('username') && !$this->session->userdata('level') ){
redirect(base_url()); 
}
}
public function index(){
$this->load->view('umum/V_header');
$this->load->view('V_dashboard');
$this->load->view('umum/V_footer');

}



}
