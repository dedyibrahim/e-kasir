<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class M_login extends CI_Model{
    public function __construct() {
        parent::__construct();
    
    }
    
    public function login($email,$password){
       
      $query = $this->db->get_where('account',array('email'=>$email,'password'=> md5($password)));  
      $data = $query->num_rows();
      
      if($data>0){
          
          return $query;
      }
     
        
    }
    
    
}
