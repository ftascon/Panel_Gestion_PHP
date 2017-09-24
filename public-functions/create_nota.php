<?php


function get_create_nota($id = false, $id_nota = false) {

    $aula = new aulas();

    $data_aula = $aula->get_aula_by_id($id);

    $nota_data = array();

    $file = 'add';

    if ($id_nota) {

        $notas = new aulas_notas();

        $nota_data = $notas->get_nota_by_id($id_nota);

//        print_r($nota_data);

        $file = 'edit';

    }

    return '<!-- Page content -->

<div class="page-content">

    <!-- Page header -->

    <div class="page-header">

        <div class="page-title">

            <h3>Nueva nota para ' . $data_aula["nombre_aula"] . '<small> Añadir calificación al aula</small></h3>

        </div>

    </div>

    <!-- /page header -->





    <!-- Breadcrumbs line -->

    <div class="breadcrumb-line">

        <ul class="breadcrumb">

            <li><a href="' . BASE_URL . '">Home</a></li>

            <li><a href="' . BASE_URL . '?aula=' . $id . '">' . $data_aula["nombre_aula"] . '</a></li>

            <li><a href="' . BASE_URL . '?lista_notas=' . $id . '">Notas</a></li>

            <li class="active">Nueva nota</li>

        </ul>

    </div>

    <!-- /breadcrumbs line -->



    <!-- Form bordered -->

    <form class="form-horizontal form-bordered" method="POST" action="ajax/' . $file . '_nota.php?fk_aula=' . $id . '" role="form">

        <div class="panel panel-default">

            <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> Nueva nota</h6></div>

            <div class="panel-body">

                <div class="form-group">

                    <label class="col-sm-2 control-label">Titulo:</label>

                    <div class="col-sm-10">

                        <input type="text" name="title_aulas_notas" class="form-control" value="' . $nota_data["title_aulas_notas"] . '" placeholder="Segunda evaluación general">

                        <input type="text" name="id_nota" class="hidden form-control" value="' . $id_nota . '" >

                    </div>

                </div>

                <div class="form-group">

                    <label class="col-sm-2 control-label">Descripción:</label>

                    <div class="col-sm-10">

                        <textarea name="coment_aulas_notas" rows="5" cols="5" class="form-control" placeholder="Nota del trabajo complementario de la segunda evaluacón" >' . $nota_data["coment_aulas_notas"] . '</textarea>

                    </div>

                </div>

                <div class="form-actions text-right">

                    <input type="submit" value="Guardar nota" class="btn btn-primary">

                </div>



            </div>

        </div>

    </form>

    <!-- /form striped -->

</div>

<!-- /page content -->';

}

