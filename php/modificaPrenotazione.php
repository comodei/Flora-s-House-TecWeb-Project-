<?php
    require_once "session.php";
    require_once "connection.php";
	require_once "input_check.php";

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
		if($connessione->isConnected()){
		
			if(isset($_POST['submitDel'])) {		 	
			 $query = "DELETE FROM prenotazione WHERE Codice=\"$codice\"";
			 $queryResult = mysqli_query($connessione->getConnection(), $query);
			 if(mysqli_affected_rows($connessione->getConnection())>=1){
					$connessione->closeConnection();
					echo "<div class='mess'>Prenotazione eliminata con successo, reindirizzamento in corso</div>";
					header( "refresh:5;url=gestPrenotazioni.php" );
					exit;
				} else {
					echo "<div class='err'>Errore nella rimozione della prenotazione </div>";
					header( "refresh:5;url=gestPrenotazioni.php" );
					exit;
				}
			
			 
			} else {
				$querable=true;
				$errorino="<div class='err'><ul>";
				if(!input_check::date_check($checkin)){
					$errorino.="<li>Inserisci una data di check-in valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</li>";
					$querable=false;
				}
				if(!input_check::date_check($checkout)){
					$errorino.='<li>Inserisci una data di check-out valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</li>';
					$querable=false;
				}
				if($checkin > $checkout){
					$errorino.='<li>La data di check in non può essere dopo la data di check out</li>';
					$querable=false;
				}
				if ($querable){
					$query = "UPDATE prenotazione SET DataCheckIn=\"$checkin\",DataCheckOut=\"$checkout\",Richieste=\"$richieste\" WHERE Codice=\"$codice\"";
					$queryResult = mysqli_query($connessione->getConnection(), $query);
					if(mysqli_affected_rows($connessione->getConnection())>=1){
						$connessione->closeConnection();
						echo "<div class='mess'>Prenotazione aggiornata con successo, reindirizzamento in corso</div>";
						header( "refresh:5;url=gestPrenotazioni.php" );
						exit;
					}
					else {
						echo "<div class='err'>Errore nell'aggiornamento della prenotazione </div>";
						header( "refresh:5;url=gestPrenotazioni.php" );
						exit;
					}
				}	else{
					echo $errorino."</ul></div>";
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