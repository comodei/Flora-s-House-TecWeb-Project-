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
                $ulAttivita.='<li><form class="book" action="../php/modificaAttivita.php" method="post" title="Form per gestire le attivita" aria-label="Form per gestire le attivita"> <fieldset class="display_admin">';
                
                //codice
                //$ulAttivita.='<div class="row"><div class="col-25"><label for="codice">Codice:</label></div><div class="field">';
				$ulAttivita.='<input type="text" aria-hidden="true" class="codicihidden" name="codice"  id="codice" value="'.$attivita['Codice'].'"/>';
                //titolo
                $ulAttivita.='<div class="campo_prenotazione campo_attivita"><div class="tag"><label for="titolo">Titolo:</label></div><div class="field">';
                $ulAttivita.='<input type="text" id="titolo" name="titolo" value="'.$attivita['Titolo'].'"/></div></div>';
                //descrizione
                $ulAttivita.='<div class="campo_prenotazione campo_attivita"><div class="tag"><label for="descrizione">Descrizione:</label></div><div class="field">';
                $ulAttivita.='<textarea name="descrizione">'.$attivita['Descrizione'].'</textarea></div></div>';
                //link
                $ulAttivita.='<div class="campo_prenotazione campo_attivita"><div class="tag"><label for="link">Link:</label></div><div class="field">';
                $ulAttivita.='<input type="text" id="link" name="link" value="'.$attivita['Link'].'"/></div></div>';
                //alt_immagine
                $ulAttivita.='<div class="campo_prenotazione campo_attivita"><div class="tag"><label for="alt_immagine">Descrizione immagine:</label></div><div class="field">';
                $ulAttivita.='<input type="text" id="alt_imamgine" name="alt_immagine" value="'.$attivita['AltImmagine'].'"/></div></div>';
                //immagine
                $ulAttivita.='<div class="campo_prenotazione campo_attivita"><div class="tag"><label for="immagine">Percorso immagine:</label></div><div class="field">';
                $ulAttivita.='<input type="text" id="immagine" name="immagine" value="'.$attivita['Immagine'].'"/></div></div>';
                //bottoni
                $ulAttivita.='<div class="campo_prenotazione campo_attivita bottoni">';
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