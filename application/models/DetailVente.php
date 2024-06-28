<?php 

class DetailVente extends CI_Model{
    private $id;
    private $etudiant;
    private $packet;
    private $client;
    private $dateheure;
    private $lieu;
    private $etatpaiement;
    

    public function __construct(Etudiant $etudiant=null,Packet $packet = null, $client='',$dateheure='',Lieu $lieu=null,$etatpaiement=''){       
        $this->packet = $packet; 
        $this->etudiant = $etudiant;
        $this->client = $client;
        $this->dateheure = $dateheure;
        $this->lieu= $lieu;
        $this->etatpaiement=$etatpaiement;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getPacket(){return $this->packet;}
    public function setPacket(Packet $packet){return $this->packet=$packet;}

    public function getEtudiant(){return $this->etudiant;}
    public function setEtudiant(Etudiant $etudiant){return $this->etudiant=$etudiant;}

    public function getClient(){return $this->client;}
    public function setClient($client){return $this->client=$client;}

    public function getDateheure(){return $this->dateheure;}
    public function setDateheure($dateheure){return $this->dateheure=$dateheure;}

    public function getLieu(){return $this->lieu;}
    public function setLieu(Lieu $lieu){return $this->lieu=$lieu;}

    public function getEtatpaiement(){return $this->etatpaiement;}
    public function setEtatpaiement($etatpaiement){return $this->etatpaiement=$etatpaiement;}
    

    public function insert($data){
        return $this->db->insert('detailvente', $data);
    }

    public function selectById($id){
        $this->load->model('Etudiant');
        $this->load->model('Packet');
        $this->db->select('*');
        $this->db->from('detailvente');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        $equipe=[];
        foreach($query as $row){
            $packet = $this->Packet->selectById($row['idpacket']);
            $etudiant = $this->Etudiant->selectById($row['idetudiant']);
            $lieu = $this->Lieu->selectById($row['idlieu']);
            $equipe= new DetailVente($etudiant,$packet,$row['client'],$row['dateheure'],$lieu,$row['etatpaiement']);
        }
        return $equipe;
    }

    public function selectAll(){
        $this->load->model('Etudiant');
        $this->load->model('Packet');
        $this->db->select('*');
        $this->db->from('detailvente');
        $query = $this->db->get()->result_array();
        $coureur=array();
        foreach($query as $row){
            $packet = $this->Packet->selectById($row['idpacket']);
            $etudiant = $this->Etudiant->selectById($row['idetudiant']);
            $lieu = $this->Lieu->selectById($row['idlieu']);
            $coureur= new DetailVente($etudiant,$packet,$row['client'],$row['dateheure'],$lieu,$row['etatpaiement']);
            $coureurs[] = $coureur;
        }
        return $coureurs;
    }

}

?>