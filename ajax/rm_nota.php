<?php

include "../includes/general_settings.php";
//print_r($_POST);

$notas_a = new aulas_notas();
$notas_a->remove_notas_by_id($_GET["notas"]);
header("Location: " . BASE_URL . "?lista_notas=".$_GET["aula"]);
