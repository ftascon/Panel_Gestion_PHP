<?php

include "../includes/general_settings.php";
//print_r($_POST);
//print_r($_GET);
$id_aula = $_GET["id_aula"];
$users_aulas = new users_aulas();
$users = $_POST["user"];
$password = $_POST["password"];
if (count($users) > 0) {
    foreach ($users as $k => $v) {
        $data["fk_aula"] = $id_aula;
        $data["user"] = $v;
        $data["password"] = $password[$k];
//        print_r($data);
        $users_aulas->insert($k, $data);
    }
}
header('Location: ' . BASE_URL . '?aula=' . $id_aula . "&ok");
