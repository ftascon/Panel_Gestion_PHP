<?php//include "../includes/general_settings.php";//print_r($_POST);function remove_aula($aula) {    $aulas = new aulas();    $aulas->remove_aula($aula);    $aulas_ediciones = new aulas_ediciones();    $aulas_ediciones->remove_by($aula);    $profes = new aulas_profesores();    $profes->remove_profes_aula($aula);    $alumnos = new aulas_alumnos();    $alumnos->remove_alumnes_aula($aula);    header("Location: " . BASE_URL . "?lista_aulas&ok");}