<?php

function get_create_servicio($data = false) {

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

    $title = "Crear nuevo servicio";

    $bread = "Nuevo servicio";

    $action = "ajax/add_servicio.php";

    if ($data) {

        $title = "Editar servicio";

        $bread = $title;

        $servicios = new servicios();

        $action = "ajax/edit_servicio.php?id=$data";

        $data = $servicios->get_services_by_id($data);

//        print_r($data);
    }

    $dates_editions = getYearsMonths();

    $output_years_services = '';
    $chk = "";
    foreach ($dates_editions['A'] as $k => $v) {
        if ($v == ($data['anio_init'] || ((int) date('Y')))) {
            $chk = "selected";
        } else {
            $chk = "";
        }
        $output_years_services .= '<option value="' . ($k + 1) . '" ' . $chk . '>' . $v . '</option> ';
    }

    $output_months_services = '';
    $chk = "";
    foreach ($dates_editions['M'] as $k => $v) {
        if ((((int) $k + 1) == ((int) $data["mes_init"])) || (((int) $k + 1) == ((int) date('m')))) {
            $chk = "selected";
        } else {
            $chk = "";
        }
        $output_months_services .= '<option value="' . ($k + 1) . '" ' . $chk . '>' . $v . '</option> ';
    }

    $t_services = new type_services();

    $type_services = $t_services->get_all();

//    print_r($type_services);

    $output_type_services = '';

    $chk = "";

    foreach ($type_services as $k => $v) {

//        print_r($v);

        if ($v["id_type_services"] == $data["id_type_services"]) {

            $chk = "selected";
        } else {

            $chk = "";
        }

        $output_type_services .= '<option value="' . $v["id_type_services"] . '" ' . $chk . '>' . $v["name"] . '</option> ';
    }

    $precio_2 = ($data["price_servicio2"] == "") ? 0 : $data["price_servicio2"];

    return '<!-- Page content -->

            <div class="page-content">





                <!-- Page header -->

                <div class="page-header">

                    <div class="page-title">

                        <h3>Servicio <small>' . $title . '</small></h3>

                    </div>

                </div>

                <!-- /page header -->





                <!-- Breadcrumbs line -->

                <div class="breadcrumb-line">

                    <ul class="breadcrumb">

                        <li><a href="' . BASE_URL . '">Home</a></li>

                        <li><a href="' . BASE_URL . '?servicios">Servicio</a></li>

                        <li>' . $bread . '</li>

                    </ul>

                </div>

                <!-- /breadcrumbs line -->

                ' . $alert . '

                <div class="row">

                    <form class="form-horizontal form-separate validate" action="' . $action . '" method="POST" role="form">

                        <div class="col-md-12">

                            <h6>Nuevo servicio</h6>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="col-md-2 control-label">Nombre</label>

                                <div class="col-md-10">

                                    <input class="form-control required" placeholder="Nombre" autofocus value="' . $data["name_servicio"] . '" type="text" name="nombre_servicio">

                                </div>

                            </div>                        

                            <!-- Separated form outside panel -->

                            <div class="form-group">

                                <label class="col-md-2 control-label">Primer Precio(€)</label>

                                <div class="col-md-10">

                                    <input class="form-control" placeholder="20" value="' . $data["price_servicio"] . '" type="number" name="precio_servicio">

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-md-2 control-label">Segundo Precio(€)</label>

                                <div class="col-md-10">

                                    <input class="form-control" placeholder="20" value="' . $precio_2 . '" type="number" name="precio_servicio2">

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="col-md-3 control-label" >Tipo de servicio: <span class="mandatory">*</span></label>

                                <div class="col-md-9">

                                    <select data-placeholder="Tipo..." class="required select-full" name="fk_type_services" tabindex="2">

                                        ' . $output_type_services . '

                                    </select>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="col-md-3 control-label" >Edición <span class="mandatory">*</span></label>

                                <div class="col-md-4">

                                    <select data-placeholder="Mes" class="required select-full" name="fk_type_services" tabindex="2">

                                        ' . $output_months_services . '

                                    </select>

                                </div>
                                <div class="col-md-5">

                                    <select data-placeholder="año" class="required select-full" name="fk_type_services" tabindex="2">

                                        ' . $output_years_services . '

                                    </select>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-md-2 control-label">Descripcion: </label> 

                                <div class="col-md-10">

                                    <textarea rows="5" cols="5" class="form-control" name="descripcion_servicio" placeholder="Descripcion del servicio..." style="margin-top: 0px; margin-bottom: 0px; height: 102px;">' . $data["descripcion_servicio"] . '</textarea>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12 form-actions text-right">

                            <input type="submit" value="Guardar tarea" class="btn btn-success">

                        </div>



                    </form>

                </div>

            </div>

            <!-- /separated form outside panel -->



        </div>

        <!-- /page content -->';
}
