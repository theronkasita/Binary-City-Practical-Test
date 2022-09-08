<?php

include '../database.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    // intialize query -->
    $sql = "SELECT * FROM `contacts`;";

    // get number of rows representing the data -->
    $num_rows = $mydb->getRows($sql);

    // check if data exist -->
    if ($num_rows > 0) :

        // get client data -->
        $data = $mydb->getData($sql);
        $contactList = array();

        // display each row -->
        foreach ($data as $result) :
            $contact = $result['id'];
            $surname =  $result['surname'];
            $email_address = $result['email_address'];

            // intialize query -->
            $sql = "SELECT * FROM `links` WHERE  `client` = '$id' AND `contact` = '$contact' ;";

            // get number of rows representing the data -->
            $num_rows = $mydb->getRows($sql);

            // check if data exist -->
            if ($num_rows < 1) {
                echo '<li onclick="createLinkt(' . $id . ',' . $contact . ')" class="list-group-item"> ' . $surname . ' | ' . $email_address . ' </li>';
                $emptyList = '';
            } else {
                $emptyList = '<li class="list-group-item"> no available contact(s) </li>';
            }
        endforeach;
        echo $emptyList;
    else :
        echo '<li class="list-group-item"> no available contact(s) </li>';
    endif;

    // if no client is selected -->
} else {
    '<li class="list-group-item"> no client selected </li>';
}
