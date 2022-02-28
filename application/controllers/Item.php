<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model(['item_m','group_m','category_m','unit_m','vendor_m']);
    }

    public function index(){
        $data = array (
            'group' => $this->group_m->get_datatables(),
            'category' => $this->category_m->get_datatables(),
            'unit'  => $this->unit_m->get_datatables(),
            'vendor' => $this->vendor_m->get_datatables(),
        );
        $this->template->load('template','item',$data);
    }

    public function ajax_list(){
        $list = $this->item_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->name_group;
            $row[] = $item->name_category;
            $row[] = $item->code_item;
            $row[] = $item->name_item;
            $row[] = $item->name_unit;
            $row[] = $item->stock;
            $row[] = $item->name_vendor;
            $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_wh('."'".$item->id_item."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_wh('."'".$item->id_item."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->item_m->count_all(),
            "recordsFiltered" => $this->item_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->item_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        $this->_validate();
        $data = array(
            'id_group' => $this->input->post('group'),
            'id_category' => $this->input->post('category'),
            'code_item' => $this->input->post('codeItem'),
            'name_item' => $this->input->post('nameItem'),
            'id_unit' => $this->input->post('unit'),
            'id_vendor' => $this->input->post('vendor'),  
        );
        $this->item_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        $this->_validate();
        $id = $this->input->post('id_item');
        $data = array(
            'id_group' => $this->input->post('group'),
            'id_category' => $this->input->post('category'),
            'code_item' => $this->input->post('codeItem'),
            'name_item' => $this->input->post('nameItem'),
            'id_unit' => $this->input->post('unit'),
            'id_vendor' => $this->input->post('vendor'),  
        );
        $this->item_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->item_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nameItem') == ''){
            $data['inputerror'][] = 'nameItem';
            $data['error_string'][] = 'Material Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('codeItem') == ''){
            $data['inputerror'][] = 'codeItem';
            $data['error_string'][] = 'Material Code is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('category') == ''){
            $data['inputerror'][] = 'category';
            $data['error_string'][] = 'category is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('group') == ''){
            $data['inputerror'][] = 'group';
            $data['error_string'][] = 'group is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('unit') == ''){
            $data['inputerror'][] = 'unit';
            $data['error_string'][] = 'unit is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('vendor') == ''){
            $data['inputerror'][] = 'vendor';
            $data['error_string'][] = 'vendor is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
 
}

