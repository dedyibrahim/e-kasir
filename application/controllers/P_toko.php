<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class P_toko extends CI_Controller{
    public function __construct() {
        parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->helper('download');
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
$i =0;
foreach ($data->result_array() as $menu){
    echo "<tr>"
       . "<td>".$i++."</td>"
       . "<td>".$menu['nama_menu']."</td>"
       ." <td> <button onclick='hapus_menu(".$menu['id_menu'].",".$menu['nama_menu'].");' class='btn btn-danger'><span class='fa fa-close'></span></button> </td></td></tr>";
    
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

}


