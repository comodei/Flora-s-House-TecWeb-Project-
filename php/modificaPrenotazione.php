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
					echo "<div class='mess'>Prenotazione eliminata con successo</div>";
					header( "refresh:5;url=gestPrenotazioni.php" );
					exit;
				} else {
					echo "<div class='err'>Errore nella rimozione della prenotazione </div>";
					header( "refresh:5;url=gestPrenotazioni.php" );
					exit;
				}
			
			 
			} else {
			
				$query = "UPDATE prenotazione SET DataCheckIn=\"$checkin\",DataCheckOut=\"$checkout\",Richieste=\"$richieste\" WHERE Codice=\"$codice\"";
				$queryResult = mysqli_query($connessione->getConnection(), $query);
				if(mysqli_affected_rows($connessione->getConnection())>=1){
					$connessione->closeConnection();
					echo "<div class='mess'>Prenotazione aggiornata con successo</div>";
					header( "refresh:5;url=gestPrenotazioni.php" );
					exit;
				}
				else {
					echo "<div class='err'>Errore nell'aggiornamento della prenotazione </div>";
					header( "refresh:5;url=gestPrenotazioni.php" );
					exit;
				}
				   	
			}	
			
			
		} else{
		echo "<div class='mess'> Errore nell'instaurazione della connessione</div>";
		header( "refresh:5;url=gestPrenotazioni.php" );
		exit;
		}
		
	} else {
		header('location:gestPrenotazioni.php');
		exit;
	}
			

?>