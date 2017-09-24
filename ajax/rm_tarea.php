<?php

include "../includes/general_settings.php";
//print_r($_SESSION);
if (isset($_GET["id"])) {
    $rol = $_SESSION["user_data"]["id_rols"];
    $id_user = $_SESSION["user_data"]["id_user"];
    $tareas = new tareas();
    $tarea_info = $tareas->get_by_id($_GET["id"]);
    if (($tarea_info["id_tarea"] == $id_user) || ($rol == 10)) {
        $tareas->remove_by_id($_GET["id"]);
        header("Location: " . BASE_URL . "?tareas&ok");
    }
}