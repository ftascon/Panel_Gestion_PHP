<?php

function get_people($rol) {
    switch ($rol) {
        case "alumno":
            include 'admins/lista_alumnos.php';
            return get_alumnos_admin();
            break;
        case "profes":
            include 'admins/lista_profesores.php';
            return get_profes_admin();
            break;
        case "coordinadores":
            break;
        default:
            break;
    }
}
