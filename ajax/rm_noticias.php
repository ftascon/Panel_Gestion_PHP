<?php

include "../includes/general_settings.php";
//print_r($_POST);

$noticias = new noticias();
$noticias->remove($_GET["id"]);
$noticias_people = new noticias_people();
$noticias_people->rm_by_noticia($_GET["id"]);
$noticias_aulas = new noticias_aulas();
$noticias_aulas->rm_by_noticia($_GET["id"]);
header("Location: " . BASE_URL . "?lista_noticias");
