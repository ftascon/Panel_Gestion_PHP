<?php

include "../includes/general_settings.php";

if ($_SESSION["user_data"]["id_rols"] == 10) {
    $examenes = new examenes();
    $examenes->remove($_GET["d"]);
    header("Location: " . BASE_URL . "?lista_examenes");
}
