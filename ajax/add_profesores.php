<?php

include "../includes/general_settings.php";
//print_r($_POST);
$alumno = new alumnos();
$_POST["fk_type_people"] = "2";
if ($_POST["fk_id_people_profile"] = $alumno->create_alumne($_POST)) {
    $usuarios = new users();
    $_POST["fk_id_rols_users"] = "2";
    if ($usuarios->create_usuarios($_POST)) {
        header("Location: " . BASE_URL . "?lista_profesores&ok");
    }
} else {
    echo 'Error!';
}

