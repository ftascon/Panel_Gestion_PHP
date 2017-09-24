<?php

include "../includes/general_settings.php";
switch ($_POST["from"]) {
    case "persona":
        $persona = new people();
        if ($imagen = $persona->set_image_persona($_FILES["newImage"], $_POST["id"])) {
            if (($_SESSION["user_data"]["id_user"]) == ($_POST["id"])) {
                $_SESSION["user_data"]["photo"] = $imagen;
            }
        } else {
            echo "Algo ha fallado, contacte con el administrador";
        }
        break;
    case "aula":
        $aulas = new aulas();
//        echo "asasdasd";
        if ($aulas->set_image_aula($_FILES["newImage"], $_POST["id"])) {
            echo true;
        } else {
            echo "Algo ha fallado, contacte con el administrador";
        }
        break;
    default:
        break;
}


    