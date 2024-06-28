<?php 

class Etudiant extends CI_Model{
    private $id;
    private $nom;
    private $prenom;
    private $genre;
    private $email;
    private $password;

    public function __construct($id='', $nom='',$prenom='', Genre $genre=null, $email='',$password=''){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->genre = $genre;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){return $this->nom=$nom;}

    public function getPrenom(){return $this->prenom;}
    public function setPrenom($prenom){return $this->prenom=$prenom;}
    
    public function getGenre(){return $this->genre;}
    public function setGenre(Genre $genre){return $this->genre=$genre;}

    public function getEmail(){return $this->email;}
    public function setEmail($email){return $this->email=$email;}
    
    public function getPassword(){return $this->password;}
    public function setPassword($password){return $this->password=$password;}

    public function get_utudiant($email, $password) {
        $this->db->select('id');
        $this->db->from('etudiant');
        $this->db->where('email' , $email);
        $this->db->where('password', $password);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->row();
            return $result->id;
        } else {
            return false;
        }
    }

    public function selectById($id){
        $this->load->model('Genre');
        $this->db->select('*');
        $this->db->from('etudiant');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        $equipe=[];
        foreach($query as $row){
            $genre = $this->Genre->selectById($row['idgenre']);
            $equipe= new Etudiant($row['id'],$row['nom'],$row['prenom'],$genre,$row['email'],$row['passwORd']);
        }
        return $equipe;
    }
}

?>