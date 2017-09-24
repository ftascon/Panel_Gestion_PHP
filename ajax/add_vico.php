<?php

include "../includes/general_settings.php";
//print_r($_GET);
$vicos = new vicos();
if ($vicos->add_vico($_POST)) {
    header("Location: ". BASE_URL . "?lista_vicos&ok");
}else{
    header("Location: ". BASE_URL . "?lista_vicos&ko");
}
