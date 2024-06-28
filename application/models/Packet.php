<?php 

class Packet extends CI_Model{
    private $id;
    private $nom;
    private $photo;
    private $prix;

    public function __construct($id='',$nom='',$photo='',$prix=''){
        $this->id=$id;
        $this->nom = $nom;
        $this->photo=$photo;
        $this->prix = $prix;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){return $this->nom=$nom;}

    public function getPhoto(){return $this->photo;}
    public function setPhoto($photo){return $this->photo=$photo;}

    public function getPrix(){return $this->prix;}
    public function setPrix($prix){return $this->prix=$prix;}

    
    public function insert($data){
        return $this->db->insert('packet', $data);
    }

    public function delete($id){
        $this->db->where('id', $id); 
        return $this->db->delete('packet');
    }

    public function update($id,$photo,$nom,$prix) {
        $mise_a_jour = array(
            'photo'=>$photo,
            'nom' => $nom,
            'prix'=>$prix
        );
        $this->db->where('id', $id);
        $this->db->update('packet', $mise_a_jour);
    }

    public function selectById($id){
        $this->db->select('*');
        $this->db->from('packet');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        foreach($query as $row){
            $reponse= new Packet($row['id'],$row['nom'],$row['photo'],$row['prix']);
        }
        return $reponse;
    }

    public function selectAll(){
        $this->db->select('*');
        $this->db->from('packet');
        $query = $this->db->get()->result_array();
        $coureur=array();
        foreach($query as $row){
            $coureur= new Packet($row['id'],$row['nom'],$row['photo'],$row['prix']);
            $coureurs[] = $coureur;
        }
        return $coureurs;
    }

}

?>