<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EtudiantController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Packet');
        $this->load->model('Etudiant');
        $this->load->model('DetailVente');
        $this->load->model('vue/VenduEtudiant');
        $this->load->model('vue/MatierePremier');
        $this->load->model('Lieu');

		$this->load->helper('file');
    }

    public function connexionEtudiant(){
            $packet = $this->Packet->selectAll();
            $lieu=$this->Lieu->selectAll();
            $data=array(
                'packet'=>$packet,
                'lieu'=>$lieu
            );
            $email=$this->input->post('email');
            $motdepasse=$this->input->post('password');
            $valiny=$this->Etudiant->get_utudiant($email,$motdepasse); 
            if ($valiny==false){
                $this->session->sess_destroy();
                echo "diso leizy";
                $this->load->view('header');
                $this->load->view('index');
            }else{
                $this->session->set_userdata('idetudiant',$valiny);
                $this->load->view('etudiant/headerEtudiant');
                $this->load->view('etudiant/index',$data);
            }
	}

    public function accueil(){
        $packet = $this->Packet->selectAll();
        $lieu=$this->Lieu->selectAll();
        $data=array(
            'packet'=>$packet,
            'lieu'=>$lieu
        );
        $this->load->view('etudiant/headerEtudiant');
        $this->load->view('etudiant/index',$data);
    }

    public function billetVendu(){
        $this->form_validation->set_rules('client','Saisissez le client','required');
        $this->form_validation->set_rules('client','client','required|min_length[3]');

        if ($this->form_validation->run()) {
            $etudiant=$this->session->userdata('idetudiant');
            $packet=$this->input->post('packet');
            echo "Packet tonga : " .$packet;
            $client=$this->input->post('client');
            $dateheure = $this->input->post('dateheure');
            $lieu = $this->input->post('lieu');
            $etat = $this->input->post('etat');
            $detailVente = array(
                'idetudiant'=>$etudiant,
                'idpacket'=>$packet,
                'client'=>$client,
                'dateheure'=>$dateheure,
                'idlieu'=>$lieu,
                'etatpaiement'=>$etat
            );
            $this->DetailVente->insert($detailVente);
            redirect('index.php/EtudiantController/accueil');
        }else{
            redirect('index.php/EtudiantController/accueil');
        } 
    }

    public function listebilletvendu(){
        $liste = $this->VenduEtudiant->selectAll();
        $data=array(
            'liste'=>$liste
        );
        $this->load->view('etudiant/headerEtudiant');
        $this->load->view('etudiant/listebilletVendu',$data);
    }

    public function matierpremier(){
        $liste = $this->MatierePremier->selectAll();
        $teste = $this->MatierePremier->teste();

        $data=array(
            'liste'=>$liste,
            'teste'=>$teste
        );
        $this->load->view('etudiant/headerEtudiant');
        $this->load->view('etudiant/detailmatierePacket',$data);
    }
	
}
