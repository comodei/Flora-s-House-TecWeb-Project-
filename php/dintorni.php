<?php
    require_once "connection.php";
    $connessione = new connection();
    $paginaHTML = file_get_contents("..". DIRECTORY_SEPARATOR . "html". DIRECTORY_SEPARATOR ."dintorni.html");
    if($connessione->isConnected()){
        
        $listaAttivita = $connessione->getListAttivita();
        if($listaAttivita != null){
			
            $dlAttivita = '<dl id="attivita">';

            foreach($listaAttivita as $attivita){
                $dlAttivita.='<dt>'. $attivita['Titolo'] . '</dt>';
                $dlAttivita.='<dd>';
                $dlAttivita.='<img src="'. $attivita["Immagine"].'" alt="'. $attivita["AltImmagine"] . '" role="img"/>';
                $dlAttivita.='<p>'. $attivita["Descrizione"] . '</p>';
                $dlAttivita.='<a href="'. $attivita["Link"] . '" title="Vai alla pagina per maggiori informazioni sull\'attività" 
                aria-label="Vai alla pagina per maggiori informazioni sull\'attività">Maggiori informazioni qui</a>';
                $dlAttivita.='</dd>';
            }

            $dlAttivita.='</dl>';
            echo str_replace("<listaAttivita />", $dlAttivita, $paginaHTML);
        }
        else{
            echo str_replace("<listaAttivita />", "Nessuna attività presente", $paginaHTML);
        }
    }
    else{
        die("Connessione non riuscita");
    }

    $connessione->closeConnection();

?>
