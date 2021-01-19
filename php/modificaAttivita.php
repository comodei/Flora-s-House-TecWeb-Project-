<?php
    require_once "connection.php";
    require_once "session.php";

    if($_SESSION['connesso']!=true){
        header('location:accessdenied.php');
        exit();
    }
    echo $_POST['codice'];
    $codice = $_POST['codice'];
    $titolo = "";
    $descrizione = "";
    $link = "";
    $altimmagine = "";
    $immagine = "";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $connessione = new connection();
        $error = '<div class="err"><ul>';
        if($connessione->isConnected()){
            
            if(isset($_POST['submitDel'])){
                $query = "DELETE FROM Attivita WHERE Codice = \"$codice\"";
                $queryResult = mysqli_query($connessione->getConnection(), $query);

                if(mysqli_affected_rows($connessione->getConnection())==1){
                    $connessione->closeConnection();
                    header('location:gestAttivita.php');
                    exit;
                }
                else{
                    //gestione degli errori
                }

            }

            else{
                $querySelect = "SELECT * FROM Attivita WHERE Codice=\"$codice\"";
                $queryResult = mysqli_query($connessione->getConnection(), $querySelect);

                if(mysqli_num_rows($queryResult)!=0){
                    $attivita = mysqli_fetch_assoc($queryResult);

                    $formattivita='<form class="book" action="../php/editAttivita.php" method="post" title="Form per gestire le attivita" aria-label="Form per gestire le attivita"> <fieldset class="field_prenotaz">';
                    
                    //codice
                    $formattivita.='<div class="row"><div class="col-25"><label for="codice">Codice:</label></div><div class="col-75">';
                    $formattivita.='<input type="text" id="codice" name="codice" value="'.$attivita['Codice'].'"/></br></div></div>';
                    //titolo
                    $formattivita.='<div class="row"><div class="col-25"><label for="titolo">Titolo:</label></div><div class="col-75">';
                    $formattivita.='<input type="text" id="titolo" name="titolo" value="'.$attivita['Titolo'].'"/></br></div></div>';
                    //descrizione
                    $formattivita.='<div class="row"><div class="col-25"><label for="descrizione">Descrizione:</label></div><div class="col-75">';
                    $formattivita.='<textarea name="descrizione">'.$attivita['Descrizione'].'</textarea></div></div>';
                    //link
                    $formattivita.='<div class="row"><div class="col-25"><label for="link">Link:</label></div><div class="col-75">';
                    $formattivita.='<input type="text" id="link" name="link" value="'.$attivita['Link'].'"/></br></div></div>';
                    //alt_immagine
                    $formattivita.='<div class="row"><div class="col-25"><label for="alt_immagine">Alt Immagine:</label></div><div class="col-75">';
                    $formattivita.='<input type="text" id="alt_imamgine" name="alt_immagine" value="'.$attivita['AltImmagine'].'"/></br></div></div>';
                    //immagine
                    $formattivita.='<div class="row"><div class="col-25"><label for="alt_immagine">Alt Immagine:</label></div><div class="col-75">';
                    $formattivita.='<input type="text" id="imamgine" name="immagine" value="'.$attivita['Immagine'].'"/></br></div></div>';
                    //bottoni
                    $formattivita.='<div class="row">';
                    $formattivita.='<button type="submit" name="submitMod" title="Pulsante per modificare con i dati inseriti">Modifica</button>';
                    $formattivita.='</div>';

                    $formattivita.='</fieldset></form>';

                    $paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."modificaAttivita.html");
                    echo str_replace("<formattivita/>",$formattivita,$paginaHTML);

                }
                else{
                    die("Errore query");
                }

            }
        }
    }



?>