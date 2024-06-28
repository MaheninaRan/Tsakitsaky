<?php 

class ProduitPacket extends CI_Model{
    private $id;
    private $packet;
    private $produit;
    private $quantite;

    public function __construct($id='',Packet $packet = null,Produit $produit =null,$quantite=''){   
        $this->id=$id;
        $this->packet = $packet; 
        $this->produit = $produit;
        $this->quantite = $quantite;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getPacket(){return $this->packet;}
    public function setPacket(Packet $packet){return $this->packet=$packet;}

    public function getProduit(){return $this->produit;}
    public function setProduit(Produit $produit){return $this->produit=$produit;}

    public function getQuantite(){return $this->quantite;}
    public function setQuantite($quantite){return $this->quantite=$quantite;}
    

    public function insert($data){
        return $this->db->insert('produitpacket', $data);
    }

    public function delete($id){
        $this->db->where('idpacket', $id); 
        $this->db->delete('produitpacket');
    }

    
    public function deleteById($id){
        $this->db->where('id', $id); 
        $this->db->delete('produitpacket');
    }

    public function update($id,$produit,$quantite) {
        $mise_a_jour = array(
            'idproduit' => $produit,
            'quantite'=>$quantite
        );
        $this->db->where('id', $id);
        $this->db->update('produitpacket', $mise_a_jour);
    }

    public function selectById($id){
        $this->load->model('Produit');
        $this->load->model('Packet');
        $this->db->select('*');
        $this->db->from('produitpacket');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        $equipe=[];
        foreach($query as $row){
            $packet = $this->Packet->selectById($row['idpacket']);
            $produit = $this->Produit->selectById($row['idproduit']);
            $equipe= new ProduitPacket($row['id'],$packet,$produit,$row['quantite']);
        }
        return $equipe;
    }

    public function selectAll(){
        $this->load->model('Produit');
        $this->load->model('Packet');
        $this->db->select('*');
        $this->db->from('produitpacket');
        $query = $this->db->get()->result_array();
        $coureur=array();
        foreach($query as $row){
            $packet = $this->Packet->selectById($row['idpacket']);
            $produit = $this->Produit->selectById($row['idproduit']);
            $coureur= new ProduitPacket($row['id'],$packet,$produit,$row['quantite']);
            $coureurs[] = $coureur;
        }
        return $coureurs;
    }
}

?>