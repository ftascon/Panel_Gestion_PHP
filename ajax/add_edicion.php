<?php

include "../includes/general_settings.php";
//print_r($_POST);
$edicion = new ediciones();
if ($edicion->create_edicion($_POST)) {
    header("Location: " . BASE_URL . "?ediciones&ok");
} else {
    header("Location: " . BASE_URL . "?nueva_edicion&ko&duplicate");
}

