<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Packet');
        $this->load->model('Admin');
        $this->load->model('ProduitPacket');
        $this->load->model('vue/PaimentEtudiant');
		$this->load->helper('file');
    }

    public function connexionAdmin(){
            $email=$this->input->post('email');
            $motdepasse=$this->input->post('password');
            $valiny=$this->Admin->get_admin($email,$motdepasse); 
            if ($valiny==false){
                $this->session->sess_destroy();
                echo "diso leizy";
                $this->load->view('header');
                $this->load->view('index');
            }else{
                $this->session->set_userdata('idadmin',$valiny);
                $packet = $this->Packet->selectAll();
                $data = array(
                    'packet'=>$packet
                );
                $this->load->view('admin/headerAdmin');
                $this->load->view('admin/index',$data);
            } 
	}

    public function accueil(){
        $packet = $this->Packet->selectAll();
        $erreur = $this->session->flashdata('error');
        $data = array(
            'packet'=>$packet,
            'error'=>$erreur
        );
        $this->load->view('admin/headerAdmin');
        $this->load->view('admin/index',$data);
    }

    public function crudFormule() {
        $listes = $this->ProduitPacket->selectAll();
        $produits = $this->Produit->selectAll();
        $packet = $this->Packet->selectAll();

        $data = array(
            'liste'=>$listes,
            'produit'=>$produits,
            'packet'=>$packet
        );
        $this->load->view('admin/headerAdmin');
        $this->load->view('admin/crudFormule',$data);
    }

    public function listePaiment(){
        $listes = $this->PaimentEtudiant->selectAll();
        $data = array(
            'liste'=>$listes
        );
        $this->load->view('admin/headerAdmin');
        $this->load->view('admin/listePayment',$data);
    }
    
	
}
