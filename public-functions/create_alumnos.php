<?php


function get_new_alumnos($id_user) {

    $countries = new countries();

    $countries_data = $countries->get_all_countries();

    $countries_list = '';

    for ($i = 0; $i < count($countries_data); $i++) {

        $countries_list .= '<option value="' . $countries_data[$i]["id_country"] . '">' . $countries_data[$i]["name_country"] . '</option> ';

    }

    if ($id_user) {

        $servicios = new servicios();

        $servicios_alumnos = new alumnos_servicios();

        $servicios_data = $servicios->get_all_servicios();

        $servicios_list = '';

        $servicios_actual = $servicios_alumnos->get_service_by_alumno($id_user);

//        print_r();

        $chk = '';

        for ($i = 0; $i < count($servicios_data); $i++) {

            $chk = ($servicios_actual["fk_servicio"] == $servicios_data[$i]["id_servicio"] ) ? "selected" : "";

            $servicios_list .= '<option value="' . $servicios_data[$i]["id_servicio"] . '" ' . $chk . '>' . $servicios_data[$i]["name_servicio"] . '</option> ';

        }

        $people = new people();

        $alumno_data = $people->get_profile($id_user);

        $alumno_data["full_name"] = $alumno_data["fname_people"] . " " . $alumno_data["lname1_people"] . " " . $alumno_data["lname2_people"];



        return '<!-- Page content -->

<div class="page-content">





    <!-- Page header -->

    <div class="page-header">

        <div class="page-title">

            <h3>Editar perfil<small>Información general del perfil</small></h3>

        </div>

    </div>

    <!-- /page header -->

    

        <!-- Profile information -->

    <div class="row">

        <form action="ajax/edit_alumnos.php?id=' . $alumno_data["id_people"] . '" method="POST" class="block" role="form">

        <div class="panel panel-default">

            <div class="panel-body">

                <div class="block-inner">

                  <h6 class="heading-hr"><i class="icon-user"></i> Información personal: </h6>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-4">

                                <label>Nombre</label>

                                <input type="text" name="fname_people" value="' . $alumno_data["fname_people"] . '" class="form-control">

                            </div>

                            <div class="col-md-4">

                                <label>Primer apeliido</label>

                                <input type="text" name="lname1_people" value="' . $alumno_data["lname1_people"] . '" class="form-control">

                            </div>

                            <div class="col-md-4">

                                <label>Segundo apeliido</label>

                                <input type="text" name="lname2_people" value="' . $alumno_data["lname2_people"] . '" class="form-control">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-4">

                                <label>Fecha de Nacimiento</label>

                                <input type="date" name="f_nacimiento" value="' . $alumno_data["f_nacimiento"] . '" class="form-control">

                            </div>

                            <div class="col-md-8">

                                <label>Nacionalidad</label>

                                <select data-placeholder="Choose a Country..." name="nacionalidad" class="select-full" tabindex="2">

                                    <option value=""></option> 

                                    ' . $countries_list . '

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <h6 class="heading-hr"><i class="icon-user"></i> Información de Contacto: </h6>

                <div class="block-inner">

                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-6">

                                <label>Pais de residencia:</label>

                                <select data-placeholder="Choose a Country..." name="fk_reside_people" class="select-full" tabindex="2">

                                    <option value=""></option> 

                                    ' . $countries_list . '

                                </select>

                            </div>

                            <div class="col-md-6">

                                <label>Ciudad</label>

                                <input type="text" name="fk_city_people" value="' . $alumno_data["fk_city_people"] . '" class="form-control">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-8">

                                <label>Dirección</label>

                                <input type="text" name="address_people" value="' . $alumno_data["address_people"] . '" class="form-control">

                            </div>

                            <div class="col-md-4">

                                <label>Codigo Postal</label>

                                <input type="text" name="postal_code" value="' . $alumno_data["postal_code"] . '" class="form-control">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-6">

                                <label>Email principal</label>

                                <input type="text" readonly="readonly" value="' . $alumno_data["email_people"] . '" class="form-control">

                            </div>

                            <div class="col-md-6">

                                <label>Email secundario</label>

                                <input type="text" name="email_people2" value="' . $alumno_data["email_people2"] . '" class="form-control">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-4">

                                <label>Telefono principal</label>

                                <input type="text" name="phone_people" value="' . $alumno_data["phone_people"] . '" class="form-control">

                                       <span class="help-block">+99-99-9999-9999</span>

                            </div>

                            <div class="col-md-4">

                                <label>Telefono secundario</label>

                                <input type="text" name="phone_people2" value="' . $alumno_data["phone_people2"] . '" class="form-control">

                                       <span class="help-block">+99-99-9999-9999</span>

                            </div>

                            <div class="col-md-4">

                                <label>Preferencia de Idioma</label>

                                <select data-placeholder="Idioma de preferencia..." name="fk_country_people" class="select-full" tabindex="2">

                                    <option value=""></option> 

                                    ' . $countries_list . '

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <h6 class="heading-hr"><i class="icon-user"></i> General: </h6>

                <div class="block-inner">

                    <div class="form-group">

                        <div class="row">

                            <div class="col-xs-12">

                                <label>Servicio</label>

                                <select data-placeholder="Servicio Contratado..." name="fk_servicio" class="select-full" tabindex="2">

                                    <option value=""></option> 

                                    ' . $servicios_list . '

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-xs-12">

                                <label>Información para el profesor</label>

                                <textarea rows="5" cols="5" name="comment_people" placeholder="Información para el profesor..." class="elastic form-control">' . $alumno_data["comment_people"] . '</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="text-right">

                    <input type="submit" value="Guardar los cambios" class="btn btn-success">

                </div>



            <!-- /profile information -->

            </div>

        </div>

        </form>

        <form action="ajax/chpasswd.php?id=' . $alumno_data["id_people"] . '" method="POST" class="block validate" role="form" novalidate="novalidate">    

             <div class="panel panel-default">

            <div class="panel-body">

                <div class="block-inner">

                        <div class="row">

                            <div class="form-group">

                            <div class="col-md-4">

                                 <h6 class="heading-hr"><i class="icon-cogs"></i> Reset password: </h6>

                                 <h5>' . $alumno_data["fname_people"] . " " . $alumno_data["lname1_people"] . " " . $alumno_data["lname2_people"] . '</<h5>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Contraseña<span class="mandatory">*</span>:</label>

                                    <input type="password" placeholder="Your password" name="password_users" class="required form-control">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Repetir contraseña:</label>

                                    <input type="password" placeholder="Repeat password" name="password_users" class="required form-control">

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="text-right">

                        <input type="submit" value="Guardar los cambios" class="btn btn-success">

                    </div>

                </div>

            </div>

        </form>

    </div>

    ' . get_footer() . '

</div>

    ';

    } else {





        $cursos_list = '';

        $services_e = new servicios();

        $services_data = $services_e->get_services_by_type("educativo");

//    print_r($services_data);

        $mitad = round(count($services_data) / 2, 0);

        $intereses_list = '<div class="col-md-6">';

        $i = 0;

        foreach ($services_data as $k => $v) {

            $services_list .= '<option value="' . $v["id_servicio"] . '">' . $v["name_servicio"] . '</option> ';

            if ($i == $mitad) {

                $intereses_list .= '</div><div class="col-md-6">';

            }

            $intereses_list .= '<div class="checkbox">

                                <label>

                                    <div class="checker">

                                        <span class="">

                                            <input type="checkbox" name="intereses[]" value="' . $v["id_services"] . '" class="styled">

                                        </span>

                                    </div>

                                    ' . $v["name_servicio"] . '

                                </label>

                            </div>';

            $i++;

        }

        $intereses_list .= '</div>';

//    print_r($countries_data);

        $alert = "";

        if (isset($_GET["ok"])) {

            $alert = '<div class="callout callout-success fade in">

				<button type="button" class="close" data-dismiss="alert">×</button>

				<h5>Operación exitosa</h5>

				

			</div>';

        }

        return

                '<!-- Page content -->

<div class="page-content">





    <!-- Page header -->

    <div class="page-header">

        <div class="page-title">

            <h3>Nuevo alumno<small>Añadir nuevo alumno</small></h3>

        </div>

    </div>

    <!-- /page header -->





    <!-- Breadcrumbs line -->

    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="' . BASE_URL . '">Home</a></li>

            <li><a href="' . BASE_URL . '?lista_alumnos">Alumnos</a></li>

            <li class="active">Nuevo alumno</li>

        </ul>



        <div class="visible-xs breadcrumb-toggle">

            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>

        </div>

    </div>

    <!-- /breadcrumbs line -->

    ' . $alert . '

    <!-- Add users form -->

    <div class="row">

        <form class="validate" action="ajax/add_alumno.php" method="POST" role="form">

            <div class="panel panel-default">



                <div class="panel-body">

                <div class="block-inner">

                            <h6 class="heading-hr">

                                    <i class="icon-pencil"></i>Datos del alumno <small class="display-block">Campos Obligatorios</small>

                            </h6>

                    </div>



                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-4">

                                <label>Nombre: <span class="mandatory">*</span></label>

                                <input type="text" name="fname_people" placeholder="Eugene" class="required form-control">

                            </div>

                            <div class="col-md-4">

                                <label>Primer apellido: <span class="mandatory">*</span></label>

                                <input type="text" name="lname1_people" placeholder="Goldsmith" class="required form-control">

                            </div>

                            <div class="col-md-4">

                                <label>Segundo apellido: </label>

                                <input type="text" name="lname2_people" placeholder="Novator" class="form-control">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-4">

                                <label>Email: <span class="mandatory">*</span></label>

                                <input type="text" name="email_people" placeholder="your@email.com" class="required form-control">

                            </div>

                            <div class="col-md-4">

                                <label>Servicio <span class="mandatory">*</span></label>

                                <select data-placeholder="Seleccionar Servicio..." class="required select-full" name="fk_servicio" tabindex="2">

                                    <option value=""></option> 

                                    ' . $services_list . '

                                </select>

                            </div>



                            <div class="col-md-4">

                                <label>Phone #:</label>

                                <input type="text" name="phone_people" placeholder="+999-99-99-99" class="form-control">

                            </div>

                        </div>

                    </div>

                    <!--<div class="form-group">

                        <div class="row">                                

                            <div class="col-md-12">

                                <label>Intereses:</label>

                            </div>

                            ' . $intereses_list . '

                        </div>

                    </div>-->

                    <div class="block-inner">

                            <h6 class="heading-hr">

                                    <i class="icon-cogs"></i>Usuario de Sistema: <small class="display-block">Campos Obligatorios</small>

                            </h6>

                    </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Usuario<span class="mandatory">*</span>:</label>

                                    <input type="text" placeholder="example@email.com" name="username_users" class="required form-control">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Contraseña<span class="mandatory">*</span>:</label>

                                    <input type="password" placeholder="Your password" name="password_users" class="required form-control">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Repetir contraseña:</label>

                                    <input type="password" placeholder="Repeat password" name="password_users" class="required form-control">

                                </div>

                            </div>

                        </div>



                        <div class="form-actions text-right">

                            <input type="submit" value="Guardar usuario" class="btn btn-success">

                        </div>

                    </div>

            <!-- /simple registration form -->

                </div>

        </form>

    </div>

    <!-- /Add users form -->

    ' . get_footer() . '

</div>

<!-- /page content -->';

    }

}

