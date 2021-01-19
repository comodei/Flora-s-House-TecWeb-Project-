<?php

    require_once "connection.php";
    require_once "session.php";

    if($_SESSION['connesso']!=true){
        header('location:accessdenied.php');
        exit();
    }

    $connessione = new connection();
    $paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."gestAttivita.html");

    if($connessione->isConnected()){
        $listaAttivita = $connessione->getListAttivita();

        if($listaAttivita != null){
            $ulAttivita ='<form class="book" action="../php/modificaAttivita.php" method="post">';
            $ulAttivita.='<ul id="attivita">';

            foreach($listaAttivita as $attivita){
        
                $ulAttivita.='<li><label for="check_'.$attivita['Codice'].'">Titolo attività:'.$attivita['Titolo'].'</label></li>';
                $ulAttivita.='<input type="radio" id="check_'.$attivita['Codice'].'" name="codice" value="'.$attivita['Codice'].'">';
                
            }
            $ulAttivita.='</ul>';
            $ulAttivita.='<button type="submit" name="submitMod" title="Pulsante per modificare con i dati inseriti">Modifica</button>';
            $ulAttivita.='<button type="submit" name="submitDel" title="Pulsante per eliminare attività">Rimuovi</button>';
            $ulAttivita.='</form>';
            
            echo str_replace("<listaattivita/>",$ulAttivita,$paginaHTML);
        }
        else{
            echo str_replace("<listaattivita/>","Nessuna attività presente nel database",$paginaHTML);
    
        }

    }
    else{
        die("Connessione non riuscita");
    }

    $connessione->closeConnection();


?>