<?phpfunction get_home($rol) {    include 'calendar.php';    $rol = $_SESSION["user_data"]["id_rols"];    $id_user = $_SESSION["user_data"]["id_user"];//    print_r($_SESSION["user_data"]);    $items = '';    $advanced_options = '';    $alumnos = '<li class="bg-warning">    <div class="top-info">        <a href="' . BASE_URL . '?lista_alumnos">Alumnos</a>        <small>datos de los alumnos</small>    </div>    <a href="' . BASE_URL . '?lista_alumnos"><i class="icon-user"></i></a>    <span class="bottom-info bg-primary">Lista de alumnos</span></li>';$profes = '<li class="bg-info"><div class="top-info">    <a href="' . BASE_URL . '?lista_profesores">Profesores</a>    <small>datos de los profesores</small></div><a href="' . BASE_URL . '?lista_profesores"><i class="icon-users"></i></a><span class="bottom-info bg-primary">Lista de profesores</span></li>';$aulas = '<li class="bg-danger"><a href="' . BASE_URL . '?lista_aulas" >    <div class="top-info">         <a href="' . BASE_URL . '?lista_aulas">            Aulas        </a>        <small>            Gestion de las Aulas        </small>    </div>    <a href="' . BASE_URL . '?lista_aulas">        <i class="icon-stack"></i>    </a>    <span class="bottom-info bg-primary">        Información de los Servicios    </span></a></li>';$vicos = '<li class="bg-success"><div class="top-info">    <a href="' . BASE_URL . '?lista_vicos">Videoconferencias</a>    <small>datos de las Videoconferencias</small></div><a href="' . BASE_URL . '?lista_vicos"><i class="icon-camera5"></i></a><span class="bottom-info bg-primary">Lista de Videoconferencias</span></li>';//    $wiki = '<li class="bg-success">//                        <div class="top-info">//                                <a href="' . BASE_URL . '?wiki">Material</a>//                                <small>Herramientas para el uso de las herramientas</small>//                        </div>//                        <a href="' . BASE_URL . '?wiki"><i class="icon-book"></i></a>//                        <span class="bottom-info bg-primary">Uso de las herramientas</span>//                </li>';$cal = '';switch ($rol) {    case 1:    $items = "";    break;    case 2:    $temporal = '<div class="col-xs-12">    <div class="row">        <div class="col-md-6">            <iframe src="https://player.vimeo.com/video/183672486 " width="420" height="260" frameborder="0" allowfullscreen="allowfullscreen"></iframe>        </div>        <div class="col-md-6">            <iframe src="https://player.vimeo.com/video/183672472 " width="420" height="260" frameborder="0" allowfullscreen="allowfullscreen"></iframe>        </div>    </div></div>';$items = $alumnos . $aulas . $vicos;$cal = ($_SESSION["user_data"]['id_user'] == 100) ? get_calendar(false, false) : get_calendar($_SESSION["user_data"]['id_user'], false);break;case 10:$temporal = '<div class="col-xs-12"><div class="row">    <div class="col-md-6">        <iframe src="https://player.vimeo.com/video/183672486 " width="420" height="260" frameborder="0" allowfullscreen="allowfullscreen"></iframe>    </div>    <div class="col-md-6">        <iframe src="https://player.vimeo.com/video/183672472 " width="420" height="260" frameborder="0" allowfullscreen="allowfullscreen"></iframe>    </div></div></div>';$cal = get_calendar(false, 'nofull');$items = $alumnos . $profes . $aulas . $vicos;$advanced_options = '<h6 class="heading-hr"><i class="icon-cogs"></i> Opciones Avanzadas</h6><!-- Info blocks --><ul class="info-blocks">    <li class="bg-primary">     <div class="top-info">      <a href="' . BASE_URL . '?usuarios">usuarios</a>      <small>gestion de usuarios</small>  </div>  <a href="' . BASE_URL . '?usuarios"><i class="icon-user-plus"></i></a>  <span class="bottom-info bg-danger">Lista de usuarios</span></li><li class="bg-warning">    <a href="' . BASE_URL . '?servicios" >        <div class="top-info">             <a href="' . BASE_URL . '?servicios">                Servicios            </a>            <small>                Gestion de los Servicios            </small>        </div>        <a href="' . BASE_URL . '?servicios">            <i class="icon-stack"></i>        </a>        <span class="bottom-info bg-primary">            Información de los Servicios        </span>    </a></li><li class="bg-danger">    <!--<a class="ctm_dash_btn" href="' . BASE_URL . '?tareas">-->    <div class="top-info">      <a  href="' . BASE_URL . '?tareas">Gestor de tareas</a>      <small>Informacion sobre las tareas</small>  </div>  <a href="' . BASE_URL . '?tareas"><i class="icon-calendar3"></i></a>  <span class="bottom-info bg-primary">Asignar tareas</span>  <!--</a>--></li></ul><!-- /info blocks -->';break;default:break;}return '<!-- Page content --><div class="page-content">    <!-- Page header -->    <div class="page-header">        <div class="page-title">            <h3>Dashboard</h3>        </div>    </div>    <!-- /page header -->    <!-- Breadcrumbs line -->    <!--    <div class="breadcrumb-line">        <ul class="breadcrumb">            <li><a href="' . BASE_URL . '">Home</a></li>            <li class="active">Dashboard</li>        </ul>    </div>--><!-- /breadcrumbs line --><div class="row">    <div class="col-xs-12">        <h6 class="heading-hr">            <i class="icon-camera5"></i> Ultimas Videoconferencias        </h6>        <div class="block">            '.$temporal.'        </div>    </div>    <div class="col-xs-12" style="margin-top:15px;">        <h6 class="heading-hr">            <i class="icon-calendar4"></i> Calendario            <span><a href="' . BASE_URL . '?calendar=' . $id_user . '" class="btn btn-info ctm-left ctm-padding-0" > Ver Completo</a></span>        </h6>        <div class="block">            ' . $cal . '        </div>    </div>    <div class="col-xs-12">        <h6 class="heading-hr">            <i class="icon-support"></i> Opciones de Gestor Energetico        </h6>        <!-- Info blocks -->        <ul class="info-blocks">            ' . $items . '                                        </ul>        <!-- /info blocks -->        ' . $advanced_options . '        <div class="row">            <div class="col-xs-12">                <h6 class="heading-hr">                    <i class="icon-link6"></i> En colaboración con:                </h6>                <div class="col-xs-12">                    <ul class="list-inline">                        <li><img src="' . BASE_URL . 'images/colaboradores/uni.png" alt="universidad de barcelona"/></li>                        <li><img src="' . BASE_URL . 'images/colaboradores/green.png" alt="Green"/></li>                        <li><img src="' . BASE_URL . 'images/colaboradores/auto.png" alt="autodesk"/></li>                    </ul>                </div>            </div>        </div>    </div></div>' . get_footer() . '</div><!-- /page content -->';}