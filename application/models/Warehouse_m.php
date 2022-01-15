<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_m extends CI_Model {

    var $column_order = array(null,'name_group','name_category','code_item','name_item','name_unit','stock','name_vendor');
    var $column_search = array('name_group','name_category','code_item','name_item');
    var $order = array('id_item' => 'asc');

    private function _get_datatables_query(){
        $this->db->from('p_item');
        $this->db->join('p_group','p_item.id_group=p_group.id_group');
        $this->db->join('p_category','p_item.id_category=p_category.id_category');
        $this->db->join('p_unit','p_item.id_unit=p_unit.id_unit');
        $this->db->join('vendor','p_item.id_vendor=vendor.id_vendor');
        $i = 0;
        foreach ($this->column_search as $item){
            if(@$_POST['search']['value']) {
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables(){
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all(){
        $this->db->from('p_item');
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id){
        $this->db->from('p_item');
        $this->db->where('id_item',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data){
        $this->db->insert('p_item', $data);
        return $this->db->insert_id();
    }
 
    public function update($id, $data){
        $this->db->where('id_item', $id);
        $this->db->update('p_item',$data);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id){
        $this->db->where('id_item', $id);
        $this->db->delete('p_item');
    }

}