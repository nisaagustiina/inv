<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stock extends CI_Controller {
    function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model('stock_m');
    }

	public function index(){
		$this->template->load('template','income');
	}

    public function ajax_list(){
        $list = $this->stock_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $stock) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $stock->po;
            $row[] = $stock->id_item;
            $row[] = $stock->qty;
            $row[] = $stock->date;
            $row[] = $stock->name;
            $row[] = $stock->note;
            // $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_stock('."'".$stock->id_stock."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            // <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_stock('."'".$stock->id_stock."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->stock_m->count_all(),
            "recordsFiltered" => $this->stock_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->stock_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        $this->_validate();
        $data = array(
            'name_stock' => $this->input->post('name_stock')
            );
        $this->stock_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        $this->_validate();
        $id = $this->input->post('id_stock');
        $data = array(
            'name_stock' => $this->input->post('name_stock')
        );
        $this->stock_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->stock_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name_stock') == ''){
            $data['inputerror'][] = 'name_stock';
            $data['error_string'][] = 'stock name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}

