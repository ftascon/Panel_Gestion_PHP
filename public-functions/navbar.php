<?php

function get_navbar($rol) {
//    print_r($_SESSION["user_data"]);
    $user_photo = get_profile_image();
    $output_dropdown = '';
    $output_btn_left_menu = '';
    $output_btn_left_menu1 = '';
    $item_news = "";
    if ($rol == 10) {
        $output_dropdown = '<li><a href="' . BASE_URL . 'index.php?perfil"><i class="icon-user"></i> Perfil</a></li>';
        $output_btn_left_menu = '<a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>';
        $output_btn_left_menu1 = '<button type="button" class="navbar-toggle offcanvas">
				<span class="sr-only">Toggle navigation</span>
				<i class="icon-paragraph-justify2"></i>
			</button>';
    } else {
        if ($rol == 2) {
            $output_dropdown = '<li><a href="' . BASE_URL . 'index.php?perfil"><i class="icon-user"></i> Perfil</a></li>';
            $output_btn_left_menu = '<a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>';
            $output_btn_left_menu1 = '<button type="button" class="navbar-toggle offcanvas">
				<span class="sr-only">Toggle navigation</span>
				<i class="icon-paragraph-justify2"></i>
			</button>';
        }
        $item_news = '<li><a href="' . BASE_URL . '"><i class="icon-newspaper"></i> Noticias</a></li>';
        $item_news = "";
    }
    return '<!-- Navbar -->
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="' . BASE_URL . '"><img src="images/logo.png" alt="gestor-energetico"></a>
			' . $output_btn_left_menu . '
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>
                        ' . $output_btn_left_menu1 . '
			
		</div>
                <style>
                    .navbar-nav > li > a.ctm-nav-logo{
                        padding: 5px 10px;
                        height: 50px;
                        margin-top: 2px;
                        background:#fff;
                    }
                    .navbar-nav > li > a.ctm-nav-logo:hover{
                        background:#7BACBF;
                    }
                </style>
		<ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
                        ' . $item_news . '
                        <li>
                            <img src="' . BASE_URL . 'images/ub_logo.png" height="50" style="margin-top:2px;" />
                        </li>
                        <!--<li style="width:150px; height:54px;;">&nbsp;</li>-->
                        <li>
                            <a href="' . BASE_URL . '?equipo" class="ctm-nav-logo">
                                <img src="' . BASE_URL . 'images/logo_login.png" height="40" />
                                <!--<img src="' . BASE_URL . 'images/logo_ge_w.png" height="40" />-->
                            </a>
                        </li>
			<li class="user dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="' . $user_photo . '">
                                    <span>' . $_SESSION["user_data"]["full_name"] . '</span>
                                    <i class="caret"></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-right icons-right">
					' . $output_dropdown . '
					<li><a href="' . BASE_URL . 'ajax/logout.php"><i class="icon-exit"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- /navbar -->';
}
