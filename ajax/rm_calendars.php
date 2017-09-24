<?php


function remove_calendars($id){
  // include "../includes/general_settings.php";
if ($_SESSION["user_data"]["id_rols"] == 10) {
    $cal = new Calendars();
    $cal->remove($id);
    header("Location: " . BASE_URL . "?lista_calendars");
}
}
