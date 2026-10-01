<?php
header('Content-Type: application/json; charset=utf-8');

require 'db.php'; 

$winner = null;
$winnerResult = mysqli_query($conn, "SELECT * FROM participants ORDER BY RAND() LIMIT 1");

if ($winnerResult && mysqli_num_rows($winnerResult) > 0) {
    $winner = mysqli_fetch_assoc($winnerResult);
}

if ($winner) {
    echo json_encode([
        'success'   => true,
        'firstName' => $winner['firstName'],
        'lastName'  => $winner['lastName'],
        'email'     => $winner['email'],
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'لا يوجد مشاركين حتى الآن',
    ]);
}

mysqli_close($conn);
?>
