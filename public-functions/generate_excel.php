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
//    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
//    header('Content-Disposition: attachment; filename=alumnos_' . $rep_data["full_name"] . "_" . get_simple_date() . '.xls');
//    header("Expires: 0");
//    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//    header("Cache-Control: private", false);
//    fputcsv($output, array('Nombre', 'Apellido', 'Apellido2', "Correo Electrónico", "Servicio"));
    $anterior = -1;
    $alumnos_ex = '';
    for ($i = 0; $i < count($alumnos_data); $i++) {
        if ($alumnos_data[$i]["id_modulo"] != $anterior) {
            $alumnos_ex .= '<tr><td>'
                    . 'Módulo:'
                    . '<td colspan="2">'
                    . $alumnos_data[$i]["nombre_modulo"]
                    . '</td>'
                    . '<td>'
                    . '</td></tr>';
//
//            $data["nombre"] = "Módulo:";
//            $data["apellido"] = $alumnos_data[$i]["nombre_modulo"];
//            $data["apellido2"] = "";
//            $data["email"] = "Fecha Inicio";
//            $data["servicio"] = $alumnos_data[$i]["f_inicio"];
//            fputcsv($output, $data);
//
//            $data["nombre"] = "Nombre";
//            $data["apellido"] = "Apellido";
//            $data["apellido2"] = "Apellido2";
//            $data["email"] = "Correo Electrónico";
//            $data["servicio"] = "Servicio";
//            fputcsv($output, $data);
        }
//        print_r($data);
        $alumnos_ex .= '<tr><td>'
                . trim($alumnos_data[$i]["fname_people"])
                . '<td>'
                . trim($alumnos_data[$i]["lname1_people"])
                . '</td>'
                . '<td>'
                . trim($alumnos_data[$i]["lname2_people"])
                . '</td>'
                . '<td>'
                . trim($alumnos_data[$i]["email_people"])
                . '</td>'
                . '<td>'
                . trim($alumnos_data[$i]["name_servicio"])
                . '</td></tr>';
//        print_r($data);
    }
}
echo '<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    </head>
    <body>
<table>'
 . '<tr>'
 . '<td>Nombre</td>'
 . '<td>Apellido</td>'
 . '<td>Apellido2</td>'
 . '<td>Correo Electronico</td>'
 . '<td>Servicio</td>'
 . '</tr>'
 . $alumnos_ex
 . '</table>'
 . '</body>
</html>';
