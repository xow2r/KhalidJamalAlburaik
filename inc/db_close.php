<?php

if ($result instanceof mysqli_result) {
    mysqli_free_result($result);
}

if ($winnerResult instanceof mysqli_result) {
    mysqli_free_result($winnerResult);
}

mysqli_close($conn);
?>