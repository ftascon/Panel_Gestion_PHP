<?php

function remove_alumno($alumno) {
    $alumnos= new alumnos();
    $alumnos->remove_alumno($alumno);
    $aulas = new aulas_alumnos();
    $aulas->remove_alumnes_from_aula($alumno);
    header("Location: " . BASE_URL . "?lista_alumnos");
}

