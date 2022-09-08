<?php

include '../includes/database.php';

// unlink client to contact
if (isset($_GET['client']) && isset($_GET['contact'])) {

    $client = $_GET['client'];

    $contact = $_GET['contact'];

    $sql = "DELETE FROM `links` WHERE `client` ='" . $client . "' AND `contact`= '" . $contact . "';";


    if ($mydb->insertData($sql)) {
        echo 'data ulinked';
        
    } else {
        echo 'ulinking data failed';
    }
}
