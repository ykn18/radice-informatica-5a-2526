<?php

require_once 'config.php';

$id = $_GET["id"];

$stmt = mysqli_prepare($conn, "DELETE FROM Alunni WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: visualizza_alunni.php?result=success");
} else {
    header("Location: visualizza_alunni.php?result=failure");
}
?>
