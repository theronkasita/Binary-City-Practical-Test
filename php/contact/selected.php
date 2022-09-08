<?php

include '../database.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = 'SELECT * FROM `contacts` WHERE `id` =' . $id;

    //get contact data -->
    $data = $mydb->getSingleData($sql);

    if ($data)
        echo '<i class="text-success">selected contact: </i>' . $data['email_address'];
}
