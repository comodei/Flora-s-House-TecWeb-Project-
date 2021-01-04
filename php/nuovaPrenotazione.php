<?php
require_once "connection.php";
require_once "prenotazione.php";
require_once "cliente.php";

$paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."prenotazioni.html");

if(isset($_POST['submit'])){

    $prenotazione = new prenotazione($_POST['checkin'],$_POST['checkout'],
        $_POST['descrizione'],$_POST['codiceFiscale']);
    
    $cliente = new cliente($_POST['codiceFiscale'],$_POST['nome'],$_POST['cognome'],
        $_POST['cellulare'],$_POST['email'],$_POST['carta'],$_POST['nascita']);
    
    /*CONTROLLI
    $prenotazione->isCorrect();
    $cliente->isCorrect();

    se non passano ==> mostro errori
    se passano ==> codice seguente
    */
    $connessione = new connection();
    if($connessione->isConnected()){
        $result_cliente = $cliente->inserisciCliente($connessione);
        $result_prenotazione = $prenotazione->inserisciPrenotazione($connessione);
        
        if($result_prenotazione && $result_cliente){
            $messaggio = '<div id="conferma"><p>Personaggio inserimento correttamente</p></div>';
        }
        else{
            $messaggio = '<div id="errori"><p>Errore nell\' inserimento del persionaggio. Riprovare</p></div>';
        }
    }
    $paginaHTML = str_replace('<messaggi/>', $messaggio, $paginaHTML);
    echo $paginaHTML;
}
?>