<?php 

class PaimentEtudiant extends CI_Model{
    private $etudiant;
    private $payer;
    private $reste;

    public function __construct(Etudiant $etudiant=null,$payer = '',$reste=''){   
        $this->etudiant = $etudiant;
        $this->payer = $payer; 
        $this->reste = $reste;
    }


    public function getpayer(){return $this->payer;}
    public function setpayer($payer){return $this->payer=$payer;}

    public function getetudiant(){return $this->etudiant;}
    public function setetudiant(Etudiant $etudiant){return $this->etudiant=$etudiant;}

    public function getreste(){return $this->reste;}
    public function setreste($reste){return $this->reste=$reste;}
    

    public function insert($data){
        return $this->db->insert('paiementEtudiant', $data);
    }

    public function selectAll(){
        $this->load->model('Etudiant');
        $this->db->select('*');
        $this->db->from('paiementEtudiant');
        $query = $this->db->get()->result_array();
        $coureurs=array();
        foreach($query as $row){
            $etudiant = $this->Etudiant->selectById($row['idetudiant']);
            $coureur= new PaimentEtudiant($etudiant,$row['payer'],$row['reste']);
            $coureurs[] = $coureur;
        }
        return $coureurs;
    }
}

?>