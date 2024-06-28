<?php 

class Admin extends CI_Model{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;

    public function __construct($nom='',$prenom='',$email='',$password=''){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(){return $this->id;}
    public function setId($id){return $this->id=$id;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){return $this->nom=$nom;}

    public function getPrenom(){return $this->prenom;}
    public function setPrenom($prenom){return $this->prenom=$prenom;}

    public function getEmail(){return $this->email;}
    public function setEmail($email){return $this->email=$email;}
    
    public function getPassword(){return $this->password;}
    public function setPassword($password){return $this->password=$password;}

    public function get_admin($email, $password) {
        $this->db->select('id');
        $this->db->from('admin');
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
}

?>