<?php

include 'database.php';

// get number of client 
if (isset($_GET['client_count'])) {
    $sql = "SELECT * FROM `clients`;";
    $data =  $mydb->getRows($sql);
    echo $data;
}

// get number of contact 
if (isset($_GET['contact_count'])) {
    $sql = "SELECT * FROM `contacts`;";
    $data =  $mydb->getRows($sql);
    echo $data;
}

// get number of link 
if (isset($_GET['link_count'])) {
    $sql = "SELECT * FROM `links`;";
    $data =  $mydb->getRows($sql);
    echo $data;
}
