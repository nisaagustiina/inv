<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Fungsi{
    protected $ci;

    function __construct(){
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('user_m');
        $id_user = $this->ci->session->userdata('id_user');
        $user_data = $this->ci->user_m->get($id_user)->row();
        return $user_data;
    }

    function count_item(){
        $this->ci->load->model('item_m');
        return $this->ci->item_m->get()->num_rows();
    }

    function count_user(){
        $this->ci->load->model('user_m');
        return $this->ci->user_m->get()->num_rows();
    }

    function count_stock_in(){
        $this->ci->load->model('stock_m');
        return $this->ci->stock_m->get_stock_in()->num_rows();
    }

    function count_stock_out(){
        $this->ci->load->model('stock_m');
        return $this->ci->stock_m->get_stock_out()->num_rows();
    }
}