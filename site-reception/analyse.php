<?php

    include_once 'inc/config.php';   // Va chercher les infos

    // Liste des conditons des alertes des machines analysées
    function Analyse($json){
        $message = 'Bonjour, ';
        $cpt = 0;
        foreach ($json as $key => $value){
            if($key == 'version' and $value != '10.0.15.0.63'){
                $message .='Le système d’exploitation n’est pas à jour';
                $cpt++;
                //connexion à la DB en utilsant les constantes
                $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
                $conn = "INSERT INTO erreur (user, hostname, statut, type)
                VALUES ('$json->user', '$json->hostname', '1', '1')";
                $conn->close();
            }
        }
        if($cpt>0){
            mail(TO, SUJET, $message); 
        }
    }
?>