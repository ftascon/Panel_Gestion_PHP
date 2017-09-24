<?php

include "../includes/general_settings.php";
//print_r($_POST);
$aulas = new aulas();
$aulas_ediciones = new aulas_ediciones();
$profes = new aulas_profesores();
$alumnos = new aulas_alumnos();

/* primera infor add aula */
$id_aula = $aulas->create_aula($_POST);
$data["fk_aula"] = $id_aula;
$data["fk_profesor"] = $_POST["fk_profesor"];
$aulas_ediciones->conect($id_aula, $_POST['aulas_ediciones']);

/* add profesor to aula */
$profes->add_profes_to_aula($data);

/* add alumnos to profes */
$alumnos->add_alumnos_to_aula($id_aula, $_POST["aula_list"]);
header("Location: " . BASE_URL . "?nueva_aula&ok");

