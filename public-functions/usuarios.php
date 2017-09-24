<?php

function get_usuarios($id_user) {
    $users = new users();
    $users_data = $users->get_all_users();
//    print_r($users_data);
    $users_list = '';
    for ($i = 0; $i < count($users_data); $i++) {
        $profile = ($users_data[$i]["id_people"] == "") ? '<span>No hay perfil asociado al usuario</span>' : '<a href="' . BASE_URL . '?ficha=' . $users_data[$i]["id_people"] . '" title="" class="tip" data-original-title="Ver ficha"><i class="icon-link"></i></a>';
        $users_list .= '<tr>
                        <td class="text-semibold">' . $users_data[$i]["username"] . '</td>
                        <td class="file-info">
                            <span>' . $users_data[$i]["rol"] . '</span>
                        </td>
                        <td class="text-center">
                            <div class="icons-group">
                                ' . $profile . '
                            </div>
                        </td>
                    </tr>';
    }

    return '<!-- Page content -->
<div class="page-content">
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Usuarios<small>Lista de usuarios del sistema</small></h3>
            </div>
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                    <li><a href="' . BASE_URL . '">Home</a></li>
                    <li><a href="' . BASE_URL . '?usuarios">Usuarios</a></li>
                    <li class="active">Lista de usuarios</li>
            </ul>
        </div>
        <!-- /breadcrumbs line -->
        <!-- alumnos (table) -->
        <div class="block">
            <h6 class="heading-hr"><i class="icon-people"></i>Lista de usuarios</h6>
            <div class="datatable-media">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre de usuario</th> 
                            <th>Rol de sistema</th>
                            <th class="team-links">Perfil</th>
                        </tr>
                    </thead>
                    <tbody>
                        ' . $users_list . '
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /alumnos (table) -->
    </div>
</div>
	<!-- /page container -->';
}
