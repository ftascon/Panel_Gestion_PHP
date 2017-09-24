<?php

include "../includes/general_settings.php";
//print_r($_POST);
//print_r($_GET);
$notas = new aulas_notas();
if ($notas->add_notas_to_aula($_GET["fk_aula"], $_POST)) {
    header("Location: " . BASE_URL . "?lista_notas=" . $_GET["fk_aula"]."&ok");
}
