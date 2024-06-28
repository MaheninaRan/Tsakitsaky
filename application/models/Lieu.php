<?php 

class Lieu extends CI_Model{
    private $id;
    private $axe;
    private $nom;

    public function __construct($id='',$axe='',$nom=''){
        $this->id=$id;
        $this->axe=$axe;
        $this->nom = $nom;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getAxe(){return $this->axe;}
    public function setAxe($axe){return $this->axe=$axe;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){return $this->nom=$nom;}

    public function selectById($id){
        $this->db->select('*');
        $this->db->from('lieu');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        $genre=[];
        foreach($query as $row){
            $genre= new Lieu($row['id'],$row['axe'],$row['nom']);
        }
        return $genre;
    }

    public function selectAll(){
        $this->db->select('*');
        $this->db->from('lieu');
        $query = $this->db->get()->result_array();
        $coureurs=array();
        foreach($query as $row){
            $genre= new Lieu($row['id'],$row['axe'],$row['nom']);
            $coureurs[] = $genre;
        }
        return $coureurs;
    }

}

?>