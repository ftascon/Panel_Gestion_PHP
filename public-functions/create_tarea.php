<?php

function get_create_tarea() {
    $profesores = new profesores();
    $servicios = new servicios();
    $servicios_data = $servicios->get_all_servicios();
//    print_r($servicios_data);
    $profesores_data = $profesores->get_simple_profesores();
    $clientes = new alumnos();
    $clientes_data = $clientes->get_all_alumnos();
    $list_servicios = '';
    $list_profesores = '';
    $list_clientes = '';
    for ($i = 0; $i < count($servicios_data); $i++) {
        $list_servicios .= '<option title="' . $servicios_data[$i]["price_servicio"] . '" value="' . $servicios_data[$i]["id_servicio"] . '">' . $servicios_data[$i]["name_servicio"] . '</option>';
    }
    for ($i = 0; $i < count($profesores_data); $i++) {
        $list_profesores .= '<option value="' . $profesores_data[$i]["id_people"] . '">' . $profesores_data[$i]["fname_people"] . " " . $profesores_data[$i]["lname1_people"] . " " . $profesores_data[$i]["lname2_people"] . '</option>';
    }
    for ($i = 0; $i < count($clientes_data); $i++) {
        $list_clientes .= '<option value="' . $clientes_data[$i]["id_people"] . '">' . $clientes_data[$i]["fname_people"] . " " . $clientes_data[$i]["lname1_people"] . " " . $clientes_data[$i]["lname2_people"] . '</option>';
    }
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
    return '<!-- Page content -->
            <div class="page-content">
                <!-- Page header -->
                <div class="page-header">
                    <div class="page-title">
                        <h3>Tareas <small>Crear nueva tarea</small></h3>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Breadcrumbs line -->
                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="' . BASE_URL . '">Home</a></li>
                        <li><a href="' . BASE_URL . '?tareas">Tareas</a></li>
                        <li>nueva tarea</li>
                    </ul>
                </div>
                <!-- /breadcrumbs line -->
                ' . $alert . '
<div class="row">
    <form class="form-horizontal form-separate" action="ajax/add_tarea.php" method="POST" role="form">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h6>Nueva Tarea</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Titulo</label>
                        <div class="col-md-10">
                            <input class="form-control" placeholder="Titulo "  type="text" name="titulo">
                        </div>
                    </div>                        
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Fecha inicio</label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-8">
                                    <input class="form-control" type="date" value="2015-12-12" name="fecha_inicio">
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" type="time" value="12:00" name="hora_inicio">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Fecha fin</label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-8">
                                    <input class="form-control" type="date" value="2016-04-02" name="fecha_fin">
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" value="00:00" type="time" name="hora_fin">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- Separated form outside panel -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Trabajador:</label>
                        <div class="col-md-10">
                            <select data-placeholder="Trabajador..." class="required select-full" id="ctm-country" name="trabajador" tabindex="2">
                                <option value=""></option> 
                                ' . $list_profesores . '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Separated form outside panel -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Cliente</label>
                        <div class="col-md-10">
                            <select data-placeholder="Cliente..." class="required select-full" id="ctm-country" name="cliente" tabindex="2">
                                <option value=""></option> 
                                ' . $list_clientes . '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Lugar</label>
                        <div class="col-md-10">
                            <input class="form-control" placeholder="Lugar relacionado"  type="text" name="lugar">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Direccion</label>
                        <div class="col-md-10">
                            <input class="form-control" placeholder="Direccion"  type="text" name="direccion">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Descuento(€)</label>
                        <div class="col-md-10">
                            <input class="form-control" placeholder="30" id="ctm_descuento_servicio_value" type="number" name="descuento_task">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-1 control-label">Estado</label>
                        <div class="col-md-5">
                            <select data-placeholder="Estado..." class="required select-full" id="ctm-country" name="estado" tabindex="2">
                                <option value=""></option> 
                                <option value="Pagado">Pagado</option> 
                                <option value="Pendiente">Pendiente</option> 
                            </select>
                        </div>
                        <label class="col-md-1 control-label">Facturado </label>
                        <div class="col-md-5">
                            <select data-placeholder="Facturado..." class="required select-full" id="ctm-country" name="facturado" tabindex="2">
                                <option value=""></option> 
                                <option value="Si">Si</option> 
                                <option value="No">No</option> 
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Servicio </label>
                        <div class="col-md-10">
                            <select data-placeholder="Servicio..." class="required select-full" id="ctm-task-service" name="servicio" tabindex="2">
                                <option value=""></option> 
                                ' . $list_servicios . ' 
                            </select>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Prioridad </label>
                        <div class="col-md-10">
                            <select data-placeholder="Prioridad..." class="required select-full" id="ctm-task-priority" name="prioridad" tabindex="2">
                                <option value=""></option> 
                                <option value="1">Alta</option> 
                                <option value="2">Media</option> 
                                <option value="3">Baja</option> 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">                        
                    <div class="form-group">
                        <label class="col-md-2 control-label">Comentario: </label>
                        <div class="col-md-10">
                            <textarea rows="5" cols="5" class="form-control" name="comentario" placeholder="Comentario" style="margin-top: 0px; margin-bottom: 0px; height: 102px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 control-label text-right">Precio 1:</label>
                        <div class="col-sm-9">
                            <h5 class="text-right" id="ctm_precio_servicio" style="border-bottom:1px dashed #ccc" ><span>0</span> €</h5>
                        </div>
                        <label class="col-sm-2 control-label text-right">Precio 2:</label>
                        <div class="col-sm-9">
                            <h5 class="text-right" id="ctm_precio_servicio_dos" style="border-bottom:1px solid #ccc" ><span>0</span> €</h5>
                        </div>
                        <div id="ctm_descuento_box" style="display:none;">
                            <label class="col-sm-2 control-label text-right">Descuento:</label>
                            <div class="col-sm-9">
                                <h5 class="text-right" id="ctm_precio_servicio_descuento" style="border-bottom:1px solid #ccc;" >-<span>0</span> €</h5>
                            </div>
                        </div>
                        <label class="col-sm-2 control-label text-right">Total:</label>
                        <div class="col-sm-9">
                            <h4 class="text-right" id="ctm_precio_servicio_total" style="border-bottom:1px dashed #ccc" ><span>0</span> €</h4>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12 form-actions text-right">
                    <input type="button" value="Actualizar precios" id="actualizar_precios" class="btn btn-default">
                    <input type="submit" value="Guardar tarea" class="btn btn-success">
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<!-- /separated form outside panel -->

</div>
<!-- /page content -->';
}
