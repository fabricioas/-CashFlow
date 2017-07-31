<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Carteira extends REST_Controller  {

	public function pesquisa_post()
	{
	    $value = "%". $this->post("pesquisa") . "%";
	    $this->load->database();
	    $query = $this->db->query('SELECT * FROM carteira where nm_carteira like ?', array($value));
	    $this->response($query->result());
	}
	
	public function salvar_post(){
	    $id = $this->post("id_carteira");
	    $nmCarteira = $this->post("nm_carteira");
	    $this->load->database();
	    $this->db->where('id_carteira', $id);
	    $this->db->update('carteira', array("nm_carteira" => $nmCarteira));
	    $this->response("Salvo");
	}
	
	public function salvar_put(){
	    $nmCarteira = $this->put("nm_carteira");
	    
	    $this->load->database();
	    $this->db->select_max('id_carteira');
	    $query = $this->db->get('carteira');
	    $id = $query->row("id_carteira");
	    $this->db->insert("carteira", array("id_carteira" => $id + 1, "nm_carteira" => $nmCarteira));
	    $this->response("Salvo");
	}
	
	public function salvar_delete($id){
	    $this->load->database();
	    $this->db->where('id_carteira', $id);
	    $this->db->delete("carteira");
	    $this->response("delete");
	}
}
