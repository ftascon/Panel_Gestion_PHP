<?php

function get_create_calendars($id_user) {

    return '<!-- Page content -->
<div class="page-content">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> Crear calendario <small></small></h3>
        </div>
    </div>
    <!-- /page header -->


    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="' . BASE_URL . '">Home</a></li>
            <li><a href="' . BASE_URL . '?lista_calendars">Calendarios</a></li>
            <li class="active">Nuevo</li>
        </ul>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Form bordered -->
    <form class="form-horizontal form-bordered" method="POST" action="ajax/add_calendar.php" role="form">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> Nueva nota</h6></div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre:</label>
                    <div class="col-sm-10">
                        <input type="text" name="nombre" class="form-control" value="" placeholder="Calendario previo Edicion Marzo - 2019">
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
