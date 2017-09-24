<?php

function get_profes_admin() {
    $list_alumnos = '';
    $profesores = new profesores();
    $profesores_data = $profesores->get_all_profesores();
//    print_r($profesores_data);
    $list_profesores = '';
    for ($i = 0; $i < count($profesores_data); $i++) {
        $user_photo = get_image_people($profesores_data[$i]["photo_people"]);
        $address = ($profesores_data[$i]["address_people"] == "") ? 'No address' : $profesores_data[$i]["address_people"];
        $email = ($profesores_data[$i]["email_people"] == "") ? 'No Email' : $profesores_data[$i]["email_people"];
        $phone = ($profesores_data[$i]["phone_people"] == "") ? 'No teléfono' : $profesores_data[$i]["phone_people"];
        if (empty($profesores_data[$i]["name_country"])) {
            $location = "No country";
        } else {
            $location = '<span><a href="#">' . $profesores_data[$i]["name_country"] . '</a></span>';
        }
        $list_alumnos .= '<tr>
                        <td class="text-center">
                            <a href="' . $user_photo . '" class="lightbox" title="' . $profesores_data[$i]["fname_people"] . " " . $profesores_data[$i]["lname1_people"] . '"><img src="' . $user_photo . '" alt="" class="img-media"></a>
                        </td>
                        <td class="text-semibold"><a href="' . BASE_URL . '?ficha=' . $profesores_data[$i]["id_people"] . '">' . $profesores_data[$i]["fname_people"] . " " . $profesores_data[$i]["lname1_people"] . " " . $profesores_data[$i]["lname2_people"] . '</a></td>
                        <td class="file-info">
                            <span><strong>Email: </strong>' . $email . '</span>
                            <span><strong>Teléfono: </strong>' . $phone . '</span>
                        </td>
                        <td class="file-info">
                            ' . $location . '
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="' . BASE_URL . '?ficha=' . $profesores_data[$i]["id_people"] . '"><i class="icon-user"></i> Ver perfil</a></li>
                                            <li><a data-toggle="modal" data-target="#ctm-rm-aula" ><i class="icon-remove3"></i> Eliminar</a></li>
                                    </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="ctm-rm-aula" role="dialog">
                              <div class="modal-dialog modal-sm">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">¿Desea borrar el profesor?</h4>
                                  </div>
                                  <div class="modal-body">
                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . '?remove_profesor=' . $profesores_data[$i]["id_people"] . '">Delete</a>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </td>
                    </tr>';
    }
    $alert = "";
    if (isset($_GET["ok"])) {
        $alert = '<div class="callout callout-success fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h5>Operación exitosa</h5>
				
			</div>';
    }
    return '<!-- Page content -->
<div class="page-content">
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Lista de profesores<small>Lista detallada de los profesores</small></h3>
            </div>                
            <div class="ctm-btn-add">
                <a href="' . BASE_URL . '?nuevo_profesores" class="btn btn-default btn-success"><i class="icon-user-plus2"></i></a>
            </div>                
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                    <li><a href="' . BASE_URL . '">Home</a></li>
                    <li><a href="' . BASE_URL . '?lista_profesores">Profesores</a></li>
                    <li class="active">Lista de profesores</li>
            </ul>
        </div>
        <!-- /breadcrumbs line -->
        ' . $alert . '
        <!-- alumnos (table) -->
        <div class="block">
            <h6 class="heading-hr"><i class="icon-people"></i>Lista de profesores</h6>
            <div class="datatable-media">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="image-column">Imagen</th>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Pais</th>
                            <th class="team-links">Opciones</th>
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
</div>
	<!-- /page container -->';
}
