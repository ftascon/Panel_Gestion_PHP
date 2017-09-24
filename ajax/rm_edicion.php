<?php

function remove_edicion($id) {
    $ediciones = new ediciones();
//    echo $id;
    $ediciones->remove_edicion($id);
    header("Location: " . BASE_URL . "?ediciones&ok");
}
