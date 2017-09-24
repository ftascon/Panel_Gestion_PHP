<?php

include "../includes/general_settings.php";
$examenes = new examenes();
$_POST['url_examen'] = ($_POST['url_examen'] == '#') ? '' : $_POST['url_examen'];
$_POST['f_inicio'] = date_db_format($_POST['f_inicio']);
$_POST['f_fin'] = date_db_format($_POST['f_fin']);
//print_r($_POST);
if ($examenes->add($_POST)) {
    if ($_GET['id']) {
        header("Location: " . BASE_URL . "?aula&ok");
    } else {
        header("Location: " . BASE_URL . "?lista_examenes&ok");
    }
} else {
    header("Location: " . BASE_URL . "?lista_examenes&ko");
}
