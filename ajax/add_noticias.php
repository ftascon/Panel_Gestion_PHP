<?php

include "../includes/general_settings.php";
//session_start();
//print_r($_POST);
$noticias = new noticias();
$permisos = new noticias_people();
$noticias_aulas = new noticias_aulas();
$id = $_GET["id"];
if ($id == "-1") {
    //crear noticias_people 
    //crear noticias_aulas
//        print_r($_POST);
    date_default_timezone_set('Europe/Andorra');
    $_POST["fk_autor"] = $_SESSION["user_data"]["id_user"];
    $_POST["fecha_noticias"] = date("m/d/Y");
    $_POST["hora_noticias"] = date("H:i");
    /* creo la noticia */
    if ($res_noticia = $noticias->create($_POST)) {
        /* asigno permisos AULAS */
        for ($i = 0; $i < count($_POST["fk_aula"]); $i++) {
            $noticias_aulas->set_noticias_aulas($res_noticia, $_POST["fk_aula"][$i]);
        }
        /* asigno permisos PERSONAS */
        for ($i = 0; $i < count($_POST["noticias_people"]); $i++) {
            $res_permisos = $permisos->set_noticias_people($res_noticia, $_POST["noticias_people"][$i]);
        }
        header("Location: " . BASE_URL . "?noticia=" . $res_noticia);
    } else {
        header("Location: " . BASE_URL . "?lista_noticias&ko");
    }
} else {
    /* edito campos estaticos */
    $res_noticia = $noticias->edit($id, $_POST);

    /* borrom todos los permisos AULAS y los creo de nuevo */
    $noticias_aulas->rm_by_noticia($id);
    for ($i = 0; $i < count($_POST["fk_aula"]); $i++) {
        $noticias_aulas->set_noticias_aulas($id, $_POST["fk_aula"][$i]);
    }

    /* borro todos los permisos PERSONAS y los creo de nuevo */
    $permisos->rm_by_noticia($id);
    for ($i = 0; $i < count($_POST["noticias_people"]); $i++) {
        $res_permisos = $permisos->set_noticias_people($id, $_POST["noticias_people"][$i]);
    }
    if ($res_noticia) {
        $kok = "ok";
    } else {
        $kok = "ko";
    }
    header("Location: " . BASE_URL . "?edit_noticias=" . $id . "&" . $kok);
}
