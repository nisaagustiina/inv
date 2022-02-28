<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_m extends CI_Model {
    public function get($id=null){
        $this->db->from('t_stock');
        if($id != null){
            $this->db->where('id_stock',$id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id){
        $this->db->where('id_stock',$id);
        $this->db->delete('t_stock');
    }

    public function get_stock_in(){
        $this->db->select('t_stock.id_stock,po,qty,date,note, p_item.id_item, p_item.name_item, p_item.code_item, p_group.name_group as group,p_category.name_category as category, user.name, p_unit.name_unit as unit,vendor.name_vendor as vendor');
        $this->db->from('t_stock');
        $this->db->join('p_item','t_stock.id_item=p_item.id_item');
        $this->db->join('user','t_stock.id_user=user.id_user');
        $this->db->join('p_group','p_item.id_group=p_group.id_group');
        $this->db->join('p_category','p_item.id_category=p_category.id_category');
        $this->db->join('p_unit','p_item.id_unit=p_unit.id_unit');
        $this->db->join('vendor','p_item.id_vendor=vendor.id_vendor');
        $this->db->where('type','in');
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_out(){
        $this->db->select('t_stock.id_stock,po,qty,date,note, p_item.id_item, p_item.name_item, p_item.code_item, p_group.name_group as group,p_category.name_category as category, user.name, p_unit.name_unit as unit,vendor.name_vendor as vendor');
        $this->db->from('t_stock');
        $this->db->join('p_item','t_stock.id_item=p_item.id_item');
        $this->db->join('user','t_stock.id_user=user.id_user');
        $this->db->join('p_group','p_item.id_group=p_group.id_group');
        $this->db->join('p_category','p_item.id_category=p_category.id_category');
        $this->db->join('p_unit','p_item.id_unit=p_unit.id_unit');
        $this->db->join('vendor','p_item.id_vendor=vendor.id_vendor');
        $this->db->where('type','out');
        $query = $this->db->get();
        return $query;
    }

    public function add_stock_in($data){
        $this->db->insert('t_stock', $data);
    }

    public function add_stock_out($data){
        $this->db->insert('t_stock', $data);
    }
}