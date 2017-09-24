<?php

function get_noticias() {
    $rol = $_SESSION["user_data"]["id_rols"];
    $id_user = $_SESSION["user_data"]["id_user"];
    $noticias = new noticias();
    $noticias_list = "";
    $add_noticias = '<div class="ctm-btn-add">
                            <a href="' . BASE_URL . '?nueva_noticia" class="btn btn-default btn-success"><i class="icon-plus"></i></a>
                        </div> ';
    if ($rol == 10) {
        $noticias_data = $noticias->get_all();
    } else {
        if ($rol == 2) {
            $noticias_data = $noticias->get_by_people($id_user);
        }
    }
//    print_r($noticias_data);
    for ($i = 0; $i < count($noticias_data); $i++) {
        $noticias_image = get_image_noticias($noticias_data[$i]["imagen_noticias"]);
        $noticias_data[$i]["full_name"] = $noticias_data[$i]["fname_people"] . " " . $noticias_data[$i]["lname1_people"] . " " . $noticias_data[$i]["lname2_people"];
        if (($rol == 10) || ($noticias_data[$i]["id_people"] == $id_user)) {
            $item_opciones = '<th class="team-links">Opciones</th>';
            $opciones = '<td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                                    <ul class="dropdown-menu icons-right dropdown-menu-right" style="display: none;">
                                            <li><a href="' . BASE_URL . '?noticia=' . $noticias_data[$i]["id_noticias"] . '" target="_blank"><i class="icon-redo2"></i> Ver noticia</a></li>
                                            <li><a href="' . BASE_URL . '?edit_noticias=' . $noticias_data[$i]["id_noticias"] . '"><i class="icon-quill2"></i> Editar</a></li>
                                            <li><a data-toggle="modal" data-target="#ctm-rm-aula' . $noticias_data[$i]["id_noticias"] . '" ><i class="icon-remove3"></i> Eliminar</a></li>
                                    </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="ctm-rm-aula' . $noticias_data[$i]["id_noticias"] . '" role="dialog">
                              <div class="modal-dialog modal-sm">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">¿Desea borrar la noticia?</h4>
                                  </div>
                                  <div class="modal-body">
                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . 'ajax/rm_noticias.php?id=' . $noticias_data[$i]["id_noticias"] . '">Delete</a>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </td>';
        } else {
            $op_url = '<td class="text-center">
                            <a href="' . BASE_URL . '?noticia=' . $noticias_data[$i]["id_noticias"] . '" class="tip" data-original-title="Ir al aula" target="_blank"><i class="icon-redo2"></i></a>
                        </td>';
            $opciones = '<td class="text-center"></td>';
        }
        $noticias_list .= '<tr>
                        <td class="text-center">
                            <a href="' . $noticias_image . '" class="lightbox" title="' . $noticias_data[$i]["titulo_noticias"] . '"><img src="' . $noticias_image . '" alt="" class="img-media"></a>
                        </td>
                        <td class="text-semibold">
                           <a href="' . BASE_URL . '?noticia=' . $noticias_data[$i]["id_noticias"] . '" title="" class="tip" data-original-title="Ver">' . $noticias_data[$i]["titulo_noticias"] . '</a>
                        </td>
                        <td class="text-semibold">
                           ' . $noticias_data[$i]["full_name"] . '
                        </td>
                        <td class="date">
                            <span>' . get_date_format($noticias_data[$i]["fecha_noticias"]) . '</span>
                        </td>
                        ' . $opciones . '
                    </tr>';
    }

    return '<!-- Page content -->
<div class="page-content"> 
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Lista de noticias<small>Noticias detalladas</small></h3>
            </div>  
            ' . $add_noticias . ' 
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                    <li><a href="' . BASE_URL . '">Home</a></li>
                    <li class="active">noticias</li>
            </ul>
        </div> 
        <!-- /breadcrumbs line -->
        <!-- alumnos (table) -->
        <div class="block">
            <h6 class="heading-hr"><i class="icon-stack"></i>Lista de noticias</h6>
            <div class="datatable-media">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="image-column">Imagen</th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Fecha de inicio</th>
                            ' . $item_opciones . '
                        </tr>
                    </thead>
                    <tbody>
                        ' . $noticias_list . '
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /alumnos (table) -->
    </div>
</div>
	<!-- /page container -->';
}
