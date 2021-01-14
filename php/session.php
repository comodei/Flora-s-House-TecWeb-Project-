<?php
    session_start();

    if(!isset($_SESSION['connesso'])){
        $_SESSION['connesso']=false;
    }

    if(!isset($_SESSION['utente'])){
        $_SESSION['utente']='';
    }
    
?>