<?php

include "../includes/general_settings.php";
//print_r($_POST);
//print_r($_GET);
$id_user = $_GET["id_user"];
$users_aulas = new users_aulas();
$users = $_POST["user"];
$password = $_POST["password"];
if (count($users) > 0) {
    foreach ($users as $k => $v) {
        $data["fk_aula"] = $k;
        $data["user"] = $v;
        $data["password"] = $password[$k];
//        print_r($data);
        $users_aulas->insert($id_user, $data);
    }
}
header('Location: ' . BASE_URL . '?aulas_usuario=' . $id_user . "&ok");
