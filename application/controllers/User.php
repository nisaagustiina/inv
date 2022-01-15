<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('user_m');
    }

    public function index(){
        $this->template->load('template','user');
    }

    public function ajax_list(){
        $list = $this->user_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $user->username;
            $row[] = $user->name;
            $row[] = $user->level;
            $row[] = '<div style="display:flex"><a style="margin-right:5px" class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$user->id_user."'".')"><i class="fa fa-edit"></i> Edit</a>                           
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$user->id_user."'".')"><i class="fa fa-trash"></i> Delete</a></div>';

            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->user_m->count_all(),
            "recordsFiltered" => $this->user_m->count_filtered(),
            "data" => $data,
            );
        echo json_encode($output);
    }
 
    public function ajax_edit($id){
        $data = $this->user_m->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add(){
        $this->_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'username' => $this->input->post('user'),
            'password' => sha1($this->input->post('pass')),
            'level' => $this->input->post('level'),
        );
        $this->user_m->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update(){
        $this->_validate();
        $id = $this->input->post('id_user');
        $data = array(
            'name' => $this->input->post('name'),
            'username' => $this->input->post('user'),
            'password' => sha1($this->input->post('pass')),
            'level' => $this->input->post('level'),
        );
        $this->user_m->update($id, $data );
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id){
        $this->user_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('name') == ''){
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('user') == ''){
            $data['inputerror'][] = 'user';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pass') == ''){
            $data['inputerror'][] = 'pass';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('level') == ''){
            $data['inputerror'][] = 'level';
            $data['error_string'][] = 'Role is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
 
}

