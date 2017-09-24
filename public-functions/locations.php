<?php

function get_locations_by_movie($id_movie, $limit) {
    $locations = new Locations();
    $items_by_page = 10;
    if (!$limit) {
        $locations_data = $locations->get_locations_by_movie($id_movie);
    } else {
        if (is_numeric($limit)) {
            $limit = ($limit * $items_by_page) - $items_by_page . ", " . $items_by_page;
        }
        $locations_data = $locations->get_locations_by_number($limit);
    }
    $images_locations = new LocationsImages();

    /* functions add for movie */
    $ctm_function_location = "modal_login('" . $id_movie . "', 1)";
    $ctm_function_images = "modal_login('" . $id_movie . "', 1)";
    if ($_SESSION["login_way"] != "no_login") {
        $ctm_function_location = "modal_add_location('" . $id_movie . "', false)";
        $ctm_function_images = "modal_add_images('" . $id_movie . "',1)";
    }
    /* /functions add for movie */
    $output = '';
    $output_wrap_end = '';
    $i = 0;
    $n_locations = 1;
    $output_wrap_init = '<div class="container">
                           <div class="row ctm-padding-left-right-0">';
    $output_wrap_end = '   </div>';
    if (!$limit) {

        $output_wrap_end .= '<div class="row ctm-padding-left-right-15 ctm-margin-bottom-15">
                            <div class="col-xs-12 col-sm-5 col-lg-4">
                                <div class="row">
                                    <div class="ctm-movies-location-add ctm-border-radius-5">
                                        <img src="' . BASE_URL . 'img/movies/ubicacion-add.png" alt="add new location">
                                        <p>
                                            <a onclick="' . $ctm_function_location . '">' . translate("CONTENT_LOCATION_ADD_LOCATION") . '</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-lg-4 pull-right">
                                <div class="row">
                                    <div class="ctm-movies-location-add ctm-border-radius-5">
                                        <img src="' . BASE_URL . 'img/movies/subir-foto-add.png" alt="add new photo">
                                    <p>
                                        <a onclick="' . $ctm_function_images . '">' . translate("CONTENT_LOCATION_ADD_PHOTO") . '</a>
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>';
    } else {
        $output_wrap_init = '  <div class="row ctm-line">
                                        <div class="container">
                                            <h3>' . translate("STRUCTURE_LOCATIONS") . '</h3>
                                        </div>
                                    </div>' . $output_wrap_init;
    }
    $output_wrap_end .= '   </div>';
    $custom_col = array(
        "1" => "6",
        "2" => "6",
        "3" => "6"
    );
    $ctm_function_images_locations = "modal_login('" . $id_movie . "', 1)";
    foreach ($locations_data as $location) {
        if ((count($locations_data) % 2) != 0) {
            if (count($locations_data) == $n_locations) {
                $custom_col = array(
                    "1" => "12",
                    "2" => "5",
                    "3" => "7"
                );
            }
        }
        if ($_SESSION["login_way"] != "no_login") {
            $ctm_function_images_locations = "modal_add_images('" . $location["idLocations"] . "', 4)";
        }
        $output_images_locations = '';
        $images_locations_data = $images_locations->get_images_by_locations($location["idLocations"]);
        if (count($images_locations_data) > 0) {
            $output_images_locations = '<ul class="ctm-list-inline" id="ctm-locations-gallery-' . $location["idLocations"] . '">';
            $i = count($images_locations_data) - 1;
            $output_images_locations_last = '</ul>
                                    <p class="text-center">
                                        <a href="' . BASE_URL . 'images/' . $images_locations_data[$i]["imagesName"] . '" class="btn btn-lg btn-block" data-gallery>' . translate("CONTENT_FILM_SEE_MORE_PICTURES") . '</a>
                                    </p>';
            for ($i; $i >= 0; $i--) {
                $output_images_locations .= '<li>'
                        . '<a href="' . BASE_URL . 'images/' . $images_locations_data[$i]["imagesName"] . '" data-gallery="ctm-locations-gallery-' . $location["idLocations"] . '">'
                        . '<img src="' . BASE_URL . 'images/thumbs/' . $images_locations_data[$i]["imagesName"] . '" alt="images location">'
                        . '</a></li>';
            }
            $output_images_locations = $output_images_locations . $output_images_locations_last;
        }
        $output .= '<div class="col-xs-12 col-md-' . $custom_col["1"] . ' ctm-movies-location">
                        <div class="row ctm-margin-right-left-0">
                        <script>
                            function initialize() {
                                var mapaOptions = {
                                    disableDefaultUI: true,
                                    zoomControl: true,
                                    streetViewControl: true,
                                    scrollwheel: false,
                                    zoom: 16,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                }
                                var mapa' . $n_locations . 'Canvas = document.getElementById("mapa' . $n_locations . '");
                                var mapalat' . $n_locations . ' = new google.maps.LatLng(' . $location["locations_x"] . ',' . $location["locations_y"] . ');
                                mapaOptions["center"] = mapalat' . $n_locations . ';
                                var mapa' . $n_locations . ' = new google.maps.Map(mapa' . $n_locations . 'Canvas, mapaOptions)
                                var marker' . $n_locations . ' = new google.maps.Marker({
                                    position: mapalat' . $n_locations . ',
                                    map: mapa' . $n_locations . '
                                });

                            }
                            google.maps.event.addDomListener(window, "load", initialize);
                        </script>
                        <div class="col-xs-12 ctm-movies-location-map" id="mapa' . $n_locations . '"></div>
                        <div class="col-xs-6 col-sm-5 col-md-' . $custom_col["2"] . ' pull-right ctm-movies-location-social">
                            <div class="row">
                                <div class="col-xs-12 hidden-xs ctm-btn-more">
                                    ' . $output_images_locations . '
                                </div>
                                <div class="col-xs-12">
                                    <ul class="list-unstyled pull-right">
                                        <li><a onclick="' . $ctm_function_images_locations . '"><img src="' . BASE_URL . 'img/movies/subir-foto-min.png"></a></li>
                                        <li class="visible-xs ctm-btn-more">
                                            <p class="text-center">
                                                <a href="#" class="btn btn-lg btn-block">' . translate("CONTENT_FILM_SEE_MORE_PICTURES") . '</a>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 ctm-padding-left-right-0">
                            <a href="' . generate_url("locations", $location["locations_url"]) . '">
                                <dl>
                                    <dt>' . $location["locations_name"] . '</dt>
                                    <dd>' . $location["locations_cities_name"] . ', ' . $location["locations_countries_name"] . '</dd>
                                </dl>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 hidden-xs ctm-btn-more">
                            <p class="text-center">
                                <a href="' . generate_url("locations", $location["locations_url"]) . '" class="btn btn-lg btn-block">' . translate("CONTENT_FILM_SEE_MORE") . '</a>
                            </p>
                        </div>
                    </div>
                </div>';
        $n_locations++;
    }
    return $output_wrap_init . $output . $output_wrap_end;
}

function get_location_info($id_location, $limit = false) {
    $location = new Locations();
    if (is_numeric($id_location)) {
        $locations_data = $location->get_locations_by("locations.id_location", $id_location);
    } else {
        $locations_data = $location->get_locations_by("locations.location", $id_location);
    }
    $output = '';
    $i = 0;
    $n_locations = 1;
    while ($i < count($locations_data)) {
        if ($i == (count($locations_data) - 1)) {
            $output = '<div class="col-xs-12 padding-right-left-0">
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
            //cafe de zurich
            var mapa9Canvas = document.getElementById("mapa9loc");
            var mapalat9 = new google.maps.LatLng(' . $locations_data[$i]["pointX"] . ', ' . $locations_data[$i]["pointY"] . ');
            mapaOptions["center"] = mapalat9;
            var mapa9 = new google.maps.Map(mapa9Canvas, mapaOptions)
            var marker9 = new google.maps.Marker({
                position: mapalat9,
                map: mapa9,
                title: "' . $locations_data[$i]["location"] . '"
            });
            
        }
        google.maps.event.addDomListener(window, "load", initialize);
    </script>
    <div id="mapa9loc" class="ctm-location-map"></div>
</div>
<div class="col-xs-12 ctm-location-info">
    <div class="container padding-right-left-0">
        <div class="row">
            <div class="col-xs-12 col-sm-9 ctm-title-header-place">
                <h1><strong><a href="' . generate_url("location", $locations_data[$i]["url"]) . '">' . $locations_data[$i]["location"] . '</a></strong></h1>
                <h3>(' . translate("CONTENT_LOCATION_FILMING") . ')</h3>
                <p>
                    <img src="' . BASE_URL . 'img/icono-lugares-blanco.png" alt="tack">
                    <strong>' . $n_locations . translate("SECTION_INFO_LOCATIONS_FILMS") . '</strong>
                </p>
            </div>
            <div class="col-xs-5 col-sm-3 ctm-tack-onplace">
                <a class="btn">
                    <img src="' . BASE_URL . 'img/icono-titulos.png" alt="He estado aqui" class="center-block" width="60"/>
                    <em class="text-center">' . translate("SECTION_INFO_TACK_ON") . '</em>
                </a>
            </div>
            <div class="col-xs-7 ctm-places-home-social-score">
                <ul class=" list-unstyled">
                    <li>
                        <ul class="list-inline">
                            <li><strong>' . translate("SECTION_INFO_RANK") . '</strong></li>
                            <li>
                                <img src="' . BASE_URL . 'img/icono-votacionA.png" alt="voto positivo" />
                                <img src="' . BASE_URL . 'img/icono-votacionA.png" alt="voto positivo" />
                                <img src="' . BASE_URL . 'img/icono-votacionA.png" alt="voto positivo" />
                                <img src="' . BASE_URL . 'img/icono-votacionB.png" alt="voto negativo" />
                                <img src="' . BASE_URL . 'img/icono-votacionB.png" alt="voto negativo" />
                                <em>(4 votos)</em>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item-text">
                        <ul class="list-inline">
                            <li class="list-group-item-text"><strong>' . translate("SECTION_INFO_SHARE") . '</strong></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/compartir-facebook.png" alt="facebook" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/compartir-twitter.png" alt="twitter" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/compartir-google.png" alt="gplus" /></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 hidden-xs hidden-sm ctm-places-social">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="center-block">' . translate("SECTION_INFO_SOCIAL_FRIENDS") . ' (26) <a href="#">' . translate("SECTION_INFO_SEE_ALL") . '</a></p>
                        <ul class="list-inline ctm-places-images-social">
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (1).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (2).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (3).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (4).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (5).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (6).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (7).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (8).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (9).jpg" alt="img1" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/profile_facebook/picture-profile-fb (10).jpg" alt="img1" class="img-responsive" /></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <p class="center-block">' . translate("SECTION_INFO_SOCIAL_IMG_USERS") . ' (15) <a href="#">' . translate("SECTION_INFO_SEE_ALL") . '</a></p>
                        <ul class="list-inline ctm-places-images-header">
                            <li><a href="#"><img src="' . BASE_URL . 'img/filming location/1.jpg" alt="images location" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/filming location/2.jpg" alt="images location" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/filming location/3.jpg" alt="images location" /></a></li>
                            <li><a href="#"><img src="' . BASE_URL . 'img/filming location/4.jpg" alt="images location" /></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
        }
        $i++;
        $n_locations++;
    }
    return $output;
}
