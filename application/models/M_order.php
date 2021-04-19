<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {


	function __Construct(){

		parent:: __Construct();
		$this->load->database();

	}

	public function place_Order($data){
		$name = $this->input->post("txtname");
		$address = $this->input->post("txtaddress");
		$contact = $this->input->post("txtcontact");

		$cus = array(

				"cus_Name" => $name,
				"cus_address" => $address,
				"cus_contact" => $contact,
				"date"=>date('Y-m-d')
		);
			
		$this->db->insert("customer", $cus);
		
		if($this->db->affected_rows() > 0){
			$cus_ID = $this->db->insert_id();
			
				foreach($data as $keys => $values){
					
							$quantity = $values["item_quantity"];
							$price = 	$values["item_price"];
							
							$total = $quantity * $price;
							$VAT = $total * 0.12;
							
							$field = array(
								'cus_ID'=>$cus_ID,
								'prod_ID'=>$values["item_id"],
								'quantity'=>$quantity,
								'VAT'=>$VAT,
								'total'=>$total,
								"date"=>date('Y-m-d')
							);
							$this->db->insert('orders', $field);		
				}
				if($this->db->affected_rows() > 0){
					return true;
				}else{
					return false;
				}
				
		}else{

			return false;

		}



	}

	public function show_Category(){
		
		$query = $this->db->query("select * from category order by cat_ID ASC");
		return $query->result();

	}
	
	
	public function show_Menu(){
		$id = $this->input->post("id");
		$query = $this->db->query("select p.* from product p where p.cat_ID = '$id' ");
		return $query->result();

	}
	
	
	public function display_Orders(){
		$query = $this->db->query("select * from customer order by cus_ID DESC ");
		return $query->result();

	}
	
	
	public function view_Orders(){
		$id = $this->input->post('id');
		$query = $this->db->query("select p.*, o.* from orders o, product p where o.cus_ID = '$id' and o.prod_ID = p.prod_ID");
		return $query->result();

	}
	
	
	
	
	
}
