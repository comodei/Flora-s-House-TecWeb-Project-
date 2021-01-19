<?php
    require_once "session.php";
    require_once "connection.php";

    if($_SESSION['connesso']==true){
        header('location:gestPrenotazioni.php');
        exit();
    }

    $paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."login.html");

    $utente = "";
    $password = "";
	if  ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

			$query = "SELECT utente FROM admin WHERE Utente=\"$utente\" AND Password=\"$password\"";
			$queryResult = mysqli_query($connessione->getConnection(), $query);

			if(mysqli_affected_rows($connessione->getConnection())==1){
				$_SESSION['connesso'] = true;
				$_SESSION['utente'] = $utente;

				$connessione->closeConnection();

				header('location:gestPrenotazioni.php');
				exit;
			}
			else {
				 $error.='<li>Credenziali errate</li>';
			}
			   
			
		}
		else{
			$error.='<li>Connessione con il database non riuscita</li>';
		}
		$error.='</ul></div>';
	
		$paginaHTML = str_replace('<messaggi/>', $error, $paginaHTML);
	}
		echo $paginaHTML;







?>