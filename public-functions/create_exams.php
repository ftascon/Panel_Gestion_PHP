<?php

function get_create_examenes($id = false, $id_aula = false) {
    $date = date("o-m-d");
    $bread_f_name = '';
    $examenes_data = array(
        "f_inicio" => "$date",
        "f_fin" => "$date",
        "url_examen" => "#"
    );
    $bread_item = 'Nuevo exámen';
    $curr = "Añadir";
    $fichero = "add";
    $bread_father = '<a href="' . BASE_URL . '?lista_examenes">Exámenes</a>';
    if ($id) {
        $fichero = "edit";
        $curr = "Editar";
        $examenes = new examenes();
        $examenes_data = $examenes->by_id($id);
//        print_r($examenes_data);
        $bread_item = $examenes_data["nombre_examen"];
//        print_r($examenes_data);
    }
    $aulas = new aulas();
    $aulas_data = $aulas->get_all_aulas();
//    print_r($aulas_data);
    $list_aulas = "";
    $chk = "selected";
    foreach ($aulas_data as $v) {
        $chk = ($examenes_data["fk_aula"] == $v["id_aula"]) ? "selected" : "";
        $chk = ($id_aula == $v["id_aula"]) ? "selected" : $chk;
        $bread_f_name = ($v["id_aula"] == $id_aula) ? $v["nombre_aula"] : $bread_f_name;
        $list_aulas .= '<option value="' . $v["id_aula"] . '" ' . $chk . '>' . ($v["f_inicio"]) . " - " . $v["nombre_aula"] . '</option>';
    }
    if ($id_aula) {
        $display = 'display:none;';
        $bread_father = '<a href="' . BASE_URL . '?aula=' . $id_aula . '">' . $bread_f_name . '</a>';
    }
    return '<!-- Page content -->
<div class="page-content">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> ' . $bread_item . ' <small> ' . $curr . ' Exámen</small></h3>
        </div>
    </div>
    <!-- /page header -->


    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="' . BASE_URL . '">Home</a></li>
            <li>' . $bread_father . '</li>
            <li class="active">' . $bread_item . '</li>
        </ul>
    </div>
    <!-- /breadcrumbs line -->
    <div class="row">
        <div class="col-xs-12">
            <!-- Form bordered -->
            <form class="form-horizontal form-bordered validate" method="POST" action="ajax/' . $fichero . '_exams.php?id=' . $id . '" role="form" novalidate="novalidate">
                <div class="panel panel-default">
                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> Nuevo exámen</h6></div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" name="nombre_examen" class="required form-control" value="' . $examenes_data["nombre_examen"] . '" placeholder="Examen modulos 3,4,5">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label">Fecha inicio</label>
                                <input class="required from-date form-control" type="text" value="' . date_db_format($examenes_data["f_inicio"], true) . '" name="f_inicio">
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Fecha fin</label>
                                <input class="required to-date form-control" type="text" value="' . date_db_format($examenes_data["f_fin"], true) . '" name="f_fin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">URL (opcional)</label>
                            <div class="col-sm-10">
                                <input type="text" name="url_examen" class="form-control" value="' . $examenes_data["url_examen"] . '" placeholder="https://www.classmarker.com/online-test/start/?quiz=d3d56e1b07eb1659">
                            </div>
                        </div>
                        <div class="form-group" style="' . $display . '">
                            <label class="col-md-2 control-label">Aula:</label>
                            <div class="col-md-10">
                                <select data-placeholder="Aula..." class="required select-full" name="fk_aula" tabindex="2">
                                    <option value=""></option> 
                                    ' . $list_aulas . '
                                </select>
                            </div>
                        </div>
                        <div class="form-actions text-right">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>

                    </div>
                </div>
            </form>
            <!-- /form striped -->
        </div>
    </div>
    ' . get_footer() . '
    
</div>
<!-- /page content -->';
}
