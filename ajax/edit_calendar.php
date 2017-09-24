<?php

include "../includes/general_settings.php";
$cal = new calendars();
if ($cal->edit($_POST)) {
    header("Location: " . BASE_URL . "?lista_calendars&ok");
} else {
    header("Location: " . BASE_URL . "?nuevo_calendars&ko");
}
