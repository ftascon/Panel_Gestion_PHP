<?php

function get_wiki() {
    $rol = $_SESSION["user_data"]["id_rols"];
    $id_user = $_SESSION["user_data"]["id_user"];
    $noticias_list = "";
    $add_noticias = '<div class="ctm-btn-add">
                            <a href="' . BASE_URL . '?nueva_noticia" class="btn btn-default btn-success"><i class="icon-plus"></i></a>
                        </div> ';

    return '<!-- Page content -->
<div class="page-content"> 
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Material<small>Para el uso de las herramientas</small></h3>
            </div>  
        </div>
        <!-- /page header -->

        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
                <ul class="breadcrumb">
                        <li><a href="' . BASE_URL . '">Home</a></li>
                        <li class="active">Material</li>
                </ul>
        </div>
        <!-- /breadcrumbs line -->

        <!-- alumnos (table) -->
        <div class="row">
            <!-- pregunta box indvl -->
            <div class="col-md-4">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-upload"></i> Agregar notas </h6>
                        </div>
                        <ul class="list-group">
                              <li class="list-group-item has-button"><i class="icon-file-pdf"></i><a href="' . BASE_URL . 'docs/agregar_notas.pdf" target="_blank">Ver PDF</a></li>
                              <!--<li class="list-group-item has-button"><i class="icon-play" ></i><a alt="Video" href="https://vimeo.com/158941121" target="_blank">Ver video</a></li>-->
                              <!--<li class="list-group-item has-button"><i class="icon-play" style="color:#999;" ></i><a alt="Video" style="color:#999;" href="https://vimeo.com/158941121" target="_blank">Ver video</a></li>-->
                        </ul>
                </div>
            </div>
            <!-- /pregunta (box) -->
            <!-- pregunta box indvl -->
            <div class="col-md-4">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-upload"></i> Lista de Correos Electrónicos por Aula</h6>
                        </div>
                        <ul class="list-group">
                              <li class="list-group-item has-button"><i class="icon-file-pdf"></i><a href="' . BASE_URL . 'docs/emails_por_aula.pdf" target="_blank">Ver PDF</a></li>
                        </ul>
                </div>
            </div>
            <!--<div class="col-md-4">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-upload"></i> Obtener lista de alumnos en Excel</h6>
                        </div>
                        <ul class="list-group">
                              <li class="list-group-item has-button"><i class="icon-file-pdf"></i><a href="' . BASE_URL . 'docs/csv_to_excel.pdf" target="_blank">Ver PDF</a></li>
                              <li class="list-group-item has-button"><i class="icon-play" style="color:#999;" ></i><a alt="pronto" style="color:#999;" target="_blank">Ver video</a></li>
                        </ul>
                </div>
            </div>-->
            <!-- /pregunta (box) -->
        </div>
        '.  get_footer().'
    </div>
</div>
	<!-- /page container -->';
}
