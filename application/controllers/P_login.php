<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class P_login extends CI_Controller{
public function __construct() {
parent::__construct();

$this->load->helper('url');
$this->load->database();
$this->load->library('session');



}
public function index(){
$this->load->view('V_login');
if($this->session->userdata('username') !=''){
    
    redirect(base_url('Kasir'));
}

}

public function login(){
$email = $this->input->post('email');
$password = $this->input->post('password');
$this->load->model('M_login');
$data = $this->M_login->login($email,$password);

if($data != NULL){

foreach ($data->result_array() as $akun){
$akun = array(
'username' => $akun['username'],
'email'    => $akun['email'],
'level'    => $akun['level'],

 );
$this->session->set_userdata($akun);

echo "success";
}
}else{
}


}
public function keluar(){
    $this->session->sess_destroy();
    redirect(base_url());
}


}
