<?php

function get_registrer_form() {
    $rols = new rols();
    $rols_data = $rols->get_all_rols();
//    print_r($rols_data);
    $rols_list = "";
    for ($i = 0; $i < count($rols_data); $i++) {
        $rols_list .= "<option value='" . $rols_data[$i]["id_rols"] . "'>" . $rols_data[$i]["name_rols"] . "</option>";
    }
    $alert = "";
    if (isset($_GET["ok"])) {
        $alert = '<div class="callout callout-success fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h5>Usuario creado correctamente</h5>
				
			</div>';
    } else {
        if (isset($_GET["ko"])) {
            $alert = '<div class="callout callout-danger fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h5>Usuario existente</h5>
				
			</div>';
        }
    }
    return ' <!-- Page content -->
            <div class="page-content">


                <!-- Page header -->
                <div class="page-header">
                    <div class="page-title">
                        <h3>Nuevo Usuario<small>Crear usuario</small></h3>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Breadcrumbs line -->
                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="' . BASE_URL . '">Home</a></li>
                        <li><a href="forms.html">Usuarios</a></li>
                        <li class="active">Nuevo usuario</li>
                    </ul>

                    <div class="visible-xs breadcrumb-toggle">
                        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
                    </div>
                </div>
                <!-- /breadcrumbs line -->
                ' . $alert . '
                <!-- Simple registration form -->
                <form class="validate" action="ajax/add_usuarios.php" method="POST" role="form" novalidate="novalidate">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Nuevo Usuario</h6></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usuario<span class="mandatory">*</span>:</label>
                                        <input type="text" placeholder="example@email.com" name="username_users" class="required form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Contraseña<span class="mandatory">*</span>:</label>
                                        <input type="password" placeholder="Your password" name="password_users" class="required form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rol:</label>
                                        <select data-placeholder="Elige un rol..." name="rols" class="select-full" tabindex="2">
                                            <option value=""></option>
                                            ' . $rols_list . '
                                        </select>
                                    </div>
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
                    </div>
                </form>
                <!-- /simple registration form -->

            </div>
            <!-- /page content -->';
}
