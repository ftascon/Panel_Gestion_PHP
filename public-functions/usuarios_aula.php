<?php

function get_aulas_usuario($id_user) {
    $aulas = new aulas_alumnos();
    $aulas_data = $aulas->get_aulas_by_alumno($id_user);
    print_r($aulas_data);
    /* - - - - - - VOLCADO - - - - - */
    $btn_volcado = '<a data-toggle="modal" data-target="#ctm-nota' . $id_nota . '" id="btn_volcado" class="tip btn btn-success ctm_out_bread" data-original-title="Cargar CSV"><i class="icon-upload"></i></a>
                        <!-- Modal -->
                            <div class="modal fade" tabindex="-1" id="ctm-nota' . $id_nota . '" role="dialog">
                                <form id="role-form" method="POST" action="' . BASE_URL . 'ajax/import_notas_alumnos.php?id_nota=' . $id_nota . '&id_aula=' . $notas_data["id_aula"] . '">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Volcado en masa</h4>
                                            </div>
                                            <div class="modal-body" style="padding:15px;">
                                              <h5>Informacion para volcar<small style="display:block;font-family: inherit;" >formato -> email;nota(0-100)</small></h5>
                                                <textarea name="content" style="width:100%; min-height:200px;"></textarea>
                                            </div>
                                            <div class="modal-footer">

                                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                              <button type="submit" class="btn btn-success">Importar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!-- /Modal -->';
    /* - - - - - - /VOLCADO - - - - - */
    if (is_array($alumnos_data)) {
        foreach ($alumnos_data as $key => $value) {
            $user_photo = get_image_people($value["photo_people"]);
            if (is_array($value)) {
                foreach ($value as $skey => $svalue) {
                    $value[$skey] = $svalue;
                }
                $list_alumnos .= '<tr id="aula_alumno_' . $value["id_people"] . '">
                        <td class="text-center">
                            <a href="' . $user_photo . '" class="lightbox"><img src="' . $user_photo . '" alt="" class="img-media"></a>
                        </td>
                        <td class="text-semibold">
                            ' . $value["fname_people"] . " " . $value["lname1_people"] . " " . $value["lname2_people"] . '
                                <small style="display:block; color:#888">' . $value["username_users"] . '</small>
                        </td>
                        <td class="text-center">
                            <div class="form-group">
                                <input type="number" name="notas[' . $value["id_people"] . '][nota_alumno]" step="any" max="10" min="0" class="col-sm-12" value="' . $data_notas_all[$key]["nota_alumno"] . '" />
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-group" style="margin-bottom:0px;">
                                <textarea name="notas[' . $value["id_people"] . '][comentario]" rows="3" cols="5" class="limited form-control" style="resize: none;" placeholder="Comentario personalizado (limitado)">' . $data_notas_all[$key]["comentario"] . '</textarea>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-group">
                                <label class="checkbox">
                                    <input type="checkbox" name="mailto[' . $value["id_people"] . ']" class="styled" ' . $check_mailto . '>
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-actions text-center">
                                <input type="submit" value="Guardar" class="btn btn-info">
                            </div>
                        </td>
                    </tr>';
            }
        }
    }

    return '<!-- Page content -->
<div class="page-content">
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3> ' . $notas_data["title_aulas_notas"] . ' resultados <small>Aula ' . $notas_data["nombre_aula"] . '</small></h3>
            </div>
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="' . BASE_URL . '">Home</a></li>
                <li><a href="' . BASE_URL . '?aula=' . $notas_data["id_aula"] . '">' . $notas_data["nombre_aula"] . '</a></li>
                <li class="active">' . $notas_data["title_aulas_notas"] . '</li>
            </ul>
            ' . $btn_volcado . ' 
        </div>
        <!-- /breadcrumbs line -->
        <div class="row">
            <div class="col-sm-12">
                <!-- profesores (table) -->
                <form class="" action="ajax/add_notas_alumnos.php?id_nota=' . $id_nota . '&id_aula=' . $notas_data["id_aula"] . '" method="POST" role="form">
                    <div class="block">
                    
                        <div class="datatable-media">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:100px" class="image-column text-center">Foto</th>
                                        <th >Nombre Alumno</th>
                                        <th style="min-width:70px;max-width:200px;width: 100px;text-align: center;">Nota</th>
                                        <th class="text-center">Comentario</th>
                                        <th style="width:170px" class="text-center">¿Notificar al alumno?</th>
                                        <th style="width:170px" class="text-center">Guardado individual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ' . $list_alumnos . '
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-actions text-right">
                        <input type="submit" value="Guardar todo" class="btn btn-success">
                    </div>
                </form>
                <!-- /profesores (table) -->
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>
</div>
	<!-- /page container -->';
}
