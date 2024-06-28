<?php 

class VenduEtudiant extends CI_Model{
    private $etudiant;
    private $packet;
    private $quantite;

    public function __construct(Etudiant $etudiant=null,Packet $packet = null,$quantite=''){   
        $this->etudiant = $etudiant;
        $this->packet = $packet; 
        $this->quantite = $quantite;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getpacket(){return $this->packet;}
    public function setpacket(Packet $packet){return $this->packet=$packet;}

    public function getetudiant(){return $this->etudiant;}
    public function setetudiant(Etudiant $etudiant){return $this->etudiant=$etudiant;}

    public function getquantite(){return $this->quantite;}
    public function setquantite($quantite){return $this->quantite=$quantite;}
    

    public function insert($data){
        return $this->db->insert('venduetudiant', $data);
    }

    public function selectAll(){
        $this->load->model('etudiant');
        $this->load->model('Packet');
        $this->db->select('*');
        $this->db->from('venduetudiant');
        $query = $this->db->get()->result_array();
        $coureurs=array();
        foreach($query as $row){
            $packet = $this->Packet->selectById($row['idpacket']);
            $etudiant = $this->Etudiant->selectById($row['idetudiant']);
            $coureur= new VenduEtudiant($etudiant,$packet,$row['quantite']);
            $coureurs[] = $coureur;
        }
        return $coureurs;
    }
}

?>