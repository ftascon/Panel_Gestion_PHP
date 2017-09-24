<?php

function get_examenes() {
    $rol = $_SESSION["user_data"]["id_rols"];
    $examenes = new examenes();
    $list_examenes = '';
    $item_opciones = '<th class="team-links">Opciones</th>';
    if ($rol == 10) {
        $add_examenes = '<div class="ctm-btn-add">
                        <a href="' . BASE_URL . '?nuevo_examen" class="btn btn-default btn-success"><i class="icon-plus"></i></a>
                    </div> ';
        $examenes_data = $examenes->get_all();
    } else {
        $examenes_data = $examenes->by_profe($_SESSION["user_data"]["id_user"]);
    }
    if (is_array($examenes_data)) {
        $opciones = "";
        foreach ($examenes_data as $v) {
//            print_r($v);
            if ($rol == (10 || 3)) {
                $opciones = ' <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="' . BASE_URL . '?edit_examen=' . $v["id_examen"] . '"><i class="icon-quill2"></i> Editar exámen</a></li>
                                            <li><a data-toggle="modal" data-target="#ctm-rm-aula' . $v["id_examen"] . '" ><i class="icon-remove3"></i> Eliminar</a></li>
                                    </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="ctm-rm-aula' . $v["id_examen"] . '" role="dialog">
                              <div class="modal-dialog modal-sm">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">¿Desea borrar el exámen?</h4>
                                  </div>
                                  <div class="modal-body">
                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . '/ajax/rm_exams.php?d=' . $v["id_examen"] . '">Delete</a>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </td>';
            }

            $v["url_examen"] = (($v["url_examen"] == '') || ($v["url_examen"] == NULL)) ? "<a href='#'>" : "<a href='" . $v["url_examen"] . "' target='_blank' > ";
            $list_examenes .= '<tr>
                            <td class="text-center">
                             ' . $v["nombre_examen"] . '
                            </td>
                            <td class="text-center">
                             En <a href="' . BASE_URL . '?aula=' . $v['id_aula'] . '"><strong>' . ($v["nombre_aula"]) . '</strong></a> de <i style="display:block;">' . $v['f_inicio_aula'] . '</i>
                            </td>
                            <td class="text-center">
                                <span>' . get_date_format($v["f_inicio"], 'examenes') . '</span>
                            </td>
                            <td class="text-center">
                                <span> ' . get_date_format($v["f_fin"], 'examenes') . '</span>
                            </td>
                            <td class="text-center">
                             ' . $v['url_examen'] . '<i class="icon-redo2"></i></a>
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
                <h3>Lista de Exámenes<small>Lista de todos los exámenes</small></h3>
            </div>
            ' . $add_examenes . '  
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                    <li><a href="' . BASE_URL . '">Home</a></li>
                    <li class="active">Exámenes</li>
            </ul>
        </div>
        <!-- /breadcrumbs line -->
        
        <div class="row">
            <div class="col-xs-12">
                <!-- alumnos (table) -->
                <div class="block">
                    <h6 class="heading-hr"><i class="icon-camera5"></i>Lista de Exámenes</h6>
                    <div class="datatable-media">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Aula</th>
                                    <th>Fecha inicio<small>(aaaa/mm/dd)</small></th>
                                    <th>Fecha limite<small>(aaaa/mm/dd)</small></th>
                                    <th>URL</th>
                                    ' . $item_opciones . '
                                </tr>
                            </thead>
                            <tbody>
                                ' . $list_examenes . '
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /alumnos (table) -->
            </div>
        </div>
        ' . get_footer() . '
    </div>
</div>
	<!-- /page container -->';
}
