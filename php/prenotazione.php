<?php

require_once "connection.php";
require_once "input_check.php";

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

    public function isCorrect(){
		if(input_check::date_check($this->check_in) && input_check::date_check($this->check_out) && input_check::future_date($this->check_in) && input_check::future_date($this->check_out)){
			if ( $this->check_in <= $this->check_out){
				return true;
			} 
		}
		return false;
	}

    public function inserisciPrenotazione(connection $db){
        
        $query = "INSERT INTO prenotazione(DataCheckIn,DataCheckOut,Richieste,CodiceFiscale)
            VALUES (\"$this->check_in\",\"$this->check_out\",\"$this->richieste\",\"$this->cf\")";
        
        $queryResult = mysqli_query($db->getConnection(),$query);
        if(mysqli_affected_rows($db->getConnection()) > 0){
            return true;
        }
        else{
            return false;
        }
    }
	
	public function getCheckin(){
		return $this->check_in;
	}
	public function getCheckout(){
		return $this->check_out;
	}
	public function getDesc(){
		return $this->richieste;
	}


}
?>