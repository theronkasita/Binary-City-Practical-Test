<?php

include '../database.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    // intialize query -->
    $sql = "SELECT * FROM `clients`;";

    // get number of rows representing the data -->
    $num_rows = $mydb->getRows($sql);

    // check if data exist -->
    if ($num_rows > 0) :

        // get client data -->
        $data = $mydb->getData($sql);
        $clientList = array();
        
        // display each row -->
        foreach ($data as $result) :
            $client = $result['id'];
            $name =  $result['name'];
            $client_code = $result['client_code'];

            // intialize query -->
            $sql = "SELECT * FROM `links` WHERE  `contact` = '$id' AND `client` = '$client' ;";

            // get number of rows representing the data -->
            $num_rows = $mydb->getRows($sql);

            // check if data exist -->
            if ($num_rows < 1) {
                echo '<li onclick="createLinkt(' . $client . ',' . $id . ')" class="list-group-item"> ' . $name . ' | ' . $client_code . ' </li>';
                $emptyList = '';
            } else {
                $emptyList = '<li class="list-group-item"> no client contact(s) found </li>';
            }
        endforeach;
        echo $emptyList;

    else :
        echo '<li class="list-group-item"> no client contact(s) found </li>';
    endif;

    // if no contact is selected -->
} else {
    echo '<li class="list-group-item"> no contact selected </li>';
}
