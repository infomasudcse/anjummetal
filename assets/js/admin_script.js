

$(document).ready(function() {

    $('#raw_material_type_table').DataTable( {
        "ajax": url+'view/get_all_material_type'
  //       dom: 'Bfrtip',
  //       buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
		// ]
    } );


    $('#raw_material_table').DataTable( {
        "ajax": url+'view/get_all_material'
  //       dom: 'Bfrtip',
  //       buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
		// ]
    } );


    $('#product_type').DataTable( {
        "ajax": url+'view/get_all_product_type'
  //       dom: 'Bfrtip',
  //       buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
		// ]
    } );
    $('#product').DataTable( {
        "ajax": url+'view/get_product'
  //       dom: 'Bfrtip',
  //       buttons: [
    //  'copy', 'csv', 'excel', 'pdf', 'print'
    // ]
    } );

     $('#ready_product').DataTable( {
        "ajax": url+'view/get_all_product'
  //       dom: 'Bfrtip',
  //       buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
		// ]
    } );

     $('#employee_list').DataTable( {
        "ajax": url+'view/get_all_employee'
  //       dom: 'Bfrtip',
  //       buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
		// ]
    } );


 $('#buyer_list').DataTable( {
        "ajax": url+'view/get_all_buyer'
  //       dom: 'Bfrtip',
  //       buttons: [
    //  'copy', 'csv', 'excel', 'pdf', 'print'
    // ]
    } );

$('#supplier_list').DataTable( {
        "ajax": url+'view/get_all_supplier'
  //       dom: 'Bfrtip',
  //       buttons: [
    //  'copy', 'csv', 'excel', 'pdf', 'print'
    // ]
    } );

  $('#staff_list').DataTable( {
        "ajax": url+'view/get_all_staff'
  //       dom: 'Bfrtip',
  //       buttons: [
    //  'copy', 'csv', 'excel', 'pdf', 'print'
    // ]
    } );

 $('#department_table').DataTable( {
        "ajax": url+'view/get_all_department'
  //       dom: 'Bfrtip',
  //       buttons: [
    //  'copy', 'csv', 'excel', 'pdf', 'print'
    // ]
    } );

$('#expense_type_table').DataTable( {
        "ajax": url+'view/get_all_expense_type'
  //       dom: 'Bfrtip',
  //       buttons: [
    //  'copy', 'csv', 'excel', 'pdf', 'print'
    // ]
    } );

$('#branch_table').DataTable( {
        "ajax": url+'view/get_all_Branch'
  //       dom: 'Bfrtip',
  //       buttons: [
    //  'copy', 'csv', 'excel', 'pdf', 'print'
    // ]
    } );







//end
} );





