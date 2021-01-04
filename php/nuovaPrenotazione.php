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
		$messaggioPerForm = '<div id="errori"><ul>';
		if(!input_check::check_nome($cliente->getNome())){
			$messaggioPerForm.='<li>Nome non valido</li>';
		}
		if(!input_check::check_nome($cliente->getCognome())){
			$messaggioPerForm.='<li>Cognome non valido</li>';
		}
		if(!input_check::cf_check($cliente->getCF())){
			$messaggioPerForm.='<li>Codice fiscale non valido</li>';
		}
		if(!input_check::check_email($cliente->getEmail())){
			$messaggioPerForm.='<li>Email non valida</li>';
		}
		if(!input_check::check_card($cliente->getCarta())){
			$messaggioPerForm.='<li>Carta di credito non valida</li>';
		}
		if(!input_check::date_check($cliente->getNascita())){
			$messaggioPerForm.='<li>Data di nascita non valida</li>';
		}
		if(!input_check::date_check($prenotazione->getCheckin())){
			$messaggioPerForm.='<li>Data check in non valida</li>';
		}
		if(!input_check::date_check($prenotazione->getCheckout())){
			$messaggioPerForm.='<li>Data check out non valida</li>';
		}
		if(!input_check::check_desc($prenotazione->getDesc())){
			$messaggioPerForm.='<li>Campo richieste non valido</li>';
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