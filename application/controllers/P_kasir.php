<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class P_kasir extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('url');
$this->load->database();
$this->load->library('Pdf');
$this->load->library('datatables');
$this->load->library('session');

if(!$this->session->userdata('email') && !$this->session->userdata('username') && !$this->session->userdata('level') ){
redirect(base_url()); 
}else if ($this->session->userdata('level') != 'super admin' && $this->session->userdata('level') != 'admin kasir') {
redirect(base_url('Kasir'));         
}
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_kasir');
$this->load->view('umum/V_footer');
}
public function cari_produk(){
$term =  strtolower ($this->input->get('term'));    
$this->load->model("M_kasir");
$query = $this->M_kasir->cari_produk($term);

foreach ($query as $d) {
$json[]     = array(
'label'                   => $d->nama_produk." Rp.".number_format($d->harga_produk),   
'id_produk'               => $d->id_produk,
);   

}
echo json_encode($json); 
}
public function cari_customer(){
$term =  strtolower ($this->input->get('term'));    
$this->load->model("M_kasir");
$query = $this->M_kasir->cari_customer($term);

foreach ($query as $d) {
$json[]     = array(
'label'                   => $d->nama_customer,   
'nama_customer'           => $d->nama_customer,
'nomor_kontak'            => $d->nomor_kontak,
'kode_pos'                => $d->kode_pos,
'alamat_lengkap'          => $d->alamat_lengkap,
);   

}
echo json_encode($json); 
}
public function set_kasir(){

if($this->input->post('id_produk')){    
$id_produk =  $this->input->post("id_produk");
$query = $this->db->get_where("data_produk",array('id_produk'=>$id_produk));
$cek_sesi = $this->session->userdata('set_kasir');


if($cek_sesi != NULL){

$data_lama = $this->session->userdata('set_kasir');
foreach ($query->result_array() as $produk ){
$array2=array(
'id_produk'        => $produk['id_produk'],
'barcode'          => $produk['barcode'],
'nama_produk'      => $produk['nama_produk'],
'qty'              => 1,
'harga_produk'     => $produk['harga_produk'],
'jumlah_produk'    => $produk['harga_produk'],
'stok_toko'        => $produk['stok_toko'],
);
}

array_push($data_lama, $array2);

$this->session->set_userdata('set_kasir',$data_lama);

unset($_SESSION['hitung_diskon']);
unset($_SESSION['total']);
unset($_SESSION['nilai_diskon']);
unset($_SESSION['nilai_ppn']);
unset($_SESSION['nama_biaya_lain']);
unset($_SESSION['jumlah_biaya_lain']);


}else{
foreach ($query->result_array() as $produk ){
$array['set_kasir'][]=[
'id_produk'        => $produk['id_produk'],
'barcode'          => $produk['barcode'],
'nama_produk'      => $produk['nama_produk'],
'qty'              => 1,
'harga_produk'     => $produk['harga_produk'],
'jumlah_produk'    => $produk['harga_produk'],
'stok_toko'        => $produk['stok_toko'],
];
$this->session->set_userdata($array);
}
unset($_SESSION['hitung_diskon']);
unset($_SESSION['total']);
unset($_SESSION['nilai_diskon']);
unset($_SESSION['nilai_ppn']);
unset($_SESSION['nama_biaya_lain']);
unset($_SESSION['jumlah_biaya_lain']);

}
}
}
public function hapus_set_kasir(){
$id_hapus = $this->input->post('id_hapus');
unset($_SESSION['set_kasir'][$id_hapus]);
unset($_SESSION['hitung_diskon']);
unset($_SESSION['total']);
unset($_SESSION['nilai_diskon']);
unset($_SESSION['nilai_ppn']);
unset($_SESSION['nama_biaya_lain']);
unset($_SESSION['jumlah_biaya_lain']);

}

public function update_qty_kasir(){

$id_qty    = $this->input->post('id_qty');
$qty_kasir = $this->input->post('qty_kasir');
$detailsdata = $this->session->userdata('set_kasir');
$d =  $detailsdata[$id_qty];

$data2 = array(
'id_produk'    => $d['id_produk'],
'barcode'      => $d['barcode'],
'nama_produk'  => $d['nama_produk'],
'qty'          => $qty_kasir,
'harga_produk' => $d['harga_produk'],
'jumlah_produk'=> $qty_kasir*$d['harga_produk'],
'stok_toko'    => $d['stok_toko'],    
);

array_push($detailsdata, $data2);

$this->session->set_userdata('set_kasir',$detailsdata);

unset($_SESSION['set_kasir'][$id_qty]);

}

public function canvas_kasir(){
echo"
<div style='background-color: #4a4a4a; padding: 5px; color:#fff;'>
<h3 align='center'>";
$jumlah = $this->session->userdata('set_kasir'); 
$hitung = count($jumlah);
$hasil = 0;   

if($hitung != ''){
foreach($jumlah as $i=>$hitung){
$hasil+=$jumlah[$i]['jumlah_produk'];
}

}
echo "Total Belanja : Rp.".number_format($hasil);

if($this->session->userdata('nilai_diskon') != '' || $this->session->userdata('nilai_ppn') != ''||  $this->session->userdata('nama_biaya_lain') != ''  ){
$set_total = array(
'total_kasir' => $hasil,
);
}else{

$set_total = array(
'total_kasir' => $hasil,
'total'       => $hasil,
);

}
$this->session->set_userdata($set_total);


echo"</h3>
</div>     

<table style='width: 100%; font-size:15px;' class='table-striped  table-condensed'>
<tr >
<th>Nama produk</th>
<th>Harga</th>
<th style='width: 13%;'>Qty</th>
<th>Jumlah</th>
<th>Aksi</th>
</tr>";
$data = $this->session->userdata('set_kasir'); 
$ht = count($data);
if($ht != ''){
foreach($data as $i=>$ht){
echo "
<tr>
<td> ".$data[$i]['nama_produk']."</td>
<td>".number_format($data[$i]['harga_produk'])."</td>
<td><input type='text' id='qty_kasir".$i."' onchange='update_qty_kasir(".$i.");' class='form-control' value='".$data[$i]['qty']."'></td>
<input type='hidden' id='stok_toko".$i."' class='form-control' value='".$data[$i]['stok_toko']."'>
<td>".number_format($data[$i]['jumlah_produk'])."</td>
<td><button onclick='hapus_setkasir(".$i.");' class='btn btn-danger'><span class='fa fa-close'></span></button></td>
</tr>";
}
}

if($this->session->userdata('total_kasir') != ''){
echo "<tr><td colspan='2'><b>Subtotal</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('total_kasir'))."</b></td></tr>";
}
if($this->session->userdata('nilai_ppn') != ''){
echo "<tr><td colspan='2'><b>PPN 10 %</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('nilai_ppn'))."</b></td></tr>";

}


if($this->session->userdata('nilai_diskon') != ''){
echo "<tr><td colspan='2'><b>Diskon ".$this->session->userdata('nilai_diskon')." %</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('hitung_diskon'))."</b></td></tr>";

}

if($this->session->userdata('nama_biaya_lain') != ''){
echo "<tr><td colspan='2'><b>".$this->session->userdata('nama_biaya_lain')."</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('jumlah_biaya_lain'))."</b></td></tr>";

}


if($this->session->userdata('total') != ''){
echo "<tr><td colspan='2'><b>Total Bayar </b></b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('total'))."</b></td></tr>";

}


echo "</table>";
}


public function modal_diskon(){
echo "<label>Total Belanja :</label>
<input readonly='' type='text' value='".$this->session->userdata('total_kasir')."' id='total_kasir_diskon' class='form-control'>";
echo "<label>Nilai Diskon :</label>
<input type='text' onkeyup='set_diskon();' value='' id='nilai_diskon' class='form-control'>";
echo "<label>Hasil Nilai Diskon :</label>
<input readonly='' type='text' value='' id='hasil_diskon' class='form-control'>";
}
public function set_diskon(){
$nilai_diskon = $this->input->post('nilai_diskon');
$total_kasir  = $this->session->userdata('total_kasir'); 
$hitung_diskon = $total_kasir * $nilai_diskon / 100 ;
$set_diskon    = $total_kasir -$hitung_diskon;
$nilai_ppn         = $this->session->userdata('nilai_ppn');
$jumlah_biaya_lain = $this->session->userdata('jumlah_biaya_lain');

if($nilai_ppn != '' || $jumlah_biaya_lain != '' ){  
$data_diskon = array(
'nilai_diskon' => $nilai_diskon,
'hitung_diskon'=> $hitung_diskon,
'total'        => $set_diskon+$nilai_ppn+$jumlah_biaya_lain,
);
}else{
$data_diskon = array(
'nilai_diskon' => $nilai_diskon,
'hitung_diskon'=> $hitung_diskon,
'total'        => $set_diskon,
);

}

$this->session->set_userdata($data_diskon);

}
public function modal_ppn(){
$hasil_nilai_ppn = $this->session->userdata('total_kasir') * 0.1;    
$harga_setelah_ppn = $this->session->userdata('total') + $hasil_nilai_ppn;    

echo "<label>Total Belanja :</label>
<input readonly='' type='text' value='".$this->session->userdata('total_kasir')."'  class='form-control'>";
echo "<label>Nilai ppn :</label>
<input type='text' readonly=''  value='10'   class='form-control'>";
echo "<label>Hasil nilai ppn :</label>
<input type='text' readonly='' id='hasil_nilai_ppn'  value='".$hasil_nilai_ppn."'   class='form-control'>";
echo "<label>Harga setelah PPN :</label>
<input readonly='' type='text' id='harga_setelah_ppn' value='".$harga_setelah_ppn."'  class='form-control'>";
}

public function simpan_ppn(){

$hasil_nilai_ppn   = $this->input->post('hasil_nilai_ppn');
$harga_setelah_ppn = $this->input->post('harga_setelah_ppn');

$data_ppn =array(

'total'    =>$harga_setelah_ppn,
'nilai_ppn'=>$hasil_nilai_ppn,

);

echo print_r($data_ppn);

$this->session->set_userdata($data_ppn);

}
public function simpan_customer(){
$simpan_customer = array(
'nama_customer'  => $this->input->post('nama_customer'),
'nomor_kontak'   => $this->input->post('nomor_kontak'),
'kode_pos'       => $this->input->post('kode_pos'),
'alamat_lengkap' => $this->input->post('alamat_lengkap'),     
);

$this->db->insert('customer_kasir',$simpan_customer);   
}

public function simpan_biaya_lain(){
$biaya_lain = array(
'nama_biaya_lain'   => $this->input->post('nama_biaya_lain'),
'jumlah_biaya_lain' => $this->input->post('jumlah_biaya_lain'),
'total'             => $this->input->post('jumlah_biaya_lain') + $this->session->userdata('total'),
);    
$this->session->set_userdata($biaya_lain);


}
public function simpan_customer_stroke(){

if($this->input->post('nama_customer')){
$data_customer = array(
'nama_customer'   => $this->input->post('nama_customer'),
'kode_pos'        => $this->input->post('kode_pos'),
'nomor_kontak'    => $this->input->post('nomor_kontak'),      
'alamat_lengkap'  => $this->input->post('alamat_lengkap'),      
);
$this->session->set_userdata($data_customer);
}

echo print_r($this->session->all_userdata());

}
public function modal_stroke(){
echo "<input type='hidden' class='form-control' id='cek_customer' value='".$this->session->userdata('nama_customer')."'>
<label>Metode pembayaran :</label>
<select class='form-control' id='metode_pembayaran'>
<option>Bank Transfer</option>   
<option>Cash</option>   
</select>
<label>Jumlah uang</label>
<input type='text' onkeyup='jumlah_uang();' id='jumlah_uang' class='form-control'>

<label>Yang Harus Dibayar</label>
<input readonly='' id='harus_bayar' value=".$this->session->userdata('total')." type='text' class='form-control'>

<label>Kembalian</label>
<input type='text' readonly='' id='kembalian' class='form-control'>
<label>Catatan</label>
<textarea type='text'  id='catatan' class='form-control'></textarea>
";

}

public function simpan_data_kasir(){
$no_invoices = $this->db->get('data_penjualan_kasir')->num_rows();    

$simpan_data_penjualan_kasir = array(
'no_invoices'     => $no_invoices,
'nama_customer'   => $this->session->userdata('nama_customer'),
'kode_pos'        => $this->session->userdata('kode_pos'),
'nama_kasir'      => $this->session->userdata('username'),  
'nomor_kontak'    => $this->session->userdata('nomor_kontak'),  
'alamat_lengkap'  => $this->session->userdata('alamat_lengkap'),
'total_kasir'     => $this->session->userdata('total_kasir'),  
'total'           => $this->session->userdata('total'),
'nilai_diskon'    => !empty($this->session->userdata('nilai_diskon'))?$this->session->userdata('nilai_diskon') :0,  
'hitung_diskon'   => !empty($this->session->userdata('hitung_diskon'))?$this->session->userdata('hitung_diskon') :0,
'nilai_ppn'       => !empty($this->session->userdata('nilai_ppn'))?$this->session->userdata('nilai_ppn') :0,  
'nama_biaya_lain' => !empty($this->session->userdata('nama_biaya_lain'))?$this->session->userdata('nama_biaya_lain') :'',  
'jumlah_biaya_lain'=>!empty($this->session->userdata('jumlah_biaya_lain'))?$this->session->userdata('jumlah_biaya_lain') :0,
'jumlah_uang'      => $this->input->get('jumlah_uang'),  
'kembalian'        => $this->input->get('kembalian'),  
'metode_pembayaran' => $this->input->get('metode_pembayaran'),  
'catatan'           => $this->input->get('catatan'),  
'tanggal_transaksi' => date("d/m/Y"),
'waktu_transaksi'   => date("H:m:i:s"),
'status'            =>'selesai',
);
$this->db->insert('data_penjualan_kasir',$simpan_data_penjualan_kasir);


$data = $this->session->userdata('set_kasir'); 
$ht = count($data);
foreach($data as $i=>$ht){

$data_produk_kasir = array(
'no_invoices'     => $no_invoices,
'id_produk'       => $data[$i]['id_produk'],
'barcode'         => $data[$i]['barcode'],
'nama_produk'     => $data[$i]['nama_produk'],
'qty'             => $data[$i]['qty'],
'harga_produk'    => $data[$i]['harga_produk'],
'jumlah_produk'   => $data[$i]['jumlah_produk'],
);

$this->db->insert('data_produk_kasir',$data_produk_kasir);
}
unset($_SESSION['set_kasir']);
$unset_array = array(
'nama_customer',
'kode_pos',
'nomor_kontak' ,  
'alamat_lengkap',
'total_kasir',  
'total',
'nilai_diskon',  
'hitung_diskon',
'nilai_ppn',  
'nama_biaya_lain',  
'jumlah_biaya_lain',
);
$this->session->unset_userdata($unset_array);


$this->print_kasir($no_invoices);    
}

public function print_kasir($no_invoices){
$this->db->select('*');
$this->db->from('data_penjualan_kasir');
$this->db->join('data_produk_kasir', 'data_produk_kasir.no_invoices = data_penjualan_kasir.no_invoices');
$this->db->where('data_penjualan_kasir.no_invoices',$no_invoices);
$data = $this->db->get();
$data_static = $data->row_array(); 

echo"<div class='col-md-4'>"
."<h4 align='center'><b>Niagarawatermart</b></h4>"
."<hr><table>"
."<tr><td>No invoices </td><td> : AD/NW/".$data_static['tanggal_transaksi']."/".$data_static['no_invoices']." </td></tr>"
."<tr><td>Kasir </td><td> : ".$data_static['nama_kasir']."<br>"
."<tr><td>Customer </td><td> : ".$data_static['nama_customer']."</td></tr>"
."<tr><td>Pembayaran </td><td> : ".$data_static['metode_pembayaran']."</td></tr>"
."<tr><td>Date </td><td> : ".$data_static['tanggal_transaksi']." ".$data_static['waktu_transaksi']."</td></tr>"
."</table><hr>";

foreach ($data->result_array() as $data_produk_kasir){
echo $data_produk_kasir['nama_produk']."<br>Rp. ".number_format($data_produk_kasir['harga_produk'])." X ".$data_produk_kasir['qty']." = Rp. ".number_format($data_produk_kasir['jumlah_produk'])."<br>";

}
echo "<hr><table>";
if($data_static['total_kasir'] != ''){
echo "<tr><td>Sub Total</td><td> : Rp. ".number_format($data_static['total_kasir'])."</td></tr>";
}
if($data_static['nilai_ppn'] != 0){
echo "<tr><td>PPN 10 % </td><td> : Rp. ".number_format($data_static['nilai_ppn'])."</td></tr>";
}

if($data_static['nilai_diskon'] != 0){
echo "<tr><td>Diskon".$data_static['nilai_diskon']."% </td><td> : Rp. ".number_format($data_static['hitung_diskon'])."</td></tr>";
}

if($data_static['nama_biaya_lain'] != ''){
echo "<tr><td>".$data_static['nama_biaya_lain']." </td><td> : Rp. ".number_format($data_static['jumlah_biaya_lain'])."</td></tr>";
}


if($data_static['total'] != ''){
echo "<tr><td>Total Bayar </td><td> : Rp. ".number_format($data_static['total'])."</td></tr>";
}

if($data_static['jumlah_uang'] != ''){
echo "<tr><td>Jumlah uang </td><td> : Rp. ".number_format($data_static['jumlah_uang'])."</td></tr>";
}

if($data_static['kembalian'] != ''){
echo "<tr><td>Kembalian </td><td> : Rp. ".number_format($data_static['kembalian'])."</td></tr>";
} 

echo "</table><hr></div>";
}

public function daftar_transaksi_hari_ini(){
$tanggal_transaksi = date("d/m/Y");
$this->db->order_by('id_penjualan','DESC');
$data = $this->db->get_where('data_penjualan_kasir',array('tanggal_transaksi'=>$tanggal_transaksi,'status !='=>'edit'));


echo"</h3>
</div>     

<table  style='width: 100%; font-size:15px; text-align:center;' class='table-striped  table-condensed'>
<tr>
<th style='text-align:center;'>No invoices</th>
<th style='text-align:center;'>Customer</th>
<th style='text-align:center;'>Total</th>
<th style='text-align:center;'>Aksi</th>
</tr>";

foreach ($data->result_array() as $hari_ini){
echo "
<tr>
<td>AD/NW/".$hari_ini['tanggal_transaksi']."/".$hari_ini['no_invoices']."</td>
<td>".$hari_ini['nama_customer']."</td>
<td>".number_format($hari_ini['total'])."</td>
<td><button class='btn btn-success'  onclick='print_stroke(".$hari_ini['no_invoices'].");'><span class='fa fa-print'> Stroke</button> <a href=P_kasir/cetak_a4/".base64_encode($hari_ini['no_invoices'])."><button class='btn btn-success'><span class='fa fa-print'> A4</button></a></td>
</tr>";
}


echo "</table>
";


}


public function cari_id_produk(){
$barcode = $this->input->post('kode_barcode');

$data =  $this->db->get_where('data_produk',array('barcode'=>$barcode))->row_array();

echo $data['id_produk'];


}
public function cetak_a4(){

$no_invoices = base64_decode($this->uri->segment(3));
$this->db->select('*');
$this->db->from('data_penjualan_kasir');
$this->db->join('data_produk_kasir', 'data_produk_kasir.no_invoices = data_penjualan_kasir.no_invoices');
$this->db->where('data_penjualan_kasir.no_invoices',$no_invoices);
$data = $this->db->get();
$data_static = $data->row_array(); 

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('AD/NW/'.$data_static['tanggal_transaksi'].'/'.$data_static['no_invoices'].'');
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(5);
$pdf->setFooterMargin(5);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();


$html = '<table  border="0" cellspacing="3" cellpadding="4">'
. '<tr>'
. '<td><h3>Niagarawatermart</h3></td><td><h3 align="right">Invoice</h3></td></tr><tr>'
. '<td>Jl.Muara Karang Blok L9/T No.8 <br>Pluit, Penjaringan Jakarta Utara DKI Jakarta<br>021-6697706</td>'
. '<td><p align="right">AD/NW/'.$data_static['tanggal_transaksi'].'/'.$data_static['no_invoices'].'<br>'.$data_static['metode_pembayaran'].'<br> Sales : '.$data_static['nama_kasir'].'</p></td>'
. '</tr>'
. '<tr>'
. '<td><h3>Alamat Customer</h3></td><td><h3 align="right">No Contact</h3></td></tr><tr>'
. '<td>'.$data_static['nama_customer'].'<br>'.$data_static['alamat_lengkap'].'</td>'
. '<td><p align="right">'.$data_static['nomor_kontak'].'</p></td>'
. '</tr>'
. '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$data_produk = '<table  border="1" cellspacing="0" cellpadding="2">'
. '<tr>'
. '<th style="width: 50%;" ><h3>Nama produk</h3></th>'
. '<th style="width: 20%;"><h3>Harga</h3></th>'
. '<th style="width: 10%;"><h3>Qty</h3></th>'
. '<th style="width: 20%;"><h3>Jumlah</h3></th>'
.'</tr>';
foreach ($data->result_array() as $produk){
$data_produk .= '<tr>
<td>' . $produk['nama_produk'] . '</td>
<td>Rp.' . number_format($produk['harga_produk']) . '</td>
<td>' . $produk['qty'] . '</td>
<td>Rp.' . number_format($produk['jumlah_produk']) . '</td>
</tr>';
}
$data_produk.= '</table>';




$pdf->writeHTML($data_produk, true, false, true, false, '');

$pdf->Output('AD/NW/'.$data_static['tanggal_transaksi'].'/'.$data_static['no_invoices'].'.pdf', 'I');
}

public function seluruh_transaksi(){
$this->load->model('M_kasir');
header('Content-Type: application/json');
echo $this->M_kasir->seluruh_transaksi();       

}

public function daftar_customer(){
$this->load->model('M_kasir');
header('Content-Type: application/json');
echo $this->M_kasir->daftar_customer();       

}
public function buat_laporan(){
$tanggal =  $this->input->post('daterange');
$range = explode(' ', $tanggal);

$this->db->where(array('tanggal_transaksi >='=>$range[0],'tanggal_transaksi <='=>$range[2]));
$data = $this->db->get('data_penjualan_kasir');



$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Laporan penjualan '.$range[0].' sampai '.$range[2].'');
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(5);
$pdf->setFooterMargin(5);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();


$html = '<h3 align="center">LAPORAN PENJUALAN <br>'.$range[0].' S/D '.$range[2].'</h3></br>';

$pdf->writeHTML($html, true, false, true, false, '');
$total = 0;
$data_produk = '<table  border="1" cellspacing="0" cellpadding="2">'
. '<tr>'
. '<th style="width: 30%;" ><h3>Nama Customer</h3></th>'
. '<th style="width: 30%;"><h3>Invoices</h3></th>'
. '<th style="width: 20%;"><h3>waktu</h3></th>'
. '<th style="width: 20%;"><h3>Jumlah</h3></th>'
.'</tr>';
foreach ($data->result_array() as $produk){
$data_produk .= '<tr>
<td>' . $produk['nama_customer'] . '</td>
<td>AD/NW/'.$produk['tanggal_transaksi'].'/'.$produk['no_invoices'].'</td>
<td>' . $produk['tanggal_transaksi'] . '</td>
<td>Rp.' . number_format($produk['total']) . '</td>
</tr>';

$total += $produk['total'];
}
$data_produk.= '<tr><td colspan="2"><h4>TOTAL BELANJA</h4></td><td colspan="2"><h4>Rp. '.number_format($total).'</h4></td></tr></table>';




$pdf->writeHTML($data_produk, true, false, true, false, '');

$pdf->Output('Laporan penjualan '.$range[0].' sampai '.$range[2].'.pdf', 'I');
}

public function edit_invoices(){
$id = $this->uri->segment(3);
$id_invoices = base64_decode($id);

$data_penjualan_kasir = $this->db->get_where('data_penjualan_kasir',array('no_invoices'=>$id_invoices))->row_array();  

if($this->session->userdata['level'] != 'super admin'){
$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_gagal_edit');
$this->load->view('umum/V_footer');

}else{
if($this->uri->segment(3)){
$data = array(
'status' => 'edit',

);

$this->db->update('data_penjualan_kasir',$data,array('no_invoices'=>base64_decode($id)));
$this->db->update('data_produk_kasir',$data,array('no_invoices'=>base64_decode($id)));

redirect(base_url('P_kasir/edit'));
}

redirect(404);
}
}
public function edit(){
if($this->session->userdata('level') != 'super admin'){    
$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_gagal_edit');
$this->load->view('umum/V_footer');
}else{
$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_kasir_edit');
$this->load->view('umum/V_footer');

}
}
public function data_transaksi_edit(){
$this->load->model('M_kasir');
header('Content-Type: application/json');
echo $this->M_kasir->data_transaksi_edit();       


}
public function get_edit(){
$no_invoice = base64_decode($this->uri->segment(3));
$this->db->select('*');
$this->db->from('data_penjualan_kasir');
$this->db->join('data_produk_kasir', 'data_produk_kasir.no_invoices = data_penjualan_kasir.no_invoices');
$this->db->join('data_produk', 'data_produk.id_produk = data_produk_kasir.id_produk');
$this->db->where('data_penjualan_kasir.no_invoices',$no_invoice);
$query = $this->db->get();

foreach ($query->result_array() as $produk){
$array['set_edit'][]=[
'id_produk'        => $produk['id_produk'],
'barcode'          => $produk['barcode'],
'nama_produk'      => $produk['nama_produk'],
'qty'              => $produk['qty'],
'harga_produk'     => $produk['harga_produk'],
'jumlah_produk'    => $produk['harga_produk'],
'stok_toko'        => $produk['stok_toko'],
];
$this->session->set_userdata($array);
}

$lainnya = $query->row_array();

$data_lain = array(
'no_invoices'             => $lainnya['no_invoices'],
'total_kasir_edit'        => $lainnya['total_kasir'],
'nilai_ppn_edit'          => $lainnya['nilai_ppn'],    
'nilai_diskon_edit'       => $lainnya['nilai_diskon'],    
'hitung_diskon_edit'      => $lainnya['hitung_diskon'],    
'nama_biaya_lain_edit'    => $lainnya['nama_biaya_lain'],    
'jumlah_biaya_lain_edit'  => $lainnya['jumlah_biaya_lain'],    
'total_edit'              => $lainnya['total'],    
'tanggal_transaksi'       => $lainnya['tanggal_transaksi'],    
'waktu_transaksi'         => $lainnya['waktu_transaksi'],
'nama_customer_edit'   => $lainnya['nama_customer'],
'nama_kasir_edit'      => $lainnya['nama_kasir'],
'kode_pos_edit'        => $lainnya['kode_pos'],
'nomor_kontak_edit'    => $lainnya['nomor_kontak'],  
'alamat_lengkap_edit'  => $lainnya['alamat_lengkap'],
    
);

$this->session->set_userdata($data_lain);
redirect(base_url('P_kasir/edit'));
}

public function canvas_edit(){
echo"
<div style='background-color: #4a4a4a; padding: 5px; color:#fff;'>
<h3 align='center'>";
$jumlah = $this->session->userdata('set_edit'); 
$hitung = count($jumlah);
$hasil = 0;   

if($hitung != ''){
foreach($jumlah as $i=>$hitung){
$hasil+=$jumlah[$i]['jumlah_produk'];
}

}
echo "Total Belanja : Rp.".number_format($hasil);

if($this->session->userdata('nilai_diskon_edit') != '' || $this->session->userdata('nilai_ppn_edit') != ''||  $this->session->userdata('nama_biaya_lain_edit') != ''  ){
$set_total = array(
'total_kasir_edit' => $hasil,
);
}else{

$set_total = array(
'total_kasir_edit' => $hasil,
'total_edit'       => $hasil,
);

}
$this->session->set_userdata($set_total);


echo"</h3>
</div>     

<table style='width: 100%; font-size:15px;' class='table-striped  table-condensed'>
<tr >
<th>Nama produk</th>
<th>Harga</th>
<th style='width: 13%;'>Qty</th>
<th>Jumlah</th>
<th>Aksi</th>
</tr>";
$data = $this->session->userdata('set_edit'); 
$ht = count($data);
if($ht != ''){
foreach($data as $i=>$ht){
echo "
<tr>
<td> ".$data[$i]['nama_produk']."</td>
<td>".number_format($data[$i]['harga_produk'])."</td>
<td><input type='text' id='qty_kasir".$i."' onchange='update_qty_edit(".$i.");' class='form-control' value='".$data[$i]['qty']."'></td>
<input type='hidden' id='stok_toko".$i."' class='form-control' value='".$data[$i]['stok_toko']."'>
<td>".number_format($data[$i]['jumlah_produk'])."</td>
<td><button onclick='hapus_setedit(".$i.");' class='btn btn-danger'><span class='fa fa-close'></span></button></td>
</tr>";
}
}

if($this->session->userdata('total_kasir_edit') != 0){
echo "<tr><td colspan='2'><b>Subtotal</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('total_kasir_edit'))."</b></td></tr>";
}
if($this->session->userdata('nilai_ppn_edit') != 0){
echo "<tr><td colspan='2'><b>PPN 10 %</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('nilai_ppn_edit'))."</b></td></tr>";

}


if($this->session->userdata('nilai_diskon_edit') != 0){
echo "<tr><td colspan='2'><b>Diskon ".$this->session->userdata('nilai_diskon_edit')." %</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('hitung_diskon_edit'))."</b></td></tr>";

}

if($this->session->userdata('nama_biaya_lain_edit') != ''){
echo "<tr><td colspan='2'><b>".$this->session->userdata('nama_biaya_lain_edit')."</b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('jumlah_biaya_lain_edit'))."</b></td></tr>";

}


if($this->session->userdata('total_edit') != ''){
echo "<tr><td colspan='2'><b>Total Bayar </b></b></td>"
."<td colspan='3'>: <b>Rp.".number_format($this->session->userdata('total_edit'))."</b></td></tr>";

}


echo "</table>";
}
public function hapus_set_edit(){
$id_hapus = $this->input->post('id_hapus');
unset($_SESSION['set_edit'][$id_hapus]);
unset($_SESSION['hitung_diskon_edit']);
unset($_SESSION['total_edit']);
unset($_SESSION['nilai_diskon_edit']);
unset($_SESSION['nilai_ppn_edit']);
unset($_SESSION['nama_biaya_lain_edit']);
unset($_SESSION['jumlah_biaya_lain_edit']);

}
public function update_qty_edit(){

$id_qty    = $this->input->post('id_qty');
$qty_kasir = $this->input->post('qty_kasir');
$detailsdata = $this->session->userdata('set_edit');
$d =  $detailsdata[$id_qty];

$data2 = array(
'id_produk'    => $d['id_produk'],
'barcode'      => $d['barcode'],
'nama_produk'  => $d['nama_produk'],
'qty'          => $qty_kasir,
'harga_produk' => $d['harga_produk'],
'jumlah_produk'=> $qty_kasir*$d['harga_produk'],
'stok_toko'    => $d['stok_toko'],    
);

array_push($detailsdata, $data2);

$this->session->set_userdata('set_edit',$detailsdata);

unset($_SESSION['set_edit'][$id_qty]);
unset($_SESSION['hitung_diskon_edit']);
unset($_SESSION['total_edit']);
unset($_SESSION['nilai_diskon_edit']);
unset($_SESSION['nilai_ppn_edit']);
unset($_SESSION['nama_biaya_lain_edit']);
unset($_SESSION['jumlah_biaya_lain_edit']);
}
public function set_edit(){

if($this->input->post('id_produk')){    
$id_produk =  $this->input->post("id_produk");
$query = $this->db->get_where("data_produk",array('id_produk'=>$id_produk));
$cek_sesi = $this->session->userdata('set_edit');


if($cek_sesi != NULL){

$data_lama = $this->session->userdata('set_edit');
foreach ($query->result_array() as $produk ){
$array2=array(
'id_produk'        => $produk['id_produk'],
'barcode'          => $produk['barcode'],
'nama_produk'      => $produk['nama_produk'],
'qty'              => 1,
'harga_produk'     => $produk['harga_produk'],
'jumlah_produk'    => $produk['harga_produk'],
'stok_toko'        => $produk['stok_toko'],
);
}

array_push($data_lama, $array2);

$this->session->set_userdata('set_edit',$data_lama);

unset($_SESSION['hitung_diskon_edit']);
unset($_SESSION['total_edit']);
unset($_SESSION['nilai_diskon_edit']);
unset($_SESSION['nilai_ppn_edit']);
unset($_SESSION['nama_biaya_lain_edit']);
unset($_SESSION['jumlah_biaya_lain_edit']);


}else{
foreach ($query->result_array() as $produk ){
$array['set_edit'][]=[
'id_produk'        => $produk['id_produk'],
'barcode'          => $produk['barcode'],
'nama_produk'      => $produk['nama_produk'],
'qty'              => 1,
'harga_produk'     => $produk['harga_produk'],
'jumlah_produk'    => $produk['harga_produk'],
'stok_toko'        => $produk['stok_toko'],
];
$this->session->set_userdata($array);
}
unset($_SESSION['hitung_diskon_edit']);
unset($_SESSION['total_edit']);
unset($_SESSION['nilai_diskon_edit']);
unset($_SESSION['nilai_ppn_edit']);
unset($_SESSION['nama_biaya_lain_edit']);
unset($_SESSION['jumlah_biaya_lain_edit']);

}
}
}
public function simpan_biaya_lain_edit(){
$biaya_lain = array(
'nama_biaya_lain_edit'   => $this->input->post('nama_biaya_lain'),
'jumlah_biaya_lain_edit' => $this->input->post('jumlah_biaya_lain'),
'total_edit'             => $this->input->post('jumlah_biaya_lain') + $this->session->userdata('total_edit'),
);    
$this->session->set_userdata($biaya_lain);


}
public function modal_diskon_edit(){
echo "<label>Total Belanja :</label>
<input readonly='' type='text' value='".$this->session->userdata('total_kasir_edit')."' id='total_kasir_diskon' class='form-control'>";
echo "<label>Nilai Diskon :</label>
<input type='text' onkeyup='set_diskon_edit();' value='' id='nilai_diskon' class='form-control'>";
echo "<label>Hasil Nilai Diskon :</label>
<input readonly='' type='text' value='' id='hasil_diskon' class='form-control'>";
}
public function set_diskon_edit(){
$nilai_diskon = $this->input->post('nilai_diskon');
$total_kasir  = $this->session->userdata('total_kasir_edit'); 
$hitung_diskon = $total_kasir * $nilai_diskon / 100 ;
$set_diskon    = $total_kasir -$hitung_diskon;
$nilai_ppn         = $this->session->userdata('nilai_ppn_edit');
$jumlah_biaya_lain = $this->session->userdata('jumlah_biaya_lain_edit');

if($nilai_ppn != '' || $jumlah_biaya_lain != '' ){  
$data_diskon = array(
'nilai_diskon_edit' => $nilai_diskon,
'hitung_diskon_edit'=> $hitung_diskon,
'total_edit'        => $set_diskon+$nilai_ppn+$jumlah_biaya_lain,
);
}else{
$data_diskon = array(
'nilai_diskon_edit' => $nilai_diskon,
'hitung_diskon_edit'=> $hitung_diskon,
'total_edit'        => $set_diskon,
);

}
$this->session->set_userdata($data_diskon);

}
public function modal_ppn_edit(){
$hasil_nilai_ppn = $this->session->userdata('total_kasir_edit') * 0.1;    
$harga_setelah_ppn = $this->session->userdata('total_edit') + $hasil_nilai_ppn;    

echo "<label>Total Belanja :</label>
<input readonly='' type='text' value='".$this->session->userdata('total_kasir_edit')."'  class='form-control'>";
echo "<label>Nilai ppn :</label>
<input type='text' readonly=''  value='10'   class='form-control'>";
echo "<label>Hasil nilai ppn :</label>
<input type='text' readonly='' id='hasil_nilai_ppn'  value='".$hasil_nilai_ppn."'   class='form-control'>";
echo "<label>Harga setelah PPN :</label>
<input readonly='' type='text' id='harga_setelah_ppn' value='".$harga_setelah_ppn."'  class='form-control'>";
}
public function simpan_ppn_edit(){

$hasil_nilai_ppn   = $this->input->post('hasil_nilai_ppn');
$harga_setelah_ppn = $this->input->post('harga_setelah_ppn');

$data_ppn =array(

'total_edit'    =>$harga_setelah_ppn,
'nilai_ppn_edit'=>$hasil_nilai_ppn,

);


$this->session->set_userdata($data_ppn);

}
public function simpan_customer_stroke_edit(){

if($this->input->post('nama_customer')){
$data_customer = array(
'nama_customer_edit'   => $this->input->post('nama_customer'),
'kode_pos_edit'        => $this->input->post('kode_pos'),
'nomor_kontak_edit'    => $this->input->post('nomor_kontak'),      
'alamat_lengkap_edit'  => $this->input->post('alamat_lengkap'),      
);
$this->session->set_userdata($data_customer);
}
}
public function modal_stroke_edit(){
echo "<input type='hidden' class='form-control' id='cek_customer' value='".$this->session->userdata('nama_customer')."'>
<label>Metode pembayaran :</label>
<select class='form-control' id='metode_pembayaran'>
<option>Bank Transfer</option>   
<option>Cash</option>   
</select>
<label>Jumlah uang</label>
<input type='text' onkeyup='jumlah_uang();' id='jumlah_uang' class='form-control'>

<label>Yang Harus Dibayar</label>
<input readonly='' id='harus_bayar' value=".$this->session->userdata('total_edit')." type='text' class='form-control'>

<label>Kembalian</label>
<input type='text' readonly='' id='kembalian' class='form-control'>
<label>Catatan</label>
<textarea type='text'  id='catatan' class='form-control'></textarea>
";

}
public function simpan_data_kasir_edit(){
$no_invoices = $this->session->userdata('no_invoices');    
$this->db->delete('data_produk_kasir',array('no_invoices'=>$no_invoices));


$simpan_data_penjualan_kasir = array(
'no_invoices'     => $no_invoices,
'nama_customer'   => $this->session->userdata('nama_customer_edit'),
'kode_pos'        => $this->session->userdata('kode_pos_edit'),
'nama_kasir'      => $this->session->userdata('nama_kasir_edit'),  
'nomor_kontak'    => $this->session->userdata('nomor_kontak_edit'),  
'alamat_lengkap'  => $this->session->userdata('alamat_lengkap_edit'),
'total_kasir'     => $this->session->userdata('total_kasir_edit'),  
'total'           => $this->session->userdata('total_edit'),
'nilai_diskon'    => !empty($this->session->userdata('nilai_diskon_edit'))?$this->session->userdata('nilai_diskon_edit') :0,  
'hitung_diskon'   => !empty($this->session->userdata('hitung_diskon_edit'))?$this->session->userdata('hitung_diskon_edit') :0,
'nilai_ppn'       => !empty($this->session->userdata('nilai_ppn_edit'))?$this->session->userdata('nilai_ppn_edit') :0,  
'nama_biaya_lain' => !empty($this->session->userdata('nama_biaya_lain_edit'))?$this->session->userdata('nama_biaya_lain_edit') :'',  
'jumlah_biaya_lain'=>!empty($this->session->userdata('jumlah_biaya_lain_edit'))?$this->session->userdata('jumlah_biaya_lain_edit') :0,
'jumlah_uang'      => $this->input->get('jumlah_uang'),  
'kembalian'        => $this->input->get('kembalian'),  
'metode_pembayaran' => $this->input->get('metode_pembayaran'),  
'catatan'           => $this->input->get('catatan'),  
'tanggal_transaksi' => $this->session->userdata('tanggal_transaksi'),
'waktu_transaksi'   => $this->session->userdata('waktu_transaksi'),
'status'            =>'selesai',
);
$this->db->update('data_penjualan_kasir',$simpan_data_penjualan_kasir,array('no_invoices'=>$no_invoices));


$data = $this->session->userdata('set_edit'); 
$ht = count($data);
foreach($data as $i=>$ht){
$data_produk_kasir = array(
'no_invoices'     => $no_invoices,
'id_produk'       => $data[$i]['id_produk'],
'barcode'         => $data[$i]['barcode'],
'nama_produk'     => $data[$i]['nama_produk'],
'qty'             => $data[$i]['qty'],
'harga_produk'    => $data[$i]['harga_produk'],
'jumlah_produk'   => $data[$i]['jumlah_produk'],
);

$this->db->insert('data_produk_kasir',$data_produk_kasir);
}
unset($_SESSION['set_edit']);
$unset_array = array(
'no_invoices',
'nama_customer_edit',
'kode_pos_edit',
'nomor_kontak_edit' ,  
'alamat_lengkap_edit',
'total_kasir_edit',  
'total_edit',
'nilai_diskon_edit',  
'hitung_diskon_edit',
'nilai_ppn_edit',  
'nama_biaya_lain_edit',  
'jumlah_biaya_lain_edit',
'tanggal_transaksi',    
'waktu_transaksi',
'nama_kasir_edit',
'kode_pos_edit',
'nomor_kontak_edit',  
'alamat_lengkap_edit',

);
$this->session->unset_userdata($unset_array);


$this->print_kasir($no_invoices);    
}

public function daftar_transaksi(){
$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_seluruh_transaksi');
$this->load->view('umum/V_footer');

}
public function data_customer(){
$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_daftar_customer');
$this->load->view('umum/V_footer');

}

public function hapus_customer(){
$id_customer = base64_decode($this->uri->segment(3));

$this->db->delete('customer_kasir',array('id_customer'=>$id_customer));

redirect(base_url('P_kasir/data_customer'));
}
public function edit_customer(){

$id_customer = base64_decode($this->uri->segment(3));

$query = $this->db->get_where('customer_kasir',array('id_customer'=>$id_customer));	

$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_edit_customer',['query'=>$query]);
$this->load->view('umum/V_footer');

}
public function update_customer(){

if($this->input->post('nama_customer')){

$data = array(
'nama_customer' => $this->input->post('nama_customer'),
'nomor_kontak' => $this->input->post('nomor_kontak'),
'kode_pos' => $this->input->post('kode_pos'),
'alamat_lengkap' => $this->input->post('alamat_lengkap'),
);

$this->db->update('customer_kasir',$data,array('id_customer'=>$this->input->post('id_customer')));
}
}
public function grafik_penjualan(){
$this->load->view('umum/V_header');
$this->load->view('P_kasir/V_grafik_penjualan');
$this->load->view('umum/V_footer');

}



}