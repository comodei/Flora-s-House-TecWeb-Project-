<?php
require_once "connection.php";

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

    /*public function isCorrect(){
        //Controlli da fare sui dati
    }*/
   
    public function inserisciCliente(connection $db){
        
        $query = "SELECT CodiceFiscale FROM Cliente WHERE CodiceFiscale=\"$this->cf\"";
        $queryResult = mysqli_query($db->getConnection(),$query);
        if(mysqli_affected_rows($db->getConnection())==0){
            $query = "INSERT INTO Cliente(CodiceFiscale,Nome,Cognome,Cellulare,Email,Carta,DataNascita)
                VALUES ( \"$this->cf\",\"$this->nome\",\"$this->cognome\",$this->cellulare,\"$this->email\",
                $this->carta,\"$this->data_nascita\")";
            
            $queryResult = mysqli_query($db->getConnection(),$query);
            if(mysqli_affected_rows($db->getConnection())>0){
                return true;
            }
            else{
                return false;
            }
        }
    }
}
?>