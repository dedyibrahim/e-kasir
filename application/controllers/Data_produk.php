<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Data_produk extends REST_Controller {

function __construct($config = 'rest') {
parent::__construct($config);
$this->load->database();
$this->load->library('session');
if(!$this->session->userdata('email') && !$this->session->userdata('username')){
           redirect(base_url()); 
}


}

function index_get(){
    $this->db->order_by('id_produk','DESC');
    $produk = $this->db->get('data_produk')->result();
    $this->response($produk, REST_Controller::HTTP_OK);
}


}
