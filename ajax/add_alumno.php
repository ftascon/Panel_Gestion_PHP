<?php

include "../includes/general_settings.php";
//print_r($_POST);
$alumno = new alumnos();
$_POST["fk_type_people"] = "1";
if ($_POST["fk_id_people_profile"] = $alumno->create_alumne($_POST)) {
    $services = new alumnos_servicios();
    $services->set_service_alumno($_POST);
    $usuarios = new users();
    $_POST["fk_id_rols_users"] = "1";
    if ($usuarios->create_usuarios($_POST)) {
        header("Location: " . BASE_URL . "?edit_alumno=" . $_POST["fk_id_people_profile"]);
    }
} else {
    echo 'Error!';
}

    