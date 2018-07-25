<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class P_aplikasi extends CI_Controller{
public function __construct() {
parent::__construct();

$this->load->helper('url');
$this->load->database();
$this->load->library('session');
if(!$this->session->userdata('email') && !$this->session->userdata('username') && !$this->session->userdata('level') ){
redirect(base_url()); 
}elseif ($this->session->userdata('level') != 'super admin') {
redirect(base_url('Kasir'));         
         
}
}
public function index(){

$this->load->view('umum/V_header');
$this->load->view('P_aplikasi/V_account');
$this->load->view('umum/V_footer');

}

public function simpan_akun(){


if($this->input->post('username')){

$data = array(
'level'    =>$this->input->post('level'),      
'username' =>$this->input->post('username'),      
'email'    =>$this->input->post('email'),
'password' =>MD5($this->input->post('password')),
);
$this->db->insert('account',$data);
}
}
public function data_akun(){
$data = $this->db->get('account');
    
    
echo "
<table style='width:100%;' class='table-condensed table-bordered table-hover table-striped'>
<tr>
<th>Nama lengkap</th>
<th>Email</th>
<th>Level</th>
<th>Aksi</th>
</tr>";

foreach ($data->result_array() as $akun){
    echo "<tr><td>".$akun['username']."</td><td>".$akun['email']."</td><td>".$akun['level']."</td>
    <td> <button onclick='hapus_akun(".$akun['id_account'].");' class='btn btn-danger'><span class='fa fa-close'></span></button> </td></td></tr>";
    
}

echo "</table>";

}
public function hapus_akun(){
    if($this->input->post('id_akun')){
    
        $this->db->delete('account',array('id_account'=>$this->input->post('id_akun')));
        
    }
}




}
