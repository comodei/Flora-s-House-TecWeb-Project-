<?php
    require_once "session.php";
    require_once "connection.php";

    if($_SESSION['connesso']==true){
        header('location:gest_prenotazioni.php');
        exit();
    }

    $paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."login.html");

    $utente = "";
    $password = "";

    if(isset($_POST['utente'])){
        $utente=$_POST['utente'];
    }
    if(isset($_POST['password'])){
        $password=$_POST['password'];
    }

    $connessione = new connection();
    $error = '<div class="err"><ul>';

    if($connessione->isConnected()){
        
        //CONTROLLI UTENTE E PASSWORD

        $query = "SELECT Utente FROM admin WHERE Utente=\"$utente\" AND Password=\"$password\"";
        $queryResult = mysqli_query($connessione->getConnection(), $query);

        if(mysqli_affected_rows($connessione->getConnection())==1){
            $_SESSION['connesso'] = true;
            $SESSION['utente'] = $utente;

            $connessione->closeConnection();

            header('location:gest_prenotazioni.php');
            exit;
        }
        else{
            $error.='<li>Credenziali errate</li>';
        }
    }
    else{
        $error.='<li>Connessione con il database non riuscita</li>';
    }
    $error.='</ul></div>';
    $paginaHTML = str_replace('<messaggi/>', $error, $paginaHTML);
    echo $paginaHTML;







?>