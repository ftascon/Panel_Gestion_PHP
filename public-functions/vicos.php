<?php

function get_vicos() {
    $rol = $_SESSION["user_data"]["id_rols"];
    $vicos = new vicos();
    $list_vicos = '';
    $add_vico = '';
    $item_opciones = '';
    $modulos = array();
    if ($rol == 10) {
//        echo $rol;
        $item_opciones = '<th class="team-links">Opciones</th>';
        $vicos_data = $vicos->get_all();
        $add_vico = '<div class="ctm-btn-add">
                        <a href="' . BASE_URL . '?nueva_vico" class="btn btn-default btn-success"><i class="icon-plus"></i></a>
                    </div> ';
    } else {
        $vicos_data = $vicos->get_vico_by_profe($_SESSION["user_data"]["id_user"]);
    }
    if (is_array($vicos_data)) {
        $opciones = "";
        foreach ($vicos_data as $v) {
//            print_r($v);
            if ($rol == 10) {
                $opciones = ' <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="' . BASE_URL . '?edit_vico=' . $v["id_vico"] . '"><i class="icon-quill2"></i> Editar VC</a></li>
                                            <li><a data-toggle="modal" data-target="#ctm-rm-aula' . $v["id_vico"] . '" ><i class="icon-remove3"></i> Eliminar</a></li>
                                    </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" tabindex="-1" id="ctm-rm-aula' . $v["id_vico"] . '" role="dialog">
                              <div class="modal-dialog modal-sm">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">¿Desea borrar la VC?</h4>
                                  </div>
                                  <div class="modal-body">
                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . '/ajax/rm_vico.php?d=' . $v["id_vico"] . '">Delete</a>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </td>';
            }
            if (array_key_exists($v["fk_aula"], $modulos)) {
                $modulos[$v["fk_aula"]] ++;
            } else {
                $modulos[$v["fk_aula"]] = 1;
            }
            $url_vico = (($v["url_vico"] == "") || ($v["url_vico"] == "#") || ($v["url_vico"] == NULL)) ? "<a href='" . get_url_vicos($v["prefix_vc_modulo"] . $modulos[$v["fk_aula"]]) . "' target='_blank'>" : "<a href='" . $v["url_vico"] . "' target='_blank' > ";
            $list_vicos .= '<tr>
                            <td class="text-center">
                             ' . $v["nombre_vico"] . '
                            </td>
                            <td class="text-center">
                             En <strong><a href="' . BASE_URL . '?aula=' . $v["id_aula"] . '" target="_blank">' . ($v["nombre_aula"]) . "</a></strong> del <i class='text-block'>" . $v["f_inicio"] . '</i>
                            </td>
                            <td class="text-center">
                                <span>' . get_date_format($v["fecha_vico"], 'vicos') . " a las " . $v["hora_vico"] . '</span>
                            </td>
                            <td class="text-center">
                             ' . $url_vico . '<i class="icon-redo2"></i></a>
                            </td>
                           ' . $opciones . '
                        </tr>';
        }
    }

    return '<!-- Page content -->
<div class="page-content">
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Lista de Videoconferencias<small>Lista detallada de las VC</small></h3>
            </div>
            ' . $add_vico . '  
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                    <li><a href="' . BASE_URL . '">Home</a></li>
                    <li class="active">Videoconferencias</li>
            </ul>
        </div>
        <!-- /breadcrumbs line -->
        <!-- alumnos (table) -->
        <div class="block">
            <h6 class="heading-hr"><i class="icon-camera5"></i>Lista de Videoconferencias</h6>
            <div class="datatable-media">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre Videoconferencia</th>
                            <th>Aula</th>
                            <th>Fecha <small>(aaaa/mm/dd)</small></th>
                            <th>URL</th>
                            ' . $item_opciones . '
                        </tr>
                    </thead>
                    <tbody>
                        ' . $list_vicos . '
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /alumnos (table) -->
    </div>
</div>
	<!-- /page container -->';
}
