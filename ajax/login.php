<?php

include '../includes/general_settings.php';

$users = new users();
$res = $users->login_users($_POST);
if ($res == "_1") {
    //usuario no existe
    header("Location: " . BASE_URL . "?ko_no");
} else {
    if ($res == "_2") {
        //contraseña incorrecta
        header("Location: " . BASE_URL . "?ko_pw");
    } else {
        //correcto
        if ($res == "ok") {
            //correcto no-profile
        } else {
            //correcto profile
//            session_destroy();
            $_SESSION["user_data"] = $users->get_alluser_by_id($res);
            $_SESSION["user_data"]["full_name"] = $_SESSION["user_data"]["fname"] . " " . $_SESSION["user_data"]["lname1"] . " " . $_SESSION["user_data"]["lname2"];
        }
        header("Location: " . BASE_URL);
    }
}

