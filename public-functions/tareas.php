<?php

function get_tareas_resumen() {
    /*
     *      3   campos de form
     *      4   campos de database
     *      4   archivos
     *      2   funciones js
     *      combbinar
     *      
     */
    $tareas = new tareas();
    $tareas_data = $tareas->get_all_tareas();

//    print_r($tareas_data);
    $output_activas = '';
    for ($i = 0; $i < count($tareas_data); $i++) {
        $prioridad = "normal";
        $prioridad_t = "normal";
        if ($tareas_data[$i]["prioridad"] == 1) {
            $prioridad = "high";
            $prioridad_t = "Alta";
        } else {
            if ($tareas_data[$i]["prioridad"] == 3) {
                $prioridad = "low";
                $prioridad_t = "baja";
            }
        }
        if ($tareas_data[$i]["estado"] == "Pagado") {
            $state = "default";
        } else {
            $state = "warning";
            $tareas_data[$i]["estado"] = $tareas_data[$i]["estado"] . " de pago";
        }
//        $prioridad;
        $output_activas .= '<div class="col-md-6"><!-- Task -->
                        <div class="block task task-' . $prioridad . '">
                            <div class="row with-padding">
                                <div class="col-sm-9">
                                    <div class="task-description">
                                        <a href="#"> ' . $tareas_data[$i]["titulo"] . '</a>
                                        <i>' . $tareas_data[$i]["lugar"] . '</i>
                                        <span>' . $tareas_data[$i]["comentario"] . '</span>
                                        <strong>' . $tareas_data[$i]["comentario"] . '</strong>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="task-info">
                                        <span>' . get_simple_date($tareas_data[$i]["fecha_inicio"], false, false, "d-m-a") . ' a las ' . $tareas_data[$i]["hora_fin"] . '</span>
                                        <span>' . (get_simple_date($tareas_data[$i]["fecha_inicio"], false, false, "d-m-a") . " " . $tareas_data[$i]["hora_inicio"] . ":00") . ' | <span class="label label-danger">12%</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="with-padding">
                                    <div class="pull-left">
                                        <p>
                                            <a href="#"><i class="icon-user"></i>' . $tareas_data[$i]["trabajador_name"] . " " . $tareas_data[$i]["trabajador_lname1"] . $tareas_data[$i]["trabajador_lname2"] . '</a>
                                            <span class="icon-arrow-right11" style="color:#999"></span>
                                            <a href="#"><i class="icon-right-arrow"></i>' . $tareas_data[$i]["cliente_nombre"] . " " . $tareas_data[$i]["cliente_nombre"] . " " . $tareas_data[$i]["cliente_apellido"] . " " . $tareas_data[$i]["cliente_apellido2"] . '</a>
                                        </p>
                                    </div>
                                    <div  class="pull-right">
                                            <p>Prioridad: ' . $prioridad_t . '</p>
                                    </div>
                                </div>
                                <hr style="margin:0; clear:both" />
                                <div class="pull-left">
                                    <span class="ctm-task-state label label-' . $state . '">' . $tareas_data[$i]["estado"] . '</span>
                                </div>
                                <div class="pull-right">
                                    <ul class="footer-icons-group">
                                        <!--<li><a href="#"><i class="icon-pencil"></i></a></li>-->
                                        <li><a <a data-toggle="modal" data-target="#ctm-rm-aula' . $tareas_data[$i]["id_tareas"] . '" ><i class="icon-remove3"></i></a></li>
                                        <!--<li class="dropup"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-wrench"></i></a>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                                                <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                                                <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                                                <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                                                <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                                            </ul>
                                        </li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                            <div class="modal fade" tabindex="-1" id="ctm-rm-aula' . $tareas_data[$i]["id_tareas"] . '" role="dialog">
                              <div class="modal-dialog modal-sm">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">¿Desea borrar esta tarea?</h4>
                                  </div>
                                  <div class="modal-body">
                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                  <a class="btn btn-danger btn-ok" href="' . BASE_URL . 'ajax/rm_tarea.php?id=' . $tareas_data[$i]["id_tareas"] . '">Delete</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- /task --></div>';
    }
    $n_cerradas = $i;
    return '
    <!-- Page content -->
<div class="page-content">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Tareas <small>Lista de tareas</small></h3>
        </div>
    </div>
    <!-- /page header -->


    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="' . BASE_URL . '">Home</a></li>
            <li>Tareas</li>
        </ul>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Page tabs -->
    <div class="tabbable page-tabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#all-tasks" data-toggle="tab"><i class="icon-paragraph-justify2"></i> All tasks</a></li>
            <!--<li><a href="#active" data-toggle="tab"><i class="icon-stack"></i> Active <span class="label label-danger">' . $n_activas . '</span></a></li>
            <li><a href="#closed" data-toggle="tab"><i class="icon-bubbles3"></i> Closed <span class="label label-success">' . $n_cerradas . '</span></a></li>-->
        </ul>
        <div class="tab-content">
            <div class="tab-pane active fade in" id="all-tasks">
                <!-- Tasks grid -->
                <div class="row">
' . $output_activas . '
                </div>
                <!-- /tasks grid -->
            </div>

            <div class="tab-pane fade" id="active">
                <!-- /tasks grid -->
                <!-- Pagination
                <div class="block text-center">
                    <ul class="pagination">
                        <li><a href="#">&larr;</a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&rarr;</a></li>
                    </ul>
                </div>
                 /pagination -->
            </div>

            <div class="tab-pane fade" id="closed">
                <!-- Tasks grid -->
                <div class="row">
                ' . $output_cerradas . '
                </div>
                <!-- /tasks grid -->
            </div>
        </div>
    </div>
    <!-- /page tabs -->


</div>
<!-- /page content -->';
}
