<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_m extends CI_Model {

    var $column_order = array(null,'id_item','qty','date','id_user','note');
    var $column_search = array('id_item','note');
    var $order = array('id_stock' => 'asc');

    private function _get_datatables_query(){
        $this->db->from('t_stock');
        $this->db->join('user','t_stock.id_user=user.id_user');
        $this->db->join('p_item','t_stock.id_item=p_item.id_item');
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
        $this->db->from('t_stock');
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id){
        $this->db->from('t_stock');
        $this->db->where('id_stock',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data){
        $this->db->insert('t_stock', $data);
        return $this->db->insert_id();
    }
 
    public function update($id, $data){
        $this->db->where('id_stock', $id);
        $this->db->update('t_stock',$data);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id){
        $this->db->where('id_stock', $id);
        $this->db->delete('t_stock');
    }

}