<?php
require_once "connection.php";
require_once "prenotazione.php";
require_once "cliente.php";
require_once "input_check.php";

$paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."prenotazioni.html");

if(isset($_POST['submit'])){

    $prenotazione = new prenotazione($_POST['checkin'],$_POST['checkout'],
        $_POST['descrizione'],$_POST['codiceFiscale']);
    
    $cliente = new cliente($_POST['codiceFiscale'],$_POST['nome'],$_POST['cognome'],
        $_POST['cellulare'],$_POST['email'],$_POST['carta'],$_POST['nascita']);
    
   
    
	if ($prenotazione->isCorrect() && $cliente->isCorrect){
		$connessione = new connection();
		if($connessione->isConnected()){
			$result_cliente = $cliente->inserisciCliente($connessione);
			$result_prenotazione = $prenotazione->inserisciPrenotazione($connessione);
        
			if($result_prenotazione && $result_cliente){
				$messaggio = '<div id="conferma"><p>Cliente inserito correttamente</p></div>';
			}
			else{
				$messaggio = '<div id="errori"><p>Errore nell\' inserimento del cliente. Riprovare</p></div>';
			}
		}
	
		$paginaHTML = str_replace('<messaggi/>', $messaggio, $paginaHTML);
		echo $paginaHTML;
	} else {
		$messaggioPerForm = '<div id="errori" class="err"><ul>';
		if(!input_check::check_nome($cliente->getNome())){
			
			$messaggioPerForm.='<div class="err"><p>Inserisci un nome valido</p></div>';
		}
		if(!input_check::check_nome($cliente->getCognome())){
		
			$messaggioPerForm.='<div class="err"><p>Inserisci un cognome valido</p></div>';
		}
		if(!input_check::cf_check($cliente->getCF())){
		
			
			$messaggioPerForm.='<div class="err"><p>Inserisci un codice fiscale valido</p></div>';
		}
		if(!input_check::check_email($cliente->getEmail())){
		
			$messaggioPerForm.='<div class="err"><p>Inserisci una mail valida</p></div>';
		}
		if(!input_check::check_card($cliente->getCarta())){
		
			$messaggioPerForm.='<div class="err"><p>Inserisci una carta di credito valida</p></div>';
		}
		if(!input_check::date_check($cliente->getNascita())){
		
			$messaggioPerForm.='<div class="err"><p>Inserisci una data di nascita valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</p></div>';
		}
		if(!input_check::date_check($prenotazione->getCheckin())){
		
			$messaggioPerForm.='<div class="err"><p>Inserisci una data di check-in valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</p></div>';
		}
		if(!input_check::date_check($prenotazione->getCheckout())){
		
			$messaggioPerForm.='<div class="err"><p>Inserisci una data di check-out valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</p></div>';
		}
		if($prenotazione->getCheckin() > $prenotazione->getCheckout()){
		
			$messaggioPerForm.='<div class="err"><p>La data di check in non può essere dopo la data di check out</p></div>';
		}
		
		
		$messaggioPerForm.='</ul></div>';
	
		$paginaHTML = str_replace('<messaggi/>', $messaggioPerForm, $paginaHTML);
		
		echo $paginaHTML;
		}
		
		
}
?>