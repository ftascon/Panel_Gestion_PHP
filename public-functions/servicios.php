<?php

function get_servicios() {
    $alert = "";
    if (isset($_GET["ok"])) {
        $alert = '<div class="callout callout-success fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h5>Operación exitosa</h5>
				
			</div>';
    } else {
        if (isset($_GET["ko"])) {
            $alert = '<div class="callout callout-danger fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h5>La operación ha fallado, compruebe si los cambios son correctos</h5>
				
			</div>';
        }
    }
    $servicios = new servicios();
    $servicios_data = $servicios->get_all_servicios();
//    print_r($servicios_data);
    $list_servicios = '';
    foreach ($servicios_data as $k => $v) {
        $des = ($v["descripcion_servicio"] == "") ? 'No hay descripcion' : $v["descripcion_servicio"];
        $list_servicios .= '<tr>
                        <td class="text-semibold">' . $v["name_servicio"] . '</td>
                        <td class="file-info">
                            <span>' . $des . '</span>
                        </td>
                        <td class="file-info">
                            <span>' . $v["name"] . '</span>
                        </td>
                        <td class="text-center">
                            <span>' . $v["price_servicio"] . '</span>
                        </td>
                        <td class="text-center">
                            <span>' . $v["price_servicio2"] . '</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="' . BASE_URL . '?edit_servicio=' . $v["id_servicio"] . '"><i class="icon-pencil"></i> Editar</a></li>
                                            <li><a data-toggle="modal" data-target="#ctm-rm-aula' . $v["id_servicio"] . '" ><i class="icon-remove3"></i> Eliminar</a></li>
                                    </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="ctm-rm-aula' . $v["id_servicio"] . '"  tabindex="-1" role="dialog">
                              <div class="modal-dialog modal-sm">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">¿Desea borrar el servicio?</h4>
                                  </div>
                                  <div class="modal-body">
                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . '?remove_servicio=' . $v["id_servicio"] . '">Delete</a>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </td>
                    </tr>';
    }

    return '<!-- Page content -->
<div class="page-content">
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Lista de servicios<small>Lista detallada de servicios </small></h3>
            </div>
            <div class="ctm-btn-add">
                <a href="' . BASE_URL . '?nuevo_servicio" class="btn btn-default btn-success"><i class="icon-plus"></i></a>
            </div>
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="' . BASE_URL . '">Home</a></li>
                <li class="active">Servicios</li>
            </ul>
        </div>
        <!-- /breadcrumbs line -->
        ' . $alert . '
        <!-- profesores (table) -->
        <div class="block">
            <div class="datatable-media">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre del servicio</th>
                            <th>Descripcion</th>
                            <th>Tipo de Servicio</th>
                            <th class="team-links">Primer Precio(€)</th>
                            <th class="team-links">Segundo Precio(€)</th>
                            <th class="team-links">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        ' . $list_servicios . '
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /profesores (table) -->
    </div>
    ' . get_footer() . '
</div>
	<!-- /page container -->';
}
