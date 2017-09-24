<?php

function get_create_vico($id=false, $id_aula=false) {
    $date = date("o-m-d");
    $vicos_data = array("fecha_vico" => "$date", "hora_vico" => "17:00");
    $bread_item = 'Nueva Videoconferencia';
    $curr = "Añadir";
    $fichero = "add";
    if ($id) {
        $fichero = "edit";
        $curr = "Editar";
        $vicos = new vicos();
        $vicos_data = $vicos->get_vico_by_id($id);
//        print_r($vicos_data);
        $bread_item = $vicos_data["nombre_vico"];
    }
    $aulas = new aulas();
    $aulas_data = $aulas->get_all_aulas();
//    print_r($aulas_data);
    $list_aulas = "";
    $chk = "selected";
    foreach ($aulas_data as $v) {
//        echo $vicos_data["id_vico"] ."==". $v["id_aula"] . "\n <br>";
        $chk = ($vicos_data["fk_aula"] == $v["id_aula"]) ? "selected" : "";
        $chk = ($id_aula == $v["id_aula"]) ? "selected" : $chk;
        $list_aulas .= '<option value="' . $v["id_aula"] . '" ' . $chk . '>' . ($v["f_inicio"]) . " - " . $v["nombre_modulo"] . '</option>';
    }
    return '<!-- Page content -->
<div class="page-content">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> ' . $bread_item . ' <small> ' . $curr . ' Videoconferencia</small></h3>
        </div>
    </div>
    <!-- /page header -->


    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="' . BASE_URL . '">Home</a></li>
            <li><a href="' . BASE_URL . '?lista_vicos">Videoconferencias</a></li>
            <li class="active">' . $bread_item . '</li>
        </ul>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Form bordered -->
    <form class="form-horizontal form-bordered" method="POST" action="ajax/' . $fichero . '_vico.php?id=' . $id . '" role="form">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> Nueva nota</h6></div>
            <div class="panel-body">
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre:</label>
                    <div class="col-sm-10">
                        <input type="text" name="nombre_vico" class="form-control" value="' . $vicos_data["nombre_vico"] . '" placeholder="Tercera Viceoconferencia">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Fecha</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" value="' . $vicos_data["fecha_vico"] . '" name="fecha_vico">
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" type="time" value="' . $vicos_data["hora_vico"] . '" name="hora_vico">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">URL</label>
                    <div class="col-sm-10">
                        <input type="text" name="url_vico" class="form-control" value="' . $vicos_data["url_vico"] . '" placeholder="https://gestorenergetico.clickwebinar.com/session4">
                    </div>
                </div>
                <div class="form-group">
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
<!-- /page content -->';
}
