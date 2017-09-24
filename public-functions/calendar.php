<?php

function get_calendar($id = false, $type = "full") {

    $rol = $_SESSION["user_data"]["id_rols"];

    $id_user = $_SESSION["user_data"]["id_user"];

    $vicos = new vicos();

    $examenes = new examenes();
    switch ($rol) {

        case 1:
            $examenes_data = $examenes->by_alumno($_SESSION["user_data"]["id_user"]);
//            echo "ya";
            $vicos_data = $vicos->get_vicos_by_alumno($_SESSION["user_data"]["id_user"]);
//            print_r($vicos_data);
            break;
        case 2:
            if ($id_user == 100) {

                $examenes_data = $examenes->get_all();
                $vicos_data = $vicos->get_all();

            } else {

                $examenes_data = $examenes->by_profe($_SESSION["user_data"]["id_user"]);
            	$vicos_data = $vicos->get_vico_by_profe($_SESSION["user_data"]["id_user"]);
            }



            break;

        case 10:

            $vicos_data = $vicos->get_all();

            $examenes_data = $examenes->get_all();

            break;

        default:

            break;
    }

    $json_data_vicos = '';

    if (is_array($examenes_data)) {

//        print_r($examenes_data);

        $i = 0;

        foreach ($examenes_data as $v) {

            $json_data_vicos .= ($i == 0) ? "" : ",";

            $json_data_vicos .= '{'
                    . "id: 'examen'"
                    . ", backgroundColor: '#E3F3FC'"
                    . ", borderColor: '#03a9f4'"
                    . ", textColor: '#000'"
                    . ", url: '" . $v["url_examen"] . "'"
                    . ", allDay: true"
                    . ", title: '" . $v['nombre_examen'] . " - " . $v['nombre_aula']
                    . "' , start: '" . $v['f_inicio']
                    . "' , end: '" . $v['f_fin']
                    . "'}";

            $i++;
        }
    }

    if (is_array($vicos_data)) {

        if (is_array($examenes_data) && count($examenes_data) > 0) {

            $json_data_vicos .= ',';
        }

        $i = 0;

        $modulos = array();

        foreach ($vicos_data as $v) {

//            print_r($v);

            if (array_key_exists($v["fk_aula"], $modulos)) {

                $modulos[$v["fk_aula"]] ++;
            } else {

                $modulos[$v["fk_aula"]] = 1;
            }

//            echo $v["url_vico"] ; 

            $v["url_vico"] = (($v["url_vico"] == "") || ($v["url_vico"] == "#") || ($v["url_vico"] == NULL)) ? get_url_vicos($v["prefix_vc_modulo"] . $modulos[$v["fk_aula"]]) : $v["url_vico"];

            $json_data_vicos .= ($i == 0) ? "" : ",";

            $json_data_vicos .= '{'
                    . "id: 'vc'"
                    . ", backgroundColor: '" . $v['bg_modulo'] . "'"
                    . ", borderColor: '" . $v['bg_modulo'] . "'"

//                    . ", borderColor: '#269abc'"
                    . ", url: '" . $v["url_vico"] . "'"
                    . ", allDay: true"
                    . ", title: '" . $v['hora_vico'] . " VC - " . $v['nombre_modulo']
                    . "' , start: '" . $v['fecha_vico'] . "T" . $v['hora_vico']
                    . ":00'}";

            $i++;
        }
    }

    switch ($type) {

        case 'full':

            $out = '<!-- Page content -->

<div class="page-content"> 

    <div class="page-content-inner">

        <!-- Page header -->

        <div class="page-header">

            <div class="page-title">

                <h3>Calendario<small>Calendario general</small></h3>

            </div>  

        </div>

        <!-- /page header -->



        <!-- alumnos (table) -->

        <div class="row">

            <script type="text/javascript">

                $(document).ready(function() {

                var h = $(window).height();
                    
                    $("#ctm-calendar").fullCalendar({

                        lang: "es",

//                        aspectRatio: 3.50,

                        monthNames:["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],

                        monthNamesShort:["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],

                        dayNames:["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],

                        dayNamesShort:["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],

                        buttonText: {

                            today: "Hoy",

                            month: "Mes",

                            week: "Semana",

                            day: "Día"

                        },

                        header: {

                                    left: "prev,next today",

                                    center: "title",

                                    right: "month,agendaWeek,agendaDay"

                        },

                        defaultDate: "' . date('o-m-d') . '",

                        defaultView: "month",

                        height: h - ((h*40)/100),

                        editable: false,

                        eventLimit: true,

                        events:[

                            ' . $json_data_vicos . ' 

                        ],

                        timeFormat: "H:mm",

                        eventClick: function(event) {

                            if (event.url) {

                                window.open(event.url);

                                return false;

                            }

                        }

                    });
                    $("#tab-calendar").tabs({
                        activate: function(event, ui) {
                            $("#ctm-calendar").fullCalendar("render");
                        }
                    });
                    $(".fc-event-container a.fc-event").attr("target", "_blank");

                    });

</script>

<div class="col-xs-12">

    <div class="block">

        <div id="ctm-calendar"></div>

    </div>

</div>



</div>

' . get_footer() . '

</div>

</div>

<!-- /page container -->';

            break;



        default :

            $ctm_enlace = '<a href="?calendar" target="_blank" >';

            $ctm_enlace = '<span><i>';

            $out = '<div class="row"><script type="text/javascript">

                $(document).ready(function () {

                    var h = $(window).height();

                    $("#ctm-calendar").fullCalendar({
//                        defaultView: "Month",
                        minTime: ' . date('G') . ',
                                maxTime: 21,
                        lang: "es",
//                        aspectRatio: 3.50,

                        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                        dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                        buttonText: {
                            today: "Hoy",
                            month: "' . $ctm_enlace . 'Mes</i></span>",
                            week: "Semana",
                            day: "Día"

                        },
                        header: {
                            left: "prev,next today",
                            center: "title",
                            right: "month,agendaWeek,agendaDay"

                        },
                        defaultDate: "' . date('o-m-d') . '",
                        height: h - ((h * 40) / 100),
                        editable: false,
                        eventLimit: true,
                        events: [
                            ' . $json_data_vicos . '

                        ],
                        timeFormat: "H:mm",
                        eventClick: function (event) {

                            if (event.url) {

                                window.open(event.url);

                                return false;

                            }

                        }

                    });
                    $("#tab-calendar").on("shown.bs.tab", function (e) {
                            $("#ctm-calendar").fullCalendar("render");
                        });

                    $(".fc-event-container a.fc-event").attr("target", "_blank");

                });

                </script>

                <div class="col-xs-12">

                    <div id="ctm-calendar"></div>

                </div>

            </div>';

            break;
    }

    return $out;
}
