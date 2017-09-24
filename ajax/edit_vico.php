<?php

include "../includes/general_settings.php";
//print_r($_GET);
$vicos = new vicos();
if ($vicos->update_vico($_POST, $_GET["id"])) {
    header("Location: " . BASE_URL . "?lista_vicos&ok");
} else {
    header("Location: " . BASE_URL . "?lista_vicos&ko");
}
