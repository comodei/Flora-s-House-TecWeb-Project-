<?php 
    class connection{
        private const HOST = 'localhost';
        private const USERNAME = 'root';
        private const PASSWORD = '';
        private const DATABASE = 'comodei';
        private $connection;

        public function __construct(){
            $this->connection = mysqli_connect(connection::HOST,connection::USERNAME,
                connection::PASSWORD, connection::DATABASE);
        }

        public function closeConnection(){
            $connection->close();
        }
        public function isConnected(){
            if(mysqli_connect_errno($this->connection)){
                return false;
            }
            else{
                return true;
            }
        }

        public function getListAttivita(){
            $querySelect = "SELECT * FROM Attivita ORDER BY Codice ASC";
            $queryResult = mysqli_query($this->connection, $querySelect);

            if(mysqli_num_rows($queryResult)!=0){
                
                $listAttivita = array();
                while($row = mysqli_fetch_assoc($queryResult)){
                    $attivita = array(
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

    }








?>