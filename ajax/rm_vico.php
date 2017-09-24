<?php

include "../includes/general_settings.php";

if ($_SESSION["user_data"]["id_rols"] == 10) {
    $aulas = new vicos();
    $aulas->remove_vico($_GET["d"]);
    header("Location: " . BASE_URL . "?lista_vicos");
}
