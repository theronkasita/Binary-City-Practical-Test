<?php

include 'database.php';

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

// Delete client 
if (isset($_GET['client_id'])) {

    $client_id = $_GET['client_id'];

    $sql = "DELETE FROM clients WHERE id = '" . $client_id . "'";
    if ($mydb->insertData($sql))
        echo 'data Removed';
    else
        echo 'Removing data failed';
}

// Delete contact
if (isset($_GET['contact_id'])) {

    $contact_id = $_GET['contact_id'];

    $sql = "DELETE FROM contacts WHERE id = '" . $contact_id . "'";

    if ($mydb->insertData($sql))
        echo 'data Removed';
    else
        echo 'Removing data failed';
}
