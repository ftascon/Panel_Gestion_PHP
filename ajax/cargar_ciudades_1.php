<?php

include "../includes/general_settings.php";
//print_r($_POST);
$cities = new cities();
$cities_data = $cities->get_cities_by_country($_POST["fk_id_country"]);
//print_r($cities_data);
$cities_list = "";
for($i=0; $i<count($cities_data); $i++){
    $cities_list .= '<option value="' . $cities_data[$i]["id_city"] . '">' . $cities_data[$i]["name_city"] . '</option>';
}
echo $cities_list;