<?php



function get_all_by_user($id) {

    $upload_max = (ini_get('upload_max_filesize'));

    $rol = $_SESSION["user_data"]["id_rols"];

    $user = new people();

    $url = "";

    $output_aulas = "";

    $user_data = $user->get_profile($id);

    $user_data["full_name"] = $user_data["fname_people"] . " " . $user_data["lname1_people"] . " " . $user_data["lname2_people"];

    $servicio = new alumnos_servicios();

    $servicio_data = $servicio->get_service_by_alumno($id);

//    print_r($servicio_data);

//    print_r($user_data);

    $comment = empty($user_data["comment_people"]) ? "No hay comentario personal" : $user_data["comment_people"];

    $title = $user_data["full_name"];

    $subtitle = $user_data["rol"];

//    print_r($user_data);

    $edit_profile = "";

    $gerundio = "";

    $btn_aulas_user = '';

    if ($rol == 10) {

        $btn_aulas_user = '<div class="ctm-btn-key">

                            <a href="' . BASE_URL . '?aulas_usuario=' . $id . '" class="btn btn-default btn-warning"><i class="icon-key"></i></a>

                        </div>';

    }

    if (($_SESSION["user_data"]["id_user"]) == ($id) || ($rol == 10)) {

        $btn_pdf = '<a id="get-pdf" class="tip btn btn-success" data-original-title="Descargar en PDF"><i class="icon-print"></i></a>';

        $btn_pdf = "";

        $edit_profile = '<div class="ctm-btn-add">

                            <a href="' . BASE_URL . '?edit_profile=' . $id . '" class="btn btn-default btn-success"><i class="icon-pencil"></i></a>

                        </div>';

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

                                                        <span onclick="upload_image(0, ' . $id . ')" class="btn btn-default">Cargar</span>

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

    }

    if (($_SESSION["user_data"]["id_user"]) == ($id)) {

        $title = "Perfil";

        $subtitle = "Informacón de usuario";

    }

    $user_photo = get_image_people($user_data["photo_people"]);

    reset($user_data);





    $data_user .= "";

    $lateral_data = "<dl class='ctm_data_user' >" . $data . "</dl>";

    if ($user_data["rol"] == "Alumno") {

        $url = "<a href='" . BASE_URL . "?lista_alumnos'> Alumnos </a>";

        $aulas = new aulas_alumnos();

        $notas = new notas_alumnos();

        $aulas_data = $aulas->get_aulas_by_alumno_nw($id);

       //print_r($aulas_data);

        $tmp_items = '';

        $tmp_aulas = '';

        $i = 0;

        $anterior = false;

        $tmp_content_aulas = "";

        if (is_array($aulas_data)) {

            foreach ($aulas_data as $v) {

                $notas_data = $notas->get_notas_by_aula($id, $v["id_aula"]);

//            print_r($v);

                $ctm_class = ($i == 0) ? "in" : "";

                $ctm_active = ($i == 0) ? "active" : "";

                if (is_array($notas_data)) {

                    foreach ($notas_data as $vv) {



                        $tmp_content_aulas .= '<tr>

                                    <td>' . $vv["title_aulas_notas"] . '</td>

                                    <td>' . $vv["nota_alumno"] . '</td>

                                    <td>' . $vv["comentario"] . '</td>

                                </tr>';

                    }

                } else {



                    $tmp_content_aulas .= '<tr>'

                            . '<td colspan="3" class="text-center" > No tienes notas aún en este módulo <td>'

                            . '</tr>';

                }



                $tmp_items .= '<li class="list-group-item has-button"><i class="icon-stack"></i> '

                        . '<a href="' . BASE_URL . '?aula=' . $v['id_aula'] . '" target="_blank">' . $v['nombre_modulo'] ."   -   <em>". $v['f_inicio'] .'</em></a> <a href="' . BASE_URL . '?aula=' . $v['id_aula'] . '" target="_blank" class="btn btn-link btn-icon"><i class="icon-redo"></i></a>'

                        . '</li>';

//                $tmp_items .= '<li class="' . $ctm_active . '" ><a href="#table-tab' . $i . '" data-toggle="tab"><i class="icon-stack"></i> Modulo ' . ($i + 1) . '</a></li>';

                $tmp_content_aulas = "";



                $i++;

            }

        } else {

            $tmp_aulas = '<h3 class="text-center" ><small>El alumno no está asociado a ningún Aula<small></h3>';

        }

        $output_aulas = ' 

                

                <h6 class="heading-hr"><i class="icon-stack"></i>Información del servicio</h6>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="panel panel-primary">

                                    <div class="panel-heading">

                                            <h6 class="panel-title"><i class="icon-stack"></i> ' . $servicio_data["name_servicio"] . '</h6>

                                    </div>

                                    <ul class="list-group">

                                      ' . $tmp_items . '

                                    </ul>

                            </div>

                        </div>

                    </div>

                    <!-- /inside tabs -->';

    } else {

        if ($user_data["rol"] == "Profesor") {

            $url = "<a href='" . BASE_URL . "?lista_profesores'> Profesores </a>";

            $aulas_profesores = new aulas_profesores();

            $aulas_data = $aulas_profesores->get_aulas_by_profes($user_data["id_people"]);

            $output_aulas_row = "";

//            print_r($aulas_data);

            if (is_array($aulas_data)) {

                foreach ($aulas_data as $k => $v) {

                    $output_aulas_row .= "<tr>

                                            <td><a href='" . BASE_URL . "?aula=" . $v["id_aula"] . "'>" . $v['nombre_aula'] . "</a></td>

                                            <td><a href='" . BASE_URL . "?aula=" . $v["id_aula"] . "'> " . get_date_format($v["f_inicio"]) . "</a></td>

                                            <td><a href='" . BASE_URL . "?aula=" . $v["id_aula"] . "'> " . get_date_format($v["f_fin"]) . "</a></td>

                                            <td><a href='" . BASE_URL . "?lista_notas=" . $v['id_aula'] . "'><i class='icon-stats2'></i></a></td>

                                            <td><a href='" . $v['url_aula'] . "'><i class='icon-redo2'></i></a></td>

                                        </tr>";

                }





                $output_aulas = '<div class="panel panel-primary">

                <div class="panel-heading">

                    <h6 class="panel-title"><i class="icon-accessibility"></i>Profesor en</h6>

                </div>

                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Nombre aula</th>

                                    <th>Fecha Inicio</th>

                                    <th>Fecha fin</th>

                                    <th>Notas</th>

                                    <th>URL</th>

                                </tr>

                            </thead>

                            <tbody>

                                ' . $output_aulas_row . '

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>';

            }

        }

    }

    $user_data["postal_code"] = ($user_data["postal_code"] == 0) ? "" : $user_data["postal_code"];

    if ($rol != 10) {

        $output_aulas = "";

    }

    $user_data["comment_service"] = ($user_data["comment_service"] == "") ? "<br/><br/>" : $user_data["comment_service"];

    return

            '<!-- Page content -->

<div class="page-content">

    <!-- Page header -->

    <div class="page-header">

        <div class="page-title">

            <h3>' . $title . '<small>' . $subtitle . '</small></h3>

        </div>

        ' . $edit_profile . $btn_aulas_user . '

    </div>

        ' . $btn_pdf . '

    <!-- /page header -->



    <!-- Breadcrumbs line -->

    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="' . BASE_URL . '">Inicio</a></li>

            <li>' . $url . '</li>

            <li class="active">' . $user_data["full_name"] . '</li>

        </ul>

        <div class="visible-xs breadcrumb-toggle">

            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>

        </div>

    </div>

    <!-- /breadcrumbs line -->





    <!-- Profile grid -->

    <div class="row" id="printable">

        <div class="col-lg-2">

            <!-- Profile links -->

            <div class="block">

                <div class="block">

                    <div class="thumbnail">

                        <div class="thumb">

                            <img alt="" src="' . $user_photo . '">

                            ' . $item_add_image . '

                        </div>

                        <div class="caption text-center">

                            <h6>' . $user_data["full_name"] . ' <small>' . $user_data["rol"] . '</small></h6>

                            <div class="icons-group">

                            </div>

                        </div>

                        <div class="panel panel-primary">

                            <div class="panel-heading">

                                <h6 class="panel-title">Descripción personal</h6>

                            </div>

                            <div class="panel-body">

                                <p>

                                    ' . $comment . '

                                </p>

                            </div>

                        </div>

                        

                    </div>

                </div>

            </div>

            <!-- /profile links -->

        </div>

        <div class="col-lg-10">

        

        <h4>Ficha de ' . $user_data["full_name"] . '</h4><h6 class="heading-hr"><i class="icon-user"></i>Información del personal</h6>

            <div class="form-group">

                <div class="row">

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "fname_people") . '</label>&nbsp;' . $user_data["fname_people"] . '

                    </div>

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "lname1_people") . '</label>&nbsp;' . $user_data["lname1_people"] . '

                    </div>

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "lname2_people") . '</label>&nbsp;' . $user_data["lname2_people"] . '

                    </div>

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "apodo") . '</label>&nbsp;' . $user_data["apodo"] . '

                    </div>

                </div>

            </div>

            <div class="form-group">

                <div class="row">

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "f_nacimiento") . '</label>&nbsp;' . $user_data["f_nacimiento"] . '

                    </div>

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "nacionalidad") . '</label>&nbsp;' . $user_data["nacionalidad"] . '

                    </div>

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "fk_reside_people") . '</label>&nbsp;' . $user_data["fk_reside_people"] . '

                    </div>

                    <div class="col-md-3">

                        <label style="display:block">' . human_cols("people", "postal_code") . '</label>&nbsp;' . $user_data["postal_code"] . '

                    </div>

                </div>

            </div>

            <div class="form-group">

                <div class="row">

                    <div class="col-md-4">

                        <label style="display:block">' . human_cols("people", "address_people") . '</label>&nbsp;' . $user_data["address_people"] . '

                    </div>

                    <div class="col-md-4">

                        <label style="display:block">' . human_cols("people", "phone_people") . '</label>&nbsp;' . $user_data["phone_people"] . '

                    </div>

                    <div class="col-md-4">

                        <label style="display:block">' . human_cols("people", "phone_people2") . '</label>&nbsp;' . $user_data["phone_people2"] . '

                    </div>

                </div>

            </div>

            <div class="form-group">

                <div class="row">

                    <div class="col-md-4">

                        <label style="display:block">' . human_cols("people", "email_people") . '</label>&nbsp;' . $user_data["email_people"] . '

                    </div>

                    <div class="col-md-4">

                        <label style="display:block">' . human_cols("people", "email_people2") . '</label>&nbsp;' . $user_data["email_people2"] . '

                    </div>

                </div>

            </div>

            <div class="form-group">

                <div class="row">

                    <div class="col-md-6">

                        <label style="display:block">' . human_cols("people", "comment_service") . '</label>&nbsp;<br/><br/>' . $user_data["comment_service"] . '

                    </div>

                </div>

            </div>

            

            ' . $output_aulas . '

        </div>

    </div>

    <!-- /profile grid -->

    ' . get_footer() . '

</div>

<!-- /page content -->';

}

