<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model('group_m');
    }

    public function index(){
        $this->template->load('template','p_group');
    }

    public function ajax_list(){
        $list = $this->group_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $group) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $group->name_group;
            $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_group('."'".$group->id_group."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_group('."'".$group->id_group."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->group_m->count_all(),
            "recordsFiltered" => $this->group_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->group_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        $this->_validate();
        $data = array(
            'name_group' => $this->input->post('name_group')
            );
        $this->group_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        $this->_validate();
        $id = $this->input->post('id_group');
        $data = array(
            'name_group' => $this->input->post('name_group')
        );
        $this->group_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->group_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name_group') == ''){
            $data['inputerror'][] = 'name_group';
            $data['error_string'][] = 'group name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
 
}

