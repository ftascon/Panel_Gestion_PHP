<?php

include "../includes/general_settings.php";
//print_r($_POST);
$users = new users();
if ($users->update_passwd_by_id($_POST, $_GET["id"])) {
    header("Location: " . BASE_URL . "?lista_alumnos&ok");
} else {
    header("Location: " . BASE_URL . "?lista_alumnos&ko");
}


