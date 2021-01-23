<?php
    require_once "connection.php";
	require_once "session.php";
	
	 if($_SESSION['connesso']!=true){
        header('location:accessdenied.php');
        exit();
    }
	
	
    $connessione = new connection();
    $paginaHTML = file_get_contents("..". DIRECTORY_SEPARATOR . "html". DIRECTORY_SEPARATOR ."gestPrenotazioni.html");

    if($connessione->isConnected()){
        
        $listaPrenotazioni = $connessione->getListPrenotazioni();
        if($listaPrenotazioni != null){
			
            $ulPrenotazione = '<ul class="admin" id="prenotazione">';

            foreach($listaPrenotazioni as $prenotazione){
				$ulPrenotazione.='<li><form class="book" action="../php/modificaPrenotazione.php" method="post" title="Form per gestione prenotazioni" aria-label="Form per gestire le prenotazioni"> <fieldset class="field_prenotaz" > 
					<label for="codice"> Codice prenotazione: '.$prenotazione['Codice'].'</label>
					<input type="text" name="codice"  id="codice" style="display:none;" value="'.$prenotazione['Codice'].'"/>
					<input type="text" name="checkin" id="checkin" aria-required="true" value="'.$prenotazione['DataCheckIn'].'"aria-label="Inserisci la data del checkin nel formato AAAA-MM-GG" title="Inserisci la data del checkin nel formato AAAA-MM-GG"/>
					<input type="text" name="checkout" id="checkout" aria-required="true" value="'.$prenotazione['DataCheckOut'].'"aria-label="Inserisci la data del checkout nel formato AAAA-MM-GG" title="Inserisci la data del checkout nel formato AAAA-MM-GG"/>
					<textarea id="richieste" name="richieste" title="Scrivi qui per richieste particolari" aria-label="Scrivi qui per richieste particolari">'.$prenotazione['Richieste'].'</textarea>
					<button type="submit" id="submitMod" name="submitMod" title="Pulsante per modificare la prenotazione" aria-label="Pulsante per modificare la prenotazione">Modifica</button>
					<button type="submit" id="submitDel" name="submitDel" title="Pulsante per cancellare la prenotazione" aria-label="Pulsante per cancellare la prenotazione">Rimuovi</button>	
					</fieldset></form></li>';
            }

            $ulPrenotazione.='</ul>';
            echo str_replace("<listaprenotazione />", $ulPrenotazione, $paginaHTML);
        }
        else{
            echo str_replace("<listaprenotazione />", "Nessuna prenotazione presente", $paginaHTML);
        }
    }
    else{
        die("Connessione non riuscita");
    }

    $connessione->closeConnection();

?>
