<?php

function get_create_noticia($id = false) {
    $rol = $_SESSION["user_data"]["id_rols"];
    $id_user = $_SESSION["user_data"]["id_user"];
    $categorias = new categorias();
    $categorias_data = $categorias->get_all();
    $noticias_data = array();
    $noticias_data["titulo_noticias"] = "";
    $noticias_data["contenido_noticias"] = "";
    $edit = "Nueva";
    $aulas = new aulas();
    if ($id) {
        $aulas_data = $aulas->get_aula_by_profe($id_user);
        $edit = 'Edit';
        $noticias = new noticias();
        $noticias_data = $noticias->get_by_id($id);
    } else {
        $aulas_data = $aulas->get_all_aulas();
        $id = "-1";
    }
//        print_r($aulas_data);
    $personas = new people();
    $profesores = new profesores();
    $aulas_permisos = new noticias_aulas();
    $profesores_list = '';
    $personas_list = '';
    $profesores_list_in = '';
    $personas_list_in = '';
    $ifprof = '';
    $aulas_list = '';
    $aulas_list_1 = '';
    $aulas_list_2 = '';
    switch ($rol) {
        case 1:
            $profesores_data = $profesores->get_by_alumno($id_user);
            break;
        case 2:
            /**/
            $personas_data = $personas->get_out_noticia_by_profesor($id, $id_user);
            for ($i = 0; $i < count($personas_data); $i++) {
                $ifprof = ($personas_data[$i]["fk_type_people"] == 2) ? '(profesorado)' : '';
                $personas_list .= '<option value="' . $personas_data[$i]["id_people"] . '">' . $ifprof . ' ' . $personas_data[$i]["fname_people"] . " " . $personas_data[$i]["lname1_people"] . " " . $personas_data[$i]["lname2_people"] . ' </option>';
            }
            $personas_data = $personas->get_in_noticia_by_profesor($id, $id_user);
            for ($i = 0; $i < count($personas_data); $i++) {
                $ifprof = ($personas_data[$i]["fk_type_people"] == 2) ? '(profesorado)' : '';
                $personas_list_in .= '<option value="' . $personas_data[$i]["id_people"] . '">' . $ifprof . ' ' . $personas_data[$i]["fname_people"] . " " . $personas_data[$i]["lname1_people"] . " " . $personas_data[$i]["lname2_people"] . ' </option>';
            }
            /* - aulas - */
//            $aulas_permisos_data = $aulas_permisos->get_aulas_permisos($id);
//            print_r($aulas_permisos_data);
            $chk_1 = '';
            $chk_2 = '';
            for ($i = 0; $i < count($aulas_data); $i++) {

                $chk = ($aulas_permisos_data[0]["fk_aulas"] == $aulas_data[$i]["id_aula"]) ? "selected='selected'" : '';
                $chk_1 = ($aulas_permisos_data[1]["fk_aulas"] == $aulas_data[$i]["id_aula"]) ? "selected='selected'" : '';
                $chk_2 = ($aulas_permisos_data[2]["fk_aulas"] == $aulas_data[$i]["id_aula"]) ? "selected='selected'" : '';

                $aulas_list .= '<option ' . $chk . '  value="' . $aulas_data[$i]["id_aula"] . '">' . get_date_format($aulas_data[$i]["f_inicio"], "min", "/") . ' - ' . $aulas_data[$i]["nombre_aula"] . '</option> ';
                $aulas_list_1 .= '<option ' . $chk_1 . '  value="' . $aulas_data[$i]["id_aula"] . '">' . get_date_format($aulas_data[$i]["f_inicio"], "min", "/") . ' - ' . $aulas_data[$i]["nombre_aula"] . '</option> ';
                $aulas_list_2 .= '<option ' . $chk_2 . '  value="' . $aulas_data[$i]["id_aula"] . '">' . get_date_format($aulas_data[$i]["f_inicio"], "min", "/") . ' - ' . $aulas_data[$i]["nombre_aula"] . '</option> ';
//                $aulas_permisos_data[$i]["fk_aulas"];
            }


            break;
        case 3:
        case 10:
            /* personas out */
            $profesores_data = $profesores->get_all_out_noticia($id);
            for ($i = 0; $i < count($profesores_data); $i++) {
                $ifprof = ($profesores_data[$i]["fk_type_people"] == 2) ? '(profesorado)' : '';
                $profesores_list .= '<option value="' . $profesores_data[$i]["id_people"] . '">' . $ifprof . ' ' . $profesores_data[$i]["fname_people"] . " " . $profesores_data[$i]["lname1_people"] . " " . $profesores_data[$i]["lname2_people"] . ' </option>';
            }
            /* personas in */
            $profesores_data = $profesores->get_all_in_noticia($id);
            for ($i = 0; $i < count($profesores_data); $i++) {
                $ifprof = ($profesores_data[$i]["fk_type_people"] == 2) ? '(profesorado)' : '';
                $profesores_list_in .= '<option value="' . $profesores_data[$i]["id_people"] . '">' . $ifprof . ' ' . $profesores_data[$i]["fname_people"] . " " . $profesores_data[$i]["lname1_people"] . " " . $profesores_data[$i]["lname2_people"] . ' </option>';
            }
            /* - aulas - */
//            $aulas_permisos_data = $aulas_permisos->get_aulas_permisos($id);
//            print_r($aulas_permisos_data);
            $chk_1 = '';
            $chk_2 = '';
            for ($i = 0; $i < count($aulas_data); $i++) {

                $chk = ($aulas_permisos_data[0]["fk_aulas"] == $aulas_data[$i]["id_aula"]) ? "selected='selected'" : '';
                $chk_1 = ($aulas_permisos_data[1]["fk_aulas"] == $aulas_data[$i]["id_aula"]) ? "selected='selected'" : '';
                $chk_2 = ($aulas_permisos_data[2]["fk_aulas"] == $aulas_data[$i]["id_aula"]) ? "selected='selected'" : '';

                $aulas_list .= '<option ' . $chk . '  value="' . $aulas_data[$i]["id_aula"] . '">' . get_date_format($aulas_data[$i]["f_inicio"], "min", "/") . ' - ' . $aulas_data[$i]["nombre_aula"] . '</option> ';
                $aulas_list_1 .= '<option ' . $chk_1 . '  value="' . $aulas_data[$i]["id_aula"] . '">' . get_date_format($aulas_data[$i]["f_inicio"], "min", "/") . ' - ' . $aulas_data[$i]["nombre_aula"] . '</option> ';
                $aulas_list_2 .= '<option ' . $chk_2 . '  value="' . $aulas_data[$i]["id_aula"] . '">' . get_date_format($aulas_data[$i]["f_inicio"], "min", "/") . ' - ' . $aulas_data[$i]["nombre_aula"] . '</option> ';
//                $aulas_permisos_data[$i]["fk_aulas"];
            }
            break;

        default:
            break;
    }
//    print_r($aulas_data);
//    print_r($noticias_data);
    return ' <!--Page content -->
<div class = "page-content">
    <!--Page header -->
    <div class = "page-header">
        <div class = "page-title">
            <h3>' . $edit . ' noticia<small> Añadir Noticia</small></h3>
        </div>
    </div>
    <!--/page header -->


    <!--Breadcrumbs line -->
    <div class = "breadcrumb-line">
        <ul class = "breadcrumb">
            <li><a href = "' . BASE_URL . '">Home</a></li>
            <li><a href = "' . BASE_URL . '?lista_noticias">Noticias</a></li>
            <li class = "active">' . $edit . ' noticia</li>
        </ul>
    </div>
    <!--/breadcrumbs line -->
 
    <!--Form bordered -->
    <form class = "form-horizontal form-bordered" id="add_noticias" method = "POST" action = "ajax/add_noticias.php?id=' . $id . '" role = "form">
        <div class = "panel panel-default">
            <div class = "panel-heading"><h6 class = "panel-title"><i class = "icon-menu"></i> ' . $edit . ' noticia</h6></div>
            <div class = "panel-body">
                <div class = "form-group">
                    <label class = "col-sm-12 control-label">Titulo:</label>
                    <div class = "col-sm-12">
                        <input type = "text" name="titulo_noticias" class = "form-control" value = "' . $noticias_data["titulo_noticias"] . '" placeholder = "Título específico">
                    </div>
                </div>
                <div class = "form-group">
                    <label class = "col-sm-12 control-label">Descripción:</label>
                    <div class = "col-sm-12">
                        <div class = "block-inner">
                            <textarea name="" id="content_add_noticias" onclick="changedata();" class = "editor form-control" rows = "25" cols = "5" placeholder = "Contenido de la noticia" >' . $noticias_data["contenido_noticias"] . '</textarea>
                            <input class="hidden" id="html_add_noticias" value="" name="contenido_noticias" />
                            <script type="text/javascript">
                                function changedata() {
                                    // Retrieve the HTML from the plugin
//                                    alert($("#content_add_noticias").val());
                                    var html = $("#content_add_noticias").val();
                                    // Put this in the hidden field
                                    $("input#html_add_noticias").val(html);
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Aula: <span class="mandatory">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <select data-placeholder="Aula..." class="required select-full" name="fk_aula[]" tabindex="2">
                            <option value=""></option> 
                            ' . $aulas_list . '
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select data-placeholder="Aula..." class="required select-full" name="fk_aula[]" tabindex="2">
                            <option value=""></option> 
                            ' . $aulas_list_1 . '
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select data-placeholder="Aula..." class="required select-full" name="fk_aula[]" tabindex="2">
                            <option value=""></option> 
                            ' . $aulas_list_2 . '
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
           <!--Inside tabs -->
           <div class = "panel panel-default">
               <div class = "panel-heading"><h6 class = "panel-title"><i class = "icon-link"></i> Compartir con...</h6></div>
               <div class = "tabbable">
                   <ul class = "nav nav-tabs toolbar-tabs">
                       <!--<li class="active"><a href = "#table-tab" data-toggle = "tab"><i class = "icon-users"></i> Profesores</a></li>
                       <li class="  "><a href = "#table-tab2" data-toggle = "tab"><i class = "icon-user"></i> Alumnos</a></li>-->
                   </ul>
                   <div class = "tab-content table-tabs">
                       <div class = "tab-pane fade active in" id = "table-tab">
                           <!--Dual selects -->
                           <div class = "panel panel-default">
                               <div class = "panel-body">
                                   <!--Left box -->
                                   <div class = "left-box">
                                       <input type = "text" id = "box1Filter" class = "form-control" placeholder = "Filter entries...">
                                       <button type = "button" id = "box1Clear" class = "filter">x</button>
                                       <select id = "box1View" multiple = "multiple" class = "form-control">
                                           ' . $profesores_list . $personas_list . '
                                       </select>
                                       <span id = "box1Counter" class = "count-label"></span>
                                       <select id = "box1Storage"></select>
                                   </div>
                                   <!--/left-box -->

                                   <!--Control buttons -->
                                   <div class = "dual-control">
                                       <button id = "to2" type = "button" class = "btn btn-default">&nbsp;&gt;&nbsp;</button>
                                       <button id = "allTo2" type = "button" class = "btn btn-default">&nbsp;&gt;&gt;&nbsp;</button>
                                       <br />
                                       <button id = "to1" type = "button" class = "btn btn-default">&nbsp;&lt;&nbsp;</button>
                                       <button id = "allTo1" type = "button" class = "btn btn-default">&nbsp;&lt;&lt;&nbsp;</button>
                                   </div>
                                   <!--/control buttons -->

                                   <!--Right box -->
                                   <div class = "right-box">
                                       <input type = "text" id = "box2Filter" class = "form-control" placeholder = "Filter entries...">
                                       <button type = "button" id = "box2Clear" class = "filter">x</button>
                                       <select id = "box2View" multiple = "multiple" name = "noticias_people[]" class = "form-control">
                                           ' . $profesores_list_in . $personas_list_in . '
                                       </select>
                                       <span id = "box2Counter" class = "count-label"></span>
                                       <select id = "box2Storage"></select>
                                   </div>
                                   <!--/right box -->

                               </div>
                           </div>
                           <!--/dual selects -->
                       </div>
                   </div>
               </div>
           </div>
           <!--/inside tabs -->
        <div class = "form-actions text-right">
            <input type = "submit" onclick="changedata()" value = "Guardar noticia" class = "btn btn-primary">
        </div>
    </form>
    <!--/form striped -->
</div>
<!--/page content -->';
}
