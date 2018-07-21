<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->library('session');
}

public function index(){
$param = 'Home';
$produk = $this->db->get_where('data_produk',array('kategori'=>$param));
$this->load->view('umum/V_header_toko');
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
$this->load->view('umum/V_header_toko');
$this->load->view('Store/V_lihat_produk');
$this->load->view('umum/V_footer_toko');
}


}