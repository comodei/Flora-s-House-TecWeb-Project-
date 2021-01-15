<?php
    require_once "connection.php";
    $connessione = new connection();
    $paginaHTML = file_get_contents("..". DIRECTORY_SEPARATOR . "html". DIRECTORY_SEPARATOR ."gestPrenotazioni.html");
    if($connessione->isConnected()){
        
        $listaPrenotazioni = $connessione->getListPrenotazioni();
        if($listaPrenotazioni != null){
			
            $ulPrenotazione = '<ul id="prenotazione">';

            foreach($listaPrenotazioni as $prenotazione){
				$ulPrenotazione.='<form class="book" action="../php/modificaPrenotazione.php" method="post" title="Form per gestione prenotazioni" aria-label="Form per gestire le prenotazioni"> <fieldset class="field_gestPrenotaz" id="anagrafica"> ';
                $ulPrenotazione.='<il> 
					<label for="codice"> Codice: '.$prenotazione['Codice'].
					'</label><input type="text" name="checkin" id="checkin" aria-required="true" value="'.$prenotazione['DataCheckIn'].'"aria-label="Inserisci la data del checkin nel formato GG-MM-AAAA" title="Inserisci la data del checkin nel formato GG-MM-AAAA"/>
					<input type="text" name="checkout" id="checkout" aria-required="true" value="'.$prenotazione['DataCheckOut'].'"aria-label="Inserisci la data del checkout nel formato GG-MM-AAAA" title="Inserisci la data del checkout nel formato GG-MM-AAAA"/>
					<textarea id="descrizione" name="descrizione" title="Scrivi qui per richieste particolari" aria-label="Scrivi qui per richieste particolari">'.$prenotazione['Richieste'].'</textarea>
					<button type="submit" name="submitMod" title="Pulsante per modificare la prenotazione" aria-label="Pulsante per modificare la prenotazione">Modifica</button>
					<button type="submit" name="submitDel" title="Pulsante per cancellare la prenotazione" aria-label="Pulsante per cancellare la prenotazione">Rimuovi</button>	
					</il></fieldset>';
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
