<?php

include "../includes/general_settings.php";
//print_r($_POST);
$servicio = new servicios();
$_POST["creador_servicio"] = $_SESSION["user_data"]["id_user"];
if($servicio->create_servicio($_POST)){
    header("Location: ". BASE_URL . "?servicios&ok");
}else{
    echo 'Error!';
}

