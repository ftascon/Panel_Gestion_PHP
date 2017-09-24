<?php

include "../includes/general_settings.php";
//print_r($_POST);
$people = new people();
$servicios_alumnos = new alumnos_servicios();
$data_service["fk_id_people_profile"] = $_GET["id"];
$data_service["fk_servicio"] = $_POST["fk_servicio"];
unset($_POST["fk_servicio"]);
if ($people->update_profile($_GET["id"], $_POST)) {
    if ($servicios_alumnos->update($data_service, $_GET["id"])) {
        header("Location: " . BASE_URL . "?ficha=" . $_GET["id"]);
    } else {
        header("Location: " . BASE_URL . "?ficha=" . $_GET["id"] . "&ok");
    }
}

