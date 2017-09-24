<?php

include "../includes/general_settings.php";
//print_r($_POST);
$servicios = new servicios();
if ($servicios->update_servicio($_POST, $_GET["id"])) {
    header("Location: " . BASE_URL . "?edit_servicio=" . $_GET["id"] . "&ok");
} else {
    header("Location: " . BASE_URL . "?edit_servicio=" . $_GET["id"] . "&ko");
}


