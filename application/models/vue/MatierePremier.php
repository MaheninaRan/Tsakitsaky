<?php 

class MatierePremier extends CI_Model{
    private $id;
    private $packet;
    private $produit;
    private $quantite;
    private $prix;

    public function __construct(Packet $packet = null,Produit $produit =null,$quantite='',$prix=''){       
        $this->packet = $packet; 
        $this->produit = $produit;
        $this->quantite=$quantite;
        $this->prix = $prix;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getPacket(){return $this->packet;}
    public function setPacket(Packet $packet){return $this->packet=$packet;}

    public function getProduit(){return $this->produit;}
    public function setProduit(Produit $produit){return $this->produit=$produit;}

    public function getQuantite(){return $this->quantite;}
    public function setQuantite($quantite){return $this->quantite=$quantite;}

    public function getPrix(){return $this->prix;}
    public function setPrix($prix){return $this->prix=$prix;}
    

    public function selectById($id){
        $this->load->model('Produit');
        $this->load->model('Packet');
        $this->db->select('*');
        $this->db->from('matierepremier');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        $equipe=[];
        foreach($query as $row){
            $packet = $this->Packet->selectById($row['idpacket']);
            $produit = $this->Produit->selectById($row['idproduit']);
            $equipe= new MatierePremier($packet,$produit,$row['quantite'],$row['prix']);
        }
        return $equipe;
    }

    public function selectAll(){
        $this->load->model('Produit');
        $this->load->model('Packet');
        $this->db->select('*');
        $this->db->from('matierepremier');
        $query = $this->db->get()->result_array();
        $coureur=array();
        foreach($query as $row){
            $packet = $this->Packet->selectById($row['idpacket']);
            $produit = $this->Produit->selectById($row['idproduit']);
            $coureur= new MatierePremier($packet,$produit,$row['quantite'],$row['prix']);
            $coureurs[] = $coureur;
        }
        return $coureurs;
    }

    public function teste(){
        $query = $this->db->query('select sum(prix) as total from matierepremier group by idpacket');
        return $query->result_array();
    }
    
}

?>