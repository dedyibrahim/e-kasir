<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_produk extends CI_Model{
public function __construct() {
parent::__construct();

}

public function json_produk_toko(){
$this->datatables->select('id_produk,'
. 'data_produk.barcode as barcode ,'
. 'data_produk.nama_produk as nama_produk ,'
. 'data_produk.harga_produk as harga_produk ,'
. 'data_produk.stok_toko as stok_toko ,'
. 'data_produk.stok_pabrik as stok_pabrik ,'
. 'data_produk.status_produk as status_produk ,'

);
$this->datatables->from('data_produk');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'P_produk/lihat_produk/$1"></a> || <a class="btn btn-sm btn-success fa fa-edit " href="'.base_url().'P_produk/edit_produk/$1"></a> || <a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'P_produk/hapus_produk/$1"></a>', 'id_produk');
return $this->datatables->generate();
}
public function json_produk_pabrik_mau_habis(){
$this->datatables->select('id_produk,'
. 'data_produk.barcode as barcode ,'
. 'data_produk.nama_produk as nama_produk ,'
. 'data_produk.harga_produk as harga_produk ,'
. 'data_produk.stok_toko as stok_toko ,'
. 'data_produk.stok_pabrik as stok_pabrik ,'
. 'data_produk.status_produk as status_produk ,'

);
$this->datatables->where('stok_pabrik <', 10);
$this->datatables->from('data_produk');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'P_produk/lihat_produk/$1"></a> || <a class="btn btn-sm btn-success fa fa-edit " href="'.base_url().'P_produk/edit_produk/$1"></a> || <a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'P_produk/hapus_produk/$1"></a>', 'id_produk');
return $this->datatables->generate();
}
public function json_produk_toko_mau_habis(){
$this->datatables->select('id_produk,'
. 'data_produk.barcode as barcode ,'
. 'data_produk.nama_produk as nama_produk ,'
. 'data_produk.harga_produk as harga_produk ,'
. 'data_produk.stok_toko as stok_toko ,'
. 'data_produk.stok_pabrik as stok_pabrik ,'
. 'data_produk.status_produk as status_produk ,'

);
$this->datatables->where('stok_toko <', 10);
$this->datatables->where('stok_toko !=', 0);
$this->datatables->from('data_produk');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'P_produk/lihat_produk/$1"></a> || <a class="btn btn-sm btn-success fa fa-edit " href="'.base_url().'P_produk/edit_produk/$1"></a> || <a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'P_produk/hapus_produk/$1"></a>', 'id_produk');
return $this->datatables->generate();
}
public function json_produk_toko_sudah_habis(){
$this->datatables->select('id_produk,'
. 'data_produk.barcode as barcode ,'
. 'data_produk.nama_produk as nama_produk ,'
. 'data_produk.harga_produk as harga_produk ,'
. 'data_produk.stok_toko as stok_toko ,'
. 'data_produk.stok_pabrik as stok_pabrik ,'
. 'data_produk.status_produk as status_produk ,'

);
$this->datatables->where('stok_toko =', 0);
$this->datatables->from('data_produk');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'P_produk/lihat_produk/$1"></a> || <a class="btn btn-sm btn-success fa fa-edit " href="'.base_url().'P_produk/edit_produk/$1"></a> || <a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'P_produk/hapus_produk/$1"></a>', 'id_produk');
return $this->datatables->generate();
}


}