<?php

include "../includes/general_settings.php";

$_POST["autor"] = $_SESSION["user_data"]["id_user"];
// print_r($_POST);
$cal = new calendars();
if ($cal->create($_POST)) {
    header("Location: " . BASE_URL . "?lista_calendars&ok");
} else {
    header("Location: " . BASE_URL . "?nuevo_calendars&ko");
}
