<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // $data is now a PHP object containing the reservation id

    $id = $data->realReservationID;

    // Connect to the MySQL database (replace the database credentials with your own)
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "probrav";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // get the reservation from the database
    $sql = "SELECT * FROM reservations WHERE reservation_id = '$id'";

    $result = mysqli_query($conn, $sql);

    // if there is a reservation with the given id, return a message stating true
    if (mysqli_num_rows($result) > 0) {
        $response = array(
            "message" => "true"
        );
        echo json_encode($response);
    } else {
        $response = array(
            "message" => "false"
        );
        echo json_encode($response);
    }
}
