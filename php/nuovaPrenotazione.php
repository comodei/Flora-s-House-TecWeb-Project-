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
    
   
    
	if ($prenotazione->isCorrect() && $cliente->isCorrect()){
		$messaggio="";
		$connessione = new connection();
		if($connessione->isConnected()){
			$result_cliente = $cliente->inserisciCliente($connessione);
			$result_prenotazione = $prenotazione->inserisciPrenotazione($connessione);
			if($result_cliente&&$result_prenotazione){
				$messaggio.= '<div class="conferma"><p>Prenotazione completata</p></div>';
			} else $messaggio.= '<div class="errori"><p>Errore nell\' inserimento della prenotazione. Riprovare</p></div>';
			
		}
	
		$paginaHTML = str_replace('<messaggi/>', $messaggio, $paginaHTML);
		echo $paginaHTML;
	} else {
		$messaggioPerForm = '<div class="errori" ><ul>';
		if(!input_check::check_nome($cliente->getNome())){
			
			$messaggioPerForm.='<li>Inserisci un nome valido</li>';
		}
		if(!input_check::check_nome($cliente->getCognome())){
		
			$messaggioPerForm.='<li>Inserisci un cognome valido</li>';

		}
		if(!input_check::cf_check($cliente->getCF())){	
		    $messaggioPerForm.='<li>Inserisci un codice fiscale valido</li>';
		}
		if(!input_check::check_email($cliente->getEmail())){
		
			$messaggioPerForm.='<li>Inserisci una mail valida</li>';
		}
		if(!input_check::check_num($cliente->getCell())){
		
			$messaggioPerForm.='<li>Inserisci un numero di telefono valido</li>';
		}
		if(!input_check::check_card($cliente->getCarta())){
		
			$messaggioPerForm.='<li>Inserisci una carta di credito valida</li>';
		}
		if(!input_check::date_check($cliente->getNascita())){
		
			$messaggioPerForm.='<li>Inserisci una data di nascita valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</li>';
		}
		if(!input_check::date_check($prenotazione->getCheckin())){
		
			$messaggioPerForm.='<li>Inserisci una data di check-in valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</li>';
		}
		if(!input_check::date_check($prenotazione->getCheckout())){
		
			$messaggioPerForm.='<li>Inserisci una data di check-out valida: deve essere in formato ANNO-MESE-GIORNO (AAAA-MM-GG)</li>';
		}
		if($prenotazione->getCheckin() > $prenotazione->getCheckout()){
		
			$messaggioPerForm.='<li>La data di check in non può essere dopo la data di check out</li>';
		}
		
		
		$messaggioPerForm.='</ul></div>';
	
		$paginaHTML = str_replace('<messaggi/>', $messaggioPerForm, $paginaHTML);
		
		echo $paginaHTML;
		}
		
		
}
?>