<?php

require_once 'config.php';

$id = $_GET["id"];

$stmt = mysqli_prepare($conn, "DELETE FROM Classi WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: visualizza_classi.php?result=success");
} else {
    header("Location: visualizza_classi.php?result=failure");
}
?>