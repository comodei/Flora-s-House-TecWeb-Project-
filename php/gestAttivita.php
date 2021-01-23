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
            $ulAttivita = '<ul class="admin" id="attivita">';

            foreach($listaAttivita as $attivita){
                //Inizio form e label
                $ulAttivita.='<li><form class="book" action="../php/modificaAttivita.php" method="post" title="Form per gestire le attivita" aria-label="Form per gestire le attivita"> <fieldset class="field_prenotaz">';
                
                //codice
                /*$ulAttivita.='<div class="row"><div class="col-25"><label for="codice">Codice:</label></div><div class="col-75">';
                $ulAttivita.='<input type="text" id="codice" name="codice" value="'.$attivita['Codice'].'"/></br></div></div>';*/
                //titolo
                $ulAttivita.='<div class="row"><div class="col-25"><label for="titolo">Titolo:</label></div><div class="col-75">';
                $ulAttivita.='<input type="text" id="titolo" name="titolo" value="'.$attivita['Titolo'].'"/></br></div></div>';
                //descrizione
                $ulAttivita.='<div class="row"><div class="col-25"><label for="descrizione">Descrizione:</label></div><div class="col-75">';
                $ulAttivita.='<textarea name="descrizione">'.$attivita['Descrizione'].'</textarea></div></div>';
                //link
                $ulAttivita.='<div class="row"><div class="col-25"><label for="link">Link:</label></div><div class="col-75">';
                $ulAttivita.='<input type="text" id="link" name="link" value="'.$attivita['Link'].'"/></br></div></div>';
                //alt_immagine
                $ulAttivita.='<div class="row"><div class="col-25"><label for="alt_immagine">Descrizione immagine:</label></div><div class="col-75">';
                $ulAttivita.='<input type="text" id="alt_imamgine" name="alt_immagine" value="'.$attivita['AltImmagine'].'"/></br></div></div>';
                //immagine
                $ulAttivita.='<div class="row"><div class="col-25"><label for="immagine">Percorso immagine:</label></div><div class="col-75">';
                $ulAttivita.='<input type="text" id="immagine" name="immagine" value="'.$attivita['Immagine'].'"/></br></div></div>';
                //bottoni
                $ulAttivita.='<div class="row">';
                $ulAttivita.='<button type="submit" name="submitMod" title="Pulsante per modificare con i dati inseriti">Modifica</button>';
                $ulAttivita.='<button type="submit" name="submitDel" title="Pulsante per eliminare attività">Rimuovi</button>';
                $ulAttivita.='</div>';

                $ulAttivita.='</fieldset></form></li>';
            }

            $ulAttivita.='</ul>';
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