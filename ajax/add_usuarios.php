<?php

include "../includes/general_settings.php";
//print_r($_POST);
$usuarios = new users();
if($usuarios->create_usuarios($_POST)){
    header("Location: ". BASE_URL . "?nuevo_usuario&ok");
}else{
    header("Location: ". BASE_URL . "?nuevo_usuario&ko");
}

