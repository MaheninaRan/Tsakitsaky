<?php 

class Genre extends CI_Model{
    private $id;
    private $nom;

    public function __construct($id='',$nom=''){
        $this->id=$id;
        $this->nom = $nom;
    }


    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){return $this->nom=$nom;}

    public function selectById($id){
        $this->db->select('*');
        $this->db->from('genre');
        $this->db->where('id' , $id);
        $query = $this->db->get()->result_array();
        $genre=[];
        foreach($query as $row){
            $genre= new Genre($row['id'],$row['nom']);
        }
       
        return $genre;
    }

}

?>