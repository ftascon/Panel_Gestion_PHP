<?php

function remove_profesor($profesor) {
    $profesors= new alumnos();
    $profesors->remove_alumno($profesor);
    $aulas = new aulas_alumnos();
    $aulas->remove_alumnes_from_aula($profesor);
    header("Location: " . BASE_URL . "?lista_profesores");
}

