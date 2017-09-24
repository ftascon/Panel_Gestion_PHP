<?php

function get_cursos($id_user) {
    $cursos = new cursos();
    $cursos_data = $cursos->get_all_cursos();
    $list_cursos = '';
    for ($i = 0; $i < count($cursos_data); $i++) {
        $address = ($cursos_data[$i]["url_cursos"] == "") ? 'No url' : "<a target='_blank' href='". $cursos_data[$i]["url_cursos"] . "'>URL</a>";
        $list_cursos .= '<tr>
                        <td class="text-semibold">' . $cursos_data[$i]["name_cursos"] . '</td>
                        <td class="curso-pricecom">
                            <span>' . $cursos_data[$i]["precio_eur"] . '</span>
                        </td>
                        <td class="curso-pricecl">
                            <span>' . $cursos_data[$i]["precio_cl"] . '</span>
                        </td>
                        <td class="curso-pricemx">
                            <span>' . $cursos_data[$i]["precio_mx"] . '</span>
                        </td>
                        <td class="text-center">
                            <span>' . $address . '</span>
                        </td>
                    </tr>';
    }
    return '<!-- Page content -->
<div class="page-content">
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Lista de Cursos<small>Lista detallada de cursos</small></h3>
            </div>
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="' . BASE_URL . '">Home</a></li>
                <li><a href="' . BASE_URL . '?lista_cursos">Cursos</a></li>
                <li class="active">Lista de cursos</li>
            </ul>
        </div>
        <!-- /breadcrumbs line -->
        <!-- profesores (table) -->
        <div class="block">
            <div class="datatable-media">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Precio .com</th>
                            <th>Precio .cl</th>
                            <th>Precio .mx</th>
                            <th class="team-links">Links</th>
                        </tr>
                    </thead>
                    <tbody>
                        ' . $list_cursos. '
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /profesores (table) -->
    </div>
</div>
	<!-- /page container -->';
}
