<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_online_menu_ordering_app extends CI_Controller {


	function __Construct(){

		parent:: __Construct();
		$this->load->helper("url");
		$this->load->driver('session');
		$this->load->model("M_order", "m");
		header('Access-Control-Allow-Origin: *'); 
		$this->load->database();

	}


	public function index()
	{   
		$this->load->view('Order');
	}

	
	
	public function show_Category(){

		$result = $this->m->show_Category();
		echo json_encode($result);
	}
	
	
	public function show_Menu(){

		$result = $this->m->show_Menu();
		echo json_encode($result);
	}
	
	
	public function display_Orders(){

		$result = $this->m->display_Orders();
		echo json_encode($result);
	}
	
	
	public function view_Orders(){

		$result = $this->m->view_Orders();
		echo json_encode($result);
		
	}
	
	
	
	
	public function add_to_cart(){
	$i=1;
	if(!empty($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($this->input->post('prod_ID'), $item_array_id))
		{
			
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
							$i = $values["item_sort"];
			}
			
			$item_array = array(
				'item_id'			=>	$this->input->post('prod_ID'),
				'item_name'			=>	$this->input->post('prod_Name'),
				'item_price'		=>	$this->input->post('prod_Price'),
				'item_quantity'		=>	$this->input->post('quantity'),
				'item_sort'			=>	$i+2
			);
			$_SESSION["shopping_cart"][$i+2] = $item_array;
			echo json_encode(true);
		}
		else
		{
			echo json_encode(false);
			//echo json_encode($_SESSION["shopping_cart"]);
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$this->input->post('prod_ID'),
			'item_name'			=>	$this->input->post('prod_Name'),
			'item_price'		=>	$this->input->post('prod_Price'),
			'item_quantity'		=>	$this->input->post('quantity'),
			'item_sort'			=>	0
		);	
		$_SESSION["shopping_cart"][0]= $item_array;
		echo json_encode($_SESSION["shopping_cart"]);	
	}
	
	
	}


	public function remove_Order(){
		
		foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				if($values["item_id"] == $this->input->post('id'))
				{
					unset($_SESSION["shopping_cart"][$keys]);
					echo json_encode(true);
				}
			}
		
	}
	
	
	function place_Order() {
		
		$data = $_SESSION["shopping_cart"];
		$result = $this->m->place_Order($data);		
		echo json_encode($result);
			
		
	}
	
	function destroy_Session(){
		
		$this->session->sess_destroy();
		
	}
	
	
	
	public function show_Orders(){
		
		if(isset($_SESSION["shopping_cart"]))
		{	
			
			echo json_encode($_SESSION["shopping_cart"]);
			
			
		}else{
			
			echo json_encode(false);
				
			
		}	
		
	}
	
	
	

		
	
}
