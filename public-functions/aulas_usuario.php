<?php



function get_aulas_usuario($id_user) {

    $aulas = new aulas_alumnos();

    $alert = '';

    if (($id_user == '') || ($id_user == NULL)) {

        $id_user = $_SESSION['user_data']['id_user'];

        $user_data = $_SESSION['user_data'];

        $aulas_data = $aulas->get_all();

    } else {

        $user = new people();

        $user_data = $user->get_info_by_id($id_user);

        $aulas_data = $aulas->get_aulas_by_alumno($id_user);

//        print_r($aulas_data);

    }



    if (isset($_GET["ok"])) {

        $alert = '<div class="callout callout-success fade in">

				<button type="button" class="close" data-dismiss="alert">×</button>

				<h5>Operación exitosa</h5>

				

			</div>';

    }



    if (is_array($aulas_data)) {

        foreach ($aulas_data as $v) {

//            print_r($v);

            $v['imagen_aula'] = get_image_aula($v['imagen_aula'], true);

            $list_alumnos .= '<tr id="aula_alumno_' . $v["fk_aula"] . '">

                        <td class="text-center">

                            <a href="' . $v['imagen_aula']['normal'] . '" class="lightbox"><img src="' . $v['imagen_aula']['thumb'] . '" alt="" class="img-media"></a>

                        </td>

                        <td class="text-semibold">

                            <a href="' . BASE_URL . '?aula=' . $v["id_aula"] . '">

                                ' . $v["nombre_aula"] . ' 

                            </a>

                        </td>

                        <td class="text-center">

                            <div class="form-group">

                                <input type="text" name="user[' . $v["id_aula"] . ']" class="col-sm-12" value="' . $v["user"] . '" />

                            </div>

                        </td>

                        <td class="text-center">

                            <div class="form-group" style="margin-bottom:0px;">

                                <input type="text" name="password[' . $v["id_aula"] . ']" class="col-sm-12" value="' . $v["password"] . '" />

                            </div>

                        </td>

                        <td class="text-center">

                            <div class="form-actions text-center">

                                <input type="submit" value="Guardar" class="btn btn-info">

                            </div>

                        </td>

                    </tr>';

        }

    }



    return '<!-- Page content -->

<div class="page-content">

    <div class="page-content-inner">

        <!-- Page header -->

        <div class="page-header">

            <div class="page-title">

                <h3> Accesos ' . $user_data["full_name"] . ' <small>Usuarios y contraseñas de las aulas virtuales</small></h3>

            </div>

        </div>

        <!-- /page header -->

        <!-- Breadcrumbs line -->

        <div class="breadcrumb-line">

            <ul class="breadcrumb">

                <li><a href="' . BASE_URL . '">Home</a></li>

                <li><a href="' . BASE_URL . '?ficha=' . $id_user . '">' . $user_data["full_name"] . '</a></li>

                <li class="active">Accesos</li>

            </ul>

        </div>

        <!-- /breadcrumbs line -->

        ' . $alert . '

        <div class="row">

            <div class="col-sm-12">

                <!-- profesores (table) -->

                <form class="" action="ajax/edit_aulas_usuarios.php?id_user=' . $id_user . '" method="POST" role="form">

                    <div class="block">

                    

                        <div class="datatable-media">

                            <table class="table table-bordered table-striped">

                                <thead>

                                    <tr>

                                        <th style="width:100px" class="image-column text-center">Imagen</th>

                                        <th >Aula</th>

                                        <th style="min-width:70px;max-width:200px;width: 100px;text-align: center;">Usuario</th>

                                        <th style="min-width:70px;max-width:200px;width: 100px;text-align: center;">Contraseña</th>

                                        <th style="width:170px" class="text-center">Guardado individual</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    ' . $list_alumnos . '

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <div class="form-actions text-right">

                        <input type="submit" value="Guardar todo" class="btn btn-success">

                    </div>

                </form>

                <!-- /profesores (table) -->

            </div>

            <div class="col-sm-2">

            </div>

        </div>

    </div>

</div>

	<!-- /page container -->';

}

