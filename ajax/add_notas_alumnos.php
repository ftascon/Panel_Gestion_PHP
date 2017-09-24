<?php

include "../includes/general_settings.php";
include "../public-functions/notifica_notas.php";

//print_r($_POST);
//print_r($_GET);
$people = new people();
$modulos = new modulos();
$notas = new notas_alumnos();
$emails = $_POST["mailto"];
if ($notas->save_notas($_POST["notas"], $_GET["id_nota"])) {
    $name_modulo = $modulos->get_by_nota($_GET["id_nota"]);
//    print_r($name_modulo);
//    print_r($emails);
    if (is_array($emails)) {
        foreach ($emails as $k => $v) {
            echo notifica_alumno($people->get_email_by_id($k), $name_modulo);
            
        }
    }
    header("Location: " . BASE_URL . "?nota=" . $_GET["id_nota"] . "&ok");
}
