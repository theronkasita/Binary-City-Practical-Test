<?php

include '../database.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = 'SELECT * FROM `clients` WHERE `id` =' . $id;

    //get client data -->
    $data = $mydb->getSingleData($sql);

    if ($data)
        echo '<i class="text-success">selected client: </i>' . $data['name'];
}
