<?php

include "../includes/general_settings.php";
//print_r($_POST);
$ediciones = new ediciones();
if ($ediciones->update_edicion($_POST, $_GET["id"])) {
    header("Location: " . BASE_URL . "?ediciones&ok");
} else {
    header("Location: " . BASE_URL . "?edit_edicion=" . $_GET["id"] . "&ko");
}


