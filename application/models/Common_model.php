<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_Model extends CI_Model {	

	
function getData($table, $column_name='', $column_value=''){
		if($column_name!='' && $column_value!=''){
			$this->db->where($column_name, $column_value);
			}
		$sql = $this->db->get($table);
		$result = array();
		if($sql->num_rows() > 0){
			$result = $sql->result_array();
		}
		return $result;	
}

function getChalanData($chalanTable, $column_name='', $column_value='',$item_table){
	$this->db->select('*');
		$this->db->from($chalanTable);
		if($column_name!='' && $column_value!=''){
			$this->db->where($chalanTable.'.'.$column_name, $column_value);
			}
		
		$this->db->join($item_table, $item_table.'.chalan_no = '.$chalanTable.'.chalan_no');	
		$query = $this->db->get();
		return $query->result_array();

}

function getRawMaterialChalan($chalanid){
	$this->db->select('*');
	$this->db->from('raw_material_chalan');
	
	$this->db->where('raw_material_chalan.id', $chalanid);
	
	
	$this->db->join('raw_material', 'raw_material.material_chalan_id = raw_material_chalan.id');	
	$query = $this->db->get();
	return $query->result_array();
}

 function getFinishProductChalan($chalanid){
	$this->db->select('*');
	$this->db->from('product_stock_chalan');
	
	$this->db->where('product_stock_chalan.id', $chalanid);
	
	
	$this->db->join('product_stock', 'product_stock.stock_chalan_id = product_stock_chalan.id');	
	$query = $this->db->get();
	return $query->result_array();
}

function getEmployeeData(){
		$this->db->select('*');
		$this->db->where('role', 'employee');	
		
		$sql = $this->db->get('users');
		$result = array();
		if($sql->num_rows() > 0){
			$result = $sql->result_array();
		}
		return $result;
}

function getMaterialData(){
		$this->db->select('*');			
		$sql = $this->db->get('raw_material');
		$result = array();
		if($sql->num_rows() > 0){
			$result = $sql->result_array();
		}
		return $result;	
}

function getProductData(){
		$this->db->select('*');
		// $this->db->join('product_type', 'product_type.product_type_id = product.product_type_id');	
		// $this->db->join('employee', 'employee.employee_id = product.employee_id');
		// $this->db->join('users', 'users.id = employee.employee_id');
		$sql = $this->db->get('product');
		$result = array();
		if($sql->num_rows() > 0){
			$result = $sql->result_array();
		}
		return $result;	
}


function delete($table, $column_name='', $column_value=''){
	if($column_name!='' && $column_value!=''){
			$this->db->where($column_name, $column_value);
			}
		$sql = $this->db->delete($table);
		return $sql;
}

function save($table, $data){
	$this->db->insert($table,$data);
	return $this->db->insert_id();
}

function update($table, $data, $column, $value){
		$this->db->where($column, $value);
		$this->db->update($table, $data);
}



//end 
}
