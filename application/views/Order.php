<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/dataTables.bootstrap.js"></script>

	<title>Simple Online Menu Ordering Application</title>
	<style type="text/css">

	li > a #1{
		
		addClass: active;
		
	}
	
	.td-center{
		
		align: center;
		
	}
	
	html {
		scroll-behavior: smooth;
	}
 

	 
	 #home {
	  padding-bottom: 5%;
	 } 
	

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
  <a style="margin-left: 35%;"  class="navbar-brand" href="#"><b>Simple Online Menu Ordering Application</b></a>
</nav>
<div class="container">
	<h3 align="center" style="color: #0e743d;"> Menu </h3>
	<hr>
	<ul class="nav nav-tabs" id ="nav">
		 
	</ul>

	<div class="content">
		<div id="menu"style="margin-top:20px;">
				
		</div>
		 
	</div>
	<!--p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php //echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p-->
</div>

<div class="container">
	<hr>
	<div class="alert alert-success" style="display: none;"></div>
	<h3 style="color: #0e743d;">Order Details <a type="button" style="margin-left: 75%;" href="javascript:;" onclick="display_Orders();"  class="btn btn-primary btn-md"><span class="glyphicon glyphicon-folder-open"></span>&nbsp; &nbsp;Show Orders</a></h3>
				<table id="table_id" class="table table-striped table-bordered table-sm">
				<thead>
					<tr>
						<th width="30%">Order</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="20%">VAT (12%)</th>
						<th width="20%">Total</th>
						<th width="5%">Action</th>
					</tr>
				</thead>
				<tbody id="showdata">
			
				</tbody>
			</table>			
</div>


<!-- Customer  Modal -->
<div id="cusModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="color: #0e743d"> Customer Information</h4>
      </div>
      <div class="modal-body">
			<form id="cusForm" action="" method="post" class="form-horizontal">
				<div class="form-group">
        			<label for="name" class="label-control col-md-2">Name:</label>
        			<div class="col-md-6">
						<input type="submit" style="display: none;">
        				<input type="text" name="txtname" class="form-control">
        			</div>
        		</div>
				
				<div class="form-group">
        			<label for="name" class="label-control col-md-2">Address:</label>
        			<div class="col-md-6">
        				<textarea type="text" name="txtaddress" class="form-control" rows="2"></textarea>
        			</div>
        		</div>
				
				<div class="form-group">
        			<label for="name" class="label-control col-md-2">Contact #:</label>
        			<div class="col-md-6">
        				<input type="text" name="txtcontact" class="form-control">
        			</div>
        		</div>
			</form>
      </div>
      <div class="modal-footer" style="text-align: center; margin: 0 auto;">
        <button type="button"  class="btn btn-success" id="btnConfirm" onclick="conFirm();"><span class="glyphicon glyphicon-ok"></span> Confirm Order</button>
      </div>
			
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Display Orders  Modal -->
<div id="orderModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"style="color: #0e743d"> Please click view to see Order by Customer</h4>
      </div>
      <div class="modal-body">
			<table id="table_cus" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact #</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="showcus">
			
				</tbody>
			</table>		
      </div>
      <div class="modal-footer" style="text-align: center; margin: 0 auto;">
        
      </div>
			
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- View Orders  Modal -->
<div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="color: #0e743d"></h4>
      </div>
      <div class="modal-body">
			<table id="table_view" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="30%">Order</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="20%">VAT (12%)</th>
						<th width="15%">Total</th>
					</tr>
				</thead>
				<tbody id="showorder">
			
				</tbody>
			</table>		
      </div>
      <div class="modal-footer" style="text-align: center; margin: 0 auto;">
        
      </div>
			
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="home"></div>
<script type="text/javascript">


// run functions here
show_Category();
show_Menu(1);
show_Orders();




//this function will populate the nav tab for category from category table
function show_Category(){
		
	$.ajax({

		method: "GET",
		type: "ajax",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/show_Category",
		async: false,
		dataType: "json",
		success: function(data){
			
			var i;
			for(i=0; i<data.length; i++){
				
				var cat_ID = data[i]["cat_ID"];
				var cat_Name = data[i]["cat_Name"];
				
				if(cat_ID == 1){
					
					$("#nav").append('<li class="active"><a data-toggle="tab" onclick="show_Menu('+cat_ID+')" href="#'+cat_ID+'">'+cat_Name+'</a></li>');
					
				}else{
				
					$("#nav").append('<li><a data-toggle="tab" onclick="show_Menu('+cat_ID+')" href="#'+cat_ID+'">'+cat_Name+'</a></li>');
				}
			}

		}

	});

}



//this function will populate the menu tab from product table
function show_Menu(id){
	$("#menu").empty();
	$.ajax({

		method: "POST",
		type: "ajax",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/show_Menu",
		async: false,
		data: {id: id},
		dataType: "json",
		success: function(data){
			
			var i;
			for(i=0; i<data.length; i++){
				
				var prod_ID = data[i]["prod_ID"];
				var cat_ID = data[i]["cat_ID"];
				var prod_Name = data[i]["prod_Name"];
				var prod_Price = data[i]["prod_Price"];
				var prod_Tax = data[i]["prod_Tax"];
				var prod_Photo = data[i]["prod_Photo"];
				var path = '<?php echo base_url() ?>'+prod_Photo;
				
				
				$("#menu").append('<form method="post" id="form'+prod_ID+'" action=""><div class="col-md-3">'
											+'<div class="panel panel-default">'
												+'<div class="panel-heading text-center">'
													+'<b>'+prod_Name+'</b>'
												+'</div>'
												+'<div class="panel-body">'
													+'<img class="resize" src="'+path+'" height="225px;" width="100%">'
												+'</div>'
												+'<div class="panel-footer text-center"><input type="submit" disabled style="display: none;">'
													+'<h4 class="text-danger">Php '+prod_Price+'</h4>'
													+'<input type="number" onKeyDown="return false" min="1" name="quantity" value="1" class="form-control" />'
													+'<input type="hidden" name="prod_Name" value="'+prod_Name+'"/>'
													+'<input type="hidden" name="prod_Price" value="'+prod_Price+'"/>'
													+'<input type="hidden" name="prod_ID" value="'+prod_ID+'"/>'
													+'</br>'
													+'<a href="#home" onclick="add_to_cart('+prod_ID+');" type="button" class="btn btn-success btn-sm">Add to Cart</a>'
												+'</div></div></div></form>');			
			}


		}

	});
		
}


function add_to_cart(prod_ID){
	var data = $("#form"+prod_ID).serialize();
	
	$.ajax({

		method: "POST",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/add_to_cart",
		data: data,
		async: false,
		dataType: "json",
		success: function(response){
				
				if(response == false || response == ""){
					
					alert("Item already added");
					//show_Orders();
						
				}else{
					show_Orders();
					
				}
			
		}

	});
	
	
}



function show_Orders(){
	
	var GrandTotal = 0;
	
	
	//transforming table to bootstrap DataTable
	$('#table_id').DataTable({
			destroy: true,
			"order": [[ 3, "desc" ]],
		    searching: false, paging: false, bFilter: false, bInfo: false, "ordering": false,
		 
	});
	
	
	
	$.ajax({
	    method: "GET",
		type: "ajax",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/show_Orders",
		async: false,
		dataType: "json",
		success: function(data){
			
			if(data != false){
				
				 
				var html = '';
			
				
				
				
				$.each(data, function(keys, values){
						
						
						// getting total price for each item
						var item_total = (values.item_quantity * values.item_price);
						var total =  parseFloat(item_total).toFixed(2);
						
						
						//computing the 12% VAT
						//note that the item price already included the 12% VAT
						var VAT = 	(item_total * 0.12);
							total_VAT = parseFloat(VAT).toFixed(2);
						
						
					
						// Getting the Grand Total
						GrandTotal = GrandTotal + item_total;
						
					
							html +='<tr>'+
										'<td>'+values.item_name+'</td>'+
										'<td>'+values.item_quantity+'</td>'+
										'<td>'+values.item_price+'</td>'+
										'<td>'+total_VAT+'</td>'+
										'<td>'+total+'</td>'+
										'<td class="td-center">'+
											'<a href="javascript:;" style="color: #c12c2c;" onclick="remove_Order('+values.item_id+');" class="btn btn-link btn-md"><span class="glyphicon glyphicon-trash"></span> Remove</a>'+
										'</td>'+
									'</tr>';
					
				});
				//formatting GrandTotal to two decimal places
				var GT_value = parseFloat(GrandTotal).toFixed(2);
				
				$('#showdata').html(html+'<tr>'+
											'<td></td>'+
											'<td></td>'+
											'<td></td>'+
											'<td style="color: #3e64ff;"><b>Grand Total</b></td>'+
											'<td style="color: #c12c2c;"><b>Php '+GT_value+'</b></td>'+
											'<td class="td-center">'+
												'<a href="javascript:;" onclick="place_Order();" style="color: #0e743d;" class="btn btn-link btn-md"><span class="glyphicon glyphicon-ok"></span> Place Order</a>'+
											'</td>'+
										 '</tr>');

			}else{
				
				$('#showdata').empty();
				
			}
		}

	});
	
	
}


function display_Orders(){
	
	$("#orderModal").modal("show");
	$('#showcus').empty();
	//transforming table to bootstrap DataTable
	$('#table_cus').DataTable({
			destroy: true,
		    searching: false, paging: false, bFilter: false, bInfo: false, "ordering": false,
		 
	});
	
	$.ajax({
		
		method: "GET",
		type: "ajax",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/display_Orders",
		async: false,
		dataType: "json",
		success: function(data){
			
				var html = '';
				$.each(data, function(keys, values){
						
							html +='<tr>'+
										'<td>'+values.cus_Name+'</td>'+
										'<td>'+values.cus_address+'</td>'+
										'<td>'+values.cus_contact+'</td>'+
										'<td>'+values.date+'</td>'+
										'<td class="td-center">'+
											'<a href="javascript:;" style="color: #0e743d;" onclick="view_Orders('+values.cus_ID+',\''+values.cus_Name+'\',\''+values.date+'\');" class="btn btn-link btn-md"><span class="glyphicon glyphicon-eye-open"></span> View</a>'+
										'</td>'+
									'</tr>';
					
				});
				
				$('#showcus').html(html);
			
		}

	});
	
	
}



function view_Orders(id, name, date){
	var GrandTotal = 0;
	
	$("#orderModal").modal("hide");
	$("#viewModal").modal("show");
	$("#viewModal .modal-title").html(name+" Orders | "+date);
	$('#showorder').empty();
	$('#table_view').DataTable({
			destroy: true,
		    searching: false, paging: false, bFilter: false, bInfo: false, "ordering": false,
		 
	});
	
	
	$.ajax({
		
		method: "POST",
		type: "ajax",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/view_Orders",
		data: {id,id},
		async: false,
		dataType: "json",
		success: function(data){
				if(data != null && data != ''){
				
				 
				var html = '';
			
				$.each(data, function(keys, values){
						
						
						// Getting the Grand Total
						var item_total = (values.quantity * values.prod_Price);
						GrandTotal = GrandTotal + item_total;
						
					
							html +='<tr>'+
										'<td>'+values.prod_Name+'</td>'+
										'<td>'+values.quantity+'</td>'+
										'<td>'+values.prod_Price+'</td>'+
										'<td>'+values.VAT+'</td>'+
										'<td>'+values.total+'</td>'+
									'</tr>';
					
				});
				console.log(GrandTotal);
				//formatting GrandTotal to two decimal places
				var GT_value = parseFloat(GrandTotal).toFixed(2);
				
				$('#showorder').html(html+'<tr>'+
											'<td></td>'+
											'<td></td>'+
											'<td></td>'+
											'<td style="color: #3e64ff;"><b>Grand Total</b></td>'+
											'<td style="color: #c12c2c;"><b>Php '+GT_value+'</b></td>'+
										 '</tr>');

			}else{
				
				$('#showorder').empty();
				
			}
			
		}

	});
	
	
}



function place_Order(){
	
	$('#cusForm')[0].reset();
	$('#cusForm input').parent().parent().removeClass('has-error');
	$('#cusForm textarea').parent().parent().removeClass('has-error');
	$("#cusModal").modal("show");
		
}


$(document).on('submit','#cusForm',function(e){

	e.preventDefault();	
	conFirm();

	
});



function conFirm(){
	
		var data = $("#cusForm").serialize();
		var name = $('input[name=txtname]');
		var address = $('textarea[name=txtaddress]');
		var contact = $('input[name=txtcontact]');
		var result = '';
		
			if(name.val()==''){
				name.parent().parent().addClass('has-error');
			}else{
				name.parent().parent().removeClass('has-error');
				result +='1';
			}
			
			if(address.val()==''){
				address.parent().parent().addClass('has-error');
			}else{
				address.parent().parent().removeClass('has-error');
				result +='2';
			}
			
			if(contact.val()==''){
				contact.parent().parent().addClass('has-error');
			}else{
				contact.parent().parent().removeClass('has-error');
				result +='3';
			}
			
			
			if(result=='123'){
		
		
				$.ajax({

					method: "POST",
					url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/place_Order",
					data: data,
					async: false,
					dataType: "json",
					success: function(message){
						if(message == true){
							$('#cusForm')[0].reset();
							$("#cusModal").modal("hide");
							$('.alert-success').html('<h4><span class="glyphicon glyphicon-thumbs-up"></span> Success! Order Complete</h4>').fadeIn().delay(4000).fadeOut('slow');
							destroy_Session();
							show_Orders();
							
						}
						
					}

				});
			}
}



	


function remove_Order(id){
	
	
	$.ajax({

		method: "POST",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/remove_Order",
		data: {id: id},
		async: false,
		dataType: "json",
		success: function(message){
			
			if(message ==  true){
				
				$('.alert-success').html('Item Removed').fadeIn().delay(4000).fadeOut('slow');
				show_Orders();
				
			}
			
		}

	});

}

function destroy_Session(){
	
	
	$.ajax({

		method: "POST",
		url: "<?php echo base_url() ?>index.php/Simple_online_menu_ordering_app/destroy_Session",
		data: "",
		async: false,
		dataType: "json",
		success: function(message){
			
			
				show_Orders();
				
			
		}

	});
	
	
	
}




</script>

</body>
</html>