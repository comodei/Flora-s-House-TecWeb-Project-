<?php
require_once "connection.php";
require_once "input_check.php";
class cliente{

    private $cf;
    private $nome;
    private $cognome;
    private $cellulare;
    private $email;
    private $carta;
    private $data_nascita;

    public function __construct($cf,$no,$co,$ce,$em,$ca,$da){
        $this->cf=$cf;
        $this->nome=$no;
        $this->cognome=$co;
        $this->cellulare=$ce;
        $this->email=$em;
        $this->carta=$ca;
        $this->data_nascita=$da;
    }

    public function isCorrect(){
       return input_check::check_nome($this->nome) && input_check::check_nome($this->cognome) && input_check::cf_check($this->cf) &&  
		input_check::check_email($this->email) && input_check::check_card($this->carta) && input_check::date_check($this->data_nascita) && input_check::check_num($this->cellulare)  && input_check::fourteen($this->data_nascita);
    }
   
    public function inserisciCliente(connection $db){
        
        $query = "SELECT CodiceFiscale FROM cliente WHERE CodiceFiscale=\"$this->cf\"";
        $queryResult = mysqli_query($db->getConnection(),$query);
		
        if(mysqli_affected_rows($db->getConnection())==0){
            $query = "INSERT INTO cliente(CodiceFiscale,Nome,Cognome,Cellulare,Email,Carta,DataNascita)
                VALUES ( \"$this->cf\",\"$this->nome\",\"$this->cognome\",$this->cellulare,\"$this->email\",
                $this->carta,\"$this->data_nascita\")";
            
            $queryResult = mysqli_query($db->getConnection(),$query);
            if(mysqli_affected_rows($db->getConnection())==1){
                return true;
            }
            else{
                return false;
            }
        } else { 
			if(mysqli_affected_rows($db->getConnection())==1){
			return true;
			} else return false;
		} 
    }
	public function getNome(){
       return $this->nome;
    }
	public function getCognome(){
       return $this->cognome;
    }
	public function getCF(){
       return $this->cf;
    }
	public function getCell(){
       return $this->cellulare;
    }
	public function getEmail(){
       return $this->email;
    }
	public function getCarta(){
       return $this->carta;
    }
	public function getNascita(){
       return $this->data_nascita;
    }
	
	
	
}
?>