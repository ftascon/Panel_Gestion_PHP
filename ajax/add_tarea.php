<?php

include "../includes/general_settings.php";
$tareas = new tareas();
if ($tareas->save_tarea($_POST)) {
    header("Location: " . BASE_URL . "?tareas&ok");
}else{
    header("Location: " . BASE_URL . "?nueva_tarea&ko");
}