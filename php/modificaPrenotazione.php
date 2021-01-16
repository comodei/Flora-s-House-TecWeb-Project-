<?php
    require_once "session.php";
    require_once "connection.php";

    if($_SESSION['connesso']==false){
        header('location:accessdenied.php');
        exit();
    }
	$checkin="";
	$checkout="";
	$richieste="";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if(isset($_POST['codice'])){
			$codice=$_POST['codice'];
		}
		if(isset($_POST['checkin'])){
			$checkin=$_POST['checkin'];
		}
		if(isset($_POST['checkout'])){
			$checkout=$_POST['checkout'];
		}
		if(isset($_POST['descrizione'])){
			$richieste=$_POST['descrizione'];
		}
		
		$connessione = new connection();
		$error = '<div class="err"><ul>';
		if($connessione->isConnected()){
		
			if(isset($_POST['submitDel'])) {
				
			 $query = "DELETE FROM prenotazione WHERE Codice=\"$codice\"";
			 $queryResult = mysqli_query($connessione->getConnection(), $query);
			 if(mysqli_affected_rows($connessione->getConnection())>=1){
					$connessione->closeConnection();
					header('location:gestPrenotazioni.php');
					exit;
				} else {
					// Gestione degli errori da decidere.
						
				}
			
			 
			} else {
			
				$query = "UPDATE prenotazione SET DataCheckIn=\"$checkin\",DataCheckOut=\"$checkout\",Richieste=\"$richieste\" WHERE Codice=\"$codice\"";
				$queryResult = mysqli_query($connessione->getConnection(), $query);
				if(mysqli_affected_rows($connessione->getConnection())>=1){
					$connessione->closeConnection();
					header('location:gestPrenotazioni.php');
					exit;
				}
				else {
					// $error.='<li>Credenziali errate</li>';
					echo "CIAO";
					echo mysqli_affected_rows($connessione->getConnection());
				}
				   
				
			}
			//$error.='<li>Connessione con il database non riuscita</li>';
			
			}
		//	$error.='</ul></div>';
		
		//	$paginaHTML = str_replace('<messaggi/>', $error, $paginaHTML);
		
	}
			







?>