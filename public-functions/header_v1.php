<?php

function getHeader() {
    session_start();
    if (!isset($_SESSION["user"])) {
        if (isset($_SESSION["fb_access_token"])) {
            $fb = new Facebook\Facebook([
                'app_id' => '126112904393475',
                'app_secret' => '4a0d38b62873395a2c1f48339c8ce29b',
                'default_graph_version' => 'v2.2',
            ]);
            try {
                $access_token = $_SESSION['fb_access_token'];
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->get('/me', $access_token);
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $fb_user_data = $response->getGraphNode();
            $user["usersName"] = $fb_user_data->getField("name");
            $user["usersMail"] = $fb_user_data->getField("email");
            $user["usersToken"] = getToken();
            $user["usersFbid"] = $fb_user_data->getField("id");
            $local_users = new Users();
            $local_users->register($user, true);
//      print_r($user);
            $_SESSION["login_way"] = "fb";
        } else {
            if (isset($_SESSION['gplus_access_token']) && $_SESSION['gplus_access_token']) {
                $client_id = '66037577324-etbrmslip06n389nrk07viik4tegud60.apps.googleusercontent.com';
                $client_secret = 'RY2BfC4d-XJti7aLtaQQKKtl';
                $redirect_uri = 'http://nuevo.filmaps.com/includes/test_gplus.php';
                $client = new Google_Client();
                $client->setClientId($client_id);
                $client->setClientSecret($client_secret);
                $client->setRedirectUri($redirect_uri);
                $client->addScope(array("profile", "email"));
                $client->setAccessToken($_SESSION['gplus_access_token']);
                $userinfo = new Google_Service_Oauth2($client);
                $gp_user_data = $userinfo->userinfo->get();
                $user["usersName"] = $gp_user_data["name"];
                $user["usersMail"] = $gp_user_data["email"];
                $user["usersPhoto"] = $gp_user_data["picture"];
                $user["usersToken"] = getToken();
                $local_users = new Users();
                $local_users->register($user);
                $_SESSION["login_way"] = "gp";
            } else {
                $user_name = '<a href="' . generate_url("standard", "URL_LOGIN") . '" class="text-right ctm-padding-15"><strong>' . translate("STRUCTURE_GET_IN") . '</strong></a>';
                $_SESSION["login_way"] = "no_login";
            }
        }
    }
    if (isset($_SESSION["user"])) {
        $user_name = "<a href='" . generate_url("standard", "URL_PROFILE") . "' class='text-right ctm-padding-15'><strong>" . $_SESSION["user"]["usersName"] . "</strong></a>";
        $_SESSION["login_way"] = "local";
    }
//    print_r($_SESSION);
//    echo $GLOBALS["lang_set"];
    /* langs list */
    $translate_data = generate_url_translations();
    $langs_list_items = "";
    foreach ($translate_data as $k => $v) {
        if ($k != $GLOBALS["lang_set"]) {
            $langs_list_items .= "<li><a href='" . $v . "'>" . translate($k) . "</a></li>";
        } else {
            $langs_list_items .= "<li><a class='active' href='" . $v . "'>" . translate($k) . "</a></li>";
        }
    }
    /* /langs list */
//    print_r($_SESSION);
    $header = ' 
    <div class="row ctm-header-menu">
        <div class="container-fluid">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="' . BASE_URL . '"><img src="' . BASE_URL . 'img/general/filmaps-logo.png" alt="Logo Filmaps" /></a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <div class="row">
                                <form class="navbar-form" role="search">
                                    <div class="form-group col-xs-12 input-group">
                                        <input type="text" class="form-control" placeholder="' . translate("HEADER_SEARCH_BOX") . '" />
                                        <div class="input-group-addon">
                                            <button type="submit" class="btn glyphicon glyphicon-play" aria-hidden="true"></button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 hidden-xs">
                            ' . $user_name . '
                        </div>
                        <div class="col-xs-12 ctm-large-menu">
                            <div id="menu-collapsed" class="yamm text-right">
                                <button type="button" class="navbar-toggle" data-toggle="dropdown" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <ul class="dropdown-menu yamm-fw">
                                    <li class="pull-left">
                                        <ul class="list-inline">
                                            <li><a href="' . generate_url("standard", "URL_MOVIES_LIST") . '" class="active">' . translate("STRUCTURE_MOVIES") . '</a></li>
                                            <li><a href="' . generate_url("standard", "URL_CITIES_LIST") . '">' . translate("STRUCTURE_CITIES") . '</a></li>
                                            <li><a href="' . generate_url("standard", "URL_COUNTRIES_LIST") . '">' . translate("STRUCTURE_COUNTRIES") . '</a></li>
                                            <li><a href="' . generate_url("standard", "URL_LOCATIONS_LIST") . '">' . translate("STRUCTURE_LOCATIONS") . '</a></li>
                                        </ul>
                                    </li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                        <li class="pull-right">';
    if ($_SESSION["login_way"] != "no_login") {
        $header .= '<li><a href="#">' . translate("STRUCTURE_FRIENDS") . '</a></li>
                                            <li><a href="' . generate_url("standard", "URL_PROFILE") . '">' . translate("STRUCTURE_PROFILE") . '</a></li>
                                            <li><a href="#" onclick="logout()">' . translate("STRUCTURE_SIGN_OUT") . '</a></li>';
    } else {
        $header .= '<li class="visible-xs"><a href="' . generate_url("standard", "URL_LOGIN") . '">' . translate("STRUCTURE_GET_IN") . '</a></li>';
    }
    $header .= '<li><a data-toggle="modal" data-target="#langs-menu">' . translate("STRUCTURE_LANGUAGES") . '</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="modal fade" id="langs-menu" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">' . translate("MODAL_LANGS_TITLE") . '</h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled">' . $langs_list_items . '</ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>';

    return $header;
}

?>