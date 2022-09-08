<?php

include 'database.php';

$conn = $mydb->connect();

// get all client data
if (isset($_GET['view'])) {

    $sql = "SELECT * FROM `clients`";

    $data =  getData($conn, $sql);

    if ($data) {

        foreach ($data as $result) {

            $id = $result['id'];
            $name = $result['name'];
            $client_code = $result['client_code'];

            $count = getRows($conn, 'SELECT * FROM `links` WHERE client = "' . $id . '" ;');

            echo '<tr>';
            echo '<th scope="row" class="text-center"> ' . $count . ' </th>';
            echo '<td class="text-left"><a class="nav-link" href="clients.php?id=' . $count . '"> ' . $name . ' </a></td>';
            echo '<td class="text-left"><a class="nav-link" href="clients.php?id= ' . $count . '"> ' . $client_code . '</a></td>';
            echo '<td class="text-center">' . $count . '</td>';
            echo '</tr>';
        }
    }
}


// link client to contact
if (isset($_POST['link_contact'])) {

    $client = $_POST['client'];
    $contact = $_POST['contact'];

    if ($contact > 0) {

        $sql = "INSERT INTO `links`( `client`, `contact`) VALUES ('$client','$contact')";

        if (mysqli_query($conn, $sql))
            echo "1";
        else
            echo "0";
    }
}


// create new client
if (isset($_POST['create_client'])) {

    $client_name = $_POST['client_name'];

    $sql = "SELECT * FROM `clients` WHERE `name` = '$client_name' ";

    if (mysqli_query($conn, $sql)) {
        echo "2";
    } else {

        $client_code  = get_code($conn, $client_name);

        $sql = "INSERT INTO `clients`(`name`, `client_code`) VALUES ('$client_name','$client_code')";

        if (mysqli_query($conn, $sql))
            echo $client_code;
        else
            echo "0";
    }
}

// update client
if (isset($_POST['edit_client'])) {

    $client_name = $_POST['client_name'];

    $sql = "SELECT * FROM `clients` WHERE `name` = '$client_name' ";

    if (mysqli_query($conn, $sql)) {
        echo "2";
    } else {

        $id = $_POST['id'];

        $client_code  = get_code($conn, $client_name);

        $sql = "UPDATE `clients` SET `name` = '$client_name' , `client_code` = '$client_code' WHERE  `id` = '$id' ";

        if (mysqli_query($conn, $sql))
            echo "1";
        else
            echo "0";
    }
}

// update contact
if (isset($_POST['edit_contact'])) {

    $contact_name = $_POST['contact_name'];

    $contact_surname = $_POST['contact_surname'];

    $contact_email_address = $_POST['contact_email'];

    $sql = "SELECT * FROM `contacts` WHERE `name` = '$contact_name' AND `surname` = '$contact_surname' AND `email_address` = '$contact_email_address'";

    if (getRows($conn, $sql)) {
        echo "2";
    } else {

        $id = $_POST['id'];

        $sql = "UPDATE `contacts` SET `name` = '$contact_name' , `surname` = '$contact_surname' , `email_address` = '$contact_email_address' WHERE  `id` = '$id' ";

        if (mysqli_query($conn, $sql))
            echo "1";
        else
            echo "0";
    }
}

// link client
if (isset($_GET['link_client']) && isset($_GET['contact'])) {

    $client = $_GET['link_client'];
    $contact = $_GET['contact'];

    if ($client != 0 && $contact != 0) {

        $sql = "INSERT INTO `links`( `client`, `contact`) VALUES ('$client','$contact')";

        if (mysqli_query($conn, $sql))
            echo "1";
        else
            echo "0";
    }
}

// create new contact
if (isset($_POST['create_contact'])) {

    $contact_name = $_POST['contact_name'];

    $contact_surname = $_POST['contact_surname'];

    $contact_email_address = $_POST['contact_email_address'];

    $sql = "SELECT * FROM `contacts` WHERE `email_address` = '$contact_email_address'";

    if (getRows($conn, $sql)) {
        echo "2";
    } else {

        $sql = "INSERT INTO `contacts`(`name`, `surname`,`email_address`) VALUES ('$contact_name','$contact_surname','$contact_email_address')";

        if (mysqli_query($conn, $sql))
            echo "1";
        else
            echo "0";
    }
}

function get_code($conn, $client_name)
{ // this function generates a unique code for a client
    $num = 1;

    // $check = true;

    $code = create_code($client_name);

    // create code with added string only select the last 3 charaters on number
    $client_code = $code . substr('000' . $num, -3);

    // while the code exit keep generating new code
    while (check_code($conn, $client_code)) {
        // save the argument
        // $check = check_code($conn, $client_code);
        // increament number
        $num++;
        // recreate code with added string only select the last 3 charaters on number
        $client_code = $code . substr('000' . $num, -3);

        // top the infinite loop if number exceed limit
        // if ($num > 999) {$check = false;}
    }
    return $client_code;
}

function create_code($client_name)
{
    // this function generates a code from the clients name
    $code = '';

    $len = str_word_count($client_name);

    if ($len >= 3) {

        $arr = explode(' ', trim($client_name));

        for ($i = 0; $i < 3; $i++) {
            $code = $code . $arr[$i][0];
        }
    } elseif ($len == 2) {

        $arr = explode(' ', trim($client_name));

        for ($i = 0; $i < $len; $i++) {
            $code = $code . $arr[$i][0];
        }

        $code = $code . 'A';
    } else {

        for ($i = 0; $i < 3; $i++) {
            $code = $code . $client_name[$i];
        }
    }

    return strtoupper($code);
}


function check_code($conn, $client_code)
{
    // this function checks if the code exit in the database

    $sql = "SELECT * FROM `clients` WHERE  client_code = '$client_code' ";

    $data = $conn->query($sql);

    if ($data->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// get data
function getData($conn, $sql)
{
    // this function gets data from the database

    $result = ($conn->query($sql));
    //declare array to store the data of database
    $row = [];

    if ($result->num_rows > 0) {
        // fetch all data from conn into array 
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {

        return false;
    }
}

// get Rows
function getRows($conn, $sql)
{
    // this function get number of row 
    $result = mysqli_query($conn, $sql);
    if ($result) {

        // Return the number of rows in result set
        $rowcount = mysqli_num_rows($result);
    }
    return $rowcount;
}


// get data
function getSingleData($conn, $sql)
{

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        // output data of each row
        if ($row = $result->fetch_assoc()) {
            return $row;
        }
    } else {
        return 0;
    }
}
