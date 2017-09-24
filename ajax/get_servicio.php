<?php

include "../includes/general_settings.php";
//print_r($_POST);
$servicio = new servicios();
$servicio_data = $servicio->get_services_by_id($_POST["id"]);

if ($_POST["options"] == "all") {
    print_r($servicio_data);
} else {
//    print_r($servicio_data);
    echo $servicio_data[$_POST["option_1"]] . "," . $servicio_data[$_POST["option_2"]] ;
}


    