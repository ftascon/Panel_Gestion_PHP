<?php

function get_single_noticias($id) {
    $noticias_aulas = new noticias_people();
    $noticias_people = new noticias_aulas();
    $noticias = new noticias();
    $rol = $_SESSION["user_data"]["id_rols"];
    $id_user = $_SESSION["user_data"]["id_user"];
    if ($noticias->check_visible($id_user, $id) || ($rol == (10))) {
        if ($rol == (10)) {
            $noticias_user = $noticias->get_all_simple();
        } else {
            $noticias_user = $noticias->get_by_people($id_user);
        }
        $list_noticias = "";
//        print_r($noticias_user);
        for ($i = 0; $i < count($noticias_user); $i++) {
            $list_noticias .= "<a href='" . BASE_URL . "?noticia=" . $noticias_user[$i]["id_noticias"] . "' class='list-group-item'> <small style='font-style:italic;font-size:12px; display:block; text-align:right;'>" . get_date_format($noticias_user[$i]["fecha_noticias"], "lista_noticias", "/") . " a las " . $noticias_user[$i]["hora_noticias"] . "</small> " . substr($noticias_user[$i]["titulo_noticias"], 0, 20) . "</a>";
        }
        $noticias_data = $noticias->get_by_id($id);
//    print_r($noticias_data);
        return '<!--Page content -->
<div class = "page-content">
    <!--Page header -->
    <div class = "page-header">
        <div class = "page-title">
        &nbsp;
        </div>
    </div>
    <div class="col-sm-12">
        <!-- Modal -->
        <div class="modal modal-info fade" tabindex="-1" id="ctm-shared-news" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header bg-info info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Compartido con...</h4>
              </div>
              <div class="modal-body">
                <ul class="message-list">
                    <li class="message-list-header">Aulas</li>
                    ' . $comparte_aulas . '
                    <li class="message-list-header">Personas</li>
                    ' . $comparte_people . '
                </ul>
              </div>
              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <!--<a class="btn btn-danger btn-ok" href="' . BASE_URL . '?remove_alumno=' . $alumnos_data[$i]["id_people"] . '">Delete</a>-->
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
    </div>
    <div class="col-sm-9">
        <h1>' . $noticias_data["titulo_noticias"] . '<a data-toggle="modal" data-target="#ctm-shared-news" ><i class="icon-share2"></i></a><span style="display:block; font-size:13px;color:#777;">' . $noticias_data["fname_people"] . $noticias_data["lname1_people"] . $noticias_data["lname2_people"] . '</span> <span style="float:right;font-size:13px;color:#777;">' . get_date_format($noticias_data["fecha_noticias"]) . ' ' . $noticias_data["hora_noticias"] . '</span></h1>
        <hr />
    </div>
    <div class="col-sm-9">
        <!--/page header -->
        <div class="page-article">
        ' . $noticias_data["contenido_noticias"] . '
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h6 class="panel-title">Últimas noticias</h6>
            </div>
                    ' . $list_noticias . '
        </div>
    </div>
</div>
<!--/page content -->';
    } else {
        header("Location: " . BASE_URL . "?lista_noticias");
    }
}
