<?php

$users = [];
$result = mysqli_query($conn, "SELECT * FROM participants ORDER BY id DESC");

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}


$winner = null;
$winnerResult = mysqli_query($conn, "SELECT * FROM participants ORDER BY RAND() LIMIT 1");

if ($winnerResult && mysqli_num_rows($winnerResult) > 0) {
    $winner = mysqli_fetch_assoc($winnerResult);
}
?>