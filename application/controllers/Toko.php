<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Toko extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->library('email');
$this->load->library('session');
$this->load->library('cart');
}
public function index(){
$param = 'Home';
$produk = $this->db->get_where('data_produk',array('kategori'=>$param));
$banner = $this->db->get('banner');
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_banner',['banner'=>$banner]);
$this->load->view('Store/V_kategori_home',['produk'=>$produk]);
$this->load->view('umum/V_footer_toko');
}
public function kategori_toko(){


$param = urldecode($this->uri->segment(3));
if($param == 'Home'){
redirect(base_url());

}else{
$produk = $this->db->get_where('data_produk',array('kategori'=>$param));
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_kategori',['produk'=>$produk]);
$this->load->view('umum/V_footer_toko');


}
}
public function lihat_produk(){

$param = base64_decode($this->uri->segment(3));
$produk = $this->db->get_where('data_produk',array('id_produk'=>$param));    
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_lihat_produk',['produk'=>$produk]);
$this->load->view('umum/V_footer_toko');

}
public function tambahkan_keranjang(){
$this->load->library('cart');    

if($this->input->post('id_produk')){
$id_produk = base64_decode($this->input->post('id_produk'));
$data_produk = $this->db->get_where('data_produk',array('id_produk'=>$id_produk))->row_array();

if($data_produk['stok_toko'] == 0){

echo"habis";

}else if($this->input->post('qty') > $data_produk['stok_toko']){

echo"stok_kurang";

}else{


$data = array(
'id'             => $data_produk['id_produk'],
'qty'            => $this->input->post('qty'),
'price'          => $data_produk['harga_produk'],
'name'           => $data_produk['nama_produk'],
'berat'          => $data_produk['berat'],



);

$this->cart->insert($data);   
$data2 = $this->cart->contents();


echo "berhasil";


}
}  
}
public function hapus_cart(){
$this->cart->destroy();

}
public function keranjang_header(){
foreach ($this->cart->contents() as $produk){

echo "".$produk['name']." ".$produk['qty']." X Rp.".number_format($produk['price'])." = Rp.".number_format($produk['subtotal'])."<hr>";        
}
}
public function keranjang(){

if($this->cart->contents() == NULL){

echo "<h1 align='center'>Keranjang belanja anda kosong</h1>";    
}else{    

echo    "<table class='table table-striped table-bordered  table-condensed table-hover' >"
. "<tr><th>No</th>"
. "<th>Nama produk</th>"
. "<th>Harga produk</th>"
. "<th style='width:8%;'>Qty</th>"
. "<th>Total</th>"
. "<th>Aksi</th></tr>";

$no=1;
foreach ($this->cart->contents() as $keranjang){
echo      "<tr><td>".$no++."</td>"
. "<td><a href='". base_url('Toko/lihat_produk/'.base64_encode($keranjang['id']))."'>".$keranjang['name']."</a></td>"
. "<td>Rp.".number_format($keranjang['price'])."</td>"
. "<td><input type='text' id='qty_keranjang".$keranjang['id']."' onchange='update_qty(".$keranjang['id'].");' class='form-control' value='".$keranjang['qty']."'></td>"
. "<td>Rp.".number_format($keranjang['subtotal'])."</td>"
. "<td><buttton onclick='hapus_cart(".$keranjang['id'].");' class='btn btn-danger'><span class='fa fa-close'></span></button></td>";

}
echo "<tr><td colspan='2'>Total Belanja</td><td colspan='4'>Rp.".number_format($this->cart->total())."</td></tr>";

echo  "</table>'";    
}

}
public function lihat_keranjang(){    
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_lihat_keranjang');
$this->load->view('umum/V_footer_toko');
}

public function update_qty_keranjang(){

if($this->input->post('qty_keranjang')){
$id_produk    =  $this->input->post('id_produk');   
$qty_keranjang = $this->input->post('qty_keranjang');   

$data_produk = $this->db->get_where('data_produk',array('id_produk'=>$id_produk))->row_array();

if($qty_keranjang > $data_produk['stok_toko']){
echo 'stok_kurang';
}else{

$data = array(
'rowid' => md5($id_produk),
'qty'   => $qty_keranjang,
);

$this->cart->update($data);


}    
}  
}

public function hapus_keranjang(){

if($this->input->post('id_produk')){
$id_produk = $this->input->post('id_produk');    
$data = array(
'rowid' => md5($id_produk),
'qty'   => 0,
);

$this->cart->update($data);
}    
}

public function search(){
$kata_kunci = $this->input->post('kata_kunci');
$array = array('nama_produk' => $kata_kunci);
$this->db->like($array);
$hasil = $this->db->get('data_produk');

foreach ($hasil->result_array() as $hasil_cari){

echo "<a href='".base_url('Toko/lihat_produk/'.base64_encode($hasil_cari['id_produk']))."'>";
echo "<div style='height:45%;' class='col-md-3'>
<div style='margin:10px;  text-align:center;'>";

if(!file_exists("./uploads/produk/".$hasil_cari['gambar0'])){     
echo "<img class='img-circle' style='width:170px; margin:5px; border:3px solid #169F85; height:170px;' src=".base_url('uploads/produk/no_image.jpg').">";
}else if($hasil_cari['gambar0'] == ''){
echo "<img class='img-circle' style='width:170px; margin:5px; border:3px solid #169F85; height:170px;' src=".base_url('uploads/produk/no_image.jpg').">";
}else{    
echo "<img class='img-circle' style='width:170px; margin:5px; border:3px solid #169F85; height:170px;' src=".base_url('uploads/produk/'.$hasil_cari['gambar0']).">";
}

echo "<br>
<h4>Rp.".number_format($hasil_cari['harga_produk'])."</h4>
<h4>".$hasil_cari['nama_produk']."</h4>
</div>
</div>
</div>
</a>";

}

}

public function ambil_kota_ongkir(){
$api = $this->db->get('api_raja_ongkir')->row_array();
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
"key: ".$api['api_key'].""
),
));
$responsekota = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
echo "cURL Error #:" . $err;
} else {


$data = json_decode($responsekota,true);

foreach ($data['rajaongkir']['results'] as $berhasil) {
echo "<option value=".$berhasil['city_id'].">".$berhasil['city_name']."</option>";
}
}    
}
public function load_data_cost(){
$kota_tujuan = $this->input->post('kota_tujuan');
$qty         = $this->input->post('qty');
$berat       = $this->input->post('berat');
$kurir       = $this->input->post('kurir');
$api = $this->db->get('api_raja_ongkir')->row_array();
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "origin=155&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir."",
CURLOPT_HTTPHEADER => array(
"content-type: application/x-www-form-urlencoded",
"key: ".$api['api_key'].""
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
if ($err) {
echo "cURL Error #:" . $err;
} else {

$data_pengiriman = json_decode($response,true);

if(!empty($data_pengiriman['rajaongkir']['results']) !=''){
foreach ($data_pengiriman['rajaongkir']['results'] as $cost) {
echo "<h4 align='center'>".$cost['name']."</h4><hr>";
foreach ($cost['costs'] as $service) {
echo "<h5>".$service['service']." ";
echo "".$service['description']."<h5>";
foreach ($service['cost'] as $biaya) {
echo "<h5>Rp.".number_format($biaya['value'])." ";
echo "Estimasi ".$biaya['etd']." Hari"; 
}

}

}
}else{

echo "<H2 align='center'>TERDAPAT KESALAHAN PERHITUNGAN<H2>";   
}
}

}

public function daftar_customer(){
if($this->session->userdata('nama_customer') != ''){
redirect(base_url());       
}else{
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_daftar_customer');
$this->load->view('umum/V_footer_toko');
}
}
public function simpan_customer(){
if($this->input->post('nama_customer')){
$config = Array(
'protocol' => 'smtp',
'smtp_host' => 'ssl://smtp.googlemail.com',
'smtp_port' => 465,
'smtp_user' => 'dedyibrahym23@gmail.com',
'smtp_pass' => 'terlalu123',
'mailtype' => 'html',
'charset' => 'iso-8859-1',
'wordwrap' => TRUE
);    
$this->email->initialize($config);
$this->load->library('email',$config);
$this->email->set_newline("\r\n");
$this->email->from('dedyibrahym23@gmail.com', 'Administrator');
$this->email->to($this->input->post('email'));
$this->email->subject('Konfirmasi akun');
$data_kirim ="<h3>Terimakasih anda telah melakukan pendaftaran</h3><br>"
        . "untuk mengkonfirmasi akun silahkan klik link di bawah ini <br><br>"
        . "<a href='".base_url('Toko/konfirmasi_akun/'. base64_encode($this->input->post('email')))."'>Konfirmasi akun</a><br><br>"
        . "atas perhatian dan kerjasamanya kami ucapkan terimaksih";
$this->email->message($data_kirim);

if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
$data =array(
'nama_customer' => $this->input->post('nama_customer'),
'email'         => $this->input->post('email'),
'password'      => md5($this->input->post('password')),
);
} 
}    
}

public function login_customer(){

if($this->input->post('email')){    
$password = md5($this->input->post('password'));
$email    = $this->input->post('email');        

$data = $this->db->get_where('customer_toko',array('password'=>$password,'email'=>$email,'status'=>'terkonfirmasi'))->row_array();
$cek_hasil = $this->db->get_where('customer_toko',array('password'=>$password,'email'=>$email,'status'=>'terkonfirmasi'))->num_rows();

if($cek_hasil > 0){
$set_sesi =array(
'nama_customer' =>$data['nama_customer'],
'email_customer'        =>$data['email'],
);

$this->session->set_userdata($set_sesi);


echo"login_berhasil";
}
}
}
public function keluar(){
$this->session->sess_destroy();
}

public function checkout(){

if($this->session->userdata('nama_customer') !='' ){
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_checkout');
$this->load->view('umum/V_footer_toko');
}else{    
redirect(base_url('Toko/daftar_customer'));    
}


}
}

