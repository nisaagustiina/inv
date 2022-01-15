<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model('category_m');
    }

    public function index(){
        $this->template->load('template','p_category');
    }

    public function ajax_list(){
        $list = $this->category_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $category) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $category->name_category;
            $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_category('."'".$category->id_category."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_category('."'".$category->id_category."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->category_m->count_all(),
            "recordsFiltered" => $this->category_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->category_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        $this->_validate();
        $data = array(
            'name_category' => $this->input->post('name_category')
            );
        $this->category_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        $this->_validate();
        $id = $this->input->post('id_category');
        $data = array(
            'name_category' => $this->input->post('name_category')
        );
        $this->category_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->category_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name_category') == ''){
            $data['inputerror'][] = 'name_category';
            $data['error_string'][] = 'category name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
 
}

