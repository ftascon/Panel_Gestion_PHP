<?php

function get_header($filter, $id_filter) {
    $output_init = '';
    $output_end = '';
    $custom_edit = '';
    $custom_title = '';
    $custom_link = '';
    $custom_place = '';
    $custom_type_place = '';
    $n_locations = 1;
    $users = new Users();
    $users_data = $users->get_id_by_token($_SESSION["user"]["usersToken"]);
    $object_category = 2;
    switch ($filter) {
        case "countries":
        case "cities":
            if ($filter == "countries") {
                $place = new Countries();
                $data_place = $place->get_countries_info($id_filter, false, $users_data["idUsers"]);
                $custom_title = '<a href="' . generate_url("countries", $data_place["countries_url"]) . '">
                                    <strong>' . $data_place["countries_name"] . '</strong>
                                </a>';
                $custom_place = $data_place["countries_name"];
                $custom_type_place = '<a href="' . generate_url("countries-list", 1) . '">' . translate("STRUCTURE_COUNTRIES") . '</a>';
                $object_category = 3; //3 countries (de cara a js functions)
                $images = new CountriesImages();
                $images_data = $images->get_images_by_countries($id_filter);
            } else {
                $place = new Cities();
                $data_place = $place->get_cities_info($id_filter, $users_data["idUsers"]);
                $custom_title = '<a href="' . generate_url("countries", $data_place["countries_url"]) . '">
                                    <strong>' . $data_place["countries_name"] . '</strong>
                                </a> 
                                <span class="hidden-xs hidden-sm">|</span> 
                                <a href="' . generate_url("cities", $data_place["cities_id"]) . '"><span>' . $data_place["cities_name"] . '</span></a>';
                $custom_link = ' > <a href="' . generate_url("cities", $data_place["cities_id"]) . '">' . $data_place["cities_name"] . '</a>';
                $custom_place = $data_place["cities_name"];
                $custom_type_place = '<a href="' . generate_url("cities-list", 1) . '">' . translate("STRUCTURE_CITIES") . '</a>';
                $images = new CitiesImages();
                $images_data = $images->get_images_by_cities($id_filter);
            }
//            print_r($data_place);
            $btn_img = '<img src="' . BASE_URL . 'img/general/cities_not_been.png" alt="not been" />';
            if ($_SESSION["login_way"] != "no_login") {
                if ($data_place["been"] == "") {
                    $btn_cities_been_first = '<a class="hidden-xs visible-md visible-lg ctm-btn-tack" id="been_' . $id_filter . '" onclick="places_been(' . $id_filter . ',' . $object_category . ')">' . $btn_img . '</a>';
                    $btn_cities_been = '<a class=" hidden-md hidden-lg ctm-btn-tack" id="been_' . $id_filter . '" onclick="places_been(' . $id_filter . ',' . $object_category . ')">' . $btn_img . '</a>';
                } else {
                    $btn_img = '<img src="' . BASE_URL . 'img/general/cities_been.png" alt="been" />';
                    $btn_cities_been_first = '<a class="hidden-xs visible-md visible-lg ctm-btn-tack" id="been_' . $id_filter . '" onclick="places_not_been(' . $id_filter . ',' . $object_category . ')">' . $btn_img . '</a>';
                    $btn_cities_been = '<a class=" hidden-md hidden-lg ctm-btn-tack" id="been_' . $id_filter . '" onclick="places_not_been(' . $id_filter . ',' . $object_category . ')">' . $btn_img . '</a>';
                }
            } else {
                $btn_cities_been_first = '<span class="hidden-xs visible-md visible-lg ctm-btn-tack"><a onclick="modal_check(' . $id_filter . ',' . $object_category . ')" >' . $btn_img . '</a></span>';
                $btn_cities_been = '<a class="hidden-md hidden-lg ctm-btn-tack" id="been_' . $id_filter . '" onclick="modal_check(' . $id_filter . ',2)" >' . $btn_img . '</a>';
            }
            $output_init .= '<div class="row ctm-places-header">
                    <div class="container ctm-padding-left-right-0">
                        <div class="col-xs-12 ctm-bg">
                            <img src="http://www.filmaps.com/photos/' . $data_place["cities_photo"] . '" class="img-responsive hidden-xs">
                        </div>
                        <div class="col-xs-12 ctm-bg-content">
                            <div class="row ctm-margin-right-left-0">
                                <div class="col-xs-12 col-sm-6 ctm-places-info">
                                    <h1>
                                    ' . $custom_title . '
                                    </h1>' . $btn_cities_been_first;
            $custom_edit .= '</div><ul class="list-inline">
                                    <li>' . $btn_cities_been . '</li>
                                <li><a class="ctm-cursor-pointer" onclick="modal_add_images(' . $id_filter . ',' . $object_category . ')"><img src="' . BASE_URL . 'img/movies/subir-foto-min.png" alt="' . translate("SECTION_INFO_ADD_PHOTO_ALT") . '"></a></li>
                                    
                            </ul>';
            $output_end .= '</div>
                        </div>
                    </div>
                </div>
                <div class="row ctm-line">
                    <div class="container">
                        <h2>' . translate("CONTENT_LOCATION_LINE_TITLE") . $custom_place . '</span></h2>
                        <p class="pull-right hidden-xs hidden-sm">
                            <a href="' . generate_url("standard") . '">' . translate("STRUCTURE_HOME") . '</a> >
                            ' . $custom_type_place . ' >
                            <a href="' . generate_url("countries", $data_place["countries_url"]) . '">' . $data_place["countries_name"] . '</a>
                            ' . $custom_link . '
                        </p>
                    </div>
                </div>';
            break;
        case "locations":
            $object_category = 4; //3 countries (de cara a js functions)
            $place = new Locations();
            $data_place = $place->get_locations_info($id_filter);

            $images = new LocationsImages();
            $images_data = $images->get_images_by_locations($id_filter);

            $output_init .= '<div class="row ctm-locations-header ctm-places-header">
                                <script>
                                    function initialize() {
                                        var mapaOptions = {
                                            navigationControl: false,
                                            mapTypeControl: false,
                                            scaleControl: false,
                                            draggable: false,
                                            disableDefaultUI: true,
                                            scrollwheel: false,
                                            zoom: 16,
                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                        }
                                        var mapa' . $n_locations . 'Canvas = document.getElementById("mapa' . $n_locations . '");
                                        var mapalat' . $n_locations . ' = new google.maps.LatLng(' . $data_place["locations_x"] . ',' . $data_place["locations_y"] . ');
                                        mapaOptions["center"] = mapalat' . $n_locations . ';
                                        var mapa' . $n_locations . ' = new google.maps.Map(mapa' . $n_locations . 'Canvas, mapaOptions)
                                        var marker' . $n_locations . ' = new google.maps.Marker({
                                            position: mapalat' . $n_locations . ',
                                            map: mapa' . $n_locations . ',
                                            title: "' . $data_place["locations_name"] . '"
                                        });

                                    }
                                    google.maps.event.addDomListener(window, "load", initialize);
                                </script>
                                <div class="col-xs-12 ctm-bg" id="mapa' . $n_locations . '"></div>
                                <div class="col-xs-12 ctm-bg-content">
                                    <div class="container ctm-padding-left-right-0">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 ctm-places-info">
                                                <h1>
                                                    <a href="' . generate_url("locations", $data_place["locations_id"]) . '">
                                                        <strong>' . $data_place["locations_name"] . '</strong>
                                                    </a> 
                                                </h1>';
            $custom_edit .= '</div>
                            <ul class="list-inline">
                                <li><a class="ctm-cursor-pointer" onclick="modal_add_images(' . $id_filter . ',' . $object_category . ')"><img src="' . BASE_URL . 'img/movies/subir-foto-min.png" alt="' . translate("SECTION_INFO_ADD_PHOTO_ALT") . '"></a></li>
                            </ul>';
            $output_end .= '</div>
                        </div>
                    </div>
                </div>
                <div class="row ctm-line">
                    <div class="container">
                        <h2>' . translate("CONTENT_LOCATION_LINE_TITLE") . $data_place["locations_name"] . '</span></h2>
                        <p class="pull-right hidden-xs hidden-sm">
                            <a href="' . generate_url("standard") . '">' . translate("STRUCTURE_HOME") . '</a> >
                            <a href="#">' . translate("STRUCTURE_LOCATIONS") . '</a> >
                            <a href="' . generate_url("countries", $data_place["countries_url"]) . '">' . $data_place["countries_name"] . '</a> >
                            <a href="' . generate_url("cities", $data_place["cities_url"]) . '">' . $data_place["cities_name"] . '</a> >
                            <a href="' . generate_url("locations", $data_place["locations_id"]) . '">' . $data_place["locations_name"] . '</a>
                        </p>
                    </div>
                </div>';
            break;
        default:
            break;
    }
    $output_place_images = '';
    if (count($images_data) > 0) {
        $output_place_images .= '<div class="row">
                        <div class="col-xs-12 ctm-places-pictures">
                            <p class="text-right"><a href="#">' . translate("SECTION_INFO_SOCIAL_IMG_USERS") . '</a></p>
                            <ul class="pull-right ctm-list-inline" id="links">';
        for ($i = count($images_data) - 1; $i >= 0; $i--) {
            $output_place_images .= '<li><a href="' . BASE_URL . 'images/' . $images_data[$i]["imagesName"] . '" title="Image 1" data-gallery>'
                    . '<img src="' . BASE_URL . 'images/thumbs/' . $images_data[$i]["imagesName"] . '" alt="images location">'
                    . '</a></li>';
        }
        $output_place_images .= '</ul>
                            <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
                            <div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
                                <!-- The container for the modal slides -->
                                <div class="slides"></div>
                                <!-- Controls for the borderless lightbox -->
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>
                            </div>
                        </div>';
    }
    $output .= '<div class="ctm-rank hidden-xs">
                    <ul class="list-unstyled">
                        <li class="list-group-item-text">
                            <ul class="list-inline">
                                <li><strong>' . translate("SECTION_INFO_RANK") . '</strong></li>
                                <li><img src="' . BASE_URL . 'img/general/icono-votacionA.png" alt="voto positivo"></li>
                                <li><img src="' . BASE_URL . 'img/general/icono-votacionA.png" alt="voto positivo"></li>
                                <li><img src="' . BASE_URL . 'img/general/icono-votacionA.png" alt="voto positivo"></li>
                                <li><img src="' . BASE_URL . 'img/general/icono-votacionB.png" alt="voto positivo"></li>
                                <li><img src="' . BASE_URL . 'img/general/icono-votacionB.png" alt="voto positivo"></li>
                                <li><em>(456 ' . translate("SECTION_INFO_RANK_VOTES") . ')</em></li>
                            </ul>
                        </li>
                        <li class="list-group-item-text">
                            <ul class="list-inline">
                                <li class="list-group-item-text"><strong>' . translate("SECTION_INFO_SHARE") . '</strong></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/general/compartir-facebook.png" alt="facebook"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/general/compartir-twitter.png" alt="twitter"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/general/compartir-google.png" alt="gplus"></a></li>
                            </ul>
                        </li>
                    </ul>
                    ' . $custom_edit . '
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <div class="col-xs-12 ctm-places-social">
                            <p class="text-right"><a href="#">' . translate("SECTION_INFO_SOCIAL_FRIENDS") . '</a></p>
                            <ul class="ctm-list-inline">
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (1).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (2).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (3).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (4).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (5).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (6).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (7).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (8).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (9).jpg" class="img-responsive"></a></li>
                                <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (10).jpg" class="img-responsive"></a></li>
                            </ul>
                        </div>
                    </div>'
            . $output_place_images
            . '</div>';
    return $output_init . $output . $output_end;
}
