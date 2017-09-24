<?php



function get_config_calendars($id, $anio=0,$edicion=0,$aula=0) {

    $rol = $_SESSION["user_data"]["id_rols"];
    $id_user = $_SESSION["user_data"]["id_user"];
    $id_selected = '';
    $calendar =  new calendars();
    $calendar_data = $calendar->get_by_id($id);

    $noticias_list = "";
    $add_noticias = '<div class="ctm-btn-add">
                            <a href="' . BASE_URL . '?nueva_noticia" class="btn btn-default btn-success"><i class="icon-plus"></i></a>
                      </div> ';
    $connection = mysqli_connect("localhost", "root", "", "nicolas_admin") or die(mysqli_error($connection));
    $stmt = "SELECT
    e.id_ediciones, 
    s.id_servicio,
    e.anio_init, e.mes_init,
    s.name_servicio
    FROM ediciones e
    INNER JOIN servicios s ON e.fk_servicio = s.id_servicio
    WHERE e.anio_init >= 2016
    ORDER BY  anio_init DESC,name_servicio ASC";
    $result = mysqli_query($connection,$stmt);
    $data_ediciones = "";
    $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
    'Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    $bef = null;
    $data_anio = '';
    while($row = mysqli_fetch_assoc($result)){
      if($edicion == $row["id_ediciones"]){
        $id_sel = "selected_edicion";
      }else{
        $id_sel = "";
      }
      if($bef != $row["anio_init"]){
        $bef = $row["anio_init"];
        $data_anio .= '<li id="'.$id_sel.'" class="list-group-item  anio_'.$row["anio_init"].'"><a href="'. BASE_URL .'?config_calendars='.$id.'&anio='.$row["anio_init"].'">'.$row["anio_init"].'</a></li>';
      }

      if($anio == $row["anio_init"]){
        $data_ediciones .= "<li id='".$id_sel."' class='list-group-item  anio_".$row["anio_init"]." ediciones_".$row["id_ediciones"]."'><a href='". BASE_URL ."?config_calendars=".$id."&anio=".$row["anio_init"]."&edicion=".$row["id_ediciones"]."'><strong>".$row["anio_init"] . "-" . $meses[$row["mes_init"]-1] ."</strong> ". utf8_encode($row["name_servicio"]) . "</a></li>";
      }
    }
    /*another query*/
    $data_aulas = '';
    
    $stmt = "SELECT  e.id_ediciones, m.nombre_modulo, a.id_aula, m.bg_modulo
    FROM aulas a
    INNER JOIN aulas_ediciones ae ON a.id_aula = ae.fk_aula
    INNER JOIN ediciones e ON e.id_ediciones = ae.fk_edicion
    INNER JOIN modulos m ON m.id_modulo = a.fk_modulo";

    $result = mysqli_query($connection,$stmt);
    while($row = mysqli_fetch_assoc($result)){
      if(isset($_GET["edicion"])){
        if($aula == $row["id_aula"]){
          $id_selected = "selected_aula";
        }else{
          $id_selected = '';
        }
        if($row["id_ediciones"] == $_GET["edicion"]){
          $data_aulas .= '<li id="'.$id_selected.'" data-ediciones="'.$row["id_ediciones"].'" data-name="'.utf8_encode($row["nombre_modulo"]).'" data-id="'.$row["id_aula"].'" data-color="'.$row["bg_modulo"].'" class="list-group-item  aulas_'.$row["id_ediciones"].'"><a href="'.BASE_URL.'?config_calendars='.$id.'&anio='.$anio.'&edicion='.$edicion.'&sesion_aula='.$row["id_aula"].'">'.utf8_encode($row["nombre_modulo"]).'</a></li>';
        }
      }else{
        $data_aulas .= '<li id="'.$id_selected.'" data-ediciones="'.$row["id_ediciones"].'" data-name="'.utf8_encode($row["nombre_modulo"]).'" data-id="'.$row["id_aula"].'" data-color="'.$row["bg_modulo"].'" class="list-group-item  aulas_'.$row["id_ediciones"].'"><a href="'.BASE_URL.'?config_calendars='.$id.'&anio='.$anio.'&edicion='.$edicion.'&sesion_aula='.$row["id_aula"].'">'.utf8_encode($row["nombre_modulo"]).'</a></li>';
      }
    }

    if(!isset($_GET["anio"])){
      $data_ediciones = '';
    }
    if(!isset($_GET["edicion"])){
      $data_aulas = '';
    }

    return '<!-- Page content -->
<script type="text/javascript" src="' . BASE_URL . '/js/moment.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/js/fullcalendar.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/js/script.js"></script>
<link rel="stylesheet" href="' . BASE_URL . '/css/fullcalendar.css">
<div class="page-content">
    <div class="page-content-inner">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Configurar Calendario<small></small></h3>
            </div>
        </div>
        <!-- /page header -->
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
                <ul class="breadcrumb">
                        <li><a href="' . BASE_URL . '">Home</a></li>
                        <li><a href="' . BASE_URL . '?lista_calendars">Lista calendarios</a></li>
                        <li class="active">'.$calendar_data["nombre"].'</li>
                </ul>
        </div>
        <!-- /breadcrumbs line -->
        <!-- alumnos (table) -->
        <div class="row">
            <!-- pregunta box indvl -->
            <div class="col-md-2">
                <div class="panel panel-primary">
                      <div class="panel-heading">
                              <h6 class="panel-title"><i class="icon-upload"></i> Años </h6>
                      </div>
                      <ul class="list-group">
                             '.$data_anio.'
                      </ul>
                </div>
            </div>
            <!-- /pregunta (box) -->
            <!-- pregunta box indvl -->
            <div class="col-md-5">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-upload"></i> Ediciones</h6>
                        </div>
                        <ul class="list-group">
                              '.$data_ediciones.'
                        </ul>
                </div>
            </div>
            <!-- pregunta box indvl -->
            <div class="col-md-5">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-upload"></i> Aulas</h6>
                        </div>
                        <ul class="list-group" id="ctm-aulas-vcs">
                              '.$data_aulas.'
                        </ul>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-9">
  <div id="calendar">
  </div>

  <!-- Modal  to Add Event -->
  <div id="createEventModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir una nueva Videoconferencia</h4>
        </div>
        <div class="modal-body" style="padding:20px;">
          <div class="control-group">
            <strong>Edición</strong>
            <div class="field desc">
              <p id="edicion" disabled name="edicion"></p>
            </div>
            <strong>Aula</strong>
            <div class="field desc">
              <p id="title"></p>
            </div>
          </div>
          <input type="hidden" id="fk_calendar" value="'.$id.'"/>
          <input type="hidden" id="fk_aula"/>
          <input type="hidden" id="start"/>
          <input type="hidden" id="end"/>
          <div class="control-group">
            <label class="control-label" for="when">Fecha:</label>
            <div class="controls controls-row" id="when" style="margin-top:5px;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>
            <!-- /pregunta (box) -->
        </div>
        '.  get_footer().'

    </div>

</div>

	<!-- /page container -->';

}
