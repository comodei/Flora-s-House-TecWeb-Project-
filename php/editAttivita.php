<?php
    require_once "connection.php";
    require_once "session.php";

    if($_SESSION['connesso']!=true){
        header('location:accessdenied.php');
        exit();
    }

    $codice = "";
    $titolo = "";
    $descrizione = "";
    $link = "";
    $altimmagine = "";
    $immagine = "";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        if(isset($_POST['codice'])){
            $codice = $_POST['codice'];
        }

        if(isset($_POST['titolo'])){
            $titolo = $_POST['titolo'];
        }
        
        if(isset($_POST['descrizione'])){
            $descrizione = $_POST['descrizione'];
        }

        if(isset($_POST['link'])){
            $link = $_POST['link'];
        }

        if(isset($_POST['alt_immagine'])){
            $altimmagine = $_POST['alt_immagine'];
        }

        if(isset($_POST['immagine'])){
            $immagine = $_POST['immagine'];
        }
    

        if(isset($_POST['submitMod'])){
            $connessione = new connection();
            if($connessione->isConnected()){
                $query = "UPDATE Attivita SET Codice=\"$codice\", Titolo=\"$titolo\", Descrizione=\"$descrizione\",
                        Link=\"$link\", AltImmagine=\"$altimmagine\", Immagine=\"$immagine\" WHERE Codice=\"$codice\"";
                $queryResult = mysqli_query($connessione->getConnection(), $query);
                if(mysqli_affected_rows($connessione->getConnection())==1){
                    $connessione->closeConnection();
                    header('location:gestAttivita.php');
                    exit;
                }
            }
        }
    }

?>