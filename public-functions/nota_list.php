<?php

function get_notas($id) {
    $aula = new aulas();
    $aula_data = $aula->get_aula_by_id($id);

    $notas = new aulas_notas();
    $notas_data = $notas->get_notas_by_aula($id);
//    print_r($notas_data);
    $output_notas = '<p>No hay notas para esta aula puede <a href="' . BASE_URL . '?add_nota=' . $id . '">crear nueva</a></p>';
    if (count($notas_data) > 0) {
        $output_notas = "";
        for ($i = 0; $i < count($notas_data); $i++) {
            $output_notas .= '<tr>
                        <td class="text-semibold">
                            <a href="' . BASE_URL . '?nota=' . $notas_data[$i]["id_aulas_notas"] . '">' . $notas_data[$i]["title_aulas_notas"] . '</a>
                        </td>
                        <td class="text-center">
                            <span>
                                ' . $notas_data[$i]["coment_aulas_notas"] . '
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                                <ul class="dropdown-menu icons-right dropdown-menu-right" style="display: none;">
                                    <li><a href="' . BASE_URL . '?nota=' . $notas_data[$i]["id_aulas_notas"] . '"><i class="icon-stats2"></i>Ver resultados</a></li>
                                    <li><a href="' . BASE_URL . '?edit_nota=' . $notas_data[$i]["id_aulas_notas"] . '&from_aula=' . $id . '"><i class="icon-quill2"></i> Editar</a></li>
                                    <li><a data-toggle="modal" data-target="#ctm-rm-aula' . $notas_data[$i]["id_aulas_notas"] . '" ><i class="icon-remove3"></i> Eliminar</a></li>
                                </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" tabindex="-1" id="ctm-rm-aula' . $notas_data[$i]["id_aulas_notas"] . '" role="dialog">
                                <div class="modal-dialog modal-sm">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">¿Desea borrar la nota?</h4>
                                        </div>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger btn-ok" href="ajax/rm_nota.php?notas=' . $notas_data[$i]["id_aulas_notas"] . '&aula=' . $notas_data[$i]["fk_aula"] . '">Delete</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>';
        }
        $output_notas = '<div class="datatable-media">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Comentario</th>
                                        <th class="team-links">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ' . $output_notas . '
                                </tbody>
                            </table>
                        </div>';
    }
//    print_r($aula_data);
    return '<!-- Page content -->
            <div class="page-content">
                <div class="page-content-inner">
                    <!-- Page header -->
                    <div class="page-header">
                        <div class="page-title">
                            <h3>Notas en ' . $aula_data["nombre_aula"] . '<small>Lista de notas</small></h3>
                        </div>
                        <div class="page-title" style="margin-left: 15px;">
                        <h3><a href="' . BASE_URL . '?add_nota=' . $aula_data["id_aula"] . '" class="btn btn-success btn-icon btn-xs"><i class="icon-plus"></i></a></h3>
                    </div>
                    </div>
                    <!-- /page header -->
                    <!-- Breadcrumbs line -->
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="' . BASE_URL . '">Home</a></li>
                            <li><a href="' . BASE_URL . '?aula=' . $id . '">' . $aula_data["nombre_aula"] . '</a></li>
                            <li class="active">Notas</li>
                        </ul>
                    </div>
                    <!-- /breadcrumbs line -->
                    <!-- profesores (table) -->
                    <div class="block">
                        ' . $output_notas . '
                    </div>
                    <!-- /profesores (table) -->
                </div>
            </div>
            <!-- /page content -->';
}
