<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class P_toko extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->helper('download');
$this->load->helper('form');
$this->load->library('session');
$this->load->library('datatables');
if(!$this->session->userdata('email') && !$this->session->userdata('username') && !$this->session->userdata('level') ){
redirect(base_url()); 
}elseif ($this->session->userdata('level') != 'super admin' && $this->session->userdata('level') != 'admin toko') {
redirect(base_url('Kasir'));         
}

}
public function index(){
$this->load->view('umum/V_header');
$this->load->view('P_toko/V_toko');
$this->load->view('umum/V_footer');
}

public function menu_toko(){
$this->load->view('umum/V_header');
$this->load->view('P_toko/V_menu_toko');
$this->load->view('umum/V_footer');

}
public function data_menu(){

$data = $this->db->get('menu_toko');


echo "
<table style='width:100%;' class='table-condensed table-bordered table-hover table-striped'>
<tr>
<th>No</th>
<th>Nama</th>
<th>Aksi</th>
</tr>";
$i =1;
foreach ($data->result_array() as $menu){
echo "<tr>"
. "<td>".$i++."</td>"
. "<td>".$menu['nama_menu']."</td>"
." <td> <button onclick='hapus_menu(".$menu['id_menu'].");' class='btn btn-danger'><span class='fa fa-close'></span></button> </td></td></tr>";

}

echo "</table>";


}

public function simpan_menu(){
if($this->input->post('nama_menu')){
$data = array(
'nama_menu' =>$this->input->post('nama_menu'),

);

$this->db->insert('menu_toko',$data);

}

}

public function hapus_menu(){
$id_menu = $this->input->post('id_menu');

$this->db->delete('menu_toko', array('id_menu' => $id_menu ));
}

public function set_produk_toko(){
$data = $this->db->get('data_produk');
$data_menu = $this->db->get('menu_toko');

$this->load->view('umum/V_header');
$this->load->view('P_toko/V_set_produk_toko',['data'=>$data,'data_menu'=>$data_menu]);
$this->load->view('umum/V_footer');

}

public function update_kategori_produk(){

if($this->input->post('kategori')){


$data = array(
'kategori' =>$this->input->post('kategori'),
);

$this->db->update('data_produk',$data,array('id_produk'=>$this->input->post('id_produk')));

}
}
public function banner_toko(){
$this->load->view('umum/V_header');
$this->load->view('P_toko/V_banner_toko');
$this->load->view('umum/V_footer');

}
public function simpan_banner(){
$config['upload_path']          = './uploads/banner/';
$config['allowed_types']        = 'gif|jpg|png';
$config['encrypt_name']        = TRUE;

$this->load->library('upload', $config);

if ( ! $this->upload->do_upload('banner'))
{
echo print_r($this->upload->display_errors());
}
else
{
$data = array(
'nama_banner' =>$this->upload->data('file_name'),
);
$this->db->insert('banner',$data);

redirect('P_toko/banner_toko');
}

}
public function data_banner(){

$data = $this->db->get('banner');


echo "
<table style='width:100%;' class='table-condensed table-bordered table-hover table-striped'>
<tr>
<th>No</th>
<th>Gambar banner</th>
<th>Aksi</th>
</tr>";
$i =1;
foreach ($data->result_array() as $banner){
echo "<tr>"
. "<td>".$i++."</td>"
. "<td><img style='width:auto; height:100px;' src='".base_url("/uploads/banner/".$banner['nama_banner'])."'></td>"
." <td> <button onclick='hapus_banner(".$banner['id_banner'].");' class='btn btn-danger'><span class='fa fa-close'></span></button> </td></td></tr>";

}

echo "</table>";


}
public function set_api_ongkir(){
$this->load->view('umum/V_header');
$this->load->view('P_toko/V_ongkir');
$this->load->view('umum/V_footer');

}
public function simpan_api_ongkir(){

if($this->input->post('api_ongkir')){

$data = array(
'api_key' => $this->input->post('api_ongkir'),
);

$this->db->update('api_raja_ongkir',$data,array('id_api'=>'1'));

}
}

public function tampil_api(){

$data = $this->db->get('api_raja_ongkir')->row_array();

echo "<h3>".$data['api_key']."</H3>";
}

public function hapus_banner(){
$id_banner= $this->input->post('id_banner');

$this->db->delete('banner', array('id_banner' => $id_banner ));
}

}


