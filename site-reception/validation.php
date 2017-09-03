<?php
    include_once 'inc/config.php';   // Va chercher les infos

    function Enregistrement($json){

        //connexion à la DB en utilsant les constantes
        $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);

        $conn = "INSERT INTO os_version (build, codename, major, minor, name, patch, platform, platform_like, version)
        VALUES ('$json->build', '$json->codename', '$json->major', '$json->minor', '$json->name', '$json->patch', '$json->platform', '$json->platform_like', '$json->version')";


        // Fermeture de la DB
        $conn->close();
    }
    
?>
