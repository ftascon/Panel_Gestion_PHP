<?php



function get_aulas_v2($id) {

    $upload_max = (ini_get('upload_max_filesize'));

    $id_user = $_SESSION["user_data"]["id_user"];

    $items_opciones = '';

    $edit_aula = '';

    $rol = $_SESSION["user_data"]["id_rols"];

    $profe = new profesores();

    $aulas = new aulas();

    $alumnos = new aulas_alumnos();

    $vico = new vicos();

    $notas = new aulas_notas();

    $aula_data = $aulas->get_aula_by_id($id);

    $vicos_data = $vico->get_vico_by_aula($id);

    $alumnos_data = $alumnos->get_alumnos_by_aula_idmod($id, true);

    $profesor_data = $profe->get_by_aula($id);

    $videos_data = $aulas->get_videos_by_aula($id);

    $items_videos = '';

//    print_r($videos_data);

    for ($i = 0; $i < count($videos_data); $i++) {

        $items_videos .= '<li><a href="' . $videos_data[$i]['video_servicios'] . '" target="_blank"><i class="icon-play"></i> Presentación ' . ($i + 1) . ' </a></li>';

    }

    $output_notas_grid = '<p>No hay notas para esta aula puede <a href="' . BASE_URL . '?add_nota=' . $id . '">crear nueva</a></p>';

    $notas_data = $notas->get_notas_by_aula($id);

    $add_alumnos = '';

    if ($rol == 10) {

        $item_add_image = '<div class="thumb-options">

                                    <span>

                                            <a data-toggle="modal" data-target="#ctm-upload-image-aula" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a>

                                    </span>

                            </div>

                            <!-- Modal -->

                            <div class="modal fade" id="ctm-upload-image-aula" role="dialog">

                                <div class="modal-dialog">

                                    <!-- Modal content-->

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                            <h4 class="modal-title">Imagen del Aula</h4>

                                        </div>

                                        <div class="modal-body">

                                            <form>

                                                <div style="margin-top:15px;" class="col-md-offset-2 col-md-8">

                                                    <div class="row">

                                                        <label>Selecciona una imagen:</label>

                                                        <input type="file" id="ctm-upload-images-input-aulas" class="styled form-control">

                                                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size ' . $upload_max . '</span>

                                                        <span onclick="upload_image(1)" class="btn btn-default">Cargar</span>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                        <div class="modal-footer">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /Modal -->';

        $items_opciones = '<th class="team-links">Opciones</th>';

        $add_alumnos = '<div class="col-lg-2 col-md-3 col-sm-6">

                                <div class="block">

                                    <div class="thumbnail">

                                        <a href="' . BASE_URL . '?edit_aula=' . $id . '" title="" class="tip" data-original-title="Añadir alumno" >

                                            <img src="' . BASE_URL . '/images/profile/add_alumno.png">

                                        </a>

                                        <div class="caption text-center">

                                            <h6><a href="' . BASE_URL . '?edit_aula=' . $id . '" title="" class="tip" data-original-title="Añadir alumno" >Añadir alumno</a></h6>

                                        </div>

                                    </div>

                                </div>

                            </div>';

        $items_panel = '<li><a href="' . BASE_URL . '?edit_aula=' . $aula_data["id_aula"] . '"><i class="icon-user-plus2"></i> Añadir Alumno</a></li>

                        <li><a href="' . BASE_URL . '?nueva_vico&id_aula=' . $aula_data["id_aula"] . '"><i class="icon-camera6"></i> Configurar videoconferencia</a></li>';

        $edit_aula = '<div class="page-title" style="margin-left: 15px;">

                            <h3><a href="' . BASE_URL . '?edit_aula=' . $aula_data["id_aula"] . '" class="btn btn-info btn-icon btn-xs"><i class="icon-pencil"></i></a></h3>

                        </div>';

        $items_videos = '';

    }

//  



    $list_alumnos = '';

    $col_table = '';

    $add_alumno = '';

    $btn_pass = '';

    $btn_file = '';

    $email_list = '';

    $btn_email_list = '';

    switch ($rol) {

        case 2:

            for ($i = 0; $i < count($alumnos_data); $i++) {

                $address = ($alumnos_data[$i]["address_people"] == "") ? 'No address' : $alumnos_data[$i]["address_people"];

                $email = ($alumnos_data[$i]["email_people"] == "") ? 'No Email' : $alumnos_data[$i]["email_people"];

                if (empty($alumnos_data[$i]["name_country"])) {

                    $location = "No country";

                } else {

                    $location = '<span><a href="#">' . $alumnos_data[$i]["name_country"] . '</a></span>';

                }

                /* email list */

                $email_list .= "<li>" . $email . "</li>";

                /* email list */

                $list_alumnos .= '<tr>

                        <td class="text-center">

                            <a href="' . $user_photo . '" class="lightbox" title="' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . '"><img src="' . $user_photo . '" alt="" class="img-media"></a>

                        </td>

                        <td class="text-semibold"><a href="' . BASE_URL . '?ficha=' . $alumnos_data[$i]["id_people"] . '">' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . " " . $alumnos_data[$i]["lname2_people"] . '</a></td>

                        <td class="text-semibold">' . $alumnos_data[$i]["name_servicio"] . '</td>

                        <td class="file-info">

                            <span><strong>Email: </strong>' . $email . '</span>

                        </td>

                        <td class="file-info">

                            ' . $location . '

                        </td>

                    </tr>';

            }

            $btn_email_list = '<a id="btn_email_list" data-toggle="modal" data-target="#ctm-email-list" class="tip btn btn-icon btn-info" data-original-title="Lista Emails"><i class="icon-list"></i></a>';

            $btn_file = '<a id="btn_pass" href="' . BASE_URL . '?alumnos_csv=' . $id_user . '" target="_blank" class="tip btn btn-success" data-original-title="Descargar CSV"><i class="icon-file"></i></a>';

            break;

        case 1:

            $alumnos_data = "";

            break;

        case 10:

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

                /* email list */

                $email_list .= "<li>" . $email . "</li>";

                /* email list */

                $list_alumnos .= '<tr>

                        <td class="text-center">

                            <a href="' . $user_photo . '" class="lightbox" title="' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . '"><img src="' . $user_photo . '" alt="" class="img-media"></a>

                        </td>

                        <td class="text-semibold"><a href="' . BASE_URL . '?ficha=' . $alumnos_data[$i]["id_people"] . '">' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . " " . $alumnos_data[$i]["lname2_people"] . '</a></td>

                        <td class="text-semibold">' . $alumnos_data[$i]["name_servicio"] . '</td>

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

                                    </ul>

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

//            $btn_file = '<a id="btn_pass" href="' . BASE_URL . '?alumnos_csv" class="tip btn btn-success" data-original-title="Descargar CSV"><i class="icon-file"></i></a>';

            $btn_email_list = '<a id="btn_email_list" data-toggle="modal" data-target="#ctm-email-list" class="tip btn btn-icon btn-info" data-original-title="Lista Emails"><i class="icon-list"></i></a>';

            break;



        default:

            break;

    }

    for ($i = 0; $i < count($profesor_data); $i++) {

        $email_list .= "<li>" . $profesor_data[$i]["email_people"] . "</li>";

    }

    $modal = '';









    $aula_image = get_image_aula($aula_data["imagen_aula"]);



    return '<!-- Page content -->

<div class="page-content">





    <!-- Page header -->

    <div class="page-header">

        <div class="page-title">

            <h3>' . $aula_data["nombre_aula"] . ' <small>' . $aula_data["nombre_modulo"] . '</small></h3>

        </div>

        

    </div>

    <!-- /page header -->



    <!-- Breadcrumbs line -->

    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="' . BASE_URL . '">Home</a></li>

            <li><a href="' . BASE_URL . '?lista_aulas">Aulas</a></li>

            <li class="active">' . $aula_data["nombre_aula"] . '</li>

        </ul>

    </div>

    <!-- /breadcrumbs line -->



    <div class="row">

        <div class="col-sm-2">

            <!-- Profile links -->

            <div class="block">



                <div class="block">

                    <div class="thumbnail">

                        <div class="thumb">

                            <img src="' . $aula_image . '" alt="">

                            ' . $item_add_image . '

                        </div>

                    </div>

                </div>

            </div>

            <ul class="nav nav-list">

                <li class="nav-header">Opciones del aula</li>

                <li><a href="' . BASE_URL . '?add_nota=' . $aula_data["id_aula"] . '"><i class="icon-stats2"></i> Crear una nota</a></li>

                ' . $items_panel . '

            </ul>

            <ul class="nav nav-list">

                <li class="nav-header"><i class="icon-info"></i>Información</li>

                ' . $items_videos . '

            </ul>

        </div>

        <div class="col-sm-10">

            <!-- Page tabs -->

            <!-- alumnos (table) -->

            <div class="block">

                <h6 class="heading-hr"><i class="icon-people"></i>Alumnos en ' . $aula_data["nombre_aula"] . $btn_file . $btn_pass . $btn_email_list . '</h6>

                <div class="datatable-media">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th class="image-column">Imagen</th>

                                <th>Nombre</th>

                                <th>Servicio</th>

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

            <!-- Modal email_list -->

                            <div class="modal fade" id="ctm-email-list" role="dialog">

                                <div class="modal-dialog">

                                    <!-- Modal content-->

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                            <h4 class="modal-title"><i class="icon-file" style="font-size:22px;margin: 3px 10px;"></i> <span style="display:inline-block;">' . $aula_data["nombre_aula"] . '<small style="display:block;color:#fff;font-style:italic;">Lista de Correos Electrónicos </small></span></h4>

                                        </div>

                                        <div class="modal-body">

                                            <div style="width:80%; margin:0 auto;">

                                                <ul style="list-style:none; margin:10px; padding:0;">

                                                    ' . $email_list . '

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /Modal -->

        </div>

    </div>

</div>

<!-- /page content -->';

}

