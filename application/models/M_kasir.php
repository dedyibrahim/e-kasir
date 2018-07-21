<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_kasir extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    
    }
    
    public function cari_produk($term){
     $this->db->from("data_produk");
     $this->db->limit(9);
     $array = array('nama_produk' => $term);
     $this->db->like($array);
     $this->db->where(array('status_produk' => 'Aktif','stok_toko !='=>0 ));
     $query = $this->db->get();
     
     if($query->num_rows() >0 ){
         
         return $query->result();
     }
        
    }
    public function cari_customer($term){
     $this->db->from("customer_kasir");
     $this->db->limit(9);
     $array = array('nama_customer' => $term);
     $this->db->like($array);
     $query = $this->db->get();
     
     if($query->num_rows() >0 ){
         
         return $query->result();
     }
        
    }
    public function seluruh_transaksi(){
$this->datatables->select('no_invoices,'
. 'data_penjualan_kasir.nama_customer as nama_customer ,'
. 'data_penjualan_kasir.nama_kasir as nama_kasir ,'
. 'data_penjualan_kasir.nomor_kontak as nomor_kontak ,'
. 'data_penjualan_kasir.metode_pembayaran as metode_pembayaran ,'
. 'data_penjualan_kasir.tanggal_transaksi as tanggal_transaksi ,'        

);
$this->datatables->from('data_penjualan_kasir');
$this->datatables->where('status','selesai');
$this->datatables->add_column('invoice','AD/NW/$1/$2','tanggal_transaksi,no_invoices');

$this->datatables->add_column('view','<a class="btn btn-sm btn-primary fa fa-print " href="'.base_url().'P_kasir/cetak_a4/$1"></a> || <a class="btn btn-sm btn-warning fa fa-edit" href="'.base_url().'P_kasir/edit_invoices/$1"></a>', 'base64_encode(no_invoices)');

return $this->datatables->generate();
}
  public function data_transaksi_edit(){
      
$nama_kasir= $this->session->userdata('username');      
      
$this->datatables->select('no_invoices,'
. 'data_penjualan_kasir.nama_customer as nama_customer ,'
. 'data_penjualan_kasir.nama_kasir as nama_kasir ,'
. 'data_penjualan_kasir.nomor_kontak as nomor_kontak ,'
. 'data_penjualan_kasir.metode_pembayaran as metode_pembayaran ,'
. 'data_penjualan_kasir.tanggal_transaksi as tanggal_transaksi ,'        

);
$this->datatables->from('data_penjualan_kasir');
$this->datatables->where('status','edit');
$this->datatables->add_column('invoice','AD/NW/$1/$2','tanggal_transaksi,no_invoices');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-exchange " href="'.base_url().'P_kasir/get_edit/$1"> Get Data</a>', 'base64_encode(no_invoices)');
return $this->datatables->generate();
}

  public function daftar_customer(){
$this->datatables->select('id_customer,'
.'customer_kasir.nama_customer as nama_customer ,'
.'customer_kasir.nomor_kontak as nomor_kontak ,'
.'customer_kasir.kode_pos as kode_pos ,'
.'customer_kasir.alamat_lengkap as alamat_lengkap ,'

);
$this->datatables->from('customer_kasir');
$this->datatables->add_column('view','<a class="btn btn-sm btn-danger fa fa-close " href="'.base_url().'P_kasir/hapus_customer/$1"></a> || <a class="btn btn-sm btn-warning fa fa-edit" href="'.base_url().'P_kasir/edit_customer/$1"></a>', 'base64_encode(id_customer)');

return $this->datatables->generate();
}
    
    
}