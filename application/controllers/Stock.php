<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
    function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model(['stock_m','item_m']);
    }

    public function stock_in_data(){
        $data = array (
            'item' => $this->item_m->get()->result(),
            'stock_in' => $this->stock_m->get_stock_in()->result(),
        );
        $this->template->load('template','stock_in',$data);
    }

    public function stock_out_data(){
        $data = array (
            'item' => $this->item_m->get()->result(),
            'stock_out' => $this->stock_m->get_stock_out()->result(),
        );
        $this->template->load('template','stock_out',$data);
    }

    public function stock_in_del(){
        $id_stock = $this->uri->segment(4);
        $id_item = $this->uri->segment(5);
        $qty = $this->stock_m->get($id_stock)->row()->qty;
        $data = ['qty' => $qty, 'id_item' => $id_item];
        $this->item_m->update_stock_out($data);
        $this->stock_m->del($id_stock);
        redirect('stock/in');
    }

    public function stock_out_del(){
        $id_stock = $this->uri->segment(4);
        $id_item = $this->uri->segment(5);
        $qty = $this->stock_m->get($id_stock)->row()->qty;
        $data = ['qty' => $qty, 'id_item' => $id_item];
        $this->item_m->update_stock_in($data);
        $this->stock_m->del($id_stock);
        redirect('stock/out');
    }

    public function process(){
        if(isset($_POST['in_add'])){
            $data = array(
                'id_item' => $this->input->post('id_item'),
                'po' => $this->input->post('po'),
                'qty' => $this->input->post('qty'),
                'date' => $this->input->post('date'),
                'id_user' => $this->session->userdata('id_user'),
                'type' => 'in',
                'note'=> $this->input->post('note'),
            );
            $this->stock_m->add_stock_in($data);
            $this->item_m->update_stock_in($data);
            redirect('stock/in');
        }else if(isset($_POST['out_add'])){
            $data = array(
                'id_item' => $this->input->post('id_item'),
                'po' => $this->input->post('po'),
                'qty' => $this->input->post('qty'),
                'date' => $this->input->post('date'),
                'id_user' => $this->session->userdata('id_user'),
                'type' => 'out',
                'note'=> $this->input->post('note'),
            );
            $this->stock_m->add_stock_out($data);
            $this->item_m->update_stock_out($data);
            redirect('stock/out');
        }
    }
}