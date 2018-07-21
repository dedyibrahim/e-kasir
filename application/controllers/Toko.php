<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Toko extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->library('session');
$this->load->library('cart');
}
public function index(){
$param = 'Home';
$produk = $this->db->get_where('data_produk',array('kategori'=>$param));
$banner = $this->db->get('banner');
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_banner',['banner'=>$banner]);
$this->load->view('Store/V_kategori',['produk'=>$produk]);
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

}