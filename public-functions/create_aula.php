<?phpfunction get_aula_form($id = false) {    $aulas_data["nombre_aula"] = "";    $aulas_data["f_inicio"] = "";    $aulas_data["f_fin"] = "";    $aulas_data["fk_modulo"] = "";    $aulas_data["url_aula"] = "";    $aulas_ediciones_data = array();    $aulas_profes_data[0]["fk_profesor"] = "";    $alumnos_list_in = "";    $alumnos_list = "";    $_SESSION["edit_aula"] = "no";    /* web */    $fichero = "add";    $title = "Nueva aula";    $s_title = "Añadir nueva aula";    /* /web */    $alumnos = new alumnos();    $profesores = new profesores();    $profesores_data = $profesores->get_all_profesores();    $profesores_list = '';    $alumnos_list = '';    $modulos = new modulos();    $modulos_data = $modulos->get_all();    $modulos_list = '';    $ediciones = new ediciones();    $ediciones_data = $ediciones->get_all();    $ediciones_list = '';    if ($id != false) {        /* web */        $fichero = "edit";        $title = "Editar aula";        $s_title = "Modificar detalles del aula";        /* /web */        $aulas = new aulas();        $aulas_data = $aulas->get_aula_by_id($id);        $_SESSION["edit_aula"] = $aulas_data;        $aulas_profes = new aulas_profesores();        $aulas_profes_data = $aulas_profes->get_profes_by_aula($id);        if (count($aulas_profes_data) <= 0) {            $aulas_profes_data[0]["fk_profesor"] = '';        }        $_SESSION["edit_aula"]["fk_profesor"] = $aulas_profes_data[0]["fk_profesor"];        $aulas_alumnos = new aulas_alumnos();        $alumnos_data = $alumnos->get_alumnos_not_aula($id);        $aulas_alumnos_data = $aulas_alumnos->get_alumnos_by_aula($id);//        print_r($aulas_alumnos_data);        for ($i = 0; $i < count($aulas_alumnos_data); $i++) {            $alumnos_list_in .= '<option value="' . $aulas_alumnos_data[$i]["id_people"] . '">' . $aulas_alumnos_data[$i]["fname_people"] . " " . $aulas_alumnos_data[$i]["lname1_people"] . " " . $aulas_alumnos_data[$i]["lname2_people"] . '</option>';        }        $aulas_ediciones = new aulas_ediciones();        $aulas_ediciones_data = $aulas_ediciones->get_by_aula($id);        if (count($aulas_ediciones_data) > 0) {            foreach ($aulas_ediciones_data as $key => $value) {                $aulas_ediciones_data["ordenado"][] = $value["fk_edicion"];                unset($aulas_ediciones_data[$key]);            }            $aulas_ediciones_data = $aulas_ediciones_data['ordenado'];        }    } else {        $alumnos_data = $alumnos->get_all_alumnos();    }    for ($i = 0; $i < count($alumnos_data); $i++) {        $alumnos_list .= '<option value="' . $alumnos_data[$i]["id_people"] . '">' . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . " " . $alumnos_data[$i]["lname2_people"] . '</option>';    }    for ($i = 0; $i < count($profesores_data); $i++) {        $profesores_list .= '<option ';        if ($aulas_profes_data[0]["fk_profesor"] == $profesores_data[$i]["id_people"]) {            $profesores_list .= ' selected="selected" ';        }        $profesores_list .= 'value="' . $profesores_data[$i]["id_people"] . '">' . $profesores_data[$i]["fname_people"] . " " . $profesores_data[$i]["lname1_people"] . " " . $profesores_data[$i]["lname2_people"] . '</option>';    }//    ******************-EDICIONES//    print_r($modulos_data);    for ($i = 0; $i < count($modulos_data); $i++) {        if ($aulas_data["fk_modulo"] != $modulos_data[$i]["id_modulo"]) {            $modulos_list .= '<option value="' . $modulos_data[$i]["id_modulo"] . '">' . $modulos_data[$i]["nombre_modulo"] . '</option> ';        } else {            $modulos_list .= '<option  selected="selected"  value="' . $modulos_data[$i]["id_modulo"] . '">' . $modulos_data[$i]["nombre_modulo"] . '</option> ';        }    }//    print_r($aulas_ediciones_data);    $dates_ediciones = getYearsMonths();    for ($i = 0; $i < count($ediciones_data); $i++) {        $chk = '';        if (count($aulas_ediciones_data) > 0) {            if (array_key_exists($ediciones_data[$i]['id_ediciones'], array_flip($aulas_ediciones_data))) {                $chk = ' selected ';            }        }        $ediciones_list .= '<option value="' . $ediciones_data[$i]['id_ediciones'] . '" ' . $chk . '>'                . '' . ($ediciones_data[$i]['name_servicio'])                . '   (' . (substr(strtoupper($dates_ediciones['M'][$ediciones_data[$i]['mes_init'] - 1]), 0, 3)) . ' - ' . $ediciones_data[$i]['anio_init'] . ')'                . '</option> ';    }    $alert = "";    if (isset($_GET["ok"])) {        $alert = '<div class="callout callout-success fade in">				<button type="button" class="close" data-dismiss="alert">×</button>				<h5>Operación exitosa</h5>				</div>';    } else {        if (isset($_GET["ko"])) {            $alert = '<div class="callout callout-danger fade in">				<button type="button" class="close" data-dismiss="alert">×</button>				<h5>¡Ha ocurrido un error!compruebe que se han efectuado los cambios</h5>				</div>';        }    }    return '<!-- Page content -->        <div class="page-content">            <!-- Page header -->            <div class="page-header">                <div class="page-title">                    <h3>' . $title . '<small>' . $s_title . '</small></h3>                </div>            </div>            <!-- /page header -->            <!-- Breadcrumbs line -->            <div class="breadcrumb-line">                <ul class="breadcrumb">                    <li><a href="' . BASE_URL . '">Home</a></li>                    <li><a href="' . BASE_URL . '?lista_aulas">Aulas</a></li>                    <li class="active">' . $title . '</li>                </ul>                <div class="visible-xs breadcrumb-toggle">                    <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>                </div>            </div>            <!-- /breadcrumbs line -->            ' . $alert . '            <!-- Add users form -->            <form class="validate" action="ajax/' . $fichero . '_aula.php" method="POST" role="form">                <div class="panel panel-default">                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil"></i> ' . $title . '</h6></div>                    <div class="panel-body">                        <div class="form-group">                            <div class="row">                                <div class="col-md-12" style="padding:15px;">                                    <div class="form-group">                                        <label class="col-sm-2 control-label"> Edición </label>                                        <div class="col-sm-10">                                            <select multiple="multiple" name="aulas_ediciones[]" class="multi-select" tabindex="2">                                                ' . $ediciones_list . '                                            </select>                                        </div>                                    </div>                                </div>                                <div class="col-md-7">                                    <label>Modulo: <span class="mandatory">*</span></label>                                    <select data-placeholder="Modulo..." class="required select-full" name="fk_modulo" tabindex="2">                                        <option value=""></option>                                         ' . $modulos_list . '                                    </select>                                </div>                                <div class="col-md-5">                                    <label>Fecha de Inicio: </label>                                    <input type="text" class="from-date form-control" value="' . $aulas_data["f_inicio"] . '" name="f_inicio" placeholder="Desde">                                </div>                            </div>                        </div>                        <div class="form-group">                            <div class="row">                                <div class="col-sm-6">                                    <label>Profesor: <span class="mandatory">*</span></label>                                    <select data-placeholder="Profesor..." class="required select-full" name="fk_profesor" tabindex="2">                                        <option value=""></option>                                         ' . $profesores_list . '                                    </select>                                </div>                                <div class="col-sm-6">                                    <label>URL: </label>                                    <input type="text" name="url_aula" placeholder="http://bimgestion.gestor-energetico.es/" value="' . $aulas_data["url_aula"] . '" class="form-control">                                </div>                            </div>                        </div>                        <div class="form-group">                            <!-- Dual selects -->                            <div class="panel panel-default">                                <div class="panel-heading"><h6 class="panel-title"><i class="icon-arrow3"></i> Alumnos</h6></div>                                <div class="panel-body">                                    <!-- Left box -->                                    <div class="left-box">                                        <input type="text" id="box1Filter" class="form-control" placeholder="Filter entries...">                                        <button type="button" id="box1Clear" class="filter">x</button>                                        <select id="box1View" multiple="multiple" name="aula_listasasd[]" class="form-control">                                            ' . $alumnos_list . '                                        </select>                                        <span id="box1Counter" class="count-label"></span>                                        <select id="box1Storage"></select>                                    </div>                                    <!-- /left-box -->                                    <!-- Control buttons -->                                    <div class="dual-control">                                        <button id="to2" type="button" class="btn btn-default">&nbsp;&gt;&nbsp;</button>                                        <button id="allTo2" type="button" class="btn btn-default">&nbsp;&gt;&gt;&nbsp;</button><br />                                        <button id="to1" type="button" class="btn btn-default">&nbsp;&lt;&nbsp;</button>                                        <button id="allTo1" type="button" class="btn btn-default">&nbsp;&lt;&lt;&nbsp;</button>                                    </div>                                    <!-- /control buttons -->                                    <!-- Right box -->                                    <div class="right-box">                                        <input style="display:none;" type="text" id="box2Filter" class="form-control" placeholder="Filter entries...">                                        <label style="padding:10px;display:table-cell;vertical-align:middle; font-size:18px; color:#666;"><i class="icon-users" style="font-size:22px;margin-top:-5px;"></i>Miembros </label>                                        <button style="visibility:hidden;" type="button" id="box2Clear" class="filter">x</button>                                                                                <select name="aula_list[]" id="box2View" multiple="multiple"  class="form-control">                                            ' . $alumnos_list_in . '                                                                                    </select>                                        <span id="box2Counter" class="count-label"></span>                                        <select id="box2Storage" name="alumns[]"></select>                                    </div>                                    <!-- /right box -->                                </div>                            </div>                            <!-- /dual selects -->                        </div>                        <div class="form-actions text-right">                            <input type="submit" onclick="selection()" value="Guardar aula" class="btn btn-success">                        </div>                    </div>                </div>            </form>            <!-- /Add users form -->        </div>        <!-- /page content -->';}