<?php
include('../php/config.php');

if (isset($_POST['recipe_id'])) {
    $recipeId = $_POST['recipe_id'];

    $sql = "DELETE FROM recipes WHERE recipe_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $recipeId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
