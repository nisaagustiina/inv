<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_login();
        $this->load->model('vendor_m');
    }

    public function index(){
        $this->template->load('template','vendor');
    }

    public function ajax_list(){
        $list = $this->vendor_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $vendor) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $vendor->name_vendor;
            $row[] = $vendor->address;
            $row[] = $vendor->phone;
            $row[] = $vendor->email;
            $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_vendor('."'".$vendor->id_vendor."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_vendor('."'".$vendor->id_vendor."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->vendor_m->count_all(),
            "recordsFiltered" => $this->vendor_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->vendor_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        $this->_validate();
        $data = array(
            'name_vendor' => $this->input->post('name_vendor'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            );
        $this->vendor_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        $this->_validate();
        $id = $this->input->post('id_vendor');
        $data = array(
            'name_vendor' => $this->input->post('name_vendor'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
        );
        $this->vendor_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->vendor_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name_vendor') == ''){
            $data['inputerror'][] = 'name_vendor';
            $data['error_string'][] = 'Vendor name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('address') == ''){
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('phone') == ''){
            $data['inputerror'][] = 'phone';
            $data['error_string'][] = 'Phone is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('email') == ''){
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
 
}

