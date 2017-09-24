<?php

session_start();
//print_r($_SESSION["user_data"]);
$id = $_GET["id"];
if ((($_SESSION["user_data"]["id_rols"] == 2) && ($_SESSION["user_data"]["id_user"] == $id)) || ($_SESSION["user_data"]["id_rols"] == 10)) {
    include '../includes/general_settings.php';
    $alumnos = new alumnos();
    if ($_SESSION["user_data"]["id_rols"] != 10) {
        $profe = new profesores();
        $rep_data = $profe->get_by_id($id);
        $rep_data["full_name"] = $rep_data["fname_people"] . "_" . $rep_data["lname1_people"];
        $alumnos_data = $alumnos->get_alumnos_by_profe_aula($id);
    } else {
        $rep_data["full_name"] = "all";
        $alumnos_data = $alumnos->get_all_alumnos();
    }
//    print_r($alumnos_data);
    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
//    header("Content-Disposition: attachment; filename=abc.xls");  //File name extension was wrong
    header('Content-Disposition: attachment; filename=alumnos_' . $rep_data["full_name"] . "_" . get_simple_date() . '.xls');
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
//    header('Content-Encoding: UTF-8');
//    header('Content-Type: text/csv; charset=utf-8');
//    header('Content-Disposition: attachment; filename=alumnos_' . $rep_data["full_name"] . "_" . get_simple_date() . '.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Nombre', 'Apellido', 'Apellido2', "Correo Electrónico", "Servicio"));
    $anterior = -1;
    for ($i = 0; $i < count($alumnos_data); $i++) {
        if ($alumnos_data[$i]["id_modulo"] != $anterior) {
            $anterior = $alumnos_data[$i]["id_modulo"];
            $data["nombre"] = "";
            $data["apellido"] = "";
            $data["apellido2"] = "";
            $data["email"] = "";
            $data["servicio"] = "";
            fputcsv($output, $data);

            $data["nombre"] = "Módulo:";
            $data["apellido"] = $alumnos_data[$i]["nombre_modulo"];
            $data["apellido2"] = "";
            $data["email"] = "Fecha Inicio";
            $data["servicio"] = $alumnos_data[$i]["f_inicio"];
            fputcsv($output, $data);

            $data["nombre"] = "Nombre";
            $data["apellido"] = "Apellido";
            $data["apellido2"] = "Apellido2";
            $data["email"] = "Correo Electrónico";
            $data["servicio"] = "Servicio";
            fputcsv($output, $data);
        }
//        print_r($data);
        $data["nombre"] = trim($alumnos_data[$i]["fname_people"]);
        $data["apellido"] = trim($alumnos_data[$i]["lname1_people"]);
        $data["apellido2"] = trim($alumnos_data[$i]["lname2_people"]);
        $data["email"] = trim($alumnos_data[$i]["email_people"]);
        $data["servicio"] = trim($alumnos_data[$i]["name_servicio"]);
        fputcsv($output, $data);
//        print_r($data);
    }
}
