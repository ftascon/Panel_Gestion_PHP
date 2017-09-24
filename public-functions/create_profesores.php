<?php

function get_new_profesores($id_user) {
    $countries = new countries();
    $countries_data = $countries->get_all_countries();
    $cursos_list = '';
//    print_r($countries_data);
    $countries_list = '';
    for ($i = 0; $i < count($countries_data); $i++) {
        $countries_list .= '<option value="' . $countries_data[$i]["id_country"] . '">' . $countries_data[$i]["name_country"] . '</option> ';
    }
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
            <h3>Nuevo profesor<small>Añadir nuevo profesor</small></h3>
        </div>
    </div>
    <!-- /page header -->


    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="forms.html">Profesores</a></li>
            <li class="active">Nuevo Profesor</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->
    ' . $alert . '
    <!-- Add users form -->
    <form class="validate" action="ajax/add_profesores.php" method="POST" role="form">
        <div class="panel panel-default">
            
            <div class="panel-body">
            <div class="block-inner">
                        <h6 class="heading-hr">
                                <i class="icon-pencil"></i>Datos del profesor <small class="display-block">Campos Obligatorios</small>
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
                            <label>Phone #:</label>
                            <input type="text" name="phone_people" placeholder="+999-99-99-99" class="form-control">
                        </div>
                    </div>
                </div>
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
    </form>
    <!-- /Add users form -->
</div>
<!-- /page content -->';
}
