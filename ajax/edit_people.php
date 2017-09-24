<?php

include "../includes/general_settings.php";
//print_r($_POST);
$people = new people();

if ($people->update_profile($_GET["id"], $_POST)) {
    header("Location: " . BASE_URL . "?ficha=" . $_GET["id"]);
}

