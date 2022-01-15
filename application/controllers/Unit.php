<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model('unit_m');
    }

    public function index(){
        $this->template->load('template','p_unit');
    }

    public function ajax_list(){
        $list = $this->unit_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $unit) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $unit->name_unit;
            $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_unit('."'".$unit->id_unit."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_unit('."'".$unit->id_unit."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->unit_m->count_all(),
            "recordsFiltered" => $this->unit_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->unit_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        $this->_validate();
        $data = array(
            'name_unit' => $this->input->post('name_unit')
            );
        $this->unit_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        $this->_validate();
        $id = $this->input->post('id_unit');
        $data = array(
            'name_unit' => $this->input->post('name_unit')
        );
        $this->unit_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->unit_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name_unit') == ''){
            $data['inputerror'][] = 'name_unit';
            $data['error_string'][] = 'unit name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
 
}

