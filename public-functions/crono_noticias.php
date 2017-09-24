<?php

function get_noticias() {
    $rol = $_SESSION["user_data"]["id_rols"];
    $id_user = $_SESSION["user_data"]["id_user"];
    $noticias = new noticias();
    $noticias_recientes = '';
    $noticias_list = "";
    $add_noticias = '<div class="ctm-btn-add">
                            <a href="' . BASE_URL . '?nueva_noticia" class="btn btn-default btn-success"><i class="icon-plus"></i></a>
                        </div> ';
    if ($rol == (10 || 3)) {
        $noticias_data = $noticias->get_all();
    } else {
        if ($rol == 2) {
            $noticias_data = $noticias->get_by_people($id_user);
        }
    }
//    print_r($noticias_data);
    if (count($noticias_data) > 0) {
        print_r($noticias_data);
        for ($i = 0; $i < count($noticias_data); $i++) {
            $icon_mod = "";
            if ($noticias_data[$i]["fk_autor"] == $id_user) {
                $icon_mod = '<div class="btn-group">
                                <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="' . BASE_URL . '?edit_noticias=' . $noticias_data[$i]["id_noticias"] . '"><i class="icon-pencil"></i> Editar Noticias</a></li>
                                            <li><a data-toggle="modal" data-target="#ctm-rm-aula' . $noticias_data[$i]["id_noticias"] . '" ><i class="icon-remove3"></i> Eliminar</a></li>
                                    </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" tabindex="-1" id="ctm-rm-aula' . $noticias_data[$i]["id_noticias"] . '" role="dialog">
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
                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . 'ajax/rm_noticias.php?id=' . $noticias_data[$i]["id_noticias"] . '">Borrar</a>
                                  </div>
                                </div>
                              </div>
                            </div>';
            }
            $noticias_recientes .= '
                    <div class="ctm-crono-single-noticias"> 
                        <div class="ctm-noticias-header">
                            <h4>' . $noticias_data[$i]["titulo_noticias"] . ' ' . $icon_mod . '</h4>
                            <small> ' . get_date_format($noticias_data[$i]["fecha_noticias"], "lista_noticias", "/") . " a las " . $noticias_data[$i]["hora_noticias"] . '</small>
                        </div>
                        <div class="ctm-noticias-content">
                            ' . $noticias_data[$i]["contenido_noticias"] . '
                        </div>
                        <span class="ctm-crono-separator">&nbsp;</span>
                    </div>';
            $noticias_image = get_image_noticias($noticias_data[$i]["imagen_noticias"]);
            $noticias_data[$i]["full_name"] = $noticias_data[$i]["fname_people"] . " " . $noticias_data[$i]["lname1_people"] . " " . $noticias_data[$i]["lname2_people"];
            if (($rol == 10) || ($noticias_data[$i]["id_people"] == $id_user)) {
                
            }
        }
    } else {
        $noticias_recientes = "No hay noticias disponibles";
    }

    return '<!-- Page content -->
<div class="page-content"> 
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Noticias<small>Lista de noticias</small></h3>
            </div>  
            ' . $add_noticias . ' 
        </div>
        <!-- /page header -->
        <!-- alumnos (table) -->
        <!--    <h6 class="heading-hr"><i class="icon-stack"></i>Noticias reciente</h6> --> 
            <div class="col-xs-12">
        <div class="block">
            <div class="chat ctm-crono-noticias">
                ' . $noticias_recientes . '
                    <div class="ctm-crono-single-noticias"> 
                    </div>
            </div>
        </div>
        <!-- /alumnos (table) -->
    </div>
    <!-- Footer -->
    <div class="footer clearfix">
        <div class="pull-left">&copy; 2016. Gestor Energetico</div>
        <div class="pull-right icons-group">
            <a href="#"><i class="icon-screen2"></i></a>
            <a href="#"><i class="icon-balance"></i></a>
            <a href="#"><i class="icon-cog3"></i></a>
        </div>
    </div>
    <!-- /footer -->
</div>
	<!-- /page container -->';
}
