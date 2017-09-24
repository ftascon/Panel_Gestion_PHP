<?php

session_start();

function get_form_modal($login = FALSE) {
    /* facebook */
    $fb = new Facebook\Facebook([
        'app_id' => '126112904393475',
        'app_secret' => '4a0d38b62873395a2c1f48339c8ce29b',
        'default_graph_version' => 'v2.2',
    ]);
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email, publish_actions, user_friends, public_profile']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://nuevo.filmaps.com/includes/test_login.php', $permissions);
    /* /facebook */
    /* GOOGLE */
    $client_id = '66037577324-etbrmslip06n389nrk07viik4tegud60.apps.googleusercontent.com';
    $client_secret = 'RY2BfC4d-XJti7aLtaQQKKtl';
    $redirect_uri = 'http://nuevo.filmaps.com/includes/test_gplus.php';
    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope(array("profile", "email"));
    $authUrl = $client->createAuthUrl();
    /* /GOOGLE */

    $output = '<div class="row ctm-login-container-form"> '
            . '<div class="col-xs-12 col-sm-6">'
            . '<a href="' . $loginUrl . '" class="ctm-btn-login-social-fb btn-block text-left btn-lg">
                                <img src="' . BASE_URL . 'img/general/login-facebook.png" alt="fb" /> <span>' . translate("CONTENT_LOGIN_FB") . '</span>
                            </a>
                            <a href="' . $authUrl . '" class="ctm-btn-login-social-gl btn-block text-left btn-lg">
                                <img src="' . BASE_URL . 'img/general/login-google.png" alt="g+" /> <span>' . translate("CONTENT_LOGIN_GP") . '</span>
                            </a>
                            
                           </div>
                           <div class="col-xs-12 col-sm-6">
                            <form role="form" id="login" class="border-radius-button-15">
                    <input type="email" required="required" class="form-control input-lg" name="usersMail" placeholder="' . translate("CONTENT_LOGIN_EMAIL") . '">
                    <input type="password" required="required" class="form-control input-lg" name="usersPassword" placeholder="' . translate("CONTENT_LOGIN_PASS") . '">
                    <button class="btn btn-lg btn-block ctm-btn-more" id="ctm-btn-login" type="button" onclick="login(false)" >' . translate("CONTENT_LOGIN_BTN") . '</button>
                    </form>'
            . '</div>'
            . '<div class="col-xs-12">'
            . '                        <hr />                        
                    <p class="text-right"><a href="' . generate_url("standard", "URL_REGISTER") . '">' . translate("CONTENT_LOGIN_TO_REGISTER") . '</a></p>                        '
            . '</div>'
            . '</div>';

    return $output;
}

function get_form($login = FALSE) {
    $output_social_login = '';
    $output_form_init = '';
    $output_form_end = '';
    unset($_SESSION["source_url"]);
    /* facebook */
    $fb = new Facebook\Facebook([
        'app_id' => '126112904393475',
        'app_secret' => '4a0d38b62873395a2c1f48339c8ce29b',
        'default_graph_version' => 'v2.2',
    ]);
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email, publish_actions, user_friends']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://nuevo.filmaps.com/includes/test_login.php', $permissions);
    /* /facebook */
    /* GOOGLE */
    $client_id = '66037577324-etbrmslip06n389nrk07viik4tegud60.apps.googleusercontent.com';
    $client_secret = 'RY2BfC4d-XJti7aLtaQQKKtl';
    $redirect_uri = 'http://nuevo.filmaps.com/includes/test_gplus.php';
    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope(array("profile", "email"));
    $authUrl = $client->createAuthUrl();
    /* /GOOGLE */

    $output_form_social .= '<a href="' . $loginUrl . '" class="ctm-btn-login-social-fb btn-block text-left btn-lg">
                                <img src="' . BASE_URL . 'img/general/login-facebook.png" alt="fb" /> <span>' . translate("CONTENT_LOGIN_FB") . '</span>
                            </a>
                            <a href="' . $authUrl . '" class="ctm-btn-login-social-gl btn-block text-left btn-lg">
                                <img src="' . BASE_URL . 'img/general/login-google.png" alt="g+" /> <span>' . translate("CONTENT_LOGIN_GP") . '</span>
                            </a>
                            <hr />';
    $output_form_init = '<div class="container ctm-padding-left-right-0">
                <div class="row ctm-margin-right-left-0 ">';
    if (!$login) {
        $output_form = '<h2>' . translate("CONTENT_REGISTER_TITLE") . '</h2>
                    <p>' . translate("CONTENT_REGISTER_DESCRIPTION") . '</p>
                    </div>
                    <div class="row ctm-login-container-form">'
                . $output_form_social .
                '<form role="form" id="register" class="border-radius-button-15">
                                <input type="text" required="required" class="form-control input-lg" name="usersName" value="" placeholder="' . translate("CONTENT_REGISTER_USER_NAME") . '">
                                <input type="email" required="required" class="form-control input-lg" name="usersMail" placeholder="' . translate("CONTENT_LOGIN_EMAIL") . '">
                                <input type="password" required="required" class="form-control input-lg" name="usersPassword" placeholder="' . translate("CONTENT_LOGIN_PASS") . '">
                                <button class="btn btn-lg btn-block ctm-btn-more" type="button" onclick="register()" >' . translate("CONTENT_REGISTER_BTN") . '</button>
                                <p class="help-block">' . translate("CONTENT_REGISTER_TEXT") . '</p>
                                </form>
                            </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 ctm-btn-more-v2">
                        <a href="' . generate_url("standard", "URL_LOGIN") . '" class="btn-block text-left btn btn-lg">' . translate("CONTENT_REGISTER_TO_LOGIN") . '</a></div>';
        $output_form_init .= '<div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ctm-border-radius-10">';
        $dropdown_lang = '<a class="dropdown-toggle" role="button" data-toggle="dropdown" id="dropdownLangFooter" aria-expanded="false">
                                <strong>' . translate("ENGLISH") . '</strong><span class="caret margin-left-15"></span>
                            </a> 
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="' . generate_url("standard", "URL_REGISTER") . '">' . translate("SPANISH") . '</a></li>
                                <li><a href="#">Ruso</a></li>
                                <li><a href="#">Chino</a></li>
                            </ul>';
    } else {
        $output_form = '<h2>' . translate("CONTENT_LOGIN_TITLE") . '</h2>
                    <p>' . translate("CONTENT_LOGIN_DESCRIPTION") . '</p>
                    </div>
                    <div class="row ctm-login-container-form">'
                . $output_form_social .
                '<form role="form" id="login" class="border-radius-button-15">
                    <input type="email" required="required" class="form-control input-lg" name="usersMail" placeholder="' . translate("CONTENT_LOGIN_EMAIL") . '">
                    <input type="password" required="required" class="form-control input-lg" name="usersPassword" placeholder="' . translate("CONTENT_LOGIN_PASS") . '">

                    <button class="btn btn-lg btn-block ctm-btn-more" type="button" onclick="login(false)" >' . translate("CONTENT_LOGIN_BTN") . '</button>
<hr />                        
<p class="text-right"><a href="' . generate_url("standard", "URL_REGISTER") . '">' . translate("CONTENT_LOGIN_TO_REGISTER") . '</a></p>                        
</form>
                            </div></div>';
        $output_form_init .= '<div class="col-xs-12 col-sm-7 col-md-6 col-sm-offset-3 ctm-border-radius-10">';
        $dropdown_lang = '<a class="dropdown-toggle" role="button" data-toggle="dropdown" id="dropdownLangFooter" aria-expanded="false">
                                <strong>' . translate("ENGLISH") . '</strong><span class="caret margin-left-15"></span>
                            </a> 
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="' . BASE_URL . 'es/login/">' . translate("SPANISH") . '</a></li>
                                <li><a href="#">Ruso</a></li>
                                <li><a href="#">Chino</a></li>
                            </ul>';
    }

    $output_form_init .= '<div class="row ctm-padding-left-right-15">
                                <a href="' . generate_url("standard") . '"><img src="' . BASE_URL . 'img/general/filmaps-logo-login.png" alt="login" /></a>';
    $output_form_end = '</div>
                <div class="row ctm-login-footer ctm-border-radius-5">
                    <div class="col-xs-12 col-sm-2 ctm-login-footer-lang">
                        <div class="dropdown">' .
            $dropdown_lang
            . '</div>
                    </div>
                    <div class="col-xs-12 col-sm-6 text-center">
                        <ul class="list-inline">
                            <li><a href="' . generate_url("standard") . '">' . translate("FOOTER_MENU_ITEM_1") . '</a></li>|
                            <li><a href="' . generate_url("standard", "URL_ABOUT_US") . '">' . translate("FOOTER_MENU_ITEM_2") . '</a></li>|
                            <li><a href="' . generate_url("standard", "URL_LEGAL_NOTICE") . '">' . translate("FOOTER_MENU_ITEM_3") . '</a></li>|
                            <li><a href="' . generate_url("standard", "URL_CONTACT") . '">' . translate("FOOTER_MENU_ITEM_4") . '</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p class="text-center">
                            ©2015 Filmaps™. ' . translate("FOOTER_MENU_COPYRIGHT") . '
                        </p>
                    </div>
                </div>
            </div>';
    ob_end_flush();
    return $output_form_init . $output_form . $output_form_end;
}
