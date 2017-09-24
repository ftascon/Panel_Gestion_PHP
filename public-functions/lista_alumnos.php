<?php

function get_alumnos() {

    $rol = $_SESSION["user_data"]["id_rols"];

    $id_user = $_SESSION["user_data"]["id_user"];

    $alumnos = new alumnos();

    $list_alumnos = '';

    $col_table = '';

    $add_alumno = '';

    $btn_pass = '';

    $btn_file = '';
    $rownotas = '';

    switch ($rol) {

        case 2:
            if ($id_user == 100) {
                $rownotas = '<th>Notas</th>';
            }

            $id = $_SESSION["user_data"]["id_user"];

            $alumnos_data = $alumnos->get_alumnos_by_profe($id);

            for ($i = 0; $i < count($alumnos_data); $i++) {

                $user_photo = get_image_people($alumnos_data[$i]["photo_people"]);

                $address = ($alumnos_data[$i]["address_people"] == "") ? 'No address' : $alumnos_data[$i]["address_people"];

                $email = ($alumnos_data[$i]["email_people"] == "") ? 'No Email' : $alumnos_data[$i]["email_people"];

                if (empty($alumnos_data[$i]["name_country"])) {

                    $location = "No country";
                } else {

                    $location = '<span><a href="#">' . $alumnos_data[$i]["name_country"] . '</a></span>';
                }

                $list_alumnos .= '<tr>
                        <td class="text-center">

                            ' . $alumnos_data[$i]["id_people"] . '

                        </td>

                        <td class="text-center">

                            <a href="' . $user_photo . '" class="lightbox" title="' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . '"><img src="' . $user_photo . '" alt="" class="img-media"></a>

                        </td>

                        <td class="text-semibold"><a href="' . BASE_URL . '?ficha=' . $alumnos_data[$i]["id_people"] . '">' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . " " . $alumnos_data[$i]["lname2_people"] . '</a></td>

                        <td class="text-semibold">' . $alumnos_data[$i]["name_servicio"] . '</td>';

                if($id_user == 100){
                    $list_alumnos .= '<td class="text-semibold text-center"> <a target="_blank" href="' . BASE_URL . '?resumen_notas=' . $alumnos_data[$i]["id_people"] . '"> <i class="icon-numbered-list" style="font-size:22px; color:#428bca;"></i> </a> </td>';
                }

                $list_alumnos .= '<td class="file-info">

                            <span><strong>Email: </strong>' . $email . '</span>

                        </td>

                        <td class="file-info">

                            ' . $location . '

                        </td>

                    </tr>';
            }

            $btn_file = '<a id="btn_pass" href="' . BASE_URL . '?alumnos_csv=' . $id_user . '" target="_blank" class="tip btn btn-success" data-original-title="Descargar CSV"><i class="icon-file"></i></a>';
            break;

        case 1:

            $alumnos_data = "";

            break;

        case 10:
            $rownotas = '<th>Notas</th>';

            $alumnos_data = $alumnos->get_all_alumnos();

//            print_r($alumnos_data);

            for ($i = 0; $i < count($alumnos_data); $i++) {

                $user_photo = get_image_people($alumnos_data[$i]["photo_people"]);

                $address = ($alumnos_data[$i]["address_people"] == "") ? 'No address' : $alumnos_data[$i]["address_people"];

                $email = ($alumnos_data[$i]["email_people"] == "") ? 'No Email' : $alumnos_data[$i]["email_people"];

                $phone = ($alumnos_data[$i]["phone_people"] == "") ? 'No teléfono' : $alumnos_data[$i]["phone_people"];

                if (empty($alumnos_data[$i]["name_country"])) {

                    $location = "No country";
                } else {

                    $location = '<span><a href="#">' . $alumnos_data[$i]["name_country"] . '</a></span>';
                }

                $list_alumnos .= '<tr>

                        <td class="text-center">

                            ' . $alumnos_data[$i]["id_people"] . '

                        </td>
                        <td class="text-center">

                            <a href="' . $user_photo . '" class="lightbox" title="' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . '"><img src="' . $user_photo . '" alt="" class="img-media"></a>

                        </td>

                        <td class="text-semibold"><a href="' . BASE_URL . '?ficha=' . $alumnos_data[$i]["id_people"] . '">' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . " " . $alumnos_data[$i]["lname2_people"] . '</a></td>

                        <td class="text-semibold">' . $alumnos_data[$i]["name_servicio"] . '</td>
                        
                        <td class="text-semibold text-center"> <a target="_blank" href="' . BASE_URL . '?resumen_notas=' . $alumnos_data[$i]["id_people"] . '"> <i class="icon-numbered-list" style="font-size:22px; color:#428bca;"></i> </a> </td>

                        <td class="file-info">

                            <span><strong>Email: </strong>' . $email . '</span>

                            <span><strong>Teléfono: </strong>' . $phone . '</span>

                        </td>

                        <td class="file-info">

                            ' . $location . '

                        </td>

                        <td class="passphrase_users"><span style="display:block;">' . trim($alumnos_data[$i]["username_users"]) . '</span></td>

                        <td class="passphrase_users">

                            <span>' . $alumnos_data[$i]["passphrase_users"] . '</span>

                        </td>

                        <td class="text-center">

                            <div class="btn-group">

                                <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>

                                    <ul class="dropdown-menu icons-right dropdown-menu-right">

                                            <li><a href="' . BASE_URL . '?ficha=' . $alumnos_data[$i]["id_people"] . '"><i class="icon-user"></i> Ver perfil</a></li>

                                                <li><a href="' . BASE_URL . '?edit_alumno=' . $alumnos_data[$i]["id_people"] . '"><i class="icon-quill2"></i> Editar Alumno</a></li>

                                            <li><a data-toggle="modal" data-target="#ctm-rm-aula' . $alumnos_data[$i]["id_people"] . '" ><i class="icon-remove3"></i> Eliminar</a></li>

                                    </ul>

                            </div>

                            <!-- Modal -->

                            <div class="modal fade" tabindex="-1" id="ctm-rm-aula' . $alumnos_data[$i]["id_people"] . '" role="dialog">

                              <div class="modal-dialog modal-sm">

                                <!-- Modal content-->

                                <div class="modal-content">

                                  <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    <h4 class="modal-title">¿Desea borrar el alumno?</h4>

                                  </div>

                                  <div class="modal-body">

                                  </div>

                                  <div class="modal-footer">



                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . '?remove_alumno=' . $alumnos_data[$i]["id_people"] . '">Delete</a>

                                  </div>

                                </div>

                              </div>

                            </div>

                        </td>

                    </tr>';
            }

            $col_table = '  <th class="passphrase_users">Usuario</th>

                            <th class="passphrase_users">Claves</th>

                            <th class="team-links">Opciones</th>';

            $add_alumno = '<div class="ctm-btn-add">

                            <a href="' . BASE_URL . '?nuevo_alumno" class="btn btn-default btn-success"><i class="icon-user-plus2"></i></a>

                        </div>  ';

            $btn_pass = '<a id="btn_pass" href="javascript:toggle_pass(1);" class="tip btn btn-success" data-original-title="Ver claves"><i class="icon-eye7"></i></a>';

            $btn_file = '<a id="btn_pass" href="' . BASE_URL . '?alumnos_csv" class="tip btn btn-success" data-original-title="Descargar CSV"><i class="icon-file"></i></a>';

            break;



        default:

            break;
    }

//    print_r($alumnos_data);



    $alert = "";

    if (isset($_GET["ok"])) {

        $alert = '<div class="callout callout-success fade in">

				<button type="button" class="close" data-dismiss="alert">×</button>

				<h5>Operación exitosa</h5>

				

			</div>';
    }

    $btn_file = '<a id="btn_pass" href="' . BASE_URL . '?alumnos_csv=' . $id_user . '" target="_blank" class="tip btn btn-success" data-original-title="Descargar CSV"><i class="icon-file"></i></a>';

    return '<!-- Page content -->

<div class="page-content">

    <div class="page-content-inner">

        <!-- Page header -->

        <div class="page-header">

            <div class="page-title">

                <h3>Lista de alumnos<small>Lista detallada de los alumnos</small></h3>

            </div>                

            ' . $add_alumno . '              

        </div>

        <!-- /page header -->

        <!-- Breadcrumbs line -->

        <div class="breadcrumb-line">

            <ul class="breadcrumb">

                    <li><a href="' . BASE_URL . '">Home</a></li>

                    <li><a href="' . BASE_URL . '?lista_alumnos">Alumnos</a></li>

                    <li class="active">Lista de alumnos</li>

            </ul>

            

        </div>

        <!-- /breadcrumbs line -->

        ' . $alert . '

        <!-- alumnos (table) -->

        <div class="block">

            <h6 class="heading-hr"><i class="icon-people"></i>Lista de alumnos ' . $btn_file . $btn_pass . '</h6>

            <div class="datatable-media">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>
 <th>ID</th>
                            <th class="image-column">Imagen</th>

                            <th>Nombre</th>

                            <th>Servicio</th>
                           ' . $rownotas . '

                            <th>Contacto</th>

                            <th>Pais</th>

                            ' . $col_table . '

                        </tr>

                    </thead>

                    <tbody>

                        ' . $list_alumnos . '

                    </tbody>

                </table>

            </div>

        </div>

        <!-- /alumnos (table) -->

    </div>

    ' . get_footer() . '

</div>

	<!-- /page container -->';
}
