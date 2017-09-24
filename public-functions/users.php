<?php

function get_users_profile($id_users) {
    $users = new Users();
    $users_data = $users->get_user_info_by_token($_SESSION["user"]["usersToken"]);
    if (($users_data["usersPhoto"] == 'http://www.filmaps.com/photosfb/.jpg') || !$users_data["usersPhoto"]) {
        $users_data["usersPhoto"] = BASE_URL . '/img/general/no-profile.png';
    }

    /* pelis vistas */
    $movies_seen_num = 0;
    $output_seen_movies = "";
    $output_more_seen_movies = "";
    $movies_seen = new MoviesUsers();
    $movies_seen_data = $movies_seen->get_movies_by_user($users_data["idUsers"]);
//    print_r($movies_seen_data);
    if (count($movies_seen_data) > 0) {
        for ($i = count($movies_seen_data) - 1; $i >= 0; $i--) {
            if (strlen($movies_seen_data[$i]["movies_poster"]) > 3) {
                $img_temp = "http://www.filmaps.com/nposters/" . $movies_seen_data[$i]["movies_poster"];
            } else {
                $img_temp = BASE_URL . '/img/movies/nocover.png';
            }
            $output_seen_movies .= "<li><a href='" . generate_url("movies", $movies_seen_data[$i]["movies_id"]) . "'>"
                    . "<img src='" . $img_temp . "' alt='" . $movies_seen_data[$i]["movies_name"] . "' class='img-responsive' />"
                    . "</a></li>";
        }
        if (count($movies_seen_data) > 5) {
            $output_more_seen_movies .= "<a class='text-center' id='ctm-btn-more-list' >" . translate("SECTION_PROFILE_MORE_SEEN_MOVIES") . "</a>";
        }
    } else {
        $output_seen_movies = "NADA";
    }
    /* pelis añadidas */
    $movies_added_num = 0;
    $output_added_num = "";
    $output_more_added_movies = "";
    $movies = new Movies();
    $movies_data = $movies->get_movies_added_user($users_data["idUsers"]);
    if (count($movies_data) > 0) {
        for ($i = count($movies_data) - 1; $i >= 0; $i--) {
            if (strlen($movies_data[$i]["movies_poster"]) > 3) {
                $img_temp = "http://www.filmaps.com/nposters/" . $movies_data[$i]["movies_poster"];
            } else {
                $img_temp = BASE_URL . '/img/movies/nocover.png';
            }
            $output_added_movies .= '<li style="color:#777">'
                    . '<a href="' . generate_url("movies", $movies_data[$i]["movies_id"]) . '">'
                    . '<img src="' . $img_temp . '" alt="' . $movies_data[$i]["movies_id"] . '" />'
                    . '</a></li>';
        }
        if (count($movies_data) > 5) {
            $output_more_added_movies .= "<a class='text-center' id='ctm-btn-more-list' >" . translate("SECTION_PROFILE_MORE_SEEN_MOVIES") . "</a>";
        }
        $movies_added_num = $i + 1;
    } else {
        $output_added_movies = "NADA";
    }

    /* places visited */
    $output_cities_visited = "";
    $cities_visited = new CitiesUsers();
    $cities_visited_data = $cities_visited->get_cities_by_user($users_data["idUsers"]);
    if (count($cities_visited_data) > 0) {
        for ($i = count($cities_visited_data) - 1; $i >= 0; $i--) {
            $output_cities_visited .= "<li><a href='" . generate_url("cities", $cities_visited_data[$i]["cities_id"]) . "'>" . $cities_visited_data[$i]["cities_name"] . "</a></li>";
        }
    } else {
        $output_cities_visited .= "NADA";
    }

    /* places visited */
    /* UPLOADED _IMAGES */
    $output_uploaded_images = "";
    $cities_images = new CitiesImages();
    $movies_images = new MoviesImages();
    $countries_images = new CountriesImages();
    $locations_images = new LocationsImages();
    /* imgs from cities */
    $cities_images_data = $cities_images->get_images_by_user($users_data["idUsers"]);
    /* imgs from countries */
    $countries_images_data = $countries_images->get_images_by_user($users_data["idUsers"]);
    /* imgs from movies */
    $movies_images_data = $movies_images->get_images_by_user($users_data["idUsers"]);
    /* imgs from locations */
    $locations_images_data = $locations_images->get_images_by_user($users_data["idUsers"]);
    $places_images = array_merge($cities_images_data, $countries_images_data, $movies_images_data, $locations_images_data);
    for ($i = count($places_images) - 1; $i >= 0; $i--) {
        $output_uploaded_images .= "<a href='" . BASE_URL . "images/" . $places_images[$i]["url_image"] . "' data-gallery>"
                . "<img src='" . BASE_URL . "images/thumbs/" . $places_images[$i]["url_image"] . "' alt='" . $places_images[$i]["place_name"] . "'>"
                . "</a>";
    }
    /* UPLOADED _IMAGES */
    return '<div class="row ctm-line">
    <div class="container">
        <h2 class="ctm-profile-icon">' . translate("STRUCTURE_PROFILE") . '</h2>
    </div>
</div>
<div class="row ctm-profile">
    <div class="container ctm-profile-content">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-lg-2 text-center">
                    <img src="' . $users_data["usersPhoto"] . '" class="img-responsive">
                </div>
                <div class="col-xs-12 col-sm-9">
                    <h2>' . $users_data["usersName"] . '</h2>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-sm-6 pull-left">
                    <h3>' . translate("SECTION_PROFILE_SEEN_MOVIES") . '</h3>
                    <ul class="list-inline">
                    ' . $output_seen_movies . '
                    </ul>
                    ' . $output_more_seen_movies . '
                </div>
                <div class="col-xs-12 col-sm-6 pull-right">
                    <h3>' . translate("SECTION_PROFILE_ADDED_MOVIES") . '</h3>
                    <ul class="list-inline">
                    ' . $output_added_movies . '
                    </ul>
                    ' . $output_more_added_movies . '
                </div>
                <div class="col-xs-12 col-sm-6 pull-right">
                    <h3>' . translate("SECTION_PROFILE_ADDED_LOCATIONS") . '</h3>

                </div>
                <div class="col-xs-12 col-sm-6 pull-left">
                    <h3>' . translate("SECTION_PROFILE_BEEN_PLACES") . '</h3>
                        <ul class="list-unstyled">
                    ' . $output_cities_visited . '
                        </ul>
                </div>
                <div class="col-xs-12 text-center">
                    <h3>' . translate("SECTION_PROFILE_ADDED_IMAGES") . '</h3>
                    <!-- The container for the list of example images -->
                    <div id="links" class="ctm-profiles-uploaded-images">
                    ' . $output_uploaded_images . '
                    </div>
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
                        <!-- The modal dialog, which will be used to wrap the lightbox content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
}
?>
<div class="row ctm-user-area">
    <div class="col-xs-12 ctm-padding-left-right-0">
        <div class="row ctm-user-area-general">
            <div class="col-xs-12 col-sm-4 ctm-user-area-photo">
                <i class="visible-xs">Hi, Danaeris4587!</i>
                <img src="/img/general/no-profile-true.PNG" class="img-responsive">
            </div>
        </div>
        <div class="row ctm-margin-right-left-0">
            <div class="col-xs-12 ctm-padding-left-right-0">
                <div class="ctm-user-area-statis">
                    <ul class="list-unstyled ">
                        <li><span>12</span> RANKING POSITION</li>
                        <li><span>2454</span> FILMAPS POINTS</li>
                    </ul>
                </div>
                <div class="ctm-user-area-icon">
                    <a href="#"><img src="/img/profile/user_color.png" alt="My profile"><span class="visible-md">MY PROFILE</span></a>
                </div>
                <div class="ctm-user-area-scale">
                    <p><strong>You are a gardener in the film set!</strong> <br /> You must keep working hard</p>   
                </div>
                <div class="ctm-user-area-statis-more">
                    <ul class="list-unstyled">
                        <li><span>45</span>REVIEWS</li>
                        <li><span>42</span>COMMENTS</li>
                        <li><span>87</span>LOCATIONS</li>
                        <li><span>8</span>LISTS</li>
                        <li><span>123</span>FOLLOWERS</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 ctm-user-area-fv">
        <ul class="list-inline">
            <li>FAVORITES</li>
            <li>
                <a href="#">
                    <img src="/img/profile/movies.png" class="img-responsive" />
                    <span class="hidden-xs">Movies</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/profile/reviews.png" class="img-responsive" />
                    <span class="hidden-xs">Reviews</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/profile/actors.png" class="img-responsive" />
                    <span class="hidden-xs">Actors</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/profile/locations.png" class="img-responsive" />
                    <span class="hidden-xs">Locations</span>
                </a>
            </li>
        </ul>
    </div>
</div>