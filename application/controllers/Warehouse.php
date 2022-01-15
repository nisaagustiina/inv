<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model(['warehouse_m','group_m','category_m','unit_m','vendor_m']);
    }

    public function index(){
        $data = array (
            'group' => $this->group_m->get_datatables(),
            'category' => $this->category_m->get_datatables(),
            'unit'  => $this->unit_m->get_datatables(),
            'vendor' => $this->vendor_m->get_datatables()
        );
        $this->template->load('template','warehouse',$data);
    }

    public function ajax_list(){
        $list = $this->warehouse_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $warehouse) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $warehouse->name_group;
            $row[] = $warehouse->name_category;
            $row[] = $warehouse->code_item;
            $row[] = $warehouse->name_item;
            $row[] = $warehouse->name_unit;
            $row[] = $warehouse->stock;
            $row[] = $warehouse->name_vendor;
            $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_wh('."'".$warehouse->id_item."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_wh('."'".$warehouse->id_item."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->warehouse_m->count_all(),
            "recordsFiltered" => $this->warehouse_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->warehouse_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        // $this->_validate();
        $data = array(
            'id_group' => $this->input->post('group'),
            'id_category' => $this->input->post('category'),
            'code_item' => $this->input->post('codeItem'),
            'name_item' => $this->input->post('nameItem'),
            'id_unit' => $this->input->post('unit'),
            'id_vendor' => $this->input->post('vendor'),  
        );
        $this->warehouse_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        // $this->_validate();
        $id = $this->input->post('id_item');
        $data = array(
            'id_group' => $this->input->post('group'),
            'id_category' => $this->input->post('category'),
            'code_item' => $this->input->post('codeItem'),
            'name_item' => $this->input->post('nameItem'),
            'id_unit' => $this->input->post('unit'),
            'id_vendor' => $this->input->post('vendor'),  
        );
        $this->warehouse_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->warehouse_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    // private function _validate(){
    //     $data = array();
    //     $data['error_string'] = array();
    //     $data['inputerror'] = array();
    //     $data['status'] = TRUE;
 
    //     if($this->input->post('name_warehouse') == ''){
    //         $data['inputerror'][] = 'name_warehouse';
    //         $data['error_string'][] = 'warehouse name is required';
    //         $data['status'] = FALSE;
    //     }

    //     if($this->input->post('address') == ''){
    //         $data['inputerror'][] = 'address';
    //         $data['error_string'][] = 'Address is required';
    //         $data['status'] = FALSE;
    //     }
 
    //     if($this->input->post('phone') == ''){
    //         $data['inputerror'][] = 'phone';
    //         $data['error_string'][] = 'Phone is required';
    //         $data['status'] = FALSE;
    //     }
 
    //     if($this->input->post('email') == ''){
    //         $data['inputerror'][] = 'email';
    //         $data['error_string'][] = 'Email is required';
    //         $data['status'] = FALSE;
    //     }

    //     if($data['status'] === FALSE){
    //         echo json_encode($data);
    //         exit();
    //     }
    // }

    
 
}

