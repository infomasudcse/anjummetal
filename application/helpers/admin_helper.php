<?php

if(!function_exists('getTablesName')){
	function getTablesName($type){
		$chalanTable='';
		$itemTable='';
		switch($type){
			case 'rawMaterial':
				$chalanTable='raw_material_chalan';$itemTable='raw_material';
				break;
			case 'spareParts':
				$chalanTable='spare_parts_chalan';$itemTable='spare_parts_receive';
				break;
			case 'productSale':
					$chalanTable='product_sale_chalan';$itemTable='product_sell';
				break;

			default:
				$chalanTable='';$itemTable='';
				break;
		}
		return array('chalanTable' => $chalanTable, 'itemTable'=> $itemTable); 

	}
}

if(!function_exists('get_branch_name')){

	function get_branch_name($id){

		

		$CI = & get_instance();

       $CI->db->where('id', $id);

		$sql = $CI->db->get('branch');

		if($sql->num_rows() == 1){

			$data = $sql->row_array()['name'];

		}

		return $data;

	}

}





if(!function_exists('get_people_of_branch')){

	function get_people_of_branch($role, $branch_id=''){

		$data = array();

		$CI = & get_instance();
		if($branch_id !=''){
	       $CI->db->where('branch_id', $branch_id);
		}
       $CI->db->where('role', $role);
       $CI->db->order_by('full_name', 'ASC');

		$sql = $CI->db->get('users');

		if($sql->num_rows() > 0){

			$data = $sql->result_array();

		}

		return $data;

	}

}


if(!function_exists('get_user_info')){

	function get_user_info($id){

		$data = array();

		$CI = & get_instance();
		
       $CI->db->where('id', $id);

		$sql = $CI->db->get('users');

		if($sql->num_rows() > 0){

			$data = $sql->row_array();

		}

		return $data;

	}

}
if(!function_exists('get_user_info_by_id')){

	function get_user_info_by_id($id){

		$data = array();

		$CI = & get_instance();
		
       $CI->db->where('id', $id);

		$sql = $CI->db->get('users');

		if($sql->num_rows() > 0){

			$data = $sql->row_array();

		}

		return $data;

	}

}



if(!function_exists('calculate_employee_earn_for_product')){

	function calculate_employee_earn_for_product($product_id, $employee_id, $qty){

		$data = '';

		$CI = & get_instance();

       $CI->db->where('user_id', $employee_id);

       $CI->db->where('product_type_id', $product_id);



		$sql = $CI->db->get('employee');

		if($sql->num_rows() == 1){

			$data = $sql->row_array();

			$cost_per_unit = $data['salary_per_unit_product'];

			$cost = $cost_per_unit * $qty ;

			return $cost;

		}else{

			return false;

		}		

	}

}





if(!function_exists('get_user_id_by_metal_id')){

	function get_user_id_by_metal_id($metal_id){

		$data = '';

		$CI = & get_instance();

       $CI->db->where('metal_id', $metal_id);

		$sql = $CI->db->get('users');

		if($sql->num_rows() > 0){

			$data = $sql->row_array()['id'];

		}

		return $data;

	}

}





if(!function_exists('get_accessories_name')){

	function get_accessories_name($id){

		$data = '';

		$CI = & get_instance();

       $CI->db->where('id', $id);

		$sql = $CI->db->get('accessories');

		if($sql->num_rows() == 1){

			$data = $sql->row_array()['name'];

		}

		return $data;

	}

}


if(!function_exists('get_material_type_name')){

	function get_material_type_name($id){

		$data = '';

		$CI = & get_instance();

       $CI->db->where('type_id', $id);

		$sql = $CI->db->get('raw_material_type');

		if($sql->num_rows() == 1){

			$data = $sql->row_array()['type_name'];

		}

		return $data;

	}

}

if(!function_exists('get_expense_type_name')){

	function get_expense_type_name($id){

		$data = '';

		$CI = & get_instance();

       $CI->db->where('id', $id);

		$sql = $CI->db->get('expense_type');

		if($sql->num_rows() == 1){

			$data = $sql->row_array()['name'];

		}

		return $data;

	}

}





if(!function_exists('get_product_total_qty_by_employee_id')){

	function get_product_total_qty_by_employee_id($user_id){

		$data = array();

		$CI = & get_instance();

		$sql = "SELECT SUM(quantity) as Total FROM product WHERE employee_id = '".$user_id."' ";

		if($sql->num_rows() > 0){

			$data = $sql->row_array();

		}

		return $data;

	}

}





if(!function_exists('get_product_total_qty_by_type_id')){

	function get_product_total_qty_by_type_id($type){

		$data = array();

		$CI = & get_instance();

		$sql = "SELECT SUM(quantity) as Total FROM product WHERE product_type_id = '".$type."' ";

		if($sql->num_rows() > 0){

			$data = $sql->row_array();

		}

		return $data;

	}

}

if(!function_exists('get_parts_name')){

	function get_parts_name($id){

		$data = array();

		$CI = & get_instance();

		$CI->db->where('id', $id);

		$sql = $CI->db->get('spare_parts');

		if($sql->num_rows() == 1){

			$data = $sql->row_array()['name'];

		}

		return $data;

	}

}

if(!function_exists('get_product_info')){

	function get_product_info($product_id){

		$data = array();

		$CI = & get_instance();

		$CI->db->where('product_id', $product_id);

		$sql = $CI->db->get('product');

		if($sql->num_rows() == 1){

			$data = $sql->row_array();

		}

		return $data;

	}

}

if(!function_exists('get_product_type_name')){
	function get_product_type_name($product_type_id){
		$data = array();
		$CI = & get_instance();
		$CI->db->where('product_type_id', $product_type_id);
		$sql = $CI->db->get('product_type');
		if($sql->num_rows() == 1){
			$data = $sql->row_array()['type_name'];
		}
		return $data;
	}
}

if(!function_exists('get_product')){

	function get_product($product_id){

		$data = array();

		$CI = & get_instance();

		$CI->db->where('product_id', $product_id);

		$sql = $CI->db->get('product');

		if($sql->num_rows() == 1){

			$data = $sql->row_array();

		}

		return $data;

	}

}

if(!function_exists('get_all_product_type_by_user_id')){

	function get_all_product_type_by_user_id($user_id){

		$data = array();

		$CI = & get_instance();

		$CI->db->where('user_id', $user_id);

		$sql = $CI->db->get('employee');

		if($sql->num_rows() > 0){

			$data = $sql->result_array();

		}

		return $data;

	}

}





if(!function_exists('get_all_product_type')){

	function get_all_product_type(){

		$data = array();

		$CI = & get_instance();

		$sql = $CI->db->get('product_type');

		if($sql->num_rows() > 0){

			$data = $sql->result_array();

		}

		return $data;

	}

}



if(!function_exists('get_branch')){

	function get_branch(){

		$data = array();

		$CI = & get_instance();

		$sql = $CI->db->get('branch');

		if($sql->num_rows() > 0){

			$data = $sql->result_array();

		}

		return $data;

	}

}

if(!function_exists('get_department_name')){

	function get_department_name($id){

		$data = '';

		$CI = & get_instance();

		$CI->db->where('department_id', $id);

		$sql = $CI->db->get('department');

		if($sql->num_rows() == 1){

			$data = $sql->row_array()['department_name'];

		}

		return $data;

	}

}



if(!function_exists('get_salary_type')){

	function get_salary_type(){

		return array(

			'1'=>'fixed Salary',

			'2'=>'Hourly Base',

			'3'=>'Production Base'

		);

	}

}





if(!function_exists('get_payment_type')){

	function get_payment_type(){

		return array(

			'1'=>'salary',

			'2'=>'advance'

		);

	}

}









