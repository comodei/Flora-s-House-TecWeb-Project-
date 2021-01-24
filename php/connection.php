<?php 
    class connection{
        private const HOST = 'localhost';
        private const USERNAME = 'root'; 
        private const PASSWORD = '';
        private const DATABASE = 'comodei';
        private $connection;
        
        /*
        private const HOST = 'localhost';
        private const USERNAME = 'comodei'; 
        private const PASSWORD = 'wail7tePahk8cahw'; 
        private const DATABASE = 'comodei';
        */

        public function __construct(){
            $this->connection = mysqli_connect(connection::HOST,connection::USERNAME,
                connection::PASSWORD, connection::DATABASE);
        }
        
        public function getConnection(){
            return $this->connection;
        }
        public function closeConnection(){
            $this->connection->close();
        }
        public function isConnected(){
            if($this->connection->connect_errno){
                return false;
            }
            else{
                return true;
            }
        }

        public function getListAttivita(){
            $querySelect = "SELECT * FROM attivita ORDER BY Codice ASC";
            $queryResult = mysqli_query($this->connection, $querySelect);

            if(mysqli_num_rows($queryResult)!=0){
                
                $listAttivita = array();
                while($row = mysqli_fetch_assoc($queryResult)){
                    $attivita = array(
                        "Codice" => $row['Codice'],
                        "Titolo" => $row['Titolo'],
                        "Descrizione" => $row['Descrizione'],
                        "AltImmagine" => $row['AltImmagine'],
                        "Immagine" => $row['Immagine'],
                        "Link" => $row['Link']
                    );

                    array_push($listAttivita, $attivita);
                }

                return $listAttivita;
            }
            else{
                return null;
            }
        }
		
		 public function getListPrenotazioni(){
            $querySelect = "SELECT Nome,Cognome,Codice,DataCheckIn,DataCheckOut,Richieste FROM prenotazione,cliente WHERE cliente.CodiceFiscale=prenotazione.CodiceFiscale ORDER BY DataCheckIn ASC";
            $queryResult = mysqli_query($this->connection, $querySelect);

            if(mysqli_num_rows($queryResult)!=0){
                
                $listPrenotazioni = array();
                while($row = mysqli_fetch_assoc($queryResult)){
                    $prenotazione = array(
						"Nome" => $row['Nome'],
						"Cognome" => $row['Cognome'],
					    "Codice" => $row['Codice'],
                        "DataCheckIn" => $row['DataCheckIn'],
                        "DataCheckOut" => $row['DataCheckOut'],
                        "Richieste" => $row['Richieste'],
                    );

                    array_push($listPrenotazioni, $prenotazione);
                }

                return $listPrenotazioni;
            }
            else{
                return null;
            }
        }

    }








?>