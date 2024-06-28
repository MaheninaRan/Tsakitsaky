<?php 

class Produit extends CI_Model{
    private $id;
    private $nom;
    private $valeur;
    private $unite;
    private $prix;

    public function __construct($id='',$nom='',$valeur='',$unite='',$prix=''){
        $this->id=$id;
        $this->nom = $nom;
        $this->valeur = $valeur;
        $this->unite = $unite;
        $this->prix = $prix;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){return $this->nom=$nom;}

    public function getvaleur(){return $this->valeur;}
    public function setvaleur($valeur){return $this->valeur=$valeur;}

    public function getunite(){return $this->unite;}
    public function setunite($unite){return $this->unite=$unite;}

    public function getPrix(){return $this->prix;}
    public function setPrix($prix){return $this->prix=$prix;}

    public function selectById($id){
        $this->db->select('*');
        $this->db->from('produit');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        $equipe=[];
        foreach($query as $row){
            $equipe= new Produit($row['id'],$row['nom'],$row['valeur'],$row['unite'],$row['prix']);
        }
        return $equipe;
    }

    public function selectAll(){
        $this->db->select('*');
        $this->db->from('produit');
        $query = $this->db->get()->result_array();
        $coureur=array();
        foreach($query as $row){
            $coureur= new Produit($row['id'],$row['nom'],$row['valeur'],$row['unite'],$row['prix']);
            $coureurs[] = $coureur;
        }
        return $coureurs;
    }

}

?>