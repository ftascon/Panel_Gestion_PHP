<?php

include "../includes/general_settings.php";
//print_r($_POST);
$out_data = array();
$prev_data = explode("\n", $_POST['content']);
for ($i = 0; $i < count($prev_data); $i++) {
    $data[] = str_getcsv($prev_data[$i], ";");
}
if (is_array($data)) {
    foreach ($data as $k => $v) {
        //si es un csv con mas de 3 campos es import (classmarker) o menos es import teacher
        if (count($v) > 3) {
            //get notas forn porcentage (campo 2) - le quito el % y lo divido por 10 
            //array de clave el email $v[12] y nota $v[2]
                $out_data[$v[12]] = str_replace("%", "", $v[2]) / 10;
        } else {
            //array de clave el email $v[0] y nota $v[1]
            $out_data[$v[0]] = str_replace("%", "", $v[1]) / 10;
        }
    }
}
//print_r($out_data);
$id_nota = $_GET["id_nota"];
$id_aula = $_GET["id_aula"];
$alumnos = new aulas_alumnos();
$alumnos_data = $alumnos->get_alumnos_by_aula_idmod($id_aula);
if (is_array($alumnos_data)) {
    foreach ($alumnos_data as $k => $v) {
        $out_alumnos[$v["username_users"]]['id_people'] = $v['id_people'];
    }
}
//print_r($out_data);
//print_r($out_alumnos);

/*
 *  recorre ekl array de datos importados
 *  verifica si los importado existen en los datos del aula
 *  si existe añade nota a verificaciones
 */
$output = array();
if (is_array($out_data)) {
    foreach ($out_data as $k => $v) {
        if (array_key_exists($k, $out_alumnos)) {
            $output[$k]["nota"] = $v;
            $output[$k]["id_people"] = $out_alumnos[$k]["id_people"];
        }
    }
}
//print_r($output);
if (is_array($output)) {
    $notas_alumnos = new notas_alumnos();
    foreach ($output as $k => $v) {
        $notas_alumnos->save_single_nota($v, $id_nota);
    }
}


header("Location: " . BASE_URL . "?nota=" . $id_nota);
