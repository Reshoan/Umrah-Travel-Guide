<?php
require_once 'dbfunc.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $airline = $_POST['airline'];
    $time = $_POST['time'];
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $quantity = $_POST['quantity'];
    $totalPrice = $_POST['total_price'];
    $flightDate = $_POST['flight_date'];

    $result = $db->addFlight($userId, $airline, $time, $departure, $destination, $quantity, $totalPrice, $flightDate);

    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
?>