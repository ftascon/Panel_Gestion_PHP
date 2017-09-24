<?php

include "../includes/general_settings.php";
//print_r($_POST);
$notas = new aulas_notas();
if ($notas->update_by_id($_POST)) {
    header("Location: " . BASE_URL . "?nota=" . $_POST["id_nota"] . "&ok");
} else {
    header("Location: " . BASE_URL . "?aula=" . $_GET["fk_nota"] . "&ko");
}

