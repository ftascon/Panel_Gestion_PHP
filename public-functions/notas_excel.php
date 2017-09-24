<?php

session_start();

//print_r($_SESSION["user_data"]);

$id = $_GET["id"];

//((($_SESSION["user_data"]["id_rols"] == 2) && ($_SESSION["user_data"]["id_user"] == $id)) || ($_SESSION["user_data"]["id_rols"] == 10))
if ($id != FALSE) {
    include '../includes/general_settings.php';
    $alumnos_notas = new notas_alumnos();

    $aulas = new aulas();

    $aula_data = $aulas->get_aula_by_id($id);

//    print_r($aula_data);
    $data_notas_details = $alumnos_notas->get_notas_details_by_aula($id);
//    print_r($data_notas_details); 
    $data_notas_alumnos = $alumnos_notas->get_all_notas_by_aula($id);
    $data_notas = array();
    for ($i = 0; $i < count($data_notas_alumnos); $i++) {

        $data_notas[$data_notas_alumnos[$i]['id_people']]['name'] = $data_notas_alumnos[$i]['fname_people'] . " " . $data_notas_alumnos[$i]['lname1_people'] . " " . $data_notas_alumnos[$i]['lname2_people'];
        $data_notas[$data_notas_alumnos[$i]['id_people']]['email'] = $data_notas_alumnos[$i]['email_people'];

        $data_notas[$data_notas_alumnos[$i]['id_people']]['notas'][$data_notas_alumnos[$i]['id_aulas_notas']]['title'] = $data_notas_alumnos[$i]['title_aulas_notas'];

        $data_notas[$data_notas_alumnos[$i]['id_people']]['notas'][$data_notas_alumnos[$i]['id_aulas_notas']]['nota'] = $data_notas_alumnos[$i]['nota_alumno'];

        $data_notas[$data_notas_alumnos[$i]['id_people']]['notas'][$data_notas_alumnos[$i]['id_aulas_notas']]['commment'] = $data_notas_alumnos[$i]['comentario'];
    }

    $notas_list = '';

    $list_notas_prev = '';

    if (is_array($data_notas)) {

        $salida = '<tr><th>Alumno</th>';
        for ($e = 0; $e < count($data_notas_details); $e++) {
            $salida .= "<th>" . $data_notas_details[$e]["title_aulas_notas"] . "</th>";
        }
        $salida .= '</tr>';
        foreach ($data_notas as $k => $v) {

            $list_notas_prev = '';

            if (is_array($v["notas"])) {
                foreach ($data_notas_details as $val) {
                    $list_notas_prev .= '<td data-original-title="' . $v["notas"][$val["id_aulas_notas"]]["commment"] . '">' . str_replace(".", ",", $v["notas"][$val["id_aulas_notas"]]["nota"]) . '</td>';
                }
            }

            $notas_list .= '<tr>

                                <td>' . $v["name"] . '<br/><!--<span style="display:block;font-weight:bold">' . $v["email"] . '</span>--></td>

                                ' . $list_notas_prev . '

                            </tr>';
        }
    }

    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header('Content-Disposition: attachment; filename=notas_' . $aula_data['nombre_aula'] . "_" . get_simple_date() . '.xls');
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    echo '<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />

        <title>Panel de gestión</title>

        <?php echo $output_css; ?> 

    </head>

    <body><table class="table table-bordered">

            <thead>

                <tr>
                    <td colspan="5"><h2>' . $aula_data['nombre_aula'] . '</h2></td>
                </tr>
                <tr>

                   ' . $salida . '

                </tr>

            </thead>

            <tbody>

                ' . $notas_list . '

            </tbody>

        </table></body></html>';
}
