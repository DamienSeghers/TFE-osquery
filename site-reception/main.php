<?php
    include('analyse.php');
    include('validation.php');

    header('Content-type: application/json');
    # récupérer les données en json
    $json_str = file_get_contents('php://input');

    //décode le json
    // si le string n'est pas en json, return null
    $json_obj = json_decode($json_str);
   
    if(isset($json_obj)){
        
        // Fonction faisant le checkup de la machine questionnée
        Analyse($json_obj);

        // Ecriture dans la DB après checkup 
        Enregistrement($json_obj);
    }  
?>