<?php


function get_create_edicion($data = false) {

    $alert = "";

    if (isset($_GET["ok"])) {

        $alert = '<div class="callout callout-success fade in">

				<button type="button" class="close" data-dismiss="alert">×</button>

				<h5>Operación exitosa</h5>

				

			</div>';
    } else {


        if (isset($_GET["ko"])) {

            $alert = '<div class="callout callout-warning fade in">

				<button type="button" class="close" data-dismiss="alert">×</button>

				<h5>La edicion que intenta crear ya existe, intentalo de nuevo con otros datos </h5>

				

			</div>';
        }
    }

    $title = "Crear nueva Edicion";

    $bread = "Nueva Edicion";

    $action = "ajax/add_edicion.php";

    if ($data) {

        $title = "Editar Edicion";

        $bread = $title;

        $servicios = new ediciones();

        $action = "ajax/edit_edicion.php?id=$data";

        $data = $servicios->get_edicion_by_id($data);

//        print_r($data);
    }

    $dates_editions = getYearsMonths();
//    print_r($dates_editions['A']);
    $output_years_services = '';
    $chk = "";
    $unic = false;
    foreach ($dates_editions['A'] as $k => $v) {
        if ((($v == $data['anio_init']) || ($v == ((int) date('Y')))) && ($unic == false)) {
            $chk = "selected";
            $unic = true;
        } else {
            $chk = "";
        }
        $output_years_services .= '<option value="' . ($v) . '" ' . $chk . '>' . $v . '</option> ';
    }

    $output_months_services = '';
    $chk = "";
    $unic = false;
    foreach ($dates_editions['M'] as $k => $v) {
        if (((((int) $k + 1) == ((int) $data["mes_init"])) || (((int) $k + 1) == ((int) date('m')))) && ($unic == false)) {
            $chk = "selected";
            $unic = true;
        } else {
            $chk = "";
        }
        $output_months_services .= '<option value="' . ($k + 1) . '" ' . $chk . '>' . strtoupper($v) . '</option> ';
    }

    $services = new servicios();

    $data_services = $services->get_all_servicios();

//    print_r($data_services);

    $output_type_services = '';

    $chk = "";

    foreach ($data_services as $k => $v) {

//        print_r($v);

        if ($v["id_servicio"] == $data["fk_servicio"]) {

            $chk = "selected";
        } else {

            $chk = "";
        }

        $output_type_services .= '<option value="' . $v["id_servicio"] . '" ' . $chk . '>' . $v["name_servicio"] . '</option> ';
    }


    return '<!-- Page content -->

            <div class="page-content">





                <!-- Page header -->

                <div class="page-header">

                    <div class="page-title">

                        <h3>Ediciones<small>' . $title . '</small></h3>

                    </div>

                </div>

                <!-- /page header -->





                <!-- Breadcrumbs line -->

                <div class="breadcrumb-line">

                    <ul class="breadcrumb">

                        <li><a href="' . BASE_URL . '">Home</a></li>

                        <li><a href="' . BASE_URL . '?ediciones">Ediciones</a></li>

                        <li>' . $bread . '</li>

                    </ul>

                </div>

                <!-- /breadcrumbs line -->

                ' . $alert . '

                <div class="row">

                    <form class="form-horizontal form-separate validate" action="' . $action . '" method="POST" role="form">

                        <div class="col-md-12">

                            <h6>Nueva Edicion</h6>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">

                                <label class="col-md-3 control-label" >Servicio: <span class="mandatory">*</span></label>

                                <div class="col-md-9">

                                    <select data-placeholder="Tipo..." class="required select-full" name="fk_servicio" tabindex="2">

                                        ' . $output_type_services . '

                                    </select>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-7">

                            <div class="form-group">

                                <label class="col-md-3 control-label" >Fecha de Inicio <span class="mandatory">*</span></label>

                                <div class="col-md-4">

                                    <select data-placeholder="Mes" class="required select-full" name="mes_init" tabindex="2">

                                        ' . $output_months_services . '

                                    </select>

                                </div>
                                <div class="col-md-5">

                                    <select data-placeholder="año" class="required select-full" name="anio_init" tabindex="2">

                                        ' . $output_years_services . '

                                    </select>

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
