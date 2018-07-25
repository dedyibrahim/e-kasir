<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH .'third_party/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class P_produk extends CI_Controller {
public function __construct() {
parent::__construct();

$this->load->helper('url');
$this->load->database();
$this->load->helper('download');
$this->load->library('session');
$this->load->library('datatables');
$this->load->library('upload');
if(!$this->session->userdata('email') && !$this->session->userdata('username') && !$this->session->userdata('level') ){
redirect(base_url()); 
}elseif ($this->session->userdata('level') != 'super admin' && $this->session->userdata('level') != 'admin produk') {
redirect(base_url('Kasir'));         
}
}

public function index(){
$produk = $this->db->get('data_produk');
$this->load->view('umum/V_header');
$this->load->view('P_produk/V_produk',['produk'=>$produk]);
$this->load->view('umum/V_footer');

}
public function pabrik_mau_habis(){
$this->load->view('umum/V_header');
$this->load->view('P_produk/V_pabrik_mau_habis');
$this->load->view('umum/V_footer');

}
public function toko_mau_habis(){
$this->load->view('umum/V_header');
$this->load->view('P_produk/V_toko_mau_habis');
$this->load->view('umum/V_footer');

}
public function toko_sudah_habis(){
$this->load->view('umum/V_header');
$this->load->view('P_produk/V_toko_sudah_habis');
$this->load->view('umum/V_footer');

}

public function simpan_produk() {
if(isset($_POST['nama_produk'])){

$data = array(
'barcode'     => $this->input->post('barcode'),
'nama_produk' => $this->input->post('nama_produk'),
'harga_produk'=> $this->input->post('harga_produk'),
'stok_toko'   => $this->input->post('stok_toko'),
'stok_pabrik' => $this->input->post('stok_pabrik'),
'status_produk'=> $this->input->post('status_produk'),
);

$this->db->insert('data_produk',$data);

}else{
redirect(404);
}
}
public function json_produk_toko(){
$this->load->model('M_produk');
header('Content-Type: application/json');
echo $this->M_produk->json_produk_toko();       

}
public function json_produk_pabrik_mau_habis(){
$this->load->model('M_produk');
header('Content-Type: application/json');
echo $this->M_produk->json_produk_pabrik_mau_habis();       

}
public function json_produk_toko_mau_habis(){
$this->load->model('M_produk');
header('Content-Type: application/json');
echo $this->M_produk->json_produk_toko_mau_habis();       

}
public function json_produk_toko_sudah_habis(){
$this->load->model('M_produk');
header('Content-Type: application/json');
echo $this->M_produk->json_produk_toko_sudah_habis();       

}

public function hapus_produk(){
$id = $this->uri->segment(3);
if($id != ''){
$this->db->delete('data_produk',array('id_produk'=>$id));

redirect(base_url('P_produk'));
}else{
redirect(404);  
}


}
public function edit_produk(){
$id_produk = $this->uri->segment(3);    
$produk = $this->db->get_where('data_produk',array('id_produk'=>$id_produk));
$this->load->view('umum/V_header');
$this->load->view('P_produk/V_edit_produk',['produk'=>$produk]);
$this->load->view('umum/V_footer');

}

function upload_produk(){

}
public function update_produk() {
if(isset($_POST['nama_produk'])){

$data = array(
'barcode'     => $this->input->post('barcode'),
'nama_produk' => $this->input->post('nama_produk'),
'harga_produk'=> $this->input->post('harga_produk'),
'stok_toko'   => $this->input->post('stok_toko'),
'stok_pabrik' => $this->input->post('stok_pabrik'),
'berat'        => $this->input->post('berat'),
'status_produk'=> $this->input->post('status_produk'),
);

$this->db->update('data_produk',$data,array('id_produk'=>$this->input->post('id_produk')));

}else{
redirect(404);
}
}




public function upload_excel(){
$this->load->library('upload', $config3);
$config3['upload_path']          = './uploads/excel/';
$config3['allowed_types']        = 'xls|xlsx|ods|odt';
$config3['max_size']             = 100;
$config3['max_width']            = 1024;
$config3['max_height']           = 768;
$config3['encrypt_name']         = TRUE;

$this->upload->initialize($config3);

if (!$this->upload->do_upload('produk'))
{

echo print_r($this->upload->display_errors());

}
else
{
ini_set('memory_limit', '-1');
$inputFileName = './uploads/excel/'.$this->upload->data('file_name');
$spreadsheet = IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$jumlah = count($sheetData);

for($i=2; $i<$jumlah; $i++){

$data_upload =array(

'barcode'      =>!empty($sheetData[$i]['B'])?$sheetData[$i]['B']:'',
'nama_produk'  =>!empty($sheetData[$i]['C'])?$sheetData[$i]['C']:'',    
'harga_produk' =>!empty($sheetData[$i]['D'])?$sheetData[$i]['D']:'',    
'deskripsi'    =>!empty($sheetData[$i]['E'])?$sheetData[$i]['E']:'',    
'berat'        =>!empty($sheetData[$i]['F'])?$sheetData[$i]['F']:'',    
'stok_toko'    =>!empty($sheetData[$i]['G'])?$sheetData[$i]['G']:'',    
'stok_pabrik'  =>!empty($sheetData[$i]['H'])?$sheetData[$i]['H']:'',    
'status_produk'=>'Aktif',    
);

$this->db->insert('data_produk',$data_upload);
}
unlink('./uploads/excel/'.$this->upload->data('file_name'));    
redirect(base_url('P_produk')); 

}



}
public function download_tamplate_excel(){

force_download('./assets/excel/tamplate_produk.xlsx', NULL);

}

public function proses_upload()
{
$F = array();
$count_uploaded_files = count( $_FILES['images']['name'] );
$files = $_FILES;
for( $i = 0; $i < $count_uploaded_files; $i++ )
{
$_FILES['userfile'] = [
'name'     => $files['images']['name'][$i],
'type'     => $files['images']['type'][$i],
'tmp_name' => $files['images']['tmp_name'][$i],
'error'    => $files['images']['error'][$i],
'size'     => $files['images']['size'][$i]
];
$F[] = $_FILES['userfile'];
$config['upload_path']          = './uploads/produk_hd/';
$config['allowed_types']        = 'gif|jpg|png';
$config['encrypt_name']        = TRUE;
$this->load->library('upload', $config);
$this->upload->initialize($config);
if ( ! $this->upload->do_upload('userfile'))
{
echo print_r($this->upload->display_errors());
}
else
{
$this->load->library('image_lib');
    
$config2['image_library'] = 'gd2';
$config2['source_image'] = './uploads/produk_hd/'.$this->upload->data('file_name');
$config2['new_image'] = './uploads/produk/';
$config2['maintain_ratio'] = TRUE;
$config2['width'] = 300;
$config2['height'] =300;
$this->image_lib->initialize($config2);

$this->image_lib->resize();


$data = array(
    
    'gambar'.$i =>$this->upload->data('file_name'),
    
    );
$this->db->update('data_produk',$data,array('id_produk'=>$this->input->post('id_produk')));



}
}



}
public function gambar_produk(){
$id_produk = $this->input->get('id_produk');
    
$produk = $this->db->get_where('data_produk',array('id_produk'=>$id_produk));    

$data = $produk->row_array();
for($i=0; $i<4; $i++){
if(!file_exists("./uploads/produk/".$data['gambar'.$i])){
echo "<img style='width:100px; padding:5px; margin:5px; height:100px;' style:  class='img-thumbnail' src='". base_url('uploads/produk/no_image.jpg')."'>";
}else if ($data['gambar'.$i] == '') {
echo "<img style='width:100px; padding:5px; margin:5px; height:100px;' style:  class='img-thumbnail' src='". base_url('uploads/produk/no_image.jpg')."'>";
}else{
echo "<img style='width:100px; padding:5px; margin:5px; height:100px;' style:  class='img-thumbnail' src='". base_url('uploads/produk/'.$data['gambar'.$i])."'>";
}
}
    
    
}

}