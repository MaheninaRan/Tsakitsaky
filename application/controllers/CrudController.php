<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Packet');
        $this->load->model('Admin');
        $this->load->model('ProduitPacket');
		$this->load->helper('file');
        $this->load->helper(array('form','url'));
		$this->load->library('upload');
    }

    public function deletePacket(){
        $idpacket=$this->input->post('idpacket');
        $this->Packet->delete($idpacket);
        $this->ProduitPacket->delete($idpacket);
        redirect('index.php/AdminController/accueil');
    }
    
    public function deleteFormule(){
        $idformule=$this->input->post('idformule');
        $this->ProduitPacket->deleteById($idformule);
        redirect('index.php/AdminController/crudFormule');
    }
    

    public function editPacket(){
        $currentPhoto = $_POST['cureentphoto'];
        $config['upload_path']='./img/';
        $config['allowed_types']='gif|jpg|png';
        $config['max_size']=2048;
        $config['max_width']=1024;
        $config['max_height']=768;
        $sary='';
        $this->upload->initialize($config);
        if( ! $this->upload->do_upload('userfile')){
            echo $erreur =$this->upload->display_errors();
            $this->session->set_flashdata('error',$erreur);
            $sary=$currentPhoto;
            redirect('index.php/AdminController/accueil');
        }else {
            $data=$this->upload->data();
            $sary = 'img/' . $data['file_name'];
            $idpacket=$this->input->post('idpacket');
            $nom=$this->input->post('nom');
            $prix=$this->input->post('prix');
            $this->Packet->update($idpacket,$sary,$nom,$prix);
            redirect('index.php/AdminController/accueil');
        } 
    }


    public function editFormule(){
        $idformule=$this->input->post('idformule');
        $produit=$this->input->post('produit');
        $quantite=$this->input->post('quantite');
        $this->ProduitPacket->update($idformule,$produit,$quantite);
        redirect('index.php/AdminController/crudFormule');
    }

    public function ajoutFormule(){
        $packet=$this->input->post('packet');
        $produit=$this->input->post('produit');
        $quantite=$this->input->post('quantite');
        $insertData = array(
            'idpacket'=>$packet,
            'idproduit'=>$produit,
            'quantite'=>$quantite
        );
        $this->ProduitPacket->insert($insertData);
        redirect('index.php/AdminController/crudFormule');
    }
    
    public function ajouter(){
        $config['upload_path']='./img/';
        $config['allowed_types']='gif|jpg|png';
        $config['max_size']=2048;
        $config['max_width']=1024;
        $config['max_height']=768;
        $this->upload->initialize($config);
        if( ! $this->upload->do_upload('userfile')){
            $erreur =$this->upload->display_errors();
            $this->session->set_flashdata('error',$erreur);            
            $packet = $this->Packet->selectAll();
            $data = array(
                'packet'=>$packet,
                'error'=>$erreur
            );
            $this->load->view('admin/headerAdmin');
            $this->load->view('admin/index',$data);
        }else { 
            $data=$this->upload->data();
            $sary = 'img/' . $data['file_name'];
            $nom=$this->input->post('nom');
            $prix=$this->input->post('prix');
            $packetInsert = array(
                'photo'=>$sary,
                'nom'=>$nom,
                'prix'=>$prix
            );
            $this->Packet->insert($packetInsert);
            redirect('index.php/AdminController/accueil');
        } 
    }

	
}
