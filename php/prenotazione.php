<?php
require_once "connection.php";

class prenotazione{

    private $check_in;
    private $check_out;
    private $richieste;
    private $cf;

    public function __construct($ci,$co,$ri,$cf){
        $this->check_in = $ci;
        $this->check_out = $co;
        $this->richieste = $ri;
        $this->cf = $cf;
    }

    /*public function isCorrect(){
        //Controlli da fare su dati prenotazione
    }*/

    public function inserisciPrenotazione(connection $db){
        
        $query = "INSERT INTO Prenotazione(DataCheckIn,DataCheckOut,Richieste,CodiceFiscale)
            VALUES (\"$this->check_in\",\"$this->check_out\",\"$this->richieste\",\"$this->cf\")";
        
        $queryResult = mysqli_query($db->getConnection(),$query);
        if(mysqli_affected_rows($db->getConnection()) > 0){
            return true;
        }
        else{
            return false;
        }
    }


}











?>